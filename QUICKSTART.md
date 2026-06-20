📚 **ERP PETROLAB - MANAJEMEN ASET - QUICK START GUIDE**
============================================================

## ✅ Setup Status: COMPLETE

Database sudah dibuat, semua migrations applied, siap untuk development!

---

## 🚀 Mulai Development Dalam 2 Langkah

### Langkah 1: Terminal 1 - Frontend Server
```bash
cd e:\Capstone\ssmi-erp-project\apps\web\frontend\web
php -S localhost:8000
```

**Output akan terlihat:**
```
[Web Server running at localhost:8000]
```

**Buka Browser:** http://localhost:8000

---

### Langkah 2: Terminal 2 - Backend Server
```bash
cd e:\Capstone\ssmi-erp-project\apps\web\backend\web
php -S localhost:8001
```

**Output akan terlihat:**
```
[Web Server running at localhost:8001]
```

**Buka Browser:** http://localhost:8001

---

## 🌐 Access URLs

| Komponen | URL | Deskripsi |
|----------|-----|-----------|
| **Frontend** | http://localhost:8000 | User-facing application |
| **Backend** | http://localhost:8001 | Admin/Management Panel |
| **Database** | runtime/yii2_advanced.db | SQLite (file-based) |

---

## 📊 Components Deployed

✅ **Web Application** (Yii2 Advanced)
- Frontend (public interface)
- Backend (admin panel)
- Common utilities & models
- Console CLI commands

✅ **Database** (SQLite)
- User management
- Room/Asset management
- Schedule/Booking system

✅ **Documentation**
- COMPONENT_ANALYSIS.md - Detailed component breakdown
- LOCAL_SETUP_GUIDE.md - Complete setup instructions
- DEPLOYMENT_SUCCESS.md - Deployment status & fixes applied

---

## 🔧 Useful Commands

### View Database Migrations Applied:
```bash
cd e:\Capstone\ssmi-erp-project\apps\web
php yii migrate/history
```

### Apply New Migrations (if you add more):
```bash
cd e:\Capstone\ssmi-erp-project\apps\web
php yii migrate
```

### Reset Database (clear all tables):
```bash
cd e:\Capstone\ssmi-erp-project\apps\web
php yii migrate/down --all
php yii migrate
```

### Run Tests:
```bash
cd e:\Capstone\ssmi-erp-project\apps\web
codecept run
```

---

## 📝 Default Login Credentials

✅ **Default accounts already created:**

| Username | Password | Email | Role |
|----------|----------|-------|------|
| `admin` | `admin123` | admin@petrolab.com | Administrator |
| `manager` | `manager123` | manager@petrolab.com | Manager |
| `user` | `user123` | user@petrolab.com | User |

**👉 Use `admin` / `admin123` for full access**

---

## 🔐 Login Steps

1. **Start Backend Server** (Port 8001)
```bash
cd e:\Capstone\ssmi-erp-project\apps\web\backend\web
php -S localhost:8001
```

2. **Open Browser:** http://localhost:8001

3. **Enter Credentials:**
   - Username: `admin`
   - Password: `admin123`

4. **Click "Sign in"**

---

## 🌐 Components Deployed

### Manajemen Aset (Asset Management):
- ✅ Room/Asset listing
- ✅ Room capacity management
- ✅ Location tracking
- ✅ Status management

### Scheduling System:
- ✅ Book rooms/assets
- ✅ View schedules
- ✅ Approval workflow
- ✅ User affiliation tracking

---

## ⚠️ Known Limitations (SQLite for Local Dev)

- Foreign key constraints disabled (commented in migrations)
- Single-user development (no concurrent access)
- File-based database (not networked)

**Note:** For production, switch to MySQL/PostgreSQL!

---

## 🐛 Quick Troubleshooting

**Q: Port 8000/8001 already in use?**  
A: Change port number in command:
```bash
php -S localhost:9000    # Use different port
```

**Q: Cannot find migration files?**  
A: Ensure you're in correct directory:
```bash
cd e:\Capstone\ssmi-erp-project\apps\web
```

**Q: Database connection error?**  
A: Check database file exists:
```bash
Get-Item e:\Capstone\ssmi-erp-project\apps\web\runtime\yii2_advanced.db
```

**Q: "Class not found" errors?**  
A: Regenerate autoloader:
```bash
cd e:\Capstone\ssmi-erp-project\apps\web
composer dump-autoload
```

---

## 📚 Complete Documentation

- **Architecture:** [COMPONENT_ANALYSIS.md](./COMPONENT_ANALYSIS.md)
- **Setup Details:** [LOCAL_SETUP_GUIDE.md](./LOCAL_SETUP_GUIDE.md)
- **Deployment Report:** [DEPLOYMENT_SUCCESS.md](./DEPLOYMENT_SUCCESS.md)
- **Project Docs:** [./docs/](./docs/)

---

## ✨ Development Tips

1. **Hot Reload:** Browser auto-refreshes on file changes (if using hot reload tool)
2. **Debug Mode:** Already enabled in dev config (check gii, debug modules)
3. **Database Changes:** Create migrations for schema changes:
   ```bash
   php yii generate/migration create_your_table
   ```
4. **Asset Compilation:** Use Yii's asset bundle system (no webpack needed)

---

**🎉 Happy Coding! Selamat mengembangkan Manajemen Aset!**

*Last Updated: 12 Juni 2026 | Branch: feature/manajemen-aset*
