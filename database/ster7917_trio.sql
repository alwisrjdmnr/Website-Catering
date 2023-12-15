-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Agu 2023 pada 04.01
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ster7917_trio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `categorieId` int(12) NOT NULL,
  `categorieName` varchar(255) NOT NULL,
  `categorieDesc` text NOT NULL,
  `categorieCreateDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`categorieId`, `categorieName`, `categorieDesc`, `categorieCreateDate`) VALUES
(27, 'Jajanan', 'Terdapat beragam pilihan menu snack & Jajanan dari yang tradisional maupun yang kekinian', '2023-08-16 09:15:06'),
(28, 'Makanan Kardus', 'Terdapat banyak pilihan menu nasi kotak yang lezat dengan harga terjangkau', '2023-08-16 09:21:43'),
(29, 'Prasmanan', 'Terdapat beragam pilihan menu makanan dari yang tradisional maupun yang kekinian', '2023-08-16 09:22:44'),
(30, 'Hantaran Lamaran', 'Terdapat beragam pilihan menu snack & Jajanan untuk hantaran dari yang tradisional maupun yang kekinian', '2023-08-16 09:23:45'),
(31, 'Dekorasi', 'dekorasi', '2023-08-18 09:23:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `contactId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phoneNo` bigint(21) NOT NULL,
  `orderId` int(21) NOT NULL DEFAULT 0 COMMENT 'If problem is not related to the order then order id = 0',
  `message` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`contactId`, `userId`, `email`, `phoneNo`, `orderId`, `message`, `time`) VALUES
(1, 6, 'syarifabdullah0200@gmail.com', 85727161005, 11, 'pemesanan', '2023-08-18 09:48:15'),
(2, 6, 'syarifabdullah0200@gmail.com', 85727161005, 11, 'pemesanan', '2023-08-18 09:50:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contactreply`
--

