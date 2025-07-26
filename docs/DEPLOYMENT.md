# 🚀 Deployment Guide - Nazwa Adinda Zhafirah Skincare

## 📋 Table of Contents
- [Prerequisites](#prerequisites)
- [Server Requirements](#server-requirements)
- [Deployment Methods](#deployment-methods)
- [Production Configuration](#production-configuration)
- [Security Hardening](#security-hardening)
- [Performance Optimization](#performance-optimization)
- [Monitoring & Maintenance](#monitoring--maintenance)
- [Troubleshooting](#troubleshooting)

## 🔧 Prerequisites

### Domain & Hosting
- Domain name (e.g., `nazwa-skincare.com`)
- Web hosting with PHP support
- SSL Certificate (recommended)
- Email hosting for notifications

### Technical Requirements
```
✅ PHP 7.4 or higher
✅ MySQL 5.7 or higher
✅ Apache/Nginx web server
✅ SSL Certificate
✅ FTP/SSH access
✅ Email service (SMTP)
```

## 🖥️ Server Requirements

### Minimum Specifications
```
RAM: 512MB (recommended 1GB+)
Storage: 1GB free space
Bandwidth: 10GB/month
PHP Extensions:
  - mysqli
  - pdo_mysql
  - gd
  - curl
  - mbstring
  - zip
```

### Recommended Hosting Providers
| Provider | Plan | Price | Features |
|----------|------|-------|----------|
| 🌟 Hostinger | Premium | $2.99/mo | Free SSL, 100GB SSD |
| 🚀 Niagahoster | Bayi | Rp 14.900/bln | Free Domain, SSL |
| 💎 Dewaweb | Scout | Rp 20.000/bln | SSD, Free Backup |

## 📦 Deployment Methods

### Method 1: Manual FTP Upload

#### Step 1: Prepare Files
```bash
# Compress project files
zip -r nazwa-skincare.zip . -x "*.git*" "node_modules/*" "*.log"
```

#### Step 2: Upload via FTP
```
1. Connect to your hosting via FTP client (FileZilla)
2. Navigate to public_html or www folder
3. Upload all project files
4. Extract if uploaded as ZIP
```

#### Step 3: Set Permissions
```bash
# Set proper permissions
chmod 755 /public_html
chmod 644 /public_html/*.php
chmod 755 /public_html/assets/uploads
chmod 644 /public_html/config/*.php
```

### Method 2: Git Deployment (Recommended)

#### Step 1: Initialize Git Repository
```bash
# On server (via SSH)
cd /public_html
git clone https://github.com/yourusername/nazwa-skincare.git .
```

#### Step 2: Set Up Auto-Deploy
```bash
# Create deploy script
nano deploy.sh

#!/bin/bash
git pull origin main
chmod 755 assets/uploads
echo "Deployment completed at $(date)" >> deploy.log
```

#### Step 3: Configure Webhook
```php
// webhook.php - Auto deploy on push
<?php
if ($_POST['payload']) {
    exec('cd /public_html && ./deploy.sh 2>&1', $output);
    echo "Deployed successfully\n";
    print_r($output);
}
?>
```

## ⚙️ Production Configuration

### Database Configuration
```php
// config/database.php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_secure_password');
define('DB_NAME', 'nazwa_skincare_prod');
define('DB_CHARSET', 'utf8mb4');
```

### Environment Setup
```php
// config/config.php
define('ENVIRONMENT', 'production');
define('BASE_URL', 'https://your-domain.com/');
define('ADMIN_EMAIL', 'admin@your-domain.com');
define('SMTP_HOST', 'smtp.your-domain.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'noreply@your-domain.com');
define('SMTP_PASS', 'your_email_password');
```

### Apache .htaccess
```apache
# .htaccess
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"

# Cache control
<FilesMatch "\.(css|js|png|jpg|jpeg|gif|ico|svg)$">
    ExpiresActive On
    ExpiresDefault "access plus 1 month"
</FilesMatch>

# Deny access to sensitive files
<Files "config.php">
    Order allow,deny
    Deny from all
</Files>
```

### Nginx Configuration
```nginx
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name your-domain.com www.your-domain.com;
    root /var/www/html;
    index index.php index.html;

    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Security
    location ~ /\. {
        deny all;
    }
    
    location ~* \.(log|sql|bak)$ {
        deny all;
    }
}
```

## 🔒 Security Hardening

### File Permissions
```bash
# Set secure permissions
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod 600 config/database.php
chmod 755 assets/uploads
```

### Database Security
```sql
-- Create dedicated database user
CREATE USER 'nazwa_app'@'localhost' IDENTIFIED BY 'secure_random_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON nazwa_skincare.* TO 'nazwa_app'@'localhost';
FLUSH PRIVILEGES;
```

### Input Validation
```php
// functions/security.php
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
```

## ⚡ Performance Optimization

### PHP Optimization
```ini
; php.ini optimizations
memory_limit = 256M
max_execution_time = 60
upload_max_filesize = 10M
post_max_size = 10M
opcache.enable = 1
opcache.memory_consumption = 128
```

### Database Optimization
```sql
-- Add indexes for better performance
CREATE INDEX idx_products_category ON products(category_id);
CREATE INDEX idx_orders_user ON orders(user_id);
CREATE INDEX idx_orders_date ON orders(created_at);
```

### Image Optimization
```php
// functions/image.php
function optimize_image($source, $destination, $quality = 80) {
    $info = getimagesize($source);
    
    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $destination, $quality);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
        imagepng($image, $destination, 8);
    }
    
    imagedestroy($image);
}
```

## 📊 Monitoring & Maintenance

### Log Monitoring
```php
// functions/logger.php
function log_error($message, $file = 'error.log') {
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[$timestamp] $message\n";
    file_put_contents("logs/$file", $log_entry, FILE_APPEND);
}
```

### Backup Script
```bash
#!/bin/bash
# backup.sh - Daily backup script

DATE=$(date +%Y%m%d)
DB_NAME="nazwa_skincare"
BACKUP_DIR="/backups"

# Database backup
mysqldump -u root -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_backup_$DATE.sql

# Files backup
tar -czf $BACKUP_DIR/files_backup_$DATE.tar.gz /public_html

# Keep only 7 days of backups
find $BACKUP_DIR -name "*.sql" -mtime +7 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +7 -delete

echo "Backup completed: $(date)" >> $BACKUP_DIR/backup.log
```

### Health Check
```php
// health-check.php
<?php
$checks = [
    'database' => check_database_connection(),
    'uploads' => is_writable('assets/uploads'),
    'sessions' => is_writable(session_save_path()),
    'memory' => memory_get_usage() < (128 * 1024 * 1024)
];

header('Content-Type: application/json');
echo json_encode([
    'status' => in_array(false, $checks) ? 'error' : 'ok',
    'checks' => $checks,
    'timestamp' => date('c')
]);
?>
```

## 🔧 Troubleshooting

### Common Issues

#### 1. Database Connection Error
```
Error: Cannot connect to database
Solution:
- Check database credentials in config.php
- Verify database server is running
- Test connection: php -r "new PDO('mysql:host=localhost;dbname=test', 'user', 'pass');"
```

#### 2. File Upload Issues
```
Error: Cannot upload images
Solution:
- Check upload directory permissions: chmod 755 assets/uploads
- Verify PHP upload settings in php.ini
- Check available disk space
```

#### 3. SSL Certificate Problems
```
Error: SSL certificate not valid
Solution:
- Verify certificate installation
- Check certificate chain
- Use SSL checker tools online
```

#### 4. Performance Issues
```
Problem: Slow page loading
Solution:
- Enable PHP OPcache
- Optimize database queries
- Compress images
- Use CDN for static assets
```

### Monitoring Commands
```bash
# Check server resources
df -h                    # Disk usage
free -m                  # Memory usage
top                      # CPU usage
tail -f /var/log/apache2/error.log  # Apache errors

# Check PHP errors
tail -f /var/log/php_errors.log

# Database performance
mysql> SHOW PROCESSLIST;
mysql> SHOW ENGINE INNODB STATUS;
```

## 📞 Support & Contact

### Emergency Contacts
- 👩‍💼 **Developer**: Nazwa Adinda Zhafirah
- 📧 **Email**: nazwa.adinda@gmail.com
- 📱 **WhatsApp**: +62 812-3456-7890
- 🌐 **Website**: https://nazwa-skincare.com

### Documentation Links
- 📖 [Installation Guide](INSTALLATION.md)
- 🗄️ [Database Schema](DATABASE.md)
- 👥 [Usage Guide](USAGE.md)
- 🏠 [Back to README](../README.md)

---

<div align="center">
  <p><strong>🚀 Deployed with ❤️ by Nazwa Adinda Zhafirah</strong></p>
  <p><em>Skincare yang Tepat untuk Kecantikan Alami Anda</em></p>
</div>
