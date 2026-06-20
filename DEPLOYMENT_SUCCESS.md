# ✅ LOCAL DEPLOYMENT SUMMARY - ERP Petrolab

**Date:** 12 Juni 2026  
**Branch:** `feature/manajemen-aset`  
**Environment:** Local SQLite Development  
**Status:** ✅ **SUCCESSFULLY DEPLOYED**

---

## 📊 Deployment Artifacts

### ✅ Database
- **Location:** `apps/web/runtime/yii2_advanced.db`
- **Type:** SQLite 3
- **Size:** ~44 KB
- **Status:** Created & Initialized ✅

### ✅ Configuration Files
Created and configured for SQLite:
- ✅ `apps/web/backend/config/main-local.php`
- ✅ `apps/web/console/config/main-local.php`
- ✅ `apps/web/common/config/main-local.php`
- ✅ `apps/web/frontend/config/main-local.php` (copied)

### ✅ Runtime Directories
- ✅ `apps/web/runtime/` - Database & cache
- ✅ `apps/web/backend/runtime/` - Backend logs
- ✅ `apps/web/frontend/runtime/` - Frontend logs
- ✅ `apps/web/console/runtime/` - Console logs

### ✅ Dependencies
- ✅ Composer installed (56 packages)
- ✅ All bower-assets resolved
- ✅ Autoloader generated

---

## 🗄️ Database Schema

### Tables Created:
1. **`migration`** - Migration tracking table
2. **`user`** - User accounts & authentication
   - Columns: `id`, `username`, `email`, `password_hash`, `auth_key`, `verification_token`
3. **`room`** - Meeting rooms (untuk fitur manajemen aset)
   - Columns: `id`, `name`, `capacity`, `location`, `status`
4. **`schedule`** - Room booking/scheduling
   - Columns: `id`, `user_id`, `room_id`, `start_datetime`, `end_datetime`, `status_attendee`, `document`, `affiliation`, `reason_of_use`

### Migrations Applied:
```
✅ m130524_201442_init                          - Initialize user table
✅ m190124_110200_add_verification_token...    - Add verification token
✅ m250529_113845_create_room_table             - Create room table (asset management)
✅ m250529_114318_create_schedule_table         - Create schedule table
```

---

## 🛠️ Fixes Applied During Setup

### Issue 1: MySQL Default Configuration
**Problem:** Configuration files defaulted to MySQL  
**Solution:** Updated to SQLite for local development  
**Files Modified:**
- `common/config/main-local.php` - Changed DSN to sqlite
- `backend/config/main-local.php` - Added SQLite db config
- `console/config/main-local.php` - Added SQLite db config

### Issue 2: SQLite Incompatibility - ENUM Type
**Problem:** Migration used MySQL ENUM type not supported by SQLite  
**Solution:** Changed to VARCHAR with default value  
**File:** `console/migrations/m250529_114318_create_schedule_table.php`
- Changed: `ENUM('Approved', 'Denied', 'Processed')` 
- To: `string()->notNull()->defaultValue('Processed')`

### Issue 3: SQLite Doesn't Support addForeignKey
**Problem:** Foreign key constraints not supported by SQLite in Yii2  
**Solution:** Commented out foreign key operations  
**File:** `console/migrations/m250529_114318_create_schedule_table.php`
- Commented out: Foreign key adds/drops
- Note: For MySQL/PostgreSQL deployment, uncomment these

---

## 🚀 Quick Start Commands

### Start Frontend Server (Port 8000):
```bash
cd apps\web\frontend\web
php -S localhost:8000
```
Access: **http://localhost:8000**

### Start Backend Server (Port 8001):
```bash
cd apps\web\backend\web
php -S localhost:8001
```
Access: **http://localhost:8001** (Admin Panel)

### Verify Database Connection:
```bash
cd apps\web
php yii migrate/history
```

### View Database Tables:
```bash
# Using SQLite CLI (if installed)
sqlite3 runtime/yii2_advanced.db ".tables"
```

---

## 📋 Directory Structure (Post-Deployment)