CREATE TABLE `contactreply` (
  `id` int(21) NOT NULL,
  `contactId` int(21) NOT NULL,
  `userId` int(23) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `deliverydetails`
--

CREATE TABLE `deliverydetails` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `deliveryBoyName` varchar(35) NOT NULL,
  `deliveryBoyPhoneNo` bigint(25) NOT NULL,
  `deliveryTime` int(200) NOT NULL COMMENT 'Time in minutes',
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id` bigint(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `cost` int(15) NOT NULL,
  `ongkirCreateDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id`, `city`, `cost`, `ongkirCreateDate`) VALUES
(8, 'Ambil Sendiri', 0, '2023-08-18'),
(9, 'Kecamatan Kota', 0, '2023-08-18'),
(10, 'Kecamatan Jekulo', 40000, '2023-08-18'),
(11, 'Kecamatan Undaan', 40000, '2023-08-18'),
(12, 'Kecamatan Kaliwungu', 35000, '2023-08-18'),
(13, 'Kecamatan Mejobo', 30000, '2023-08-18'),
(14, 'Kecamatan Jati', 30000, '2023-08-18'),
(15, 'Kecamatan Gebog', 32000, '2023-08-18'),
(16, 'Kecamatan Dawe', 35000, '2023-08-18'),
(17, 'Kecamatan Bae', 28000, '2023-08-18'),
(18, 'Kota Pati', 65000, '2023-08-18'),
(19, 'Kota Demak', 60000, '2023-08-18'),
(20, 'Kota Jepara', 65000, '2023-08-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `produkId` int(21) NOT NULL,
  `itemQuantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orderitems`
--

INSERT INTO `orderitems` (`id`, `orderId`, `produkId`, `itemQuantity`) VALUES
(1, 1, 71, 10),
(2, 1, 69, 10),
(3, 2, 70, 15),
(4, 3, 71, 10),
(5, 4, 71, 1),
(6, 5, 71, 10),
(7, 6, 71, 10),
(8, 7, 70, 10),
(9, 8, 73, 1),
(10, 9, 73, 30),
(11, 10, 81, 1),
(12, 11, 84, 30),
(13, 11, 85, 30),
(14, 11, 93, 30),
(15, 12, 72, 100),
(16, 13, 75, 30),
(17, 14, 78, 30),
(18, 15, 104, 100),
(19, 16, 72, 30),
(20, 17, 72, 30),
(21, 18, 73, 1),
(22, 19, 73, 1),
(23, 20, 73, 1),
(24, 21, 73, 1),
(25, 22, 73, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `orderId` int(21) NOT NULL,
  `id_unik` varchar(20) DEFAULT NULL,
  `userId` int(21) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zipCode` text DEFAULT NULL,
  `phoneNo` bigint(21) DEFAULT NULL,
  `amount` int(200) DEFAULT NULL,
  `paymentMode` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=cash on delivery, \r\n1=online ',
  `orderStatus` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '0=Order Placed.\r\n1=Order Confirmed.\r\n2=Preparing your Order.\r\n3=Your order is on the way!\r\n4=Order Delivered.\r\n5=Order Denied.\r\n6=Order Cancelled.',
  `orderDate` date NOT NULL DEFAULT current_timestamp(),
  `bank` varchar(20) DEFAULT NULL,
  `tujuan` varchar(20) NOT NULL,
  `va_number` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `metode` varchar(50) DEFAULT NULL,
  `pengiriman` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`orderId`, `id_unik`, `userId`, `address`, `zipCode`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`, `bank`, `tujuan`, `va_number`, `status`, `metode`, `pengiriman`) VALUES
(9, '977281310', 6, 'desa barongan, desa barongan', 'tidak ada', 85876736291, 1065000, '0', '0', '2023-08-18', NULL, 'Kecamatan Kota', NULL, 0, 'Rapat', '2023-08-25 08:55:00'),
(10, '1lXjC', 6, 'Karang Bener, Lapangan Ngelo', 'tidak ada', 85876736291, 503000, '0', '0', '2023-08-18', NULL, 'Kecamatan Bae', NULL, 0, 'Pengajian', '2023-09-01 15:57:00'),
(11, 'OdzRg', 6, 'desa barongan, desa barongan', '', 85876736291, 705000, '0', '6', '2023-08-18', 'bni', 'Kecamatan Kota', '9885775884900400', 1, 'Pengajian', '2023-09-07 09:59:00'),
(12, 'a1AM8', 6, 'Desa Glantengan, Jenang 33 masuk mentok', '', 85876736291, 2000000, '0', '0', '2023-08-18', 'bni', 'Ambil Sendiri', '9885775884900400', 1, 'Ulang Tahun', '2023-08-25 08:01:00'),
(13, 'TQFnL', 6, 'Barongan, Kerjanan', 'tidak ada', 85727161005, 1200000, '0', '0', '2023-08-18', NULL, 'Kecamatan Kota', NULL, 0, 'pengajian', '2023-09-08 09:17:00'),
(14, 'BgDkH', 6, 'Barongan, Kerjanan', '', 85727161005, 5400000, '0', '0', '2023-08-18', NULL, 'Ambil Sendiri', NULL, 0, 'pengajian', '2023-08-26 00:30:00'),
(15, 'kURnY', 6, 'burikan, burikan', '', 85727161005, 3800000, '0', '0', '2023-08-18', NULL, 'Kecamatan Kota', NULL, 0, 'pengajian', '2023-09-01 09:32:00'),
(16, 'KxSs0', 6, 'Barongan, sd 1 barongan', '', 85727161005, 600000, '0', '0', '2023-08-18', NULL, 'Kecamatan Kota', NULL, 0, 'pengajian', '2023-09-01 00:16:00'),
(17, '1290524969', 6, 'Barongan, barongan', 'syarif', 85727, 640000, '0', '0', '2023-08-18', NULL, 'Kecamatan Undaan', NULL, 0, 'pengajian', '2023-09-01 09:58:00'),
(18, '62J9j', 6, 'Barongan, barongan', 'syarif', 85727161005, 35500, '0', '0', '2023-08-22', NULL, 'Ambil Sendiri', NULL, 0, 'pengajian', '2023-09-08 10:23:00'),
(19, 'ZLmAl', 6, 'Barongan, barongan', 'syarif', 85727161005, 35500, '0', '0', '2023-08-22', NULL, 'Ambil Sendiri', NULL, 0, 'pengajian', '2023-09-08 10:28:00'),
(20, 'ys4j9', 6, 'Barongan, barongan', 'syarif', 85727161005, 35500, '0', '0', '2023-08-22', NULL, 'Ambil Sendiri', NULL, 0, 'pengajian', '2023-08-25 10:55:00'),
(21, 'NXdLA', 6, 'Barongan, barongan', 'syarif', 85727161005, 75500, '0', '0', '2023-08-22', NULL, 'Kecamatan Undaan', NULL, 0, 'pengajian', '2023-08-24 10:59:00'),
(22, 'm5hej', 6, 'Barongan, barongan', 'syarif', 85727161005, 35500, '0', '0', '2023-08-24', NULL, 'Ambil Sendiri', NULL, 0, 'pengajian', '2023-09-01 10:15:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `produkId` int(12) NOT NULL,
  `produkName` varchar(255) NOT NULL,
  `produkPrice` int(12) NOT NULL,
  `produkDesc` text NOT NULL,
  `produkCategorieId` int(12) NOT NULL,
  `produkPubDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`produkId`, `produkName`, `produkPrice`, `produkDesc`, `produkCategorieId`, `produkPubDate`) VALUES
