-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 01:58 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paket_wisata_dan_spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `id_paketwisata` int(11) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `jumlah_wisata` int(11) NOT NULL,
  `lama_tour` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `id_paketwisata`, `harga`, `jumlah_wisata`, `lama_tour`) VALUES
(2, 111, '5', 3, '3'),
(4, 112, '4', 5, '5'),
(5, 113, '3', 1, '3'),
(6, 114, '5', 1, '3'),
(8, 131, '3', 1, '5');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bus`
--

CREATE TABLE `tb_bus` (
  `id_bus` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `fasilitas_bus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bus`
--

INSERT INTO `tb_bus` (`id_bus`, `nama`, `fasilitas_bus`) VALUES
(1, 'Big Bus Pariwisata', 'AC, LCD TV, Audio Karaoke, Recleaning Seat.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `atribut` enum('Cost','Benefit') NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama_kriteria`, `atribut`, `bobot`) VALUES
(1, 'Harga Paket Wisata (C1)', 'Cost', 50),
(3, 'Jumlah Wisata (C2)', 'Benefit', 30),
(4, 'Lama Tour (C3)', 'Benefit', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tb_normalisasi`
--

CREATE TABLE `tb_normalisasi` (
  `id_normalisasi` int(11) NOT NULL,
  `id_paketwisata` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah_wisata` int(11) NOT NULL,
  `lama_tour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paketwisata`
--

CREATE TABLE `tb_paketwisata` (
  `id_paketwisata` int(11) NOT NULL,
  `nama_paketwisata` varchar(50) DEFAULT NULL,
  `lama_paket` varchar(30) NOT NULL,
  `fasilitas` text DEFAULT NULL,
  `id_bus` int(11) DEFAULT NULL,
  `harga_paket` varchar(25) DEFAULT NULL,
  `id_paketwisata_grup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_paketwisata`
--

INSERT INTO `tb_paketwisata` (`id_paketwisata`, `nama_paketwisata`, `lama_paket`, `fasilitas`, `id_bus`, `harga_paket`, `id_paketwisata_grup`) VALUES
(111, 'Yogyakarta - Jakarta ', '3 Hari 1 Malam', '<ul><li>Jumlah peserta 45 orang</li><li>Hotel di Jakarta 1 hari (1 kamar 3-4 orang).</li><li>Welcome snack &amp; softdrink.</li><li>Makan 11 kali sesuai program selama perjalanan.</li><li>Tiket masuk semua obyek wisata.</li><li>Live music.</li><li>Tour leader.</li><li>Dokumentasi.</li></ul>', 1, '56300000', 1),
(112, 'Yogyakarta - Bali ', '5 Hari 2 Malam', '<ul><li>Jumlah peserta 45 orang</li><li>Hotel di Bali 2 malam (1 kamar 3-4 orang).</li><li>Welcome snack &amp; softdrink.</li><li>Makan 11 kali sesuai program selama perjalanan.</li><li>Tiket masuk semua obyek wisata.</li><li>Live music.</li><li>Tour leader.</li><li>Dokumentasi.</li></ul>', 1, '53150000', 2),
(113, 'Yogyakarta - Bandung ', '3 Hari 1 Malam', '<ul><li>Jumlah peserta 45 orang</li><li>Hotel di Bandung 1 hari (1 kamar 3-4 orang).</li><li>Welcome snack &amp; softdrink.</li><li>Makan 11 kali sesuai program selama perjalanan.</li><li>Tiket masuk semua obyek wisata.</li><li>Live music.</li><li>Tour leader.</li><li>Dokumentasi.</li></ul>', 1, '52000000', 3),
(114, 'Yogyakarta - Malang ', '3 Hari 1 Malam', '<ul><li>Jumlah peserta 45 orang</li><li>Hotel di Malang 1 hari (1 kamar 3-4 orang).</li><li>Welcome snack &amp; softdrink.</li><li>Makan 11 kali sesuai program selama perjalanan.</li><li>Tiket masuk semua obyek wisata.</li><li>Live music.</li><li>Tour leader.</li><li>Dokumentasi.</li></ul>', 1, '57575000', 4),
(131, 'Yogyakarta - Jakarta  2', '5 Hari', '<p>- Lengkap</p>', NULL, '2000000', 1),
(132, 'Yogyakarta - Jakarta  3', '10 hari', '<p>- Lengkap</p>', NULL, '3500000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_paketwisata_grup`
--

CREATE TABLE `tb_paketwisata_grup` (
  `id_paketwisata_grup` int(11) NOT NULL,
  `nama_paketwisata` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_paketwisata_grup`
--

INSERT INTO `tb_paketwisata_grup` (`id_paketwisata_grup`, `nama_paketwisata`) VALUES
(1, 'Yogyakarta - Jakarta'),
(2, 'Yogyakarta - Bali'),
(3, 'Yogyakarta - Bandung'),
(4, 'Yogyakarta - Malang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telepon`, `email`, `username`, `password`) VALUES
(3, 'asrinda alwita', 'bandung', '089123456789', 'asrinda123@gmail.com', 'asrinda', '1234'),
(6, 'Rowinda Dwi', 'Bandung', '089765123456', 'rowinda123@gmail.com', 'rowinda', '1234'),
(7, 'Mandasari', 'Yogyakarta', '081789032123', 'mandasari@gmail.com', 'manda', '1234'),
(8, 'Ade Dita Widyasari', 'Bandung', '082345123678', 'adedita@gmail.com', 'ade', '123456'),
(10, 'Najwa Ayla', 'Cilacap', '081324567123', 'najwaayla@gmail.com', 'najwa', '827ccb0eea8a706c4c34'),
(12, 'Fahmi Alfin', ' Kebumen ', '082123908564', 'fahmialfin@gmail.com', 'alfin1234', '1234'),
(13, 'Devita Juliyanti', 'Purwodadi', '081456123890', 'devita@gmailcom', 'devita', 'devita123'),
(14, 'Arfan Chanafi', 'Yogyakarta', '089654123098', 'arfan123@gmail.com', 'arfan', '81dc9bdb52d04dc20036'),
(15, 'Aprilia', 'Yogyakarta', '081564378908', 'april@gmail.com', 'april', '12345'),
(16, 'zul', 'Kebumen', '088543123456', 'zul@gmail.com', 'zul', '6911ce0b67e45660207a'),
(17, '!@###$#$#@', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembatalan`
--

CREATE TABLE `tb_pembatalan` (
  `id_pembatalan` int(11) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `tanggal_pembatalan` date DEFAULT NULL,
  `keterangan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembatalan`
--

INSERT INTO `tb_pembatalan` (`id_pembatalan`, `id_pemesanan`, `tanggal_pembatalan`, `keterangan`) VALUES
(8, 9, '2020-04-28', 'test aja dulu'),
(9, 16, '2020-05-14', 'test aja dulu'),
(10, 18, '2020-05-14', 'test aja dulu'),
(11, 19, '2020-05-15', 'test aja dulu'),
(12, 20, '2020-05-16', 'test aja dulu'),
(13, 27, '2021-01-25', 'test aja dulu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah_bayar` varchar(20) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `bukti_transfer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_pemesanan`, `nama`, `jumlah_bayar`, `tanggal`, `bukti_transfer`) VALUES
(1, 9, 'Asrinda Alwita', '109575000', '2020-04-12', '20200412095841daun2.jpg'),
(2, 16, 'Mandasari', '112600000', '2020-05-14', '202005140843501527432374_27-05-2018_photo6077615961109801001.jpg'),
(3, 17, 'Mandasari', '56300000', '2020-05-14', '202005140918001527432374_27-05-2018_photo6077615961109801001.jpg'),
(4, 18, 'Rowinda Dwi', '56300000', '2020-05-14', '20200514092231img-20161120-wa0001_3501.jpg'),
(5, 19, 'Mandasari', '56300000', '2020-05-15', '20200515054356img-20161120-wa0001_3501.jpg'),
(6, 20, 'Ade Dita Widyasari', '56300000', '2020-05-16', '202005160815271527432374_27-05-2018_photo6077615961109801001.jpg'),
(7, 21, 'Zul Fahmi Alfin', '106300000', '2020-08-20', '20200820141820gambar2.jpg'),
(8, 26, 'Fahmi Alfin', '53150000', '2020-08-21', '20200821142705gambar3.jpg'),
(9, 27, 'manda', '53150000', '2021-01-25', '20210125055434bukti_transfer_1511770644_d1d5a6a2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_paketwisata` int(11) DEFAULT NULL,
  `tanggal_pesan` date DEFAULT NULL,
  `tanggal_tour` date NOT NULL,
  `tanggal_selesai_tour` date NOT NULL,
  `total_pemesanan` int(20) NOT NULL,
  `status_pemesanan` varchar(30) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`id_pemesanan`, `id_pelanggan`, `id_paketwisata`, `tanggal_pesan`, `tanggal_tour`, `tanggal_selesai_tour`, `total_pemesanan`, `status_pemesanan`) VALUES
(9, 3, 113, '2020-04-10', '2020-04-30', '2020-05-03', 109575000, 'pesanan dibatalkan'),
(11, 6, 113, '2020-04-11', '2020-09-17', '2020-09-20', 2406667, 'pending'),
(12, 3, 114, '2020-04-13', '2020-06-02', '2020-06-05', 57575000, 'pending'),
(16, 7, 111, '2020-05-14', '2020-06-29', '2020-07-01', 112600000, 'pesanan dibatalkan'),
(17, 7, 111, '2020-05-14', '2020-06-27', '2020-06-30', 56300000, 'sudah kirim pembayaran'),
(18, 6, 111, '2020-05-14', '2020-07-02', '2020-07-05', 56300000, 'pesanan dibatalkan'),
(19, 7, 111, '2020-05-15', '2020-05-30', '2020-06-02', 56300000, 'pesanan dibatalkan'),
(20, 8, 111, '2020-05-16', '2020-06-30', '2020-07-02', 56300000, 'pesanan dibatalkan'),
(21, 12, 112, '2020-08-20', '2020-09-09', '2020-09-14', 106300000, 'menunggu konfirmasi admin'),
(22, 12, 112, '2020-08-20', '2020-10-28', '2020-11-02', 53150000, 'pending'),
(23, 12, 113, '2020-08-20', '2020-09-15', '2020-09-18', 52000000, 'pending'),
(24, 12, 112, '2020-08-21', '2020-08-27', '2020-09-01', 53150000, 'pending'),
(25, 12, 112, '2020-08-21', '2020-10-14', '2020-10-19', 53150000, 'pending'),
(26, 12, 112, '2020-08-21', '2020-09-08', '2020-09-13', 53150000, 'menunggu konfirmasi admin'),
(27, 7, 112, '2021-01-25', '2021-02-10', '2021-02-15', 53150000, 'pesanan dibatalkan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan_paket`
--

CREATE TABLE `tb_pemesanan_paket` (
  `id_pemesanan_paket` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_paketwisata` int(11) NOT NULL,
  `jumlah` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemesanan_paket`
--

INSERT INTO `tb_pemesanan_paket` (`id_pemesanan_paket`, `id_pemesanan`, `id_paketwisata`, `jumlah`) VALUES
(1, 9, 114, 1),
(2, 9, 113, 1),
(4, 11, 111, 1),
(5, 11, 113, 1),
(6, 12, 114, 1),
(10, 16, 111, 2),
(11, 17, 111, 1),
(12, 18, 111, 1),
(13, 19, 111, 1),
(14, 20, 111, 1),
(15, 21, 112, 2),
(16, 22, 112, 1),
(17, 23, 113, 1),
(18, 24, 112, 1),
(20, 25, 112, 1),
(21, 26, 112, 1),
(22, 27, 112, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_print_hasil`
--

CREATE TABLE `tb_print_hasil` (
  `id` int(11) NOT NULL,
  `content` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_subkriteria`
--

CREATE TABLE `tb_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bobot_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_subkriteria`
--

INSERT INTO `tb_subkriteria` (`id_subkriteria`, `id_kriteria`, `nama`, `bobot_subkriteria`) VALUES
(1, 1, 'Harga <= 53000000', 3),
(2, 1, 'Harga 53000000-55000000', 4),
(3, 1, 'Harga >=55000000', 5),
(4, 3, '5-6', 1),
(5, 3, '7-8', 3),
(6, 3, '9-10', 5),
(7, 4, '<=3 hari', 1),
(8, 4, '3-4 hari', 3),
(9, 4, '>=4 hari', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tb_wisata`
--

CREATE TABLE `tb_wisata` (
  `id_wisata` int(11) NOT NULL,
  `id_paketwisata` int(11) DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_wisata`
--

INSERT INTO `tb_wisata` (`id_wisata`, `id_paketwisata`, `nama`, `foto`) VALUES
(11, 111, 'Ancol', 'ancol.jpg'),
(12, 111, 'TMII', 'tmii.jpg'),
(13, 111, 'Masjid Istiqlal', 'masjid.jpg'),
(14, 111, 'Keong Mas', 'keongmas.jpg'),
(15, 111, 'Dunia Fantasi (Dufan)', 'dufan.jpg'),
(16, 111, 'Mangga II', 'mangga2.jpg'),
(17, 111, 'Gereja Katedral', 'katedral.jpg'),
(18, 112, 'Tanah Lot', 'tanahlot.jpg'),
(19, 112, 'Tanjung Benoa', 'tanjung benoa.jpg'),
(20, 112, 'Sangeh', 'sangeh.jpg'),
(21, 112, 'Pantai Kuta', 'kuta.jpg'),
(22, 112, 'Bedugul', 'bedugul.jpg'),
(23, 112, 'Pantai Pandawa', 'pandawa.jpg'),
(24, 112, 'Krisna', 'krisna.jpg'),
(25, 112, 'Joger', 'joger1.jpg'),
(26, 112, 'Puja Mandala', 'puja mandala.jpg'),
(27, 113, 'Tangkupan Perahu', 'tangkupanperahu.jpg'),
(28, 113, 'Ciater', 'ciater.jpg'),
(29, 113, 'Floating Mart', 'floatingmarket.jpeg'),
(30, 113, 'Farm House Susu Lembang', 'farmhouse.jpg'),
(31, 113, 'Trans Studio Bandung', 'trans studio.jpg'),
(32, 113, 'Cibaduyut', 'cibaduyut.jpg'),
(33, 114, 'Jatim Park II', 'jatim park.jpg'),
(34, 114, 'Museum Angkut', 'museum angkut.jpg'),
(35, 114, 'BNS', 'bns.jpg'),
(36, 114, 'Petik Apel', 'petik apel.jpg'),
(37, 114, 'Taman Safari', 'taman safari.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `FK_tb_alternatif` (`id_paketwisata`),
  ADD KEY `FK_tb_alternatif_2` (`harga`),
  ADD KEY `FK_tb_alternatif_3` (`jumlah_wisata`);

--
-- Indexes for table `tb_bus`
--
ALTER TABLE `tb_bus`
  ADD PRIMARY KEY (`id_bus`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_normalisasi`
--
ALTER TABLE `tb_normalisasi`
  ADD PRIMARY KEY (`id_normalisasi`);

--
-- Indexes for table `tb_paketwisata`
--
ALTER TABLE `tb_paketwisata`
  ADD PRIMARY KEY (`id_paketwisata`),
  ADD KEY `FK_tb_paketwisata` (`id_bus`);

--
-- Indexes for table `tb_paketwisata_grup`
--
ALTER TABLE `tb_paketwisata_grup`
  ADD PRIMARY KEY (`id_paketwisata_grup`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_pembatalan`
--
ALTER TABLE `tb_pembatalan`
  ADD PRIMARY KEY (`id_pembatalan`),
  ADD KEY `FK_tb_pembatalan` (`id_pemesanan`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `FK_tb_pembayaran` (`id_pemesanan`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `FK_tb_pemesanan` (`id_pelanggan`),
  ADD KEY `FK_tb_pemesanan_2` (`id_paketwisata`);

--
-- Indexes for table `tb_pemesanan_paket`
--
ALTER TABLE `tb_pemesanan_paket`
  ADD PRIMARY KEY (`id_pemesanan_paket`),
  ADD KEY `FK_tb_pemesanan_paket` (`id_paketwisata`),
  ADD KEY `FK_tb_pemesanan_paket_3` (`id_pemesanan`);

--
-- Indexes for table `tb_print_hasil`
--
ALTER TABLE `tb_print_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `FK_tb_nilai` (`id_kriteria`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_wisata`
--
ALTER TABLE `tb_wisata`
  ADD PRIMARY KEY (`id_wisata`),
  ADD KEY `FK_tb_wisata` (`id_paketwisata`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_bus`
--
ALTER TABLE `tb_bus`
  MODIFY `id_bus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_normalisasi`
--
ALTER TABLE `tb_normalisasi`
  MODIFY `id_normalisasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_paketwisata`
--
ALTER TABLE `tb_paketwisata`
  MODIFY `id_paketwisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `tb_paketwisata_grup`
--
ALTER TABLE `tb_paketwisata_grup`
  MODIFY `id_paketwisata_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_pembatalan`
--
ALTER TABLE `tb_pembatalan`
  MODIFY `id_pembatalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_pemesanan_paket`
--
ALTER TABLE `tb_pemesanan_paket`
  MODIFY `id_pemesanan_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_print_hasil`
--
ALTER TABLE `tb_print_hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_wisata`
--
ALTER TABLE `tb_wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD CONSTRAINT `FK_tb_alternatif` FOREIGN KEY (`id_paketwisata`) REFERENCES `tb_paketwisata` (`id_paketwisata`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_paketwisata`
--
ALTER TABLE `tb_paketwisata`
  ADD CONSTRAINT `FK_tb_paketwisata` FOREIGN KEY (`id_bus`) REFERENCES `tb_bus` (`id_bus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembatalan`
--
ALTER TABLE `tb_pembatalan`
  ADD CONSTRAINT `FK_tb_pembatalan` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `FK_tb_pembayaran` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD CONSTRAINT `FK_tb_pemesanan` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tb_pemesanan_2` FOREIGN KEY (`id_paketwisata`) REFERENCES `tb_paketwisata` (`id_paketwisata`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pemesanan_paket`
--
ALTER TABLE `tb_pemesanan_paket`
  ADD CONSTRAINT `FK_tb_pemesanan_paket` FOREIGN KEY (`id_paketwisata`) REFERENCES `tb_paketwisata` (`id_paketwisata`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tb_pemesanan_paket_3` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD CONSTRAINT `FK_tb_nilai` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_wisata`
--
ALTER TABLE `tb_wisata`
  ADD CONSTRAINT `FK_tb_wisata` FOREIGN KEY (`id_paketwisata`) REFERENCES `tb_paketwisata` (`id_paketwisata`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
