# Deployment Guide - Nazwaazhf Skincare

## Overview
This document provides comprehensive instructions for deploying the Nazwaazhf Skincare e-commerce application to various environments.

## Prerequisites

### System Requirements
- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **PHP**: Version 7.4+ (Recommended: PHP 8.1+)
- **Database**: MySQL 5.7+ or MariaDB 10.4+
- **Operating System**: Linux (Ubuntu 20.04+), Windows Server 2019+, or macOS 10.15+

### Required PHP Extensions
```
- mysqli
- gd
- curl
- json
- mbstring
- openssl
- xml
- zip
```

## Local Development Deployment

### Using XAMPP (Windows/macOS/Linux)

1. **Install XAMPP**
   - Download from [Apache Friends](https://www.apachefriends.org/)
   - Install following the setup wizard

2. **Setup Project**
   ```bash
   # Navigate to htdocs directory
   cd C:\xampp\htdocs  # Windows
   cd /Applications/XAMPP/htdocs  # macOS
   cd /opt/lampp/htdocs  # Linux
   
   # Clone or copy project
   git clone https://github.com/yourrepo/nazwaazhf_skincare.git
   # or copy the project files
   ```

3. **Database Setup**
   - Start Apache and MySQL in XAMPP Control Panel
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Create database: `nazwaazhf_skincare`
   - Import database structure from `docs/database.sql`

4. **Configuration**
   - Edit `koneksi.php` with your database credentials
   - Access application: http://localhost/nazwaazhf_skincare

### Using WAMP (Windows)

1. **Install WAMP**
   - Download from [WampServer](https://www.wampserver.com/)
   - Install and start all services

2. **Setup Project**
   ```bash
   # Navigate to www directory
   cd C:\wamp64\www
   
   # Copy project files
   copy nazwaazhf_skincare folder here
   ```

3. **Database Configuration**
   - Same as XAMPP steps above
   - Access: http://localhost/nazwaazhf_skincare

## Production Deployment

### Shared Hosting (cPanel)

1. **File Upload**
   ```bash
   # Compress project files
   zip -r nazwaazhf_skincare.zip *
   
   # Upload via cPanel File Manager or FTP
   # Extract in public_html directory
   ```

2. **Database Setup**
   - Create MySQL database in cPanel
   - Import database structure via phpMyAdmin
   - Update `koneksi.php` with new credentials

3. **Configuration**
   ```php
   // koneksi.php for shared hosting
   <?php
   $host = 'localhost';
   $username = 'your_db_username';
   $password = 'your_db_password';
   $database = 'your_db_name';
   
   $conn = mysqli_connect($host, $username, $password, $database);
   ?>
   ```

### VPS/Dedicated Server (Ubuntu 20.04)

1. **Server Setup**
   ```bash
   # Update system
   sudo apt update && sudo apt upgrade -y
   
   # Install LAMP stack
   sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql -y
   
   # Install required PHP extensions
   sudo apt install php-gd php-curl php-json php-mbstring php-xml php-zip -y
   ```

2. **Configure Apache**
   ```bash
   # Create virtual host
   sudo nano /etc/apache2/sites-available/nazwaazhf.conf
   ```
   
   ```apache
   <VirtualHost *:80>
       ServerName your-domain.com
       ServerAlias www.your-domain.com
       DocumentRoot /var/www/html/nazwaazhf_skincare
       
       <Directory /var/www/html/nazwaazhf_skincare>
           Options Indexes FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
       
       ErrorLog ${APACHE_LOG_DIR}/nazwaazhf_error.log
       CustomLog ${APACHE_LOG_DIR}/nazwaazhf_access.log combined
   </VirtualHost>
   ```

3. **Enable Site**
   ```bash
   # Enable site and rewrite module
   sudo a2ensite nazwaazhf.conf
   sudo a2enmod rewrite
   sudo systemctl reload apache2
   ```

4. **Database Setup**
   ```bash
   # Secure MySQL installation
   sudo mysql_secure_installation
   
   # Create database and user
   sudo mysql -u root -p
   ```
   
   ```sql
   CREATE DATABASE nazwaazhf_skincare;
   CREATE USER 'nazwaazhf_user'@'localhost' IDENTIFIED BY 'secure_password';
   GRANT ALL PRIVILEGES ON nazwaazhf_skincare.* TO 'nazwaazhf_user'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```

5. **Deploy Application**
   ```bash
   # Copy files to web directory
   sudo cp -r /path/to/project/* /var/www/html/nazwaazhf_skincare/
   
   # Set proper permissions
   sudo chown -R www-data:www-data /var/www/html/nazwaazhf_skincare
   sudo chmod -R 755 /var/www/html/nazwaazhf_skincare
   sudo chmod -R 775 /var/www/html/nazwaazhf_skincare/assets/gambar
   ```

## Cloud Deployment

### AWS EC2 Deployment

1. **Launch EC2 Instance**
   - Choose Ubuntu 20.04 LTS AMI
   - Configure security groups (HTTP:80, HTTPS:443, SSH:22)
   - Launch with key pair

2. **Connect and Setup**
   ```bash
   # Connect to instance
   ssh -i your-key.pem ubuntu@your-ec2-ip
   
   # Follow VPS deployment steps above
   ```

3. **Configure Domain**
   - Point domain to EC2 Elastic IP
   - Configure SSL certificate with Let's Encrypt

### Google Cloud Platform

1. **Create Compute Engine Instance**
   - Choose appropriate machine type
   - Select Ubuntu 20.04 LTS
   - Configure firewall rules

2. **Deploy Application**
   - Follow VPS deployment steps
   - Configure Google Cloud Load Balancer if needed

## SSL Certificate Setup

### Let's Encrypt (Free SSL)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-apache -y

# Obtain certificate
sudo certbot --apache -d your-domain.com -d www.your-domain.com

# Test auto-renewal
sudo certbot renew --dry-run
```

### Manual SSL Certificate

```bash
# If you have SSL certificate files
sudo mkdir /etc/ssl/certs/nazwaazhf
sudo cp your-certificate.crt /etc/ssl/certs/nazwaazhf/
sudo cp your-private.key /etc/ssl/private/nazwaazhf/

# Update Apache configuration
sudo nano /etc/apache2/sites-available/nazwaazhf-ssl.conf
```

## Environment-Specific Configurations

### Production Environment

```php
// config/production.php
<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'production_user');
define('DB_PASS', 'secure_production_password');
define('DB_NAME', 'nazwaazhf_skincare');

// Security Settings
define('ENVIRONMENT', 'production');
define('DEBUG_MODE', false);
define('DISPLAY_ERRORS', false);
?>
```

### Development Environment

```php
// config/development.php
<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'nazwaazhf_skincare');