(72, 'Nasi Kuning Dos 18', 20000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 09:32:00'),
(73, 'Nasi Ayam Goreng Kalasan Kampung 1/4', 35500, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 09:51:18'),
(74, 'Nasi Ayam Goreng Kalasan Pedaging 1/4', 30000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 09:52:45'),
(75, 'Nasi Ikan Gurami Bakar / Asam Manis', 40000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 09:56:40'),
(76, 'Nasi Rames Bola-bola Daging', 21000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 09:59:52'),
(77, 'Nasi Ayam Kremes Kampung 1/2 (Dos 22)', 63000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 10:04:39'),
(78, 'Nasi Ayam Kremes Kampung Utuh (Embor)', 180000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 10:07:54'),
(79, 'Nasi Ayam Kremes Kampung Utuh (Stainless)', 180000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 10:08:45'),
(80, 'Paket Nasi Tumpeng 10 Orang', 350000, 'Paket Menu Harga Lebih Terjangkau', 28, '2023-08-16 10:13:52'),
(81, 'Paket Nasi Tumpeng 15 Orang', 475000, 'Paket Menu Harga Lebih Terjangkau', 28, '2023-08-16 10:16:54'),
(82, 'Nasi Kuning Tanpa Ayam,Kering Tempe (Mika Tanggung)', 8500, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 10:19:07'),
(83, 'Nasi Kuning Ayam Pedaging 1/8 ( Tumini Mika coklat)', 35000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per dos)', 28, '2023-08-16 10:21:00'),
(84, 'Lontong Sate Ayam', 11000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per piring)', 29, '2023-08-16 10:29:46'),
(85, 'Siomay', 9000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per piring)', 29, '2023-08-16 10:31:16'),
(86, 'Nasi Liwet Ayam Kampung', 14000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per piring)', 29, '2023-08-16 10:32:02'),
(87, 'Aneka Bubur', 4000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per piring)', 29, '2023-08-16 10:32:59'),
(88, 'Chiken Cordon', 15000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per piring)', 29, '2023-08-16 10:34:21'),
(89, 'Gado-gado', 12500, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per piring)', 29, '2023-08-16 10:36:24'),
(90, 'Galantin', 10000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per piring)', 29, '2023-08-16 10:38:34'),
(91, 'Lentog + Sate Telur + Kerupuk', 11500, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per piring)', 29, '2023-08-16 10:43:02'),
(92, 'Zuppa Soup', 15000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per piring)', 29, '2023-08-16 10:43:55'),
(93, 'Jus Jambu / Jeruk', 3500, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per gelas)', 29, '2023-08-16 10:45:40'),
(94, 'Es Cream', 5000, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per gelas)', 29, '2023-08-16 10:46:33'),
(95, 'Es Coctail', 4500, 'Dijamin Enak Dan Harga Terjangkau (harga yang tertera dibawah adalah harga satuan per gelas)', 29, '2023-08-16 10:47:08'),
(96, 'Pukis Kecil (isi 2)', 2000, ' Dijamin Enak Dan Harga Terjangkau', 27, '2023-08-18 05:19:30'),
(97, 'Bolu Gulung', 2500, ' Dijamin Enak Dan Harga Terjangkau ', 27, '2023-08-18 05:20:58'),
(98, 'Putu Ayu', 2250, ' Dijamin Enak Dan Harga Terjangkau ', 27, '2023-08-18 05:22:16'),
(99, 'Klepon', 2250, ' Dijamin Enak Dan Harga Terjangkau ', 27, '2023-08-18 05:23:13'),
(100, 'Sosis Ayam', 2000, ' Dijamin Enak Dan Harga Terjangkau ', 27, '2023-08-18 05:24:19'),
(101, 'Bogis', 2000, ' Dijamin Enak Dan Harga Terjangkau ', 27, '2023-08-18 05:25:29'),
(102, 'Kue Sus', 3500, ' Dijamin Enak Dan Harga Terjangkau ', 27, '2023-08-18 05:27:35'),
(103, 'Lapis', 2500, ' Dijamin Enak Dan Harga Terjangkau ', 27, '2023-08-18 05:28:44'),
(104, 'Paket Hantaran Sosis Ayam isi 20', 38000, ' Dijamin Enak Dan Harga Terjangkau ', 30, '2023-08-18 05:32:23'),
(105, 'Paket Hantaran Dadar Gulung Enten isi 20', 40000, ' Dijamin Enak Dan Harga Terjangkau ', 30, '2023-08-18 05:34:00'),
(106, 'Paket Hantaran Lumpia isi 20', 42000, ' Dijamin Enak Dan Harga Terjangkau ', 30, '2023-08-18 05:35:22'),
(107, 'Paket Hantaran Telur Ceplok Semar Mesem isi 20', 45000, ' Dijamin Enak Dan Harga Terjangkau ', 30, '2023-08-18 05:37:10'),
(108, 'Pukis Kecil (isi 2)', 2500, 'Pukis Kecil (isi 2)', 27, '2023-08-18 09:24:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sitedetail`
--

CREATE TABLE `sitedetail` (
  `tempId` int(11) NOT NULL,
  `systemName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `contact1` bigint(21) NOT NULL,
  `contact2` bigint(21) DEFAULT NULL COMMENT 'Optional',
  `address` text NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sitedetail`
--

INSERT INTO `sitedetail` (`tempId`, `systemName`, `email`, `contact1`, `contact2`, `address`, `dateTime`) VALUES
(1, 'Catering Trio', 'CateringTrio3@gmail.com', 85727161005, 85876736291, 'Desa Barongan', '2021-03-23 19:56:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(21) NOT NULL,
  `username` varchar(21) NOT NULL,
  `firstName` varchar(21) NOT NULL,
  `lastName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `userType` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=user\r\n1=admin',
  `password` varchar(255) NOT NULL,
  `joinDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`, `joinDate`) VALUES
(1, 'admin', 'yulianti', 'yulianti', 'yulianti@gmail.com', 85876736291, '1', '$2y$10$AAfxRFOYbl7FdN17rN3fgeiPu/xQrx6MnvRGzqjVHlGqHAM4d9T1i', '2021-04-11 11:40:58'),
(5, 'faris', 'faris', 'akbar', 'faris@gmail.com', 1111111111, '0', '$2y$10$eC//LQG4jpvbGh68AEWSxOdm0.B3MlsQYZMjasyLMWpLITJtrXzbi', '2023-08-02 00:54:14'),
(6, 'syarif', 'syarif', 'abdullah', 'syarifabdullah0200@gmail.com', 85876736291, '0', '$2y$10$uWgrgg/l3DcWPgc.wdbhBuhgR6OA/3M6mwexyMlC4.J2UOX8k.Uvu', '2023-08-18 03:39:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `viewcart`
--

CREATE TABLE `viewcart` (
  `cartItemId` int(11) NOT NULL,
  `produkId` int(11) NOT NULL,
  `itemQuantity` int(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ongkir` int(15) DEFAULT NULL,
  `lokasi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `viewcart`
--

INSERT INTO `viewcart` (`cartItemId`, `produkId`, `itemQuantity`, `userId`, `addedDate`, `ongkir`, `lokasi`) VALUES
(22, 72, 1, 1, '2023-08-16 17:11:07', 10000, 'Kudus');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorieId`);
ALTER TABLE `categories` ADD FULLTEXT KEY `categorieName` (`categorieName`,`categorieDesc`);

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactId`);

--
-- Indeks untuk tabel `contactreply`
--
ALTER TABLE `contactreply`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deliverydetails`
--
ALTER TABLE `deliverydetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderId` (`orderId`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produkId`);
ALTER TABLE `produk` ADD FULLTEXT KEY `pizzaName` (`produkName`,`produkDesc`);

--
-- Indeks untuk tabel `sitedetail`
--
ALTER TABLE `sitedetail`
  ADD PRIMARY KEY (`tempId`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `viewcart`
--
ALTER TABLE `viewcart`
  ADD PRIMARY KEY (`cartItemId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `categorieId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `contactId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `contactreply`
--
ALTER TABLE `contactreply`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `deliverydetails`
--
ALTER TABLE `deliverydetails`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `produkId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT untuk tabel `sitedetail`
--
ALTER TABLE `sitedetail`
  MODIFY `tempId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `viewcart`
--
ALTER TABLE `viewcart`
  ADD CONSTRAINT `viewcart_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
