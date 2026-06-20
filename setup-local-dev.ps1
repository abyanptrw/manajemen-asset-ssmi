# ERP Petrolab - Local Development Setup Script
# For: Windows PowerShell
# Usage: .\setup-local-dev.ps1 -Environment sqlite
#        .\setup-local-dev.ps1 -Environment mysql

param(
    [ValidateSet('sqlite', 'mysql')]
    [string]$Environment = 'sqlite',
    
    [string]$ProjectPath = ".\manajemen_aset"
)

$ErrorActionPreference = 'Stop'

Write-Host "=======================================================================" -ForegroundColor Cyan
Write-Host "  ERP Petrolab - Local Development Setup" -ForegroundColor Yellow
Write-Host "=======================================================================" -ForegroundColor Cyan
Write-Host ""

# Check if project path exists
if (-not (Test-Path $ProjectPath)) {
    Write-Host "[X] Project path not found: $ProjectPath" -ForegroundColor Red
    exit 1
}

Write-Host "[*] Project Path: $ProjectPath" -ForegroundColor Green
Write-Host "[*] Environment: $Environment" -ForegroundColor Green
Write-Host ""

# Change to project directory
Push-Location $ProjectPath

try {
    # ===== Step 1: Check Prerequisites =====
    Write-Host "Step 1: Verifying prerequisites..." -ForegroundColor Cyan
    
    $phpVersion = (php -v 2>&1)[0]
    if ($LASTEXITCODE -ne 0) {
        Write-Host "[X] PHP not found. Please install PHP 7.4+" -ForegroundColor Red
        exit 1
    }
    Write-Host "  [+] PHP: $phpVersion" -ForegroundColor Green
    
    $composerVersion = (composer --version 2>&1)[0]
    if ($LASTEXITCODE -ne 0) {
        Write-Host "[X] Composer not found. Please install Composer" -ForegroundColor Red
        exit 1
    }
    Write-Host "  [+] Composer: $composerVersion" -ForegroundColor Green
    
    Write-Host ""
    
    # ===== Step 2: Install Dependencies =====
    Write-Host "Step 2: Installing Composer dependencies..." -ForegroundColor Cyan
    
    if (Test-Path "vendor" -PathType Container) {
        Write-Host "  [i] vendor/ folder already exists, skipping..." -ForegroundColor Yellow
    } else {
        Write-Host "  Installing packages (this may take a few minutes)..." -ForegroundColor Gray
        & composer install --no-interaction 2>&1 | Out-Null
        
        if ($LASTEXITCODE -ne 0) {
            Write-Host "[X] Composer install failed" -ForegroundColor Red
            exit 1
        }
        Write-Host "  [+] Composer dependencies installed" -ForegroundColor Green
    }
    
    Write-Host ""
    
    # ===== Step 3: Initialize Project =====
    Write-Host "Step 3: Initializing project..." -ForegroundColor Cyan
    
    Write-Host "  Running initialization..." -ForegroundColor Gray
    & php init --env=Development --overwrite=y 2>&1 | Out-Null
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host "  [+] Project initialized" -ForegroundColor Green
    } else {
        Write-Host "  [!] Initialization had issues, continuing..." -ForegroundColor Yellow
    }
    
    Write-Host ""
    
    # ===== Step 4: Create Runtime Directories =====
    Write-Host "Step 4: Creating runtime directories..." -ForegroundColor Cyan
    
    $runtimeDirs = @(
        "backend\runtime",
        "frontend\runtime", 
        "console\runtime"
    )
    
    foreach ($dir in $runtimeDirs) {
        if (-not (Test-Path $dir -PathType Container)) {
            New-Item -Path $dir -ItemType Directory | Out-Null
            Write-Host "  [+] Created: $dir" -ForegroundColor Green
        } else {
            Write-Host "  [i] Already exists: $dir" -ForegroundColor Yellow
        }
    }
    
    Write-Host ""
    
    # ===== Step 5: Setup Database Config =====
    Write-Host "Step 5: Setting up database configuration ($Environment)..." -ForegroundColor Cyan
    
    $mainLocalPath = "common\config\main-local.php"
    
    if ($Environment -eq 'sqlite') {
        # Create SQLite database config
        $sqliteConfig = '<?php
return [
    "components" => [
        "db" => [
            "class" => \yii\db\Connection::class,
            "dsn" => "sqlite:" . dirname(dirname(__DIR__)) . "/backend/runtime/manajemen_aset.db",
            "emulatePrepare" => true,
            "charset" => "utf8",
        ],
        "mailer" => [
            "class" => \yii\symfonymailer\Mailer::class,
            "viewPath" => "@common/mail",
            "useFileTransport" => true,
        ],
    ],
];'
        
        Set-Content -Path $mainLocalPath -Value $sqliteConfig
        Write-Host "  [+] SQLite database configured (backend/runtime/manajemen_aset.db)" -ForegroundColor Green
        
        Write-Host ""
        Write-Host "Step 6: Running database migrations (Import SQLite)..." -ForegroundColor Cyan
        
        if (Test-Path "import_sqlite.php") {
            Write-Host "  Running: php import_sqlite.php..." -ForegroundColor Gray
            & php import_sqlite.php 2>&1
            Write-Host "  [+] SQLite initial data imported" -ForegroundColor Green
        } else {
            Write-Host "  [!] import_sqlite.php not found. Falling back to yii migrate." -ForegroundColor Yellow
            & php yii migrate --interactive=0 2>&1
        }
        
    } elseif ($Environment -eq 'mysql') {
        # Create MySQL database config
        $mysqlConfig = '<?php
return [
    "components" => [
        "db" => [
            "class" => \yii\db\Connection::class,
            "dsn" => "mysql:host=localhost;dbname=yii2advanced",
            "username" => "yii2advanced",
            "password" => "secret",
            "charset" => "utf8mb4",
        ],
        "mailer" => [
            "class" => \yii\symfonymailer\Mailer::class,
            "viewPath" => "@common/mail",
            "useFileTransport" => true,
        ],
    ],
];'
        
        Set-Content -Path $mainLocalPath -Value $mysqlConfig
        
        Write-Host "  [!] MySQL configuration set (host: localhost, user: yii2advanced)" -ForegroundColor Yellow
        Write-Host "  [!] Make sure MySQL is running and database exists!" -ForegroundColor Yellow
        
        Write-Host ""
        Write-Host "Step 6: Running database migrations..." -ForegroundColor Cyan
        Write-Host "  Running: php yii migrate..." -ForegroundColor Gray
        
        & php yii migrate --interactive=0 2>&1
        
        if ($LASTEXITCODE -eq 0) {
            Write-Host "  [+] Migrations completed" -ForegroundColor Green
        } else {
            Write-Host "  [!] Migrations had issues (database may not exist yet)" -ForegroundColor Yellow
        }
    }
    
    Write-Host ""
    
    # ===== Final Summary =====
    Write-Host "=======================================================================" -ForegroundColor Cyan
    Write-Host "  [+] SETUP COMPLETE!" -ForegroundColor Green
    Write-Host "=======================================================================" -ForegroundColor Cyan
    Write-Host ""
    
    Write-Host ">> To start development servers, run:" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "  Terminal 1 (Frontend):" -ForegroundColor Cyan
    Write-Host "    cd manajemen_aset\frontend\web" -ForegroundColor Gray
    Write-Host "    php -S localhost:8000" -ForegroundColor Gray
    Write-Host ""
    Write-Host "  Terminal 2 (Backend):" -ForegroundColor Cyan
    Write-Host "    cd manajemen_aset\backend\web" -ForegroundColor Gray
    Write-Host "    php -S localhost:8001" -ForegroundColor Gray
    Write-Host ""
    
    Write-Host ">> Access URLs:" -ForegroundColor Yellow
    Write-Host "  Frontend: http://localhost:8000" -ForegroundColor Green
    Write-Host "  Backend:  http://localhost:8001" -ForegroundColor Green
    Write-Host ""
    
} catch {
    Write-Host "[X] Error: $_" -ForegroundColor Red
    exit 1
} finally {
    Pop-Location
}