```
apps/web/
├── runtime/
│   └── yii2_advanced.db           ✅ SQLite Database
├── backend/
│   ├── config/
│   │   ├── main-local.php         ✅ Configured
│   │   └── params-local.php       ✅ Copied
│   └── runtime/                   ✅ Created
├── frontend/
│   ├── config/
│   │   ├── main-local.php         ✅ Configured
│   │   └── params-local.php       ✅ Copied
│   └── runtime/                   ✅ Created
├── console/
│   ├── config/
│   │   ├── main-local.php         ✅ Configured
│   │   └── params-local.php       ✅ Copied
│   ├── migrations/                ✅ Fixed
│   └── runtime/                   ✅ Created
├── common/
│   ├── config/
│   │   ├── main-local.php         ✅ Configured
│   │   └── params-local.php       ✅ Copied
│   └── fixtures/                  ✅ Test data
├── vendor/                        ✅ Dependencies installed
└── composer.json                  ✅ Lock file valid
```

---

## 📊 Deployment Statistics

| Metric | Value |
|--------|-------|
| **Total Migrations** | 4 |
| **Successful** | 4 ✅ |
| **Failed** | 0 |
| **Tables Created** | 4 |
| **Config Files Created** | 6 |
| **Directories Created** | 4 |
| **Time to Complete** | ~2 minutes |

---

## ⚠️ Important Notes

### For SQLite Development:
✅ **No MySQL required** - Database is file-based (`runtime/yii2_advanced.db`)  
✅ **Portable** - Can be version controlled (but currently .gitignored)  
✅ **Performance** - Suitable for development, not production  

### For Production Deployment (MySQL/PostgreSQL):
1. Uncomment foreign key constraints in migration files
2. Update config to use MySQL/PostgreSQL DSN
3. Update database connection settings
4. Run migrations again

### Sample MySQL Config:
```php
'db' => [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2advanced;charset=utf8mb4',
    'username' => 'yii2advanced',
    'password' => 'secret',
    'charset' => 'utf8mb4',
],
```

---

## 🔐 Security Notes

- ✅ Cookie validation key set to `dev-secret-key-change-in-production`
- ✅ Database file permissions: Default (restricted to current user)
- ⚠️ **DO NOT** commit main-local.php files with real passwords
- ⚠️ Change cookie key before production deployment

---

## 📚 Next Steps

1. **Start Development Servers** (see Quick Start above)
2. **Test Login Functionality**
   - Default credentials (check fixtures or documentation)
3. **Explore Manajemen Asset Features**
   - Room listing, scheduling, etc.
4. **Run Tests** (if test database needed)
   ```bash
   php yii_test migrate
   codecept run
   ```

---

## 🆘 Troubleshooting

### Issue: Cannot write to database
**Solution:** Ensure write permissions on `runtime/` directory
```bash
icacls "runtime" /grant %USERNAME%:F /T
```

### Issue: "SQLSTATE[HY000] [14] unable to open database file"
**Solution:** Recreate runtime directory and database
```bash
Remove-Item runtime/yii2_advanced.db
php yii migrate
```

### Issue: Missing migration files
**Solution:** Verify migration path
```bash
ls console/migrations/
```

---

## ✅ Deployment Checklist

- [x] Repository cloned
- [x] Branch: feature/manajemen-aset active
- [x] PHP 8.3 verified
- [x] Composer dependencies installed
- [x] Configuration files created
- [x] Database SQLite configured
- [x] Runtime directories created
- [x] All 4 migrations applied successfully
- [x] Migration files fixed for SQLite
- [x] Frontend & Backend ready for development
- [x] Documentation created

---

## 📞 Support

- **Framework Docs:** https://www.yiiframework.com/doc/guide/2.0/en
- **SQLite Docs:** https://www.sqlite.org/
- **Project Docs:** Check `/docs/` folder in project

---

**Status: READY FOR LOCAL DEVELOPMENT** ✅  
**Last Updated:** 12 Juni 2026  
**Branch:** feature/manajemen-aset