// Security Settings
define('ENVIRONMENT', 'development');
define('DEBUG_MODE', true);
define('DISPLAY_ERRORS', true);
?>
```

## Security Hardening

### File Permissions
```bash
# Set proper file permissions
find /var/www/html/nazwaazhf_skincare -type f -exec chmod 644 {} \;
find /var/www/html/nazwaazhf_skincare -type d -exec chmod 755 {} \;
chmod 600 /var/www/html/nazwaazhf_skincare/koneksi.php
```

### Apache Security
```apache
# Add to .htaccess
RewriteEngine On

# Prevent access to sensitive files
<FilesMatch "\.(sql|log|md)$">
    Order allow,deny
    Deny from all
</FilesMatch>

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
```

## Performance Optimization

### Enable Compression
```apache
# Add to .htaccess
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>
```

### Caching
```apache
# Browser caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 month"
    ExpiresByType image/jpeg "access plus 1 month"
    ExpiresByType image/gif "access plus 1 month"
    ExpiresByType image/png "access plus 1 month"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/pdf "access plus 1 month"
    ExpiresByType text/javascript "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

## Monitoring and Maintenance

### Log Monitoring
```bash
# Check Apache logs
sudo tail -f /var/log/apache2/error.log
sudo tail -f /var/log/apache2/access.log

# Check MySQL logs
sudo tail -f /var/log/mysql/error.log
```

### Backup Strategy
```bash
# Database backup script
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u username -p nazwaazhf_skincare > backup_${DATE}.sql
gzip backup_${DATE}.sql

# File backup
tar -czf files_backup_${DATE}.tar.gz /var/www/html/nazwaazhf_skincare
```

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check MySQL service status
   - Verify database credentials
   - Check firewall settings

2. **File Permission Issues**
   - Ensure proper ownership (www-data:www-data)
   - Check directory permissions (755)
   - Verify file permissions (644)

3. **Image Upload Problems**
   - Check upload directory permissions
   - Verify PHP upload limits
   - Check disk space availability

### Performance Issues
- Monitor server resources (CPU, Memory, Disk)
- Optimize database queries
- Enable caching mechanisms
- Use CDN for static assets

## Rollback Procedures

### Database Rollback
```bash
# Restore from backup
mysql -u username -p nazwaazhf_skincare < backup_file.sql
```

### File Rollback
```bash
# Restore application files
sudo rm -rf /var/www/html/nazwaazhf_skincare
sudo tar -xzf files_backup_DATE.tar.gz -C /
```

---

**Note**: Always test deployment procedures in a staging environment before applying to production. Keep regular backups and monitor system performance after deployment.
