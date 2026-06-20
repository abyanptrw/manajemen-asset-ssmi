# Local Deployment Setup Guide - ERP Petrolab

## 🚀 Quick Start (5 menit)

### Prerequisite Check
```bash
# Verify installed tools
php --version          # Should be >= 7.4
composer --version     # Should be installed
```

---

## Option A: Local Development (WITHOUT Docker/MySQL)

Gunakan built-in PHP server dan SQLite untuk quick testing.

### Step 1: Navigate to project
```bash
cd e:\Capstone\ssmi-erp-project\apps\web
```

### Step 2: Create environment configuration files

Copy template files:
```bash
# For Backend
copy environments\dev\backend\config\main-local.php backend\config\main-local.php
copy environments\dev\backend\config\params-local.php backend\config\params-local.php
copy environments\dev\backend\config\test-local.php backend\config\test-local.php

# For Frontend
copy environments\dev\frontend\config\main-local.php frontend\config\main-local.php
copy environments\dev\frontend\config\params-local.php frontend\config\params-local.php

# For Console
copy environments\dev\console\config\main-local.php console\config\main-local.php
copy environments\dev\console\config\params-local.php console\config\params-local.php

# For Common
copy environments\dev\common\config\main-local.php common\config\main-local.php
copy environments\dev\common\config\params-local.php common\config\params-local.php
```

### Step 3: Modify database configuration (SQLite)

Edit `backend/config/main-local.php`:
```php
<?php
$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:' . dirname(__DIR__) . '/../runtime/yii2_advanced.db',
            'emulatePrepare' => true,
            'charset' => 'utf8',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // This is non-test configuration for backend
}

return $config;
```

Edit `console/config/main-local.php`:
```php
<?php
$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:' . dirname(__DIR__) . '/../runtime/yii2_advanced.db',
            'emulatePrepare' => true,
            'charset' => 'utf8',
        ],
    ],
];

return $config;
```

### Step 4: Initialize project
```bash
# Interactive initialization (choose Development)
php init

# Or non-interactive:
php init --env=Development --overwrite=y
```

### Step 5: Create database and run migrations
```bash
# Run all migrations
php yii migrate

# Create directories if not exist
mkdir -p backend\runtime
mkdir -p frontend\runtime
mkdir -p console\runtime
```

### Step 6: Start development servers

**Terminal 1 - Frontend Server:**
```bash
cd frontend\web
php -S localhost:8000
# Access: http://localhost:8000
```

**Terminal 2 - Backend Server:**
```bash
cd backend\web
php -S localhost:8001
# Access: http://localhost:8001
```

### Step 7: Test access
- Frontend: `http://localhost:8000`
- Backend: `http://localhost:8001` (admin panel)
- Default credentials: Check `common/fixtures/` or documentation

---

## Option B: Setup with MySQL Server

### Step 1: Install MySQL/MariaDB

**Windows - Using Installer:**
1. Download: https://dev.mysql.com/downloads/mysql/
2. Run installer
3. Note: hostname, username, password

**Windows - Using Chocolatey:**
```powershell
choco install mysql
```

**Windows - Using MariaDB:**
```powershell
choco install mariadb
```

### Step 2: Create database
```bash
# Login to MySQL
mysql -u root -p

# Create database & user
CREATE DATABASE yii2advanced;
CREATE DATABASE yii2advanced_test;
CREATE USER 'yii2advanced'@'localhost' IDENTIFIED BY 'secret';
GRANT ALL PRIVILEGES ON yii2advanced.* TO 'yii2advanced'@'localhost';
GRANT ALL PRIVILEGES ON yii2advanced_test.* TO 'yii2advanced'@'localhost';
FLUSH PRIVILEGES;
```

### Step 3: Update database config

Edit `backend/config/main-local.php`:
```php
<?php
$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced;charset=utf8mb4',
            'username' => 'yii2advanced',
            'password' => 'secret',
            'charset' => 'utf8mb4',
        ],
    ],
];

return $config;
```

Do same for `console/config/main-local.php`

### Step 4: Initialize and migrate
```bash
php init --env=Development --overwrite=y
php yii migrate
php yii_test migrate
```

### Step 5: Start servers
```bash
# Terminal 1
cd frontend\web && php -S localhost:8000

# Terminal 2
cd backend\web && php -S localhost:8001
```

---

## Option C: Using Docker Compose

### Step 1: Install Docker Desktop
- Download from: https://www.docker.com/products/docker-desktop
- Run installer & restart

### Step 2: Start containers
```bash
cd apps\web
docker-compose up -d
```

### Step 3: Access services
- Frontend: `http://localhost:20080`
- Backend: `http://localhost:21080`
- MySQL: `localhost:3306` (user: yii2advanced, pass: secret)

