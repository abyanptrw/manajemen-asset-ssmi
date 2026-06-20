# 🔐 LOGIN CREDENTIALS - ERP Petrolab Backend

**Status:** ✅ Default users created and verified

---

## 📝 Available Accounts

### Account 1: Administrator
| Field | Value |
|-------|-------|
| **Username** | `admin` |
| **Password** | `admin123` |
| **Email** | admin@petrolab.com |
| **Status** | ACTIVE ✅ |
| **Role** | Full access (Administrator) |

### Account 2: Manager
| Field | Value |
|-------|-------|
| **Username** | `manager` |
| **Password** | `manager123` |
| **Email** | manager@petrolab.com |
| **Status** | ACTIVE ✅ |
| **Role** | Manager access |

### Account 3: Regular User
| Field | Value |
|-------|-------|
| **Username** | `user` |
| **Password** | `user123` |
| **Email** | user@petrolab.com |
| **Status** | ACTIVE ✅ |
| **Role** | User access |

---

## 🌐 Backend Access

**URL:** `http://localhost:8001`

**Steps to Login:**
1. Open http://localhost:8001 in browser
2. You'll see login form
3. Enter username and password (use one of accounts above)
4. Click "Sign in"
5. You'll be redirected to dashboard

---

## 🎯 Recommended for Development

**Use:** `admin` / `admin123`
- Full access to all features
- Can manage users, assets, schedules
- Can access all modules

**Alternative:** `manager` / `manager123`
- Manager-level access
- Can manage assets and schedules
- Cannot manage users (admin only)

---

## 💾 Where Credentials Are Stored

Database: `runtime/yii2_advanced.db`  
Table: `user`

**Passwords are hashed using Yii2 security (bcrypt), not stored as plaintext.**

---

## 🔄 Create More Users

To create additional users via console:

```bash
cd e:\Capstone\ssmi-erp-project\apps\web

# Create single user
php yii init/user --username=testuser --password=testpass123 --email=test@example.com

# Create multiple default users (if needed again)
php yii init/default-users
```

---

## ⚙️ Change Password

Passwords are hashed, so to change them:

```bash
# Create new user with different password (old one can be overwritten)
php yii init/user --username=admin --password=newpassword123 --email=admin@petrolab.com
```

---

## 🔒 Security Notes

- ✅ Passwords are hashed (bcrypt)
- ✅ Auth keys are auto-generated
- ✅ Status set to ACTIVE for immediate use
- ⚠️ These are development credentials - change for production!
- ⚠️ Never commit real passwords to version control

---

## 📋 User Management via Backend

After login, you can:
1. **Create new users** - Via admin panel
2. **Update credentials** - Change passwords for existing users
3. **Deactivate users** - Set status to INACTIVE
4. **Delete users** - Set status to DELETED

---

**Created:** 12 Juni 2026  
**Database:** SQLite (local development)  
**Status:** Ready for testing ✅
