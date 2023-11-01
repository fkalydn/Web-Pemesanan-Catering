-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2019 at 06:44 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `produk_id`, `qty`, `pesanan_id`) VALUES
(21, 1, 50, 27),
(22, 4, 100, 28),
(23, 7, 100, 28),
(24, 10, 100, 28),
(26, 1, 100, 30),
(27, 7, 50, 30),
(28, 9, 50, 30),
(29, 9, 500, 31),
(30, 2, 500, 32),
(32, 1, 20, 34),
(33, 6, 20, 34),
(34, 10, 20, 34),
(36, 2, 40, 36),
(37, 1, 40, 36),
(38, 2, 40, 37),
(39, 1, 40, 37);

-- --------------------------------------------------------

--
-- Table structure for table `info_pembayaran`
--

CREATE TABLE `info_pembayaran` (
  `id` int(5) NOT NULL,
  `info` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_pembayaran`
--

INSERT INTO `info_pembayaran` (`id`, `info`) VALUES
(1, 'Transaksi pembayaran bisa di bayar DP 50% dulu sebelum hari H.\r\nJika tidak, maka transaksi akan otomatis di batalkan .\r\n\r\nPembayaran Transaksi Bisa Melalui Rekening Di Bawah Ini\r\nBank CIMB Niaga => 7036623941000  a/n Fiki Aliyudin\r\nBank Mandiri => 8976123479999 a/n Fiki Aliyudin\r\n\r\nkemudian konfirmasi pembayaran bisa di menu Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(5) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `nama`, `deskripsi`) VALUES
(6, 'Makanan', 'Berbagai macam makanan dengan olahan daging dll.'),
(7, 'Minuman', 'Aneka minuman tradisional dan modern.'),
(8, 'Hidangan Penutup', 'Lezat');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` int(5) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `ongkir` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `nama`, `ongkir`) VALUES
(2, 'Bogor', 10000),
(3, 'Jakarta', 20000),
(4, 'Depok', 11000),
(5, 'Tangerang', 14000),
(6, 'Bekasi', 18000);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_pengeluaran` int(11) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `Tanggal_pengeluaran` date NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_pengeluaran`, `nama_barang`, `Tanggal_pengeluaran`, `harga`, `jumlah`, `total`) VALUES
(41, 'Beras', '2017-12-02', 1500000, 20, 1500000),
(42, 'Gas', '2017-12-04', 20000, 5, 20000),
(43, 'Garam', '2019-08-09', 10000, 20, 200000),
(46, 'Ikan Gurame', '2019-08-11', 10000, 100, 1000000),
(47, 'Daging Ayam', '2019-08-10', 30000, 100, 3000000),
(48, 'Wajan', '2019-08-07', 50000, 5, 250000),
(49, 'Kompor Gas', '2019-08-01', 150000, 2, 300000),
(50, 'Piring', '2019-08-02', 5000, 100, 500000),
(51, 'Sendok', '2019-08-03', 2000, 100, 200000),
(52, 'Tepung Beras', '2019-08-08', 7000, 20, 140000),
(53, 'Minyak Goreng', '2019-08-06', 12000, 50, 600000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `file` varchar(70) NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('pending','verified','','') NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_pesanan`, `id_user`, `file`, `total`, `status`, `keterangan`, `created_at`) VALUES
(15, 31, 9, '49eb6a44db57cba8d66b3404fa9f0ad4struk.jpg', 5010000, 'verified', '', '2019-08-12 23:50:55'),
(16, 32, 9, '49eb6a44db57cba8d66b3404fa9f0ad4struk.jpg', 65100000, 'verified', 'Struk', '2019-08-13 11:53:18'),
(17, 34, 9, '49eb6a44db57cba8d66b3404fa9f0ad4struk.jpg', 530000, 'verified', 'Struk CIMB', '2019-08-13 12:35:02'),
(18, 35, 9, '49eb6a44db57cba8d66b3404fa9f0ad4struk.jpg', 200000, 'verified', 'Saya bayar 200000 dahulu ', '2019-08-15 12:42:34'),
(19, 36, 9, '49eb6a44db57cba8d66b3404fa9f0ad4struk.jpg', 1014000, 'verified', 'Lunas', '2019-08-15 13:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(5) NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `tanggal_digunakan` datetime NOT NULL,
  `user_id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(10) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `read` enum('0','1') NOT NULL,
  `status` enum('lunas','belum lunas','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `tanggal_pesan`, `tanggal_digunakan`, `user_id`, `nama`, `alamat`, `kota`, `ongkir`, `telephone`, `read`, `status`) VALUES
(27, '2019-08-11 03:43:11', '2019-08-15 00:00:00', 7, 'Fiki Aliyudin', 'Parakan Salak, Rt. 003/001, Kemang, Bogor', 'Bogor', 10000, '089608375792', '1', 'lunas'),
(28, '2019-08-11 06:40:49', '2019-08-15 14:00:00', 7, 'Fiki Aliyudin', 'Parakan Salak, Rt. 003/001, Kemang, Bogor', 'Bogor', 10000, '089608375792', '1', 'lunas'),
(30, '2019-08-12 17:34:02', '2019-08-16 14:00:00', 7, 'Fiki Aliyudin', 'Parakan Salak, Rt. 003/001, Kemang, Bogor', 'Bogor', 10000, '089608375792', '1', 'lunas'),
(31, '2019-08-12 18:23:31', '2019-08-16 18:00:00', 9, 'Azhar Yassar', 'Perumahan Bogor Nirwana Residence, Blok B5, No. 12', 'Bogor', 10000, '087812345678', '1', 'lunas'),
(32, '2019-08-13 06:48:52', '2019-08-16 18:00:00', 9, 'Azhar Yassar', 'Perumahan Bogor Nirwana Residence, Blok B5, No. 12', 'Bogor', 10000, '087812345678', '1', 'lunas'),
(34, '2019-08-13 07:03:25', '2019-08-17 10:00:00', 9, 'Azhar Yassar', 'Perumahan Bogor Nirwana Residence, Blok B5, No. 12', 'Bogor', 10000, '087812345678', '1', 'lunas'),
(36, '2019-08-15 08:11:56', '2019-08-30 13:50:00', 9, 'Azhar Yassar', 'Perumahan Bogor Nirwana Residence, Blok B5, No. 12', 'Tangerang', 14000, '087812345678', '1', 'lunas'),
(37, '2019-08-19 07:41:19', '2019-08-22 00:00:00', 9, 'Azhar Yassar', 'Perumahan Bogor Nirwana Residence, Blok B5, No. 12', 'Bogor', 10000, '087812345678', '1', 'belum lunas');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `kategori_produk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `gambar`, `harga`, `kategori_produk_id`) VALUES
(1, 'Ayam Bakar Taliwang', 'Dibuat dengan penuh cinta', '49eb6a44db57cba8d66b3404fa9f0ad4taliwang.jpg', '12000', 6),
(2, 'Ikan Gurame Bakar', 'Racikan daging ikan gurame', '49eb6a44db57cba8d66b3404fa9f0ad4gambar4.jpg', '13000', 6),
(4, 'Ayam Bakar', 'Ayam bakar asli Bandung ', '49eb6a44db57cba8d66b3404fa9f0ad4ayambakar.jpg', '25000', 6),
(5, 'Es Cendols', 'Minuman menyegarkan', '49eb6a44db57cba8d66b3404fa9f0ad4cendols.jpg', '3000', 7),
(6, 'Es Teler', 'Es teler sedap menyegarkan', '49eb6a44db57cba8d66b3404fa9f0ad4esteler.jpg', '5000', 7),
(7, 'Es Pisang Ijo', 'Racikan menu tradisional yang modern', '49eb6a44db57cba8d66b3404fa9f0ad4espisang.jpg', '6000', 7),
(8, 'Punch Cake', 'Lezat sekaliiii', '49eb6a44db57cba8d66b3404fa9f0ad4dessert.jpg', '7000', 8),
(9, 'Pucini Siraton', 'Kue dengan rasa manis dan menyebabkan ketagihan', '49eb6a44db57cba8d66b3404fa9f0ad4pucini.jpg', '10000', 8),
(10, 'Cake Strawberry', 'Kue enak', '49eb6a44db57cba8d66b3404fa9f0ad4dess.jpg', '9000', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `telephone`, `alamat`, `password`, `status`) VALUES
(1, 'Admin PEKAT', 'admin@gmail.com', '08985432330', 'Bogor, West Java', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(7, 'Fiki Aliyudin', 'fikipigo@gmail.com', '089608375792', 'Parakan Salak, Rt. 003/001, Kemang, Bogor', '056d516341070fe6dd3d3e21dab8a2d1', 'user'),
(9, 'Azhar Yassar', 'azhar@gmail.com', '087812345678', 'Perumahan Bogor Nirwana Residence, Blok B5, No. 12', '838e24a98647b16ed33f20774b2e3502', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`,`produk_id`,`pesanan_id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `info_pembayaran`
--
ALTER TABLE `info_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`,`kategori_produk_id`),
  ADD KEY `kategori_produk_id` (`kategori_produk_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `info_pembayaran`
--
ALTER TABLE `info_pembayaran`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pesanan_ibfk_3` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