### Step 4: Run migrations
```bash
# Enter backend container
docker-compose exec backend bash

# Inside container:
php yii migrate
exit
```

### Step 5: Stop containers
```bash
docker-compose down
```

---

## Option D: Using Vagrant

### Step 1: Install requirements
```bash
# Download VirtualBox: https://www.virtualbox.org/
# Download Vagrant: https://www.vagrantup.com/
# Install both

vagrant --version
```

### Step 2: Create vagrant config
```bash
cd apps/web/vagrant/config
copy vagrant-local.example.yml vagrant-local.yml

# Edit vagrant-local.yml and add GitHub token (40 characters)
```

### Step 3: Start Vagrant VM
```bash
cd apps/web
vagrant up
# Will provision Ubuntu 18.04 with all dependencies

# Wait 15-20 minutes for first setup
```

### Step 4: Access via browser
- Frontend: `http://y2aa-frontend.test`
- Backend: `http://y2aa-backend.test`

### Step 5: SSH into VM
```bash
vagrant ssh

# Inside VM, navigate to app:
app    # alias untuk cd /app
php yii migrate
```

### Step 6: Stop Vagrant
```bash
vagrant halt

# Or destroy:
vagrant destroy
```

---

## 🧪 Running Tests

### Setup Test Database
```bash
# If using MySQL
mysql> CREATE DATABASE yii2advanced_test;

# Run test migrations
php yii_test migrate
```

### Run Tests with Codeception
```bash
# All tests
codecept run

# Specific test suite
codecept run unit       # Unit tests
codecept run functional # Functional tests
codecept run acceptance # Acceptance tests
```

### Run Tests with PHPUnit
```bash
# All tests
vendor\bin\phpunit

# Specific test file
vendor\bin\phpunit tests\unit\models\UserTest.php
```

---

## 🐛 Troubleshooting

### Issue: "SQLSTATE[HY000] [2002] No such file or directory"
**Solution:** Database not running. Start MySQL/MariaDB or switch to SQLite.

### Issue: "Permission denied" on migrations
**Solution:** Check directory permissions:
```bash
chmod -R 755 backend/runtime
chmod -R 755 frontend/runtime
chmod -R 755 console/runtime
```

### Issue: "Class not found" errors
**Solution:** Regenerate autoloader:
```bash
composer dump-autoload
```

### Issue: "No route matches"
**Solution:** Ensure web server is serving from correct folder:
- Frontend: `frontend/web/`
- Backend: `backend/web/`

### Issue: xdebug/pcntl warnings
**Solution:** These are optional. Ignore if not needed for development.

---

## 📋 Project File Structure

```
apps/web/
├── backend/              # Admin panel application
│   ├── config/          # Backend configuration
│   ├── controllers/     # Backend controllers
│   ├── models/          # Backend models
│   ├── views/           # Backend templates
│   └── web/             # Web root (index.php)
│
├── frontend/             # User-facing application
│   ├── config/          # Frontend configuration
│   ├── controllers/     # Frontend controllers
│   ├── models/          # Frontend models
│   ├── views/           # Frontend templates
│   └── web/             # Web root (index.php)
│
├── common/              # Shared code
│   ├── config/          # Shared configuration
│   ├── models/          # Shared models (User, Post, etc.)
│   ├── widgets/         # Reusable widgets
│   ├── mail/            # Email templates
│   └── fixtures/        # Test data
│
├── console/             # Console application
│   ├── controllers/     # Console commands
│   └── migrations/      # Database migrations
│
├── environments/        # Environment templates
│   ├── dev/            # Development settings
│   └── prod/           # Production settings
│
├── vendor/             # Composer dependencies
├── composer.json       # Project dependencies
└── docker-compose.yml  # Docker configuration
```

---

## ✅ Verification Checklist

After setup, verify:

```bash
# 1. Check dependencies
php requirements.php
# All "OK" except warnings

# 2. Check database connection
php -r "require_once 'vendor/autoload.php'; require_once 'common/config/bootstrap.php'; echo 'Database: ' . Yii::$app->db->driverName;"

# 3. List migrations
php yii migrate/up --trace=0

# 4. Check assets
ls -la backend/web/assets/
ls -la frontend/web/assets/

# 5. Run simple test
php -S localhost:8000 -t frontend/web &
# Open browser: http://localhost:8000
# Should see login page or home page
```

---

## 📞 Need Help?

- **Yii2 Documentation:** https://www.yiiframework.com/doc/guide/2.0/en
- **Framework Issues:** https://github.com/yiisoft/yii2/issues
- **Local Project Docs:** Check `/docs/` folder

---

**Last Updated:** 12 Juni 2026  
**Branch:** feature/manajemen-aset  
**Status:** ✅ Ready for local development
