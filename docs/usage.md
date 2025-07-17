# Usage Guide - Nazwaazhf Skincare

## Overview
This comprehensive guide explains how to use the Nazwaazhf Skincare e-commerce application for both customers and administrators.

## Getting Started

### Accessing the Application
- **URL**: `http://localhost/nazwaazhf_skincare` (local development)
- **Production URL**: `https://yourdomain.com` (production environment)

### User Types
1. **Customer/User**: Can browse, shop, and manage their account
2. **Administrator**: Can manage users, products, and view reports

## Customer/User Guide

### Account Management

#### Registration
1. **Create Account**
   - Navigate to registration page
   - Fill in required information:
     - Full Name
     - Username (must be unique)
     - Email address
     - Password (minimum 8 characters)
   - Click "Daftar" to create account

2. **Account Verification**
   - Account is activated immediately
   - Login credentials are ready for use

#### Login Process
1. **Access Login Page**
   - Click "Login" from homepage
   - Or navigate to `/auth/login.php`

2. **Enter Credentials**
   - Username or Email
   - Password
   - Click "Login" button

3. **Dashboard Access**
   - Successful login redirects to user dashboard
   - View personalized greeting and navigation

### Product Browsing

#### Homepage Navigation
1. **Brand Selection**
   - Choose from available brands:
     - Glow2Glow
     - Skintific
     - Emina
     - Originote
     - Garnier
     - L'Oreal
     - Azarine
     - Scarlett

2. **Product Categories**
   - Skincare products organized by brand
   - View product images and descriptions
   - Check prices and availability

#### Product Details
1. **Product Information**
   - Product name and brand
   - Detailed description
   - Price in Indonesian Rupiah
   - Stock availability
   - High-quality product images

2. **Product Features**
   - Hover effects on product cards
   - Smooth animations
   - Responsive design for mobile devices

### Shopping Cart

#### Adding Products
1. **Add to Cart**
   - Browse product catalog
   - Click "🛒 Tambah ke Keranjang" button
   - Animated feedback confirms addition
   - Button changes to "Ditambahkan!" temporarily

2. **Cart Management**
   - View cart contents anytime
   - See product thumbnails
   - Check quantities and prices
   - Calculate subtotals automatically

#### Cart Operations
1. **View Cart**
   - Navigate to "Keranjang" from sidebar
   - Review all selected items
   - See total amount calculation

2. **Modify Cart**
   - Remove items if needed
   - Update quantities
   - Real-time price updates

### Checkout Process

#### Payment Methods
1. **Available Options**
   - Transfer Bank (Bank Transfer)
   - COD (Cash on Delivery)
   - E-Wallet (Dana, Gopay, OVO)

2. **Selection Process**
   - Choose preferred payment method
   - Confirm total amount
   - Review order summary

#### Order Confirmation
1. **Checkout Steps**
   - Review cart contents
   - Select payment method
   - Confirm order details
   - Click "Checkout Sekarang"

2. **Order Processing**
   - Order is recorded in system
   - Cart is automatically cleared
   - Receipt is generated

### Account Features

#### Address Management
1. **Add Address**
   - Navigate to "Alamat" section
   - Enter delivery address
   - Save for future orders

2. **Manage Addresses**
   - Edit existing addresses
   - Set default address
   - Delete unused addresses

#### Order History
1. **View Orders**
   - Access "Riwayat" section
   - See all past orders
   - Check order status and details

2. **Order Details**
   - Order date and time
   - Products purchased
   - Total amount paid
   - Payment method used

#### Reviews and Ratings
1. **Leave Reviews**
   - Navigate to "Ulasan" section
   - Rate products and service
   - Write detailed feedback

2. **View Reviews**
   - See all submitted reviews
   - Track review status
   - Edit or delete reviews

### Transaction Reports

#### Generate Reports
1. **Access Reports**
   - Navigate to "Laporan Transaksi"
   - View personal transaction history
   - Print reports for records

2. **Report Features**
   - Professional print layout
   - Date and time stamps
   - Complete transaction details
   - Export capabilities

## Administrator Guide

### Admin Dashboard

#### Accessing Admin Panel
1. **Admin Login**
   - Use admin credentials
   - Navigate to `/admin/dashboard.php`
   - Access admin-only features

2. **Dashboard Overview**
   - Product stock summary
   - Quick navigation menu
   - System status indicators

#### Navigation Menu
1. **Main Features**
   - 📊 Laporan Transaksi (Transaction Reports)
   - 👤 Manajemen User (User Management)
   - 📋 Monitoring (System Monitoring)
   - ⚙️ Pengaturan (Settings)

### User Management

#### View Users
1. **User List**
   - See all registered users
   - View user details and roles
   - Check account status

2. **User Information**
   - Full name and contact details
   - Registration date
   - Account level (admin/user)
   - Activity status

#### Manage Users
1. **Add Users**
   - Create new user accounts
   - Set user roles and permissions
   - Configure account settings

2. **Edit Users**
   - Modify user information
   - Change user roles
   - Update account status

3. **Delete Users**
   - Remove inactive accounts
   - Confirmation dialogs prevent accidents
   - Maintain data integrity

### Product Management

#### Stock Overview
1. **Product Inventory**
   - View all products in database
   - Check stock levels
   - Monitor product status

