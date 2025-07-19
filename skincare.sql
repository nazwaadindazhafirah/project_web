-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2025 pada 05.33
-- Versi server: 11.6.2-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skincare`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat_pengiriman`
--

CREATE TABLE `alamat_pengiriman` (
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`, `harga_satuan`) VALUES
(1, 1, 1, 1, 45000),
(2, 2, 5, 1, 46000),
(3, 2, 7, 1, 40000),
(4, 3, 5, 1, 46000),
(5, 4, 1, 1, 45000),
(6, 5, 10, 1, 70000),
(7, 6, 1, 1, 45000),
(8, 7, 1, 1, 45000),
(9, 8, 1, 2, 45000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aktivitas` varchar(255) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text NOT NULL,
  `status_baca` enum('belum','sudah') DEFAULT 'belum',
  `waktu_kirim` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `brand`, `harga`, `gambar`, `deskripsi`, `stok`) VALUES
(1, 'Glow Cleanser 1', 'Glow2Glow', 45000, 'glow2glow1.jpg', NULL, 10),
(2, 'Glow Serum 1', 'Glow2Glow', 50000, 'glow2glow2.jpg', NULL, 8),
(3, 'Skintific Serum A', 'Skintific', 70000, 'skintific1.jpg', NULL, 5),
(4, 'Glow Cleanser 1', 'Glow2Glow', 45000, 'glow1.jpg', 'Pembersih wajah lembut.', 10),
(5, 'Glow Cleanser 2', 'Glow2Glow', 46000, 'glow2.jpg', 'Membersihkan dan melembapkan.', 15),
(6, 'Glow Serum', 'Glow2Glow', 50000, 'glow3.jpg', 'Serum pencerah alami.', 8),
(7, 'Glow Toner', 'Glow2Glow', 40000, 'glow4.jpg', 'Toner menyegarkan wajah.', 12),
(8, 'Glow Moisturizer', 'Glow2Glow', 48000, 'glow5.jpg', 'Pelembap kulit sehat.', 7),
(9, 'Glow Mask', 'Glow2Glow', 52000, 'glow6.jpg', 'Masker wajah glowing.', 9),
(10, 'Skintific Serum A', 'Skintific', 70000, 'skintific1.jpg', 'Serum untuk kulit sensitif.', 10),
(11, 'Skintific Cleanser', 'Skintific', 65000, 'skintific2.jpg', 'Pembersih wajah lembut.', 12),
(12, 'Skintific Toner', 'Skintific', 60000, 'skintific3.jpg', 'Toner menghidrasi kulit.', 8),
(13, 'Skintific Moisturizer', 'Skintific', 68000, 'skintific4.jpg', 'Melembapkan seharian.', 14),
(14, 'Skintific Night Cream', 'Skintific', 75000, 'skintific5.jpg', 'Krim malam untuk regenerasi.', 6),
(15, 'Skintific Sunscreen', 'Skintific', 72000, 'skintific6.jpg', 'Perlindungan dari sinar UV.', 11),
(16, 'Emina Bright Stuff', 'Emina', 30000, 'emina1.jpg', 'Facial wash mencerahkan.', 20),
(17, 'Emina Sun Protection', 'Emina', 35000, 'emina2.jpg', 'Sunscreen ringan.', 18),
(18, 'Emina Moisturizer', 'Emina', 33000, 'emina3.jpg', 'Lembut untuk kulit remaja.', 14),
(19, 'Emina Serum Glow', 'Emina', 40000, 'emina4.jpg', 'Serum untuk glowing skin.', 10),
(20, 'Emina Lip Mask', 'Emina', 25000, 'emina5.jpg', 'Perawatan bibir semalaman.', 25),
(21, 'Emina Toner', 'Emina', 32000, 'emina6.jpg', 'Toner menyegarkan wajah.', 17),
(22, 'Originote Gentle Wash', 'Originote', 55000, 'originote1.jpg', 'Sabun wajah untuk kulit sensitif.', 12),
(23, 'Originote Serum', 'Originote', 58000, 'originote2.jpg', 'Serum anti aging.', 9),
(24, 'Originote Cream', 'Originote', 59000, 'originote3.jpg', 'Krim malam lembut.', 11),
(25, 'Originote Day Cream', 'Originote', 57000, 'originote4.jpg', 'Perawatan siang hari.', 10),
(26, 'Originote Toner', 'Originote', 56000, 'originote5.jpg', 'Toner menghidrasi.', 13),
(27, 'Originote Mask', 'Originote', 61000, 'originote6.jpg', 'Masker wajah relaksasi.', 7),
(28, 'Garnier Facial Foam', 'Garnier', 40000, 'garnier1.jpg', 'Sabun pembersih wajah.', 15),
(29, 'Garnier Light Complete', 'Garnier', 45000, 'garnier2.jpg', 'Krim pencerah wajah.', 10),
(30, 'Garnier Serum Mask', 'Garnier', 50000, 'garnier3.jpg', 'Masker serum instan.', 8),
(31, 'Garnier Night Cream', 'Garnier', 47000, 'garnier4.jpg', 'Krim malam pencerah.', 9),
(32, 'Garnier Eye Roll', 'Garnier', 52000, 'garnier5.jpg', 'Perawatan mata.', 5),
(33, 'Garnier Toner', 'Garnier', 43000, 'garnier6.jpg', 'Toner menyegarkan.', 13),
(34, 'L’Oreal Revitalift', 'L\'Oreal', 85000, 'loreal1.jpg', 'Krim anti-aging.', 7),
(35, 'L’Oreal Cleanser', 'L\'Oreal', 60000, 'loreal2.jpg', 'Pembersih wajah.', 9),
(36, 'L’Oreal Serum', 'L\'Oreal', 95000, 'loreal3.jpg', 'Serum wajah premium.', 6),
(37, 'L’Oreal Toner', 'L\'Oreal', 62000, 'loreal4.jpg', 'Toner revitalisasi.', 8),
(38, 'L’Oreal Eye Cream', 'L\'Oreal', 99000, 'loreal5.jpg', 'Perawatan mata lengkap.', 5),
(39, 'L’Oreal Day Cream', 'L\'Oreal', 88000, 'loreal6.jpg', 'Perawatan siang.', 10),
(40, 'Azarine Sunscreen Gel', 'Azarine', 45000, 'azarine1.jpg', 'Gel sunscreen ringan.', 18),
(41, 'Azarine Night Cream', 'Azarine', 47000, 'azarine2.jpg', 'Krim malam melembutkan.', 9),
(42, 'Azarine Serum', 'Azarine', 49000, 'azarine3.jpg', 'Serum brightening.', 10),
(43, 'Azarine Face Wash', 'Azarine', 43000, 'azarine4.jpg', 'Sabun wajah menyegarkan.', 12),
(44, 'Azarine Moisturizer', 'Azarine', 48000, 'azarine5.jpg', 'Krim pelembap.', 8),
(45, 'Azarine Toner', 'Azarine', 46000, 'azarine6.jpg', 'Toner ringan kulit.', 11),
(46, 'Scarlett Brightly Serum', 'Scarlett', 70000, 'scarlett1.jpg', 'Serum pencerah wajah.', 11),
(47, 'Scarlett Facial Wash', 'Scarlett', 65000, 'scarlett2.jpg', 'Sabun wajah lembut.', 13),
(48, 'Scarlett Toner', 'Scarlett', 62000, 'scarlett3.jpg', 'Toner mencerahkan.', 9),
(49, 'Scarlett Cream', 'Scarlett', 68000, 'scarlett4.jpg', 'Krim siang dan malam.', 7),
(50, 'Scarlett Mask', 'Scarlett', 72000, 'scarlett5.jpg', 'Masker alami.', 6),
(51, 'Scarlett Body Serum', 'Scarlett', 75000, 'scarlett6.jpg', 'Perawatan tubuh cerah.', 10),
(52, 'L’Oreal Revitalift', 'L\'Oreal', 85000, 'loreal1.jpg', 'Krim anti-aging.', 7),
(53, 'L’Oreal Cleanser', 'L\'Oreal', 60000, 'loreal2.jpg', 'Pembersih wajah.', 9),
(54, 'L’Oreal Serum', 'L\'Oreal', 95000, 'loreal3.jpg', 'Serum wajah premium.', 6),
(55, 'L’Oreal Toner', 'L\'Oreal', 62000, 'loreal4.jpg', 'Toner revitalisasi.', 8),
(56, 'L’Oreal Eye Cream', 'L\'Oreal', 99000, 'loreal5.jpg', 'Perawatan mata lengkap.', 5),
(57, 'L’Oreal Day Cream', 'L\'Oreal', 88000, 'loreal6.jpg', 'Perawatan siang.', 10),
(58, 'Loreal Day Cream', 'Loreal', 75000, 'loreal1.jpg', 'Krim siang mencerahkan.', 10),
(59, 'Loreal Night Cream', 'Loreal', 78000, 'loreal2.jpg', 'Krim malam untuk regenerasi kulit.', 8),
(60, 'Loreal Serum Vitamin C', 'Loreal', 120000, 'loreal3.jpg', 'Serum dengan kandungan vitamin C.', 12),
(61, 'Loreal Cleanser Foam', 'Loreal', 58000, 'loreal4.jpg', 'Pembersih wajah lembut.', 9),
(62, 'Loreal Toner Fresh', 'Loreal', 62000, 'loreal5.jpg', 'Toner segar untuk semua jenis kulit.', 7),
(63, 'Loreal Mask Sheet', 'Loreal', 33000, 'loreal6.jpg', 'Masker wajah untuk hidrasi maksimal.', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `metode` varchar(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `metode_pembayaran`, `total`, `metode`, `tanggal`) VALUES
(1, 4, 'Transfer Bank', 45000, NULL, '2025-07-08 14:19:41'),
(2, 4, 'Transfer Bank', 86000, NULL, '2025-07-08 14:45:16'),
(3, 11, 'COD', 46000, NULL, '2025-07-08 18:07:40'),
(4, 12, 'Transfer Bank', 45000, NULL, '2025-07-16 03:48:53'),
(5, 12, 'Transfer Bank', 70000, NULL, '2025-07-16 03:49:05'),
(6, 13, 'Transfer Bank', 45000, NULL, '2025-07-18 18:48:50'),
(7, 15, 'Transfer Bank', 45000, NULL, '2025-07-18 19:22:04'),
(8, 12, 'Transfer Bank', 90000, NULL, '2025-07-19 05:10:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `isi_ulasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_user`, `id_produk`, `isi`, `tanggal`, `isi_ulasan`) VALUES
(1, 12, NULL, NULL, '2025-07-19 10:50:21', 'sangat bagus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `level` enum('admin','user') NOT NULL DEFAULT 'user',
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `email`, `password`, `role`, `level`, `alamat`) VALUES
(1, NULL, 'Admin', 'admin@skincare.com', 'admin', 'admin', 'user', NULL),
(2, 'wawek', 'wawa', 'wawa@gmail.com', '$2y$10$WrAsKEYBLXnQYCd41E.SMeQA9KWCFsOv6QEMtYk/MutSU4wmdzRl6', 'admin', 'user', NULL),
(4, 'nazwa', 'Nazwa Adinda Zhafirah', 'nazwaazhf@gmail.com', '$2y$10$zJ/LbScpyARNDefRtYdUg.8Zvs7mR2xjU5Qg9GCU.2BFlB/tv8Ck2', 'user', 'user', 'jln tarakan'),
(6, 'admin', 'Admin Nazwa', NULL, '$2y$10$vi7cxKXJNJhexGnrdU4ZReb6fpvjhkMpJaZwtaq3LIJFI4D.n9Vt6', 'user', 'admin', NULL),
(7, 'adil', 'a\'deel ahmad fazza', 'adil@gmail.com', '$2y$10$hwOcA7suFQcXt4ecMX6QhunKaUXkqQkVD4PXSOEHiMQ/kOUENfP.a', 'user', 'user', NULL),
(9, 'zhafirah@gmail.com', 'zhafirah', NULL, '$2y$10$P1o6aQkLsnJypejiEv48i.RW6E7F/T3sPP7s.mnxjaT6eLor3msPq', 'user', 'user', NULL),
(10, 'adil12@gmail.com', 'adill', NULL, '$2y$10$jybCKW/AP/LXSXva0QgNbexT1Ij95iknlxqufvb7eLif6ZsOfs0hC', 'user', 'admin', NULL),
(11, 'dinda', 'adinda', 'din@gmail.com', '$2y$10$cKFVsb0IhptCeSU6dDbOc.pYHIznkJeZqT1g9RMYy0QMjD.4SReJC', 'user', 'user', NULL),
(12, 'wawawa', 'nazwa', 'wawa12@gmail.com', '$2y$10$vxCydnqm4rDxMAXtrr3sLeide7aot6Qa2YDbywJKpAB0ZK45zVTlS', 'user', 'user', NULL),
(13, 'benay', 'nalla', 'nala@gmail.com', '$2y$10$r0XXjYRU759O7Y7JE43bH.SJ8DT2dJaaQDtm5h07e3yYBX1lw4sbK', 'user', 'user', NULL),
(15, 'hikma', 'hikma', 'hikma@gmail.com', '$2y$10$KdH5dlMP8YoZohZFqQSS2.q7HX1wqCxJBEPSfqIXMYw5DtuAh4Ihm', 'user', 'user', 'jln tarakan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `tanggal_ditambahkan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamat_pengiriman`
--
ALTER TABLE `alamat_pengiriman`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamat_pengiriman`
--
ALTER TABLE `alamat_pengiriman`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alamat_pengiriman`
--
ALTER TABLE `alamat_pengiriman`
  ADD CONSTRAINT `alamat_pengiriman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
