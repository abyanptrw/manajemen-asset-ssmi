# Analisis Komponen ERP Petrolab - Branch Feature/Manajemen-Aset

**Tanggal Analisis:** 12 Juni 2026  
**Branch:** `feature/manajemen-aset`  
**Status:** ✅ Repository sudah dipindahkan ke branch manajemen-aset

---

## 📋 Ringkasan Eksekutif

Project **ERP Petrolab** (Digitalisasi United Tractor) adalah aplikasi enterprise berbasis web yang menggunakan:
- **Backend/Frontend Web:** Yii2 Framework (PHP) - Advanced Template
- **Mobile:** Flutter/Dart (placeholder)
- **API:** REST API Service (placeholder)
- **IoT Module:** IoT Integration (placeholder)
- **RBAC:** Role-Based Access Control Module (placeholder)
- **Database:** MySQL 5.7 / MariaDB
- **Infrastructure:** Docker Compose, Vagrant, Terraform, Helm Charts

---

## 🗂️ Struktur Komponen Utama

### 1. **apps/web/** - Aplikasi Web Utama (Yii2 Advanced)

#### Teknologi Stack:
```
Framework:    Yii2 ~2.0.45
PHP Version:  >= 7.4.0 (saat ini test dengan PHP 8.3)
Package Mgmt: Composer
Database:     MySQL 5.7 / PostgreSQL 9.5
UI Framework: Bootstrap 5
JavaScript:   jQuery 3.7.1
CSS:          Bootstrap 5 + Custom CSS
```

#### Sub-Komponen:

**a) Backend (`backend/`)**
- **Port:** 21080 (via docker-compose)
- **Teknologi:** Yii2 MVC Web Application
- **Fitur:**
  - Admin Dashboard
  - User Management
  - Module Management
  - Database Schema Migration
  - RESTful API Endpoints
  - Codeception Testing

**b) Frontend (`frontend/`)**
- **Port:** 20080 (via docker-compose)
- **Teknologi:** Yii2 Web Application
- **Fitur:**
  - User-facing Web Interface
  - Authentication/Login
  - Contact/Support Pages
  - Asset Management Interface
  - Dashboard

**c) Common (`common/`)**
- **Fungsi:** Shared components untuk backend & frontend
- **Konten:**
  - Models (Database Models)
  - Fixtures (Test Data)
  - Widgets (Reusable UI Components)
  - Config (Shared Configuration)
  - Firebase Integration (Email/Auth)
  - Testing Support

**d) Console (`console/`)**
- **Fungsi:** CLI Commands untuk automation
- **Konten:**
  - Database Migrations
  - Console Commands
  - Scheduled Tasks
  - Batch Processing

#### Database Schema:
- **Migrations:** Terletak di `console/migrations/`
- **Models:** Terletak di `backend/models/`, `frontend/models/`, `common/models/`
- **Fixtures:** Terletak di `common/fixtures/` untuk testing

#### Dependencies Penting:
```json
{
  "yiisoft/yii2": "~2.0.45",
  "yiisoft/yii2-bootstrap5": "~2.0.2",
  "yiisoft/yii2-symfonymailer": "~2.0.3",
  "yiisoft/yii2-debug": "~2.1.0",
  "yiisoft/yii2-gii": "~2.2.0",
  "codeception/codeception": "^5.0.0 || ^4.0",
  "phpunit/phpunit": "~9.5.0"
}
```

---

### 2. **apps/api/** - REST API Service
- **Status:** Placeholder (dokumentasi saja)
- **Tujuan:** REST API untuk koneksi aplikasi eksternal
- **Rencana:** Will be implemented in future phases

---

### 3. **apps/iot/** - IoT Integration Module
- **Status:** Placeholder
- **Tujuan:** Integrasi dengan perangkat IoT (sensors, monitoring)
- **Rencana:** Will be implemented in future phases

---

### 4. **apps/rbac/** - Role-Based Access Control
- **Status:** Placeholder
- **Tujuan:** Manajemen Permission dan Role untuk aplikasi
- **Rencana:** Will be integrated into Yii2 framework

---

### 5. **docs/** - Dokumentasi Lengkap

