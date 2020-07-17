-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2020 pada 07.42
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
  `satuan` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`id`, `kode`, `kode_siva`, `nama_obat`, `generik`, `satuan`, `harga`, `insert_at`) VALUES
(1, '313123213', '23213', 'coba', 'Ya', 'VIAL', 10000, '2020-06-16 02:16:43'),
(3, 'dvsf3443', 'sdgdgsdfg', 'coba1111', 'Ya', 'Ampul', 111, '2020-06-16 02:16:32');

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
(14, 1, 'APD72549874', '2020-06-20'),
(15, 1, 'APD72549874', '2020-06-20'),
(16, 3, 'APD72549874', '2020-06-20');

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
(15, 14, 'coba', '313123213', '2020-06-27', 200, 20000),
(16, 14, 'coba1111', 'dvsf3443', '2020-06-27', 300, 10000),
(17, 15, 'coba1111', 'dvsf3443', '2020-06-27', 100, 30000),
(18, 15, 'coba', '313123213', '2020-06-27', 100, 30000),
(19, 16, 'coba1111', 'dvsf3443', '2020-06-27', 50, 10000),
(20, 16, 'coba', '313123213', '2020-06-27', 50, 10000);

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
(2, 'SPB12381297', 1, 2, '2020-06-20'),
(4, 'SPB12381210', 1, 2, '2020-06-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengiriman_detail`
--

CREATE TABLE `tb_pengiriman_detail` (
  `id` int(11) NOT NULL,
  `id_pengiriman` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tgl_diterima` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_pengiriman_detail`
--

INSERT INTO `tb_pengiriman_detail` (`id`, `id_pengiriman`, `kode_barang`, `jumlah`, `harga`, `status`, `tgl_diterima`) VALUES
(3, 2, '313123213', 100, 20000, 2, ''),
(4, 2, '313123213', 20, 10000, 2, ''),
(5, 4, 'dvsf3443', 20, 10000, 2, '2020-06-20');

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
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_stok`
--

INSERT INTO `tb_stok` (`id`, `kode_barang`, `harga`, `stok`, `id_ruang`) VALUES
(18, '313123213', 20000, 0, 1),
(19, 'dvsf3443', 10000, 330, 1),
(20, 'dvsf3443', 30000, 100, 1),
(21, '313123213', 30000, 100, 1),
(22, '313123213', 10000, 10, 1),
(24, '313123213', 20000, 200, 2),
(26, '313123213', 10000, 40, 2),
(27, 'dvsf3443', 10000, 20, 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_obat_transaksi_detail`
--
ALTER TABLE `tb_obat_transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
