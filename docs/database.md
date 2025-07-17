# Database Documentation - Nazwaazhf Skincare

## Overview
This document provides comprehensive information about the database structure used in the Nazwaazhf Skincare e-commerce system.

## Database Schema

### Database Name: `nazwaazhf_skincare`

## Tables Structure

### 1. `user` Table
Stores user account information for both customers and administrators.

```sql
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
);
```

**Fields:**
- `id_user`: Primary key, auto-increment
- `nama`: User's full name
- `username`: Unique username for login
- `email`: User's email address
- `password`: Hashed password using PHP password_hash()
- `level`: User role (admin/user)
- `created_at`: Account creation timestamp

### 2. `produk` Table
Contains product information for all skincare items.

```sql
CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(200) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `deskripsi` text,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) DEFAULT 0,
  `gambar` varchar(255),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_produk`)
);
```

**Fields:**
- `id_produk`: Primary key, auto-increment
- `nama_produk`: Product name
- `brand`: Brand name (Glow2Glow, Skintific, Emina, etc.)
- `deskripsi`: Product description
- `harga`: Product price
- `stok`: Available stock quantity
- `gambar`: Product image filename
- `created_at`: Product creation timestamp
- `updated_at`: Last update timestamp

### 3. `keranjang` Table
Manages shopping cart items for users.

```sql
CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_keranjang`),
  FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE,
  FOREIGN KEY (`id_produk`) REFERENCES `produk`(`id_produk`) ON DELETE CASCADE
);
```

**Fields:**
- `id_keranjang`: Primary key, auto-increment
- `id_user`: Foreign key to user table
- `id_produk`: Foreign key to produk table
- `jumlah`: Quantity of items in cart
- `created_at`: Item added timestamp

### 4. `transaksi` Table
Records completed transactions.

```sql
CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tanggal` timestamp DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  PRIMARY KEY (`id_transaksi`),
  FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
);
```

**Fields:**
- `id_transaksi`: Primary key, auto-increment
- `id_user`: Foreign key to user table
- `metode_pembayaran`: Payment method (Transfer Bank, COD, E-Wallet)
- `total`: Total transaction amount
- `tanggal`: Transaction timestamp
- `status`: Transaction status

### 5. `detail_transaksi` Table
Stores detailed information about items in each transaction.

```sql
CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`jumlah` * `harga_satuan`) STORED,
  PRIMARY KEY (`id_detail`),
  FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi`(`id_transaksi`) ON DELETE CASCADE,
  FOREIGN KEY (`id_produk`) REFERENCES `produk`(`id_produk`) ON DELETE CASCADE
);
```

**Fields:**
- `id_detail`: Primary key, auto-increment
- `id_transaksi`: Foreign key to transaksi table
- `id_produk`: Foreign key to produk table
- `jumlah`: Quantity purchased
- `harga_satuan`: Unit price at time of purchase
- `subtotal`: Calculated subtotal (jumlah × harga_satuan)

## Database Relationships

### Entity Relationship Diagram (ERD)

```
user (1) -----> (N) keranjang (N) -----> (1) produk
  |                                         ^
  |                                         |
  v                                         |
transaksi (1) -----> (N) detail_transaksi (N)
```

### Key Relationships:
1. **User to Keranjang**: One-to-Many (One user can have multiple cart items)
2. **Produk to Keranjang**: One-to-Many (One product can be in multiple carts)
3. **User to Transaksi**: One-to-Many (One user can have multiple transactions)
4. **Transaksi to Detail_Transaksi**: One-to-Many (One transaction can have multiple items)
5. **Produk to Detail_Transaksi**: One-to-Many (One product can be in multiple transaction details)

## Sample Data

### Sample Users
```sql
INSERT INTO `user` (`nama`, `username`, `email`, `password`, `level`) VALUES
('Administrator', 'admin', 'admin@nazwaazhf.com', '$2y$10$...', 'admin'),
('Nazwa Azhar', 'nazwa', 'nazwa@example.com', '$2y$10$...', 'user'),
('Customer Test', 'customer', 'customer@example.com', '$2y$10$...', 'user');
```

### Sample Products
```sql
INSERT INTO `produk` (`nama_produk`, `brand`, `deskripsi`, `harga`, `stok`, `gambar`) VALUES
('Glow2Glow Vitamin C Serum', 'Glow2Glow', 'Serum vitamin C untuk kulit glowing', 89000, 50, 'vitamin-c-serum.jpg'),
('Skintific Niacinamide Serum', 'Skintific', 'Serum niacinamide untuk mencerahkan kulit', 95000, 30, 'niacinamide-serum.jpg'),
('Emina Sun Protection SPF 30', 'Emina', 'Sunscreen untuk perlindungan optimal', 45000, 100, 'sunscreen-spf30.jpg');
```

## Database Backup and Restore

### Creating Backup
```bash
mysqldump -u username -p nazwaazhf_skincare > backup_nazwaazhf_skincare.sql
```

### Restoring Backup
```bash
mysql -u username -p nazwaazhf_skincare < backup_nazwaazhf_skincare.sql
```

## Security Considerations

1. **Password Security**: All passwords are hashed using PHP's `password_hash()` function
2. **SQL Injection Prevention**: All queries use prepared statements or proper escaping
3. **Foreign Key Constraints**: Ensure data integrity and prevent orphaned records
4. **User Roles**: Separate admin and user access levels
5. **Data Validation**: Input validation on both client and server side

## Performance Optimization

1. **Indexes**: Primary keys and foreign keys are automatically indexed
2. **Query Optimization**: Use efficient JOIN operations for related data
3. **Pagination**: Implement pagination for large result sets
4. **Caching**: Consider implementing query caching for frequently accessed data

## Migration Scripts

### Initial Database Setup
```sql
-- Create database
CREATE DATABASE `nazwaazhf_skincare` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use database
USE `nazwaazhf_skincare`;

-- Create tables (run the CREATE TABLE statements above)
```

### Sample Data Population
```sql
-- Insert sample data (run the INSERT statements above)
```

---

**Note**: This database structure is designed to be scalable and maintainable. Regular backups and proper indexing are recommended for production use.
