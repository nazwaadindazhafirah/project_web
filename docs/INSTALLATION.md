# 🚀 Installation Guide
*Complete setup guide for Nazwa Skincare Store*

---

## 📋 Table of Contents
- [System Requirements](#system-requirements)
- [Pre-Installation](#pre-installation)
- [Installation Steps](#installation-steps)
- [Database Setup](#database-setup)
- [Configuration](#configuration)
- [Testing Installation](#testing-installation)
- [Troubleshooting](#troubleshooting)

---

## 💻 System Requirements

### Minimum Requirements:
| Component | Requirement |
|-----------|-------------|
| **Operating System** | Windows 10/11, macOS 10.15+, Ubuntu 18.04+ |
| **Web Server** | Apache 2.4+ or Nginx 1.18+ |
| **PHP** | PHP 7.4+ (Recommended: PHP 8.0+) |
| **Database** | MySQL 5.7+ or MariaDB 10.3+ |
| **Memory** | 2GB RAM minimum |
| **Storage** | 1GB free disk space |

### PHP Extensions Required:
```bash
php-mysql
php-mysqli
php-pdo
php-gd
php-curl
php-json
php-mbstring
php-xml
php-zip
```

---

## 🛠️ Pre-Installation

### 1. Install XAMPP (Recommended for Development)

#### Windows:
1. Download XAMPP from [https://www.apachefriends.org](https://www.apachefriends.org)
2. Run the installer as Administrator
3. Select components: Apache, MySQL, PHP, phpMyAdmin
4. Install to default directory: `C:\xampp`
5. Start Apache and MySQL services

#### macOS:
```bash
# Using Homebrew
brew install --cask xampp

# Or download from official website
```

#### Linux (Ubuntu/Debian):
```bash
# Download XAMPP
wget https://www.apachefriends.org/xampp-files/8.2.4/xampp-linux-x64-8.2.4-0-installer.run

# Make executable and run
chmod +x xampp-linux-x64-8.2.4-0-installer.run
sudo ./xampp-linux-x64-8.2.4-0-installer.run
```

### 2. Verify XAMPP Installation
1. Open XAMPP Control Panel
2. Start Apache and MySQL
3. Visit `http://localhost` - should show XAMPP dashboard
4. Visit `http://localhost/phpmyadmin` - should show phpMyAdmin

---

## 📦 Installation Steps

### Step 1: Clone the Repository

#### Using Git (Recommended):
```bash
# Navigate to XAMPP htdocs directory
cd C:\xampp\htdocs  # Windows
cd /Applications/XAMPP/htdocs  # macOS
cd /opt/lampp/htdocs  # Linux

# Clone the repository
git clone https://github.com/NazwaAdindaZhafirah/nazwa-skincare-store.git
cd nazwa-skincare-store
```

#### Manual Download:
1. Download ZIP from GitHub repository
2. Extract to `htdocs/nazwa-skincare-store`
3. Navigate to the project directory

### Step 2: Set Permissions (Linux/macOS)
```bash
# Set proper permissions
sudo chown -R www-data:www-data /opt/lampp/htdocs/nazwa-skincare-store
sudo chmod -R 755 /opt/lampp/htdocs/nazwa-skincare-store

# For uploads directory
sudo chmod -R 777 /opt/lampp/htdocs/nazwa-skincare-store/uploads
```

---

## 🗄️ Database Setup

### Method 1: Using phpMyAdmin (Recommended)

1. **Access phpMyAdmin:**
   - Open browser and go to `http://localhost/phpmyadmin`
   - Login with username: `root`, password: (leave empty)

2. **Create Database:**
   ```sql
   CREATE DATABASE nazwa_skincare_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. **Import Database:**
   - Click on `nazwa_skincare_store` database
   - Go to "Import" tab
   - Choose file: `database/nazwa_skincare_store.sql`
   - Click "Go" to import

### Method 2: Using MySQL Command Line

```bash
# Access MySQL
mysql -u root -p

# Create database
CREATE DATABASE nazwa_skincare_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Exit MySQL
exit

# Import SQL file
mysql -u root -p nazwa_skincare_store < database/nazwa_skincare_store.sql
```

### Step 3: Verify Database Import
```sql
USE nazwa_skincare_store;
SHOW TABLES;
-- Should show: users, products, categories, brands, cart, wishlist, addresses, orders, order_items
```

---

## ⚙️ Configuration

### 1. Database Configuration

Create or edit `config/database.php`:

```php
<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'nazwa_skincare_store');
define('DB_CHARSET', 'utf8mb4');

// Database connection
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
```

### 2. Application Configuration

Create `config/config.php`:

```php
<?php
// Site configuration
define('SITE_NAME', 'Nazwa Skincare Store');
define('SITE_URL', 'http://localhost/nazwa-skincare-store');
define('SITE_EMAIL', 'admin@nazwaskincare.com');
define('ADMIN_EMAIL', 'nazwa.adinda@example.com');

// File upload settings
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Session settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 for HTTPS

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
```

### 3. Create Required Directories

```bash
# Create uploads directory structure
mkdir -p uploads/products
mkdir -p uploads/categories
mkdir -p uploads/brands
mkdir -p uploads/users

# Set permissions (Linux/macOS)
chmod -R 755 uploads/
```

### 4. Environment Configuration

Create `.env` file (optional):

```env
# Database
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=nazwa_skincare_store

# Application
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost/nazwa-skincare-store

# Upload settings
UPLOAD_MAX_SIZE=5242880
ALLOWED_EXTENSIONS=jpg,jpeg,png,gif

# Email settings (for notifications)
SMTP_HOST=
SMTP_PORT=
SMTP_USER=
SMTP_PASS=
```

---

## 🧪 Testing Installation

### 1. Basic Access Test
```bash
# Open browser and test these URLs:
http://localhost/nazwa-skincare-store/          # Homepage
http://localhost/nazwa-skincare-store/products/ # Products page
http://localhost/nazwa-skincare-store/login/    # Login page
http://localhost/nazwa-skincare-store/register/ # Register page
```

### 2. Database Connection Test

Create `test_connection.php`:

```php
<?php
require_once 'config/database.php';

try {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $result = $stmt->fetch();
    echo "✅ Database connection successful!<br>";
    echo "👥 Users in database: " . $result['count'];
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage();
}
?>
```

Access: `http://localhost/nazwa-skincare-store/test_connection.php`

### 3. File Upload Test

```php
<?php
// test_upload.php
$uploadDir = 'uploads/test/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if (is_writable($uploadDir)) {
    echo "✅ Upload directory is writable";
} else {
    echo "❌ Upload directory is not writable";
}
?>
```

### 4. PHP Extensions Test

```php
<?php
// test_extensions.php
$required_extensions = [
    'pdo', 'pdo_mysql', 'mysqli', 'gd', 
    'curl', 'json', 'mbstring', 'xml'
];

echo "<h3>PHP Extensions Check:</h3>";
foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "✅ $ext - Loaded<br>";
    } else {
        echo "❌ $ext - Missing<br>";
    }
}

echo "<br><strong>PHP Version:</strong> " . phpversion();
?>
```

---

## 🐛 Troubleshooting

### Common Issues and Solutions

#### 1. Apache Won't Start
**Issue:** Port 80 already in use

**Solution:**
```bash
# Windows - Check what's using port 80
netstat -aon | findstr :80

# Change Apache port in httpd.conf
Listen 8080
ServerName localhost:8080
```

#### 2. MySQL Won't Start
**Issue:** Port 3306 already in use

**Solution:**
```bash
# Windows
net stop mysql
# or change MySQL port in my.ini

# Linux/macOS
sudo service mysql stop
```

#### 3. Database Connection Error
**Issue:** `SQLSTATE[HY000] [1049] Unknown database`

**Solution:**
```bash
# Verify database exists
mysql -u root -p
SHOW DATABASES;

# Create database if missing
CREATE DATABASE nazwa_skincare_store;
```

#### 4. Permission Denied Errors
**Issue:** Cannot write to uploads directory

**Solution:**
```bash
# Linux/macOS
sudo chmod -R 777 uploads/
sudo chown -R www-data:www-data uploads/

# Windows
# Right-click folder → Properties → Security → Edit → Full Control
```

#### 5. PHP Extension Missing
**Issue:** `Class 'PDO' not found`

**Solution:**
```bash
# Ubuntu/Debian
sudo apt-get install php-mysql php-pdo

# CentOS/RHEL
sudo yum install php-mysql php-pdo

# Windows XAMPP - Enable in php.ini:
extension=pdo_mysql
```

#### 6. Session Issues
**Issue:** Login not persisting

**Solution:**
```php
// Check session directory permissions
echo session_save_path();

// Set custom session path
session_save_path('./sessions');
```

### Debug Mode Setup

Enable debug mode in `config/config.php`:

```php
// Development settings
if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', './logs/php_errors.log');
}
```

### Log Files to Check

```bash
# Apache error log
tail -f /opt/lampp/logs/error_log  # Linux
tail -f C:\xampp\apache\logs\error.log  # Windows

# PHP error log
tail -f ./logs/php_errors.log

# MySQL error log
tail -f /opt/lampp/var/mysql/error.log
```

---

## 🚀 Post-Installation Steps

### 1. Security Hardening

```php
// Remove test files
unlink('test_connection.php');
unlink('test_upload.php');
unlink('test_extensions.php');

// Set production config
define('APP_ENV', 'production');
error_reporting(0);
ini_set('display_errors', 0);
```

### 2. Create Admin User

```sql
INSERT INTO users (nama, email, password, is_admin) VALUES 
('Nazwa Adinda Zhafirah', 'nazwa.adinda@example.com', '$2y$10$hash_here', 1);
```

### 3. Sample Data Import

```bash
# Import sample products and categories
mysql -u root -p nazwa_skincare_store < database/sample_data.sql
```

---

## ✅ Installation Checklist

- [ ] XAMPP installed and running
- [ ] Project files in htdocs directory
- [ ] Database created and imported
- [ ] Configuration files set up
- [ ] Upload directories created with proper permissions
- [ ] All URLs accessible
- [ ] Database connection working
- [ ] File uploads working
- [ ] PHP extensions loaded
- [ ] Error logging configured
- [ ] Admin user created
- [ ] Sample data imported (optional)

---

<div align="center">

### 🎉 Installation Complete!

Your Nazwa Skincare Store is now ready to use!

**Next Steps:**
- [📖 Read Usage Guide](USAGE.md)
- [🚀 Deploy to Production](DEPLOYMENT.md)
- [🗄️ Database Documentation](DATABASE.md)

---

*Happy coding! 💻✨*

</div>