2. **Stock Information**
   - Product names and brands
   - Current stock quantities
   - Price information
   - Last updated timestamps

#### Inventory Management
1. **Add Products**
   - Create new product entries
   - Upload product images
   - Set pricing and descriptions

2. **Update Products**
   - Edit product information
   - Adjust stock quantities
   - Update prices and descriptions

3. **Product Images**
   - Upload product photos
   - Organize by brand folders
   - Maintain image quality

### Transaction Management

#### Transaction Reports
1. **View All Transactions**
   - Complete transaction history
   - Filter by date ranges
   - Search specific transactions

2. **Transaction Details**
   - Customer information
   - Products purchased
   - Payment methods used
   - Transaction amounts

#### Report Generation
1. **Admin Reports**
   - Comprehensive transaction reports
   - Professional formatting
   - Print-ready layouts
   - Export capabilities

2. **Report Features**
   - Date range filtering
   - Customer-specific reports
   - Product sales analysis
   - Revenue tracking

### System Monitoring

#### Performance Monitoring
1. **System Status**
   - Database connection status
   - Server performance metrics
   - User activity logs

2. **Error Monitoring**
   - System error logs
   - User error reports
   - Performance issues

#### Maintenance Tasks
1. **Database Maintenance**
   - Regular backups
   - Data optimization
   - Performance tuning

2. **System Updates**
   - Security patches
   - Feature updates
   - Performance improvements

## Advanced Features

### Print Functionality

#### Customer Reports
1. **Print Orders**
   - Generate printable receipts
   - Professional formatting
   - Company branding included

2. **Print Features**
   - Popup confirmation dialogs
   - Print preview available
   - Custom print layouts

#### Admin Reports
1. **Business Reports**
   - Comprehensive sales reports
   - Customer analysis
   - Product performance metrics

2. **Report Customization**
   - Date range selection
   - Filter options
   - Export formats

### Button Enhancements

#### Interactive Elements
1. **Enhanced Buttons**
   - Smooth hover animations
   - Click feedback effects
   - Professional styling

2. **Confirmation Dialogs**
   - Delete confirmations
   - Checkout confirmations
   - Logout confirmations

#### Visual Feedback
1. **Loading States**
   - Button loading animations
   - Progress indicators
   - Success/error messages

2. **Responsive Design**
   - Mobile-friendly buttons
   - Touch-optimized interface
   - Consistent styling

### Navigation System

#### Hamburger Menu
1. **Mobile Navigation**
   - Collapsible menu system
   - Touch-friendly interface
   - Smooth animations

2. **Menu Features**
   - Hover activation
   - Slide-in animations
   - Professional styling

#### Desktop Navigation
1. **Sidebar Navigation**
   - Traditional sidebar layout
   - Quick access to features
   - User-friendly design

2. **Breadcrumb Navigation**
   - Clear page hierarchy
   - Easy navigation
   - Consistent layout

## Security Features

### User Authentication
1. **Secure Login**
   - Password hashing
   - Session management
   - Brute force protection

2. **Role-Based Access**
   - User level permissions
   - Admin-only features
   - Secure authentication

### Data Protection
1. **Input Validation**
   - Form validation
   - SQL injection prevention
   - XSS protection

2. **Secure Transactions**
   - Encrypted data transmission
   - Secure payment processing
   - Privacy protection

## Troubleshooting

### Common Issues

#### Login Problems
1. **Forgot Password**
   - Contact administrator
   - Password reset process
   - Security verification

2. **Account Locked**
   - Check with administrator
   - Account reactivation
   - Security clearance

#### Shopping Cart Issues
1. **Items Not Adding**
   - Check stock availability
   - Verify product status
   - Clear browser cache

2. **Payment Problems**
   - Verify payment method
   - Check internet connection
   - Contact support

#### Technical Issues
1. **Page Not Loading**
   - Check internet connection
   - Clear browser cache
   - Try different browser

2. **Image Not Displaying**
   - Check image files
   - Verify file permissions
   - Contact administrator

### Support Contact

#### Getting Help
1. **Technical Support**
   - Email: support@nazwaazhf.com
   - Phone: +62-xxx-xxx-xxxx
   - Live chat available

2. **Documentation**
   - User manuals
   - Video tutorials
   - FAQ section

## Best Practices

### For Customers
1. **Account Security**
   - Use strong passwords
   - Log out after use
   - Keep credentials secure

2. **Shopping Tips**
   - Review orders carefully
   - Check delivery address
   - Save order confirmations

### For Administrators
1. **System Maintenance**
   - Regular backups
   - Monitor performance
   - Update security patches

2. **User Management**
   - Regular user audits
   - Role permission reviews
   - Account cleanup

## Updates and Maintenance

### System Updates
1. **Regular Updates**
   - Security patches
   - Feature improvements
   - Bug fixes

2. **Maintenance Schedule**
   - Scheduled downtime
   - Update notifications
   - Backup procedures

### Feature Requests
1. **Request Process**
   - Submit feature requests
   - Review and approval
   - Implementation timeline

2. **Feedback Integration**
   - User feedback collection
   - Priority assessment
   - Development planning

---

**Note**: This usage guide covers all major features of the Nazwaazhf Skincare application. For specific technical issues or custom requirements, please consult the technical documentation or contact support.
