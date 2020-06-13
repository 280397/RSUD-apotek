-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2020 pada 04.44
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_distributor`
--

CREATE TABLE `tb_distributor` (
  `id` int(11) NOT NULL,
  `nama_distributor` varchar(128) NOT NULL,
  `nama_perusahaan` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kode_pos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_distributor`
--

INSERT INTO `tb_distributor` (`id`, `nama_distributor`, `nama_perusahaan`, `alamat`, `telp`, `kota`, `kode_pos`) VALUES
(1, 'APD', 'PT. APD', 'Surabaya', '081326556111111', 'Surabaya', 68463),
(3, 'AL-KOHOL', 'PT. Al-Kohol', 'Tegalsari', '081231246465', 'Banyuwangi', 68433);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id` int(11) NOT NULL,
  `kode` varchar(128) NOT NULL,
  `kode_siva` varchar(128) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `generik` enum('Ya','Tidak') NOT NULL,
  `satuan` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`id`, `kode`, `kode_siva`, `nama_obat`, `generik`, `satuan`, `harga`, `insert_at`) VALUES
(1, 'SPK212', 'SPKK1111', 'APD', 'Tidak', 3, 200000, '2020-06-02 03:10:37'),
(2, 'A2222', 'A2222111', 'ALKOHOL', 'Tidak', 3, 20000, '2020-06-02 03:11:54'),
(3, 'SS333', 'SKSJA', 'Panadol', 'Ya', 1, 300000, '2020-06-08 04:50:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat_transaksi`
--

CREATE TABLE `tb_obat_transaksi` (
  `id` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_obat_transaksi`
--

INSERT INTO `tb_obat_transaksi` (`id`, `id_distributor`, `no_faktur`, `tanggal`) VALUES
(1, 3, 'APD72549874', '2020-06-03'),
(2, 1, 'APD72549874', '2020-06-03'),
(3, 1, 'APD72549874', '2020-06-03'),
(4, 3, 'APD72549874', '2020-06-05'),
(5, 3, 'APD72549874', '2020-06-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat_transaksi_detail`
--

CREATE TABLE `tb_obat_transaksi_detail` (
  `id` int(11) NOT NULL,
  `id_obat_transaksi` int(11) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `kode_barang` varchar(128) NOT NULL,
  `exp` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_obat_transaksi_detail`
--

INSERT INTO `tb_obat_transaksi_detail` (`id`, `id_obat_transaksi`, `nama_barang`, `kode_barang`, `exp`, `jumlah`, `harga`) VALUES
(1, 1, 'Panadol', 'SS333', '2020-06-11', 12, 22),
(2, 2, 'APD', 'SPK212', '2020-06-11', 12, 20000),
(3, 3, 'APD', 'SPK212', '2020-06-18', 200, 20000),
(4, 4, 'Panadol', 'SS333', '2020-06-20', 200, 10000),
(5, 5, 'ALKOHOL', 'A2222', '2020-06-19', 200, 20000),
(6, 5, 'APD', 'SPK212', '2020-06-05', 12, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengiriman`
--

CREATE TABLE `tb_pengiriman` (
  `id` int(11) NOT NULL,
  `no_spb` varchar(50) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `id_ruang_tujuan` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_pengiriman`
--

INSERT INTO `tb_pengiriman` (`id`, `no_spb`, `id_ruang`, `id_ruang_tujuan`, `date`) VALUES
(33, 'SPB12381299', 1, 3, '2020-06-08'),
(34, 'SPB12381297', 1, 3, '2020-06-08'),
(36, 'ISO21913', 3, 1, '2020-06-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengiriman_detail`
--

CREATE TABLE `tb_pengiriman_detail` (
  `id` int(11) NOT NULL,
  `id_pengiriman` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_pengiriman_detail`
--

INSERT INTO `tb_pengiriman_detail` (`id`, `id_pengiriman`, `kode_barang`, `jumlah`, `status`) VALUES
(10, 33, 'SPK212', 10, 2),
(11, 34, 'SPK212', 5, 2),
(12, 34, 'SS333', 50, 2),
(14, 36, 'SPK212', 10, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ruang`
--

CREATE TABLE `tb_ruang` (
  `id` int(11) NOT NULL,
  `nama_ruang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_ruang`
--

INSERT INTO `tb_ruang` (`id`, `nama_ruang`) VALUES
(1, 'Gudang'),
(2, 'Isolasi 1'),
(3, 'Isolasi 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`id`, `satuan`) VALUES
(1, 'Ampul'),
(2, 'Bax'),
(3, 'Botol'),
(4, 'Box'),
(5, 'Fles'),
(6, '1 Kg'),
(7, 'Kaleng'),
(8, 'Kaplet'),
(9, 'Kapsul'),
(10, 'OBX'),
(11, 'Roll'),
(12, 'Soft Capsul'),
(13, 'Tablet'),
(14, 'TUBE'),
(15, 'VIAL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stok`
--

CREATE TABLE `tb_stok` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_stok`
--

INSERT INTO `tb_stok` (`id`, `kode_barang`, `stok`, `id_ruang`) VALUES
(11, 'SPK212', 25, 1),
(12, 'SS333', 150, 1),
(13, 'A2222', 200, 1),
(14, 'SPK212', 15, 3),
(15, 'SS333', 50, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `level` int(1) NOT NULL COMMENT '1:admin,2:manajemen, 3:user',
  `id_ruang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `address`, `level`, `id_ruang`) VALUES
(1, 'adminapotek', '7c222fb2927d828af22f592134e8932480637c0d', 'Admin', 'Banyuwangi', 1, 1),
(7, 'gudang', '7c222fb2927d828af22f592134e8932480637c0d', 'Gudang', 'Genteng', 2, 1),
(10, 'isolasi1', '7c222fb2927d828af22f592134e8932480637c0d', 'Isolasi1', 'Genteng', 3, 2),
(11, 'isolasi2', '7fa5703436b844f93b4918c2cc2d909b69fa7260', 'Isolasi2', 'Genteng', 3, 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_distributor`
--
ALTER TABLE `tb_distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_obat_transaksi`
--
ALTER TABLE `tb_obat_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_obat_transaksi_detail`
--
ALTER TABLE `tb_obat_transaksi_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengiriman_detail`
--
ALTER TABLE `tb_pengiriman_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_ruang`
--
ALTER TABLE `tb_ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_distributor`
--
ALTER TABLE `tb_distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_obat_transaksi`
--
ALTER TABLE `tb_obat_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_obat_transaksi_detail`
--
ALTER TABLE `tb_obat_transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tb_pengiriman_detail`
--
ALTER TABLE `tb_pengiriman_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_ruang`
--
ALTER TABLE `tb_ruang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
