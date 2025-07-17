# Installation Guide - Nazwaazhf Skincare

## Overview
This guide provides step-by-step instructions for installing and setting up the Nazwaazhf Skincare e-commerce application on your local development environment.

## System Requirements

### Minimum Requirements
- **Operating System**: Windows 10, macOS 10.14+, or Linux (Ubuntu 18.04+)
- **Web Server**: Apache 2.4+ or Nginx 1.16+
- **PHP**: Version 7.4 or higher
- **Database**: MySQL 5.7+ or MariaDB 10.2+
- **Memory**: 2GB RAM minimum
- **Storage**: 500MB free disk space

### Recommended Requirements
- **PHP**: Version 8.1+
- **Database**: MySQL 8.0+ or MariaDB 10.6+
- **Memory**: 4GB RAM or higher
- **Storage**: 1GB free disk space

## Pre-Installation Setup

### Windows Installation (XAMPP)

1. **Download XAMPP**
   - Visit [Apache Friends](https://www.apachefriends.org/download.html)
   - Download XAMPP for Windows (PHP 8.1+ recommended)

2. **Install XAMPP**
   ```
   - Run the installer as Administrator
   - Select components: Apache, MySQL, PHP, phpMyAdmin
   - Choose installation directory (default: C:\xampp)
   - Complete the installation
   ```

3. **Start Services**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services
   - Verify services are running (green status)

### macOS Installation (XAMPP)

1. **Download and Install**
   - Download XAMPP for macOS from Apache Friends
   - Mount the .dmg file and drag XAMPP to Applications folder
   - Launch XAMPP from Applications

2. **Start Services**
   ```bash
   # Open terminal and navigate to XAMPP
   cd /Applications/XAMPP/xamppfiles
   sudo ./xampp start
   ```

### Linux Installation (Ubuntu/Debian)

1. **Update System**
   ```bash
   sudo apt update && sudo apt upgrade -y
   ```

2. **Install LAMP Stack**
   ```bash
   # Install Apache
   sudo apt install apache2 -y
   
   # Install MySQL
   sudo apt install mysql-server -y
   
   # Install PHP and required extensions
   sudo apt install php libapache2-mod-php php-mysql php-gd php-curl php-json php-mbstring php-xml php-zip -y
   
   # Install phpMyAdmin (optional)
   sudo apt install phpmyadmin -y
   ```

3. **Configure Services**
   ```bash
   # Start and enable services
   sudo systemctl start apache2
   sudo systemctl enable apache2
   sudo systemctl start mysql
   sudo systemctl enable mysql
   
   # Secure MySQL installation
   sudo mysql_secure_installation
   ```

## Database Setup

### Using phpMyAdmin (Recommended for beginners)

1. **Access phpMyAdmin**
   - Open browser and navigate to: `http://localhost/phpmyadmin`
   - Login with your MySQL credentials

2. **Create Database**
   - Click "New" in the left sidebar
   - Database name: `nazwaazhf_skincare`
   - Collation: `utf8mb4_general_ci`
   - Click "Create"

3. **Create Tables**
   - Select the newly created database
   - Click "Import" tab
   - Choose the SQL file from `docs/database.sql`
   - Click "Go" to execute

### Using MySQL Command Line

1. **Connect to MySQL**
   ```bash
   mysql -u root -p
   ```

2. **Create Database and User**
   ```sql
   -- Create database
   CREATE DATABASE nazwaazhf_skincare CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   
   -- Create user (optional, for security)
   CREATE USER 'skincare_user'@'localhost' IDENTIFIED BY 'secure_password';
   GRANT ALL PRIVILEGES ON nazwaazhf_skincare.* TO 'skincare_user'@'localhost';
   FLUSH PRIVILEGES;
   
   -- Use the database
   USE nazwaazhf_skincare;
   ```

3. **Import Database Structure**
   ```bash
   # Exit MySQL and import from command line
   mysql -u root -p nazwaazhf_skincare < docs/database.sql
   ```

## Application Installation

### Download and Extract

1. **Download Source Code**
   ```bash
   # Using Git (if available)
   git clone https://github.com/yourrepo/nazwaazhf_skincare.git
   
   # Or download ZIP file and extract
   ```

2. **Copy to Web Directory**
   ```bash
   # Windows (XAMPP)
   Copy the project folder to: C:\xampp\htdocs\nazwaazhf_skincare
   
   # macOS (XAMPP)
   Copy to: /Applications/XAMPP/xamppfiles/htdocs/nazwaazhf_skincare
   
   # Linux
   sudo cp -r nazwaazhf_skincare /var/www/html/
   ```

### Configure Database Connection

1. **Edit Database Configuration**
   - Open `koneksi.php` in your text editor
   - Update database credentials:

   ```php
   <?php
   // Database configuration
   $host = 'localhost';
   $username = 'root';           // or your MySQL username
   $password = '';               // or your MySQL password
   $database = 'nazwaazhf_skincare';
   
   // Create connection
   $conn = mysqli_connect($host, $username, $password, $database);
   
   // Check connection
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   ?>
   ```

### Set File Permissions (Linux/macOS)

```bash
# Set proper permissions
sudo chown -R www-data:www-data /var/www/html/nazwaazhf_skincare
sudo chmod -R 755 /var/www/html/nazwaazhf_skincare
sudo chmod -R 775 /var/www/html/nazwaazhf_skincare/assets/gambar
```

## Initial Configuration

### Create Admin Account

1. **Access Registration Page**
   - Open: `http://localhost/nazwaazhf_skincare/auth/register.php`
   - Fill in the form with admin details

2. **Update User Level to Admin**
   ```sql
   -- Connect to database and update user level
   USE nazwaazhf_skincare;
   UPDATE user SET level = 'admin' WHERE username = 'your_admin_username';
   ```

### Upload Sample Products (Optional)

1. **Prepare Product Images**
   - Create folders in `assets/gambar/` for each brand:
     - `assets/gambar/glow2glow/`
     - `assets/gambar/skintific/`
     - `assets/gambar/emina/`
     - `assets/gambar/originote/`
     - `assets/gambar/garnier/`
     - `assets/gambar/loreal/`
     - `assets/gambar/azarine/`
     - `assets/gambar/scarlett/`

2. **Add Sample Products**
   ```sql
   -- Insert sample products
   INSERT INTO produk (nama_produk, brand, deskripsi, harga, stok, gambar) VALUES
   ('Glow2Glow Vitamin C Serum', 'Glow2Glow', 'Serum vitamin C untuk kulit glowing', 89000, 50, 'vitamin-c-serum.jpg'),
   ('Skintific Niacinamide Serum', 'Skintific', 'Serum niacinamide untuk mencerahkan kulit', 95000, 30, 'niacinamide-serum.jpg'),
   ('Emina Sun Protection SPF 30', 'Emina', 'Sunscreen untuk perlindungan optimal', 45000, 100, 'sunscreen-spf30.jpg');
   ```

## Testing Installation

### Verify Database Connection

1. **Test Database Connection**
   - Create a test file: `test_db.php`
   ```php
   <?php
   include 'koneksi.php';
   
   if ($conn) {
       echo "Database connection successful!";
       
       // Test query
       $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM user");
       $row = mysqli_fetch_assoc($result);
       echo "<br>User count: " . $row['count'];
   } else {
       echo "Database connection failed!";
   }
   ?>
   ```

2. **Access Test File**
   - Open: `http://localhost/nazwaazhf_skincare/test_db.php`
   - Should show "Database connection successful!"

### Test Application Features

1. **User Registration**
   - Navigate to: `http://localhost/nazwaazhf_skincare/auth/register.php`
   - Create a test account
   - Verify successful registration

2. **User Login**
   - Navigate to: `http://localhost/nazwaazhf_skincare/auth/login.php`
   - Login with test credentials
   - Check dashboard access

3. **Admin Access**
   - Login with admin credentials
   - Navigate to: `http://localhost/nazwaazhf_skincare/admin/dashboard.php`
   - Verify admin features

## Common Installation Issues

### Database Connection Problems

1. **"Access denied for user" Error**
   ```
   Solution:
   - Check MySQL username and password in koneksi.php
   - Ensure MySQL service is running
   - Verify user has proper permissions
   ```

2. **"Unknown database" Error**
   ```
   Solution:
   - Ensure database 'nazwaazhf_skincare' exists
   - Check database name spelling in koneksi.php
   - Import database structure properly
   ```

### PHP Extension Issues

1. **Missing Extensions**
   ```bash
   # Check installed extensions
   php -m
   
   # Install missing extensions (Ubuntu/Debian)
   sudo apt install php-mysqli php-gd php-curl php-json php-mbstring
   ```

2. **File Upload Issues**
   ```php
   // Check PHP configuration
   phpinfo();
   
   // Verify these settings in php.ini:
   file_uploads = On
   upload_max_filesize = 10M
   post_max_size = 10M
   ```

### Permission Issues (Linux/macOS)

1. **File Permission Denied**
   ```bash
   # Fix web directory permissions
   sudo chown -R www-data:www-data /var/www/html/nazwaazhf_skincare
   sudo chmod -R 755 /var/www/html/nazwaazhf_skincare
   ```

2. **Upload Directory Issues**
   ```bash
   # Make upload directories writable
   sudo chmod -R 775 /var/www/html/nazwaazhf_skincare/assets/gambar
   ```

## Post-Installation Steps

### Security Configuration

1. **Change Default Passwords**
   - Update MySQL root password
   - Change default admin credentials

2. **Configure PHP Settings**
   ```php
   // In php.ini for production
   display_errors = Off
   log_errors = On
   error_log = /var/log/php_errors.log
   ```

### Performance Optimization

1. **Enable PHP OPcache**
   ```php
   // In php.ini
   opcache.enable=1
   opcache.memory_consumption=128
   opcache.interned_strings_buffer=8
   opcache.max_accelerated_files=4000
   ```

2. **Configure MySQL**
   ```sql
   -- Basic MySQL optimization
   SET GLOBAL innodb_buffer_pool_size = 128M;
   SET GLOBAL query_cache_size = 64M;
   ```

## Backup and Recovery

### Create Initial Backup

1. **Database Backup**
   ```bash
   mysqldump -u root -p nazwaazhf_skincare > initial_backup.sql
   ```

2. **File Backup**
   ```bash
   tar -czf skincare_backup.tar.gz nazwaazhf_skincare/
   ```

### Recovery Process

1. **Database Recovery**
   ```bash
   mysql -u root -p nazwaazhf_skincare < initial_backup.sql
   ```

2. **File Recovery**
   ```bash
   tar -xzf skincare_backup.tar.gz
   ```

## Next Steps

After successful installation:

1. **Read Usage Documentation**: Check `docs/usage.md` for user guide
2. **Configure Deployment**: Review `docs/deployment.md` for production setup
3. **Database Management**: Refer to `docs/database.md` for advanced database operations
4. **Customize Application**: Modify theme, add features, or integrate with other systems

## Support and Troubleshooting

For additional help:
- Check error logs in `/var/log/apache2/error.log` (Linux)
- Review MySQL logs for database issues
- Verify PHP version compatibility
- Ensure all required extensions are installed

---

**Note**: This installation guide covers basic setup. For production environments, additional security measures and performance optimizations should be implemented. Always backup your data before making system changes.