#### Sub-Folder:
- **api-specs/** - Dokumentasi API (Swagger/OpenAPI, Postman collections)
- **architecture.md, arch-overview.md** - Arsitektur sistem
- **standard-docs/** - Dokumentasi standar project (BRD, URS, SRS, SDP, SDD, etc.)
- **tech-docs/** - Dokumentasi teknis (UML, BPMN, DFD, ERD, Mockup)
- **user-manual/** - Panduan pengguna (User Documentation)
- **releases/** - Release notes dan changelog

---

### 6. **infra/** - Infrastructure & Deployment

#### Sub-Komponen:

**a) Docker (`infra/docker/`)**
- **File:** `docker-compose.yml` di root web
- **Services:**
  ```yaml
  frontend:
    build: frontend
    ports: 20080:80
  backend:
    build: backend
    ports: 21080:80
  mysql:
    image: mysql:5.7
    ports: 3306:3306
  ```

**b) Vagrant (`infra/docker/` - Vagrantfile)**
- **OS:** Ubuntu 18.04
- **Features:**
  - PHP 7.4 + FPM
  - NGINX Web Server
  - MySQL 5.7
  - Composer
  - Xdebug untuk debugging
  - Host entries management

**c) Terraform (`infra/terraform/`)**
- Untuk infrastructure provisioning di cloud

**d) Helm Charts (`infra/helm-chart/`)**
- Untuk Kubernetes deployment

**e) Firebase (`infra/firebase/`)**
- Firebase configuration untuk hosting/authentication

---

### 7. **tests/** - Testing Structure

#### Test Categories:
- **api/** - API endpoint tests
- **backend/** - Backend application tests
- **frontend/** - Frontend application tests
- **integration/** - Integration tests antar komponen
- **iot/** - IoT module tests
- **mobile/** - Mobile application tests
- **rbac/** - RBAC permission tests
- **unit/** - Unit tests

#### Testing Framework:
- **Codeception** untuk acceptance & functional tests
- **PHPUnit** untuk unit tests

---

## 🔧 Requirement Checks

### System Requirements Status:

| Requirement | Status | Note |
|------------|--------|------|
| PHP 7.4+ | ✅ OK | PHP 8.3.31 sudah terinstall |
| Reflection | ✅ OK | |
| PCRE | ✅ OK | |
| SPL | ✅ OK | |
| MBString | ✅ OK | |
| OpenSSL | ✅ OK | |
| Intl | ✅ OK | |
| DOM | ✅ OK | |
| PDO | ✅ OK | |
| PDO MySQL | ✅ OK | |
| GD Extension | ✅ OK | |
| Composer | ✅ OK | Composer 2.8.1 terinstall |
| MySQL/MariaDB | ⚠️ NOT INSTALLED | Perlu diinstall untuk production |
| Docker | ⚠️ NOT INSTALLED | Optional, bisa skip untuk development |
| Vagrant | ⚠️ NOT INSTALLED | Optional alternative deployment |

### Warnings (Optional untuk Development):
- `pcntl` - Recommended untuk queue processing
- `memcache` - Optional caching layer
- `ImageMagick` - Optional (GD sudah cukup)

---

## 📦 Dependencies Status

Semua PHP dependencies sudah terinstall via Composer:
- ✅ 56 packages ready to use
- ✅ Autoloader generated
- ✅ All bower-assets resolved (Bootstrap 5, jQuery, etc.)

---

## 🚀 Deployment Options

### Option 1: Docker Compose (Recommended - Terstruktur)
```bash
cd apps/web
docker-compose up -d
# Frontend: http://localhost:20080
# Backend:  http://localhost:21080
# MySQL:    localhost:3306
```
**Kebutuhan:** Docker Desktop installed

### Option 2: Vagrant (VM-based)
```bash
cd apps/web
vagrant up
# Akan provision Ubuntu 18.04 VM dengan semua tools
```
**Kebutuhan:** VirtualBox + Vagrant plugins

### Option 3: Local Development (Manual)
```bash
cd apps/web
# Setup PHP built-in server & manually run migrations
php -S localhost:8000 -t frontend/web
php -S localhost:8001 -t backend/web
# Manual MySQL setup
```
**Kebutuhan:** PHP CLI + MySQL server running

### Option 4: Helm + Kubernetes (Production)
```bash
helm install erp-petrolab infra/helm-chart/
```
**Kebutuhan:** Kubernetes cluster + Helm CLI

---

## 📊 Project Metrics

| Metrik | Nilai |
|--------|-------|
| PHP Files | Ratusan (vendor excluded) |
| Total Packages | 56+ composer packages |
| Lines of Code | ~50K+ (estimated, excluding vendor) |
| Test Files | Multiple (Codeception + PHPUnit) |
| Configuration Files | 10+ (dev/prod environments) |
| Documentation Files | 20+ markdown files |

---

## 🔐 Security Considerations

1. **Database Credentials** - Stored in `-local.php` files (gitignored)
2. **Environment Variables** - dev/prod separation via `environments/`
3. **Auth Methods:**
   - Yii2 built-in authentication
   - Firebase integration ready (in common/firebase/)
   - RBAC planned in apps/rbac/
   - SSO ready (mentioned in project goal)

---

## 🎯 Branch Naming Convention

Berdasarkan README:
```
main              → Stable, production-ready version
feature/*         → New features (e.g., feature/manajemen-aset)
bugfix/*          → Bug fixes
hotfix/*          → Emergency hotfixes
develop           → Development branch
release/*         → Release preparation
```

**Current:** `feature/manajemen-aset` - Development fitur manajemen asset

---

## ✅ Setup Checklist untuk Local Development

- [x] Clone repository
- [x] Switch ke branch `feature/manajemen-aset`
- [x] Verify PHP 8.3 + Composer installed
- [x] Run `composer install` in apps/web/
- [x] Verify system requirements (php requirements.php)
- [ ] Setup database (MySQL/SQLite)
- [ ] Run `./init` script untuk development
- [ ] Create main-local.php config files
- [ ] Run migrations
- [ ] Start development servers
- [ ] Test both frontend & backend

---

## 📝 Catatan Penting

1. **Node/JavaScript Build:** Tidak ada webpack/npm configuration terlihat
   - Assets mungkin menggunakan Yii Asset Bundle system
   - Bootstrap 5 + jQuery via Composer bower-asset

2. **Environment Files:**
   - `.env` files recommended (bisa tambah ke project)
   - Currently using `-local.php` pattern

3. **Testing:**
   - Codeception untuk automated testing
   - Can run via `codecept run`

4. **Migrasi Database:**
   - Using Yii migrations (`console/migrations/`)
   - Run via: `./yii migrate` (console app)

5. **Frontend/Backend Separation:**
   - Sudah completely separated
   - Different entry points, controllers, views
   - Shared models via `common/`

---

**Status Deployment:** READY untuk Local Development Setup  
**Next Step:** Konfigurasi Database & Run Init Script
