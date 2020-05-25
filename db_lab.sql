-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 25, 2020 at 12:04 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acuan_metode`
--

CREATE TABLE `tbl_acuan_metode` (
  `acuan_metode_id` int(11) NOT NULL,
  `acuan_metode_nama` varchar(100) NOT NULL,
  `acuan_metode_doc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_acuan_metode`
--

INSERT INTO `tbl_acuan_metode` (`acuan_metode_id`, `acuan_metode_nama`, `acuan_metode_doc`) VALUES
(2, 'saasa', 'c96692a4268dfbc7984503b8d2c81176.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `anggota_id` int(11) NOT NULL,
  `anggota_nama` varchar(200) NOT NULL,
  `anggota_username` varchar(50) NOT NULL,
  `anggota_password` varchar(50) NOT NULL,
  `anggota_email` varchar(100) NOT NULL,
  `anggota_alamat` varchar(500) NOT NULL,
  `anggota_personil` varchar(100) NOT NULL,
  `anggota_jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `anggota_kontak` varchar(100) NOT NULL,
  `anggota_level` varchar(3) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`anggota_id`, `anggota_nama`, `anggota_username`, `anggota_password`, `anggota_email`, `anggota_alamat`, `anggota_personil`, `anggota_jenis_kelamin`, `anggota_kontak`, `anggota_level`) VALUES
(6, 'xyz', 'andi', 'e10adc3949ba59abbe56e057f20f883e', 'yusufxyx114@gmail.com', 'Jl. Banda', 's', 'Laki-laki', '+6281258535938', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inbox`
--

CREATE TABLE `tbl_inbox` (
  `inbox_id` int(11) NOT NULL,
  `inbox_nama` varchar(40) DEFAULT NULL,
  `inbox_email` varchar(60) DEFAULT NULL,
  `inbox_kontak` varchar(20) DEFAULT NULL,
  `inbox_pesan` text,
  `inbox_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `inbox_status` int(11) DEFAULT '1' COMMENT '1=Belum dilihat, 0=Telah dilihat'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_informasi_sampel`
--

CREATE TABLE `tbl_informasi_sampel` (
  `is_id` int(11) NOT NULL,
  `is_us_id` varchar(20) NOT NULL,
  `tanggal_sampel` date DEFAULT NULL,
  `no_identifikasi` varchar(100) NOT NULL,
  `kondisi` enum('Terbuka','Tertutup') DEFAULT NULL,
  `tanggal_pengujian_awal` date DEFAULT NULL,
  `tanggal_pengujian_akhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_sampel`
--

CREATE TABLE `tbl_jenis_sampel` (
  `js_id` int(11) NOT NULL,
  `js_nama` varchar(100) NOT NULL,
  `js_kode` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_sampel`
--

INSERT INTO `tbl_jenis_sampel` (`js_id`, `js_nama`, `js_kode`) VALUES
(1, 'Limbah Cair', '02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_wadah`
--

CREATE TABLE `tbl_jenis_wadah` (
  `jw_id` int(11) NOT NULL,
  `jw_nama` varchar(100) NOT NULL,
  `jw_kode` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_wadah`
--

INSERT INTO `tbl_jenis_wadah` (`jw_id`, `jw_nama`, `jw_kode`) VALUES
(1, 'Plastik', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kontak`
--

CREATE TABLE `tbl_kontak` (
  `kontak_id` int(11) NOT NULL,
  `kontak_field` varchar(100) NOT NULL,
  `kontak_data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kontak`
--

INSERT INTO `tbl_kontak` (`kontak_id`, `kontak_field`, `kontak_data`) VALUES
(1, 'Jam Kerja', '07.30 - 16.00 WIB'),
(2, 'Alamat', 'Jl. Tjilik Riwut Km. 2,5 Palangka Raya'),
(3, 'No. Telepon', '0536-3239764'),
(4, 'Email', 'lablingkungan.pky@gmail.com'),
(5, 'Longitude', '-2.1953479'),
(6, 'Latitude', '113.897856');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_layanan`
--

CREATE TABLE `tbl_layanan` (
  `layanan_id` int(11) NOT NULL,
  `layanan_nama` varchar(100) NOT NULL,
  `layanan_ikon` varchar(100) NOT NULL,
  `layanan_teks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_layanan`
--

INSERT INTO `tbl_layanan` (`layanan_id`, `layanan_nama`, `layanan_ikon`, `layanan_teks`) VALUES
(2, 'Uji Sampel Limbah', '85b3b0d2ce6a3c1b8c87f2a311fb1f2e.png', '<p>Bersumber dari makalah berjudul Peran Sampel Lingkungan sebagai Alat Bukti Dalam Penegakan Hukum Terkait Masalah Lingkungan Hidup oleh Lilin Indrayani yang kami akses dari laman perpusatakaan digital Badan Tenaga Nuklir Nasional (BATAN) dikatakan antara lain bahwa tujuan kegiatan pengambilan sampel pada dasarnya adalah untuk mendapatkan informasi tentang kualitas (mutu) lingkungan.</p>\r\n\r\n<p>&nbsp;<br />\r\nAkan tetapi istilah pengambilan sampel yang &lsquo;rutin&rsquo; tersebut akan memiliki arti yang berbeda bila kegiatan pengambilan sampel digunakan untuk sebagai alat bukti kepentingan penegakan hukum terkait lingkungan hidup misalnya untuk pembuktian adanya pencemaran lingkungan.</p>\r\n\r\n<p>&nbsp;<br />\r\nDalam konteks pertanyaan Anda soal air yang diduga dicemarkan oleh suatu perusahaan, kami asumsikan bahwa pengambilan sampel air ini dilakukan untuk tujuan pembuktian adanya pencemaran lingkungan terkait penegakan hukum.</p>\r\n'),
(3, 'Uji Sampel Tanah', '71d83f4fbf793ce5edbff43e338bb5ed.png', '<p>Analisis tanah atau pengujian tanah adalah aktivitas menganalisis sampel tanah untuk mengetahui kondisi dan karakteristik tanah, seperti nutrien, kontaminasi, komposisi, keasaman, dan sebagainya. Analisis tanah menentukan tingkat kecocokan tanah terhadap aktivitas pertanian dan jenis tanaman yang ditanam. Keberadaan mineral tertentu yang berlebih dapat menyebabkan keracunan bagi tumbuhan, tetapi tumbuhan jenis lain mungkin dapat bertahan.[1] Berbagai lembaga pengujian tanah dapat memiliki standar sendiri mengenai berapa sampel yang dibutuhkan per luas area. Air yang digunakan sebagai irigasi lahan setempat dapat diuji secara terpisah karena kandungan mineral yang dikandung oleh air tersebut mempengaruhi kondisi tanah. Kondisi nutrisi tanah dapat bervariasi seiring waktu dan kedalaman, sehingga waktu pengambilan sample dan kedalaman sampel akan mempengaruhi hasil pengujian.</p>\r\n\r\n<p>Pengambilan contoh tanah merupakan tahapan terpenting di dalam program uji tanah. Analisis kimia dari contoh tanah yang diambil diperlukan untuk mengukur kadar hara, menetapkan status hara tanah dan dapat digunakan sebagai petunjuk penggunaan pupuk dan kapur secara efisien, rasional dan menguntungkan. Namun, hasil uji tanah tidak berarti apabila contoh tanah yang diambil tidak mewakili areal yang dimintakan rekomendasinya dan tidak dengan cara benar. Oleh karena itu pengambilan contoh tanah merupakan tahapan terpenting di dalam program uji tanah.</p>\r\n\r\n<p>Contoh tanah dapat diambil setiap saat, tidak perlu menunggu saat sebelum tanam namun tidak boleh dilakukan beberapa hari setelah pemupukan. Keadaan tanah saat pengambilan contoh tanah pada lahan kering sebaiknya pada kondisi kapasitas lapang (kelembaban tanah sedang yaitu keadaan tanah kira-kira cukup untuk pengolahan tanah). Sedang pengambilan pada lahan sawah sebaiknya diambil pada kondisi basah.</p>\r\n\r\n<p>Secara umum, contoh diambil sekali dalam 4 tahun untuk sistem pertanaman dilpangan. Untuk tanah yang digunakan secara intensif, contoh tanah diambil paling sedikit sekali dalam 1 tahun. Pada tanah-tanah dengan nilai uji tanah tinggi, contoh tanah disarankan diambil setiap 5 tahun sekali.<br />\r\n&nbsp;</p>\r\n'),
(4, 'Uji Sampel Udara', '69e257d45ef4239b996b28cb8bce26c4.png', '<p>Peralatan sampling umumnya terdiri dari collector, flowmeter dan vacuum pump.&nbsp; Untuk mengumpulkan sampel gas dapat digunakan collector &nbsp;seperti impinger, fritted bubbler atau tube adsorber dimana sampel akan bereaksi terhadap penyerap yang spesifik. &nbsp;Sedangkan untuk mengumpulkan sampel berupa partikel diperlukan filter. Flowmeter berfungsi untuk mengetahui volume udara yang terkumpul, dapat berupa dry gas meter, wet gas meter atau rotameter. Vacuum pump digunakan untuk menghisap udara ke dalam collector. Ketelusuran data hasil pengukuran umumnya tergantung kepada alat ukur flow meter.</p>\r\n\r\n<p>Lokasi pemantauan kualitas udara ambien ditetapkan dengan mempertimbangkan faktor-faktor arah angin, tata guna lahan, tinggi cerobong dan luas sebaran bahan pencemar (dispersi polutan). Adapun penentuan lokasi pemantauan mempertimbangkan apakah pemantauan dilakukan secara kontinyu (stasiun pemantauan) ataukah pemantauan secara grab atau sesaat dalam kaitannya dengan penaatan terhadap peraturan-peraturan lingkungan, pemenuhan dokumen AMDAL (dokumen RKL/RPL), verifikasi pengaduan, dll.</p>\r\n'),
(5, 'Tarif Pengujian Sampel', '39fb63d079ab2f441d71c00f23848372.png', '<p>blblblbl</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parameter_uji`
--

CREATE TABLE `tbl_parameter_uji` (
  `pu_id` int(11) NOT NULL,
  `pu_nama` varchar(500) NOT NULL,
  `pu_sp_id` int(11) NOT NULL,
  `pu_tarif` double NOT NULL,
  `pu_mutu` varchar(10) NOT NULL,
  `pu_satuan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_parameter_uji`
--

INSERT INTO `tbl_parameter_uji` (`pu_id`, `pu_nama`, `pu_sp_id`, `pu_tarif`, `pu_mutu`, `pu_satuan_id`) VALUES
(3, 'Temperatur (Suhu)', 1, 10000, '30', 2),
(7, 'Residu Tersuspensi (TSS)', 1, 23000, '30', 1),
(8, 'Derajat Keasaman (pH)', 2, 10000, '6-9', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parameter_us`
--

CREATE TABLE `tbl_parameter_us` (
  `parameter_us` int(11) NOT NULL,
  `parameter_us_id` varchar(50) NOT NULL,
  `parameter_us_uji_id` int(11) NOT NULL,
  `parameter_us_metode_id` int(11) NOT NULL,
  `parameter_us_hasil` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengambilan_sampel`
--

CREATE TABLE `tbl_pengambilan_sampel` (
  `ps_id` int(11) NOT NULL,
  `ps_us_id` varchar(20) NOT NULL,
  `lokasi` text NOT NULL,
  `titik_pengambilan` varchar(100) NOT NULL DEFAULT '-',
  `metode_id` int(11) NOT NULL,
  `rincian` varchar(500) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `pengguna_id` int(11) NOT NULL,
  `pengguna_nama` varchar(50) DEFAULT NULL,
  `pengguna_jenkel` varchar(2) DEFAULT NULL,
  `pengguna_username` varchar(30) DEFAULT NULL,
  `pengguna_password` varchar(35) DEFAULT NULL,
  `pengguna_email` varchar(50) DEFAULT NULL,
  `pengguna_nohp` varchar(20) DEFAULT NULL,
  `pengguna_status` int(2) DEFAULT '1',
  `pengguna_level` varchar(3) DEFAULT NULL,
  `pengguna_register` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pengguna_photo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`pengguna_id`, `pengguna_nama`, `pengguna_jenkel`, `pengguna_username`, `pengguna_password`, `pengguna_email`, `pengguna_nohp`, `pengguna_status`, `pengguna_level`, `pengguna_register`, `pengguna_photo`) VALUES
(1, 'Administrator', 'L', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'yusufxyz114@gmail.com', '081254738486', 1, '1', '2016-09-03 06:07:55', '2463062cf45a317f2c3acc289734f2a1.png'),
(2, 'Operator Satu', 'L', 'operator1', 'e10adc3949ba59abbe56e057f20f883e', 'operator@admin.com', '081277159401', 1, '2', '2020-04-29 03:47:46', 'f93fe4f7cf91ccf00e4f8a3ed422b3ff.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengunjung`
--

CREATE TABLE `tbl_pengunjung` (
  `pengunjung_id` int(11) NOT NULL,
  `pengunjung_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pengunjung_ip` varchar(40) DEFAULT NULL,
  `pengunjung_perangkat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_nama` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`satuan_id`, `satuan_nama`) VALUES
(1, 'mg/L'),
(2, 'C'),
(3, '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `setting_id` int(11) NOT NULL,
  `setting_nama` varchar(100) NOT NULL,
  `setting_data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`setting_id`, `setting_nama`, `setting_data`) VALUES
(1, 'Persentase Uang Muka', '10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting_email`
--

CREATE TABLE `tbl_setting_email` (
  `setting_id` int(11) NOT NULL,
  `setting_nama` varchar(100) NOT NULL,
  `setting_data` text NOT NULL,
  `setting_type` enum('number','text','email','password','url') NOT NULL DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting_email`
--

INSERT INTO `tbl_setting_email` (`setting_id`, `setting_nama`, `setting_data`, `setting_type`) VALUES
(1, 'SMPT User (Email)', 'yusufxyz114@gmail.com', 'email'),
(2, 'SMTP Host', 'ssl://smtp.googlemail.com', 'url'),
(3, 'SMPT Port', '465', 'number'),
(4, 'SMPT Password', 'zhikanoseishin', 'text'),
(5, 'Nama Pengirim', 'Admin UPT Laboratorium Lingkungan', 'text'),
(6, 'Subject Email (Valid)', 'Pemberitahuan Uji Sampel (Valid)', 'text'),
(7, 'Subject Email (Tidak Valid)', 'Pemberitahuan Uji Sampel (Tidak Valid)', 'text'),
(8, 'Isi Pesan ', 'Pelanggan yang terhormat, dengan ini kami beritahukan bahwa subjek uji sampel Anda, saat ini statusnya ialah', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sifat_pengujian`
--

CREATE TABLE `tbl_sifat_pengujian` (
  `sp_id` int(11) NOT NULL,
  `sp_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sifat_pengujian`
--

INSERT INTO `tbl_sifat_pengujian` (`sp_id`, `sp_jenis`) VALUES
(1, 'Sifat Fisik'),
(2, 'Sifat Kimia');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `slider_promo` varchar(100) NOT NULL,
  `slider_foto` varchar(100) NOT NULL,
  `slider_tombol` varchar(50) NOT NULL,
  `slider_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_promo`, `slider_foto`, `slider_tombol`, `slider_link`) VALUES
(2, 'Permudah Proses Uji Sampel Sekarang', 'person-holding-green-grains-1230157.jpg', 'Registrasi', 'http://localhost/layanan_lab/administrator/registrasi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_nama` varchar(100) NOT NULL,
  `status_class` varchar(100) NOT NULL,
  `status_id_setting_email` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_nama`, `status_class`, `status_id_setting_email`) VALUES
(1, 'Menunggu Konfirmasi', 'alert-warning', 0),
(2, 'Pengujian Selesai', 'alert-info', 6),
(3, 'Proses dibatalkan', 'alert-primary', 0),
(4, 'Tidak Diterima', 'alert-danger', 7),
(5, 'Diterima', 'alert-success', 6),
(6, 'Proses Pengujian Sampel', 'alert-success', 6),
(7, 'Sudah Melakukan Pembayaran', 'alert-success', 0),
(8, 'Tutup', 'alert-danger', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tentang`
--

CREATE TABLE `tbl_tentang` (
  `tentang_id` int(11) NOT NULL,
  `tentang_judul` varchar(100) NOT NULL,
  `tentang_isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tentang`
--

INSERT INTO `tbl_tentang` (`tentang_id`, `tentang_judul`, `tentang_isi`) VALUES
(2, 'Tugas Pokok dan Fungsi', '<p>sdsd</p>\r\n'),
(3, 'Struktur Organisasi', '<p>sdsd</p>\r\n'),
(4, 'Dasar Hukum dan Standarisasi Pengujian', '<p>sdsd</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_us` varchar(50) NOT NULL,
  `transaksi_bayar` double NOT NULL,
  `transaksi_tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_us`
--

CREATE TABLE `tbl_us` (
  `us_id` varchar(50) NOT NULL,
  `us_anggota` int(11) NOT NULL,
  `us_kode_sampel` varchar(100) NOT NULL,
  `us_fk_js` int(11) NOT NULL,
  `us_fk_jw` int(11) NOT NULL,
  `us_pengambilan` enum('Pelanggan','Laboratorium') NOT NULL,
  `us_total` double NOT NULL,
  `us_uang_muka` double NOT NULL,
  `us_sisa` double NOT NULL,
  `us_file` text NOT NULL,
  `us_catatan` text NOT NULL,
  `us_catatan_status` text NOT NULL,
  `us_status_id` int(11) NOT NULL DEFAULT '1',
  `us_laporan` varchar(200) NOT NULL,
  `us_notif_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=belum dilihat,1=sudah'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acuan_metode`
--
ALTER TABLE `tbl_acuan_metode`
  ADD PRIMARY KEY (`acuan_metode_id`);

--
-- Indexes for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`anggota_id`);

--
-- Indexes for table `tbl_inbox`
--
ALTER TABLE `tbl_inbox`
  ADD PRIMARY KEY (`inbox_id`);

--
-- Indexes for table `tbl_informasi_sampel`
--
ALTER TABLE `tbl_informasi_sampel`
  ADD PRIMARY KEY (`is_id`);

--
-- Indexes for table `tbl_jenis_sampel`
--
ALTER TABLE `tbl_jenis_sampel`
  ADD PRIMARY KEY (`js_id`);

--
-- Indexes for table `tbl_jenis_wadah`
--
ALTER TABLE `tbl_jenis_wadah`
  ADD PRIMARY KEY (`jw_id`);

--
-- Indexes for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  ADD PRIMARY KEY (`kontak_id`);

--
-- Indexes for table `tbl_layanan`
--
ALTER TABLE `tbl_layanan`
  ADD PRIMARY KEY (`layanan_id`);

--
-- Indexes for table `tbl_parameter_uji`
--
ALTER TABLE `tbl_parameter_uji`
  ADD PRIMARY KEY (`pu_id`),
  ADD KEY `pu_sp_id` (`pu_sp_id`);

--
-- Indexes for table `tbl_parameter_us`
--
ALTER TABLE `tbl_parameter_us`
  ADD PRIMARY KEY (`parameter_us`);

--
-- Indexes for table `tbl_pengambilan_sampel`
--
ALTER TABLE `tbl_pengambilan_sampel`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`pengguna_id`);

--
-- Indexes for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  ADD PRIMARY KEY (`pengunjung_id`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `tbl_setting_email`
--
ALTER TABLE `tbl_setting_email`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `tbl_sifat_pengujian`
--
ALTER TABLE `tbl_sifat_pengujian`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_tentang`
--
ALTER TABLE `tbl_tentang`
  ADD PRIMARY KEY (`tentang_id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `tbl_us`
--
ALTER TABLE `tbl_us`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acuan_metode`
--
ALTER TABLE `tbl_acuan_metode`
  MODIFY `acuan_metode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  MODIFY `anggota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_inbox`
--
ALTER TABLE `tbl_inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_informasi_sampel`
--
ALTER TABLE `tbl_informasi_sampel`
  MODIFY `is_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jenis_sampel`
--
ALTER TABLE `tbl_jenis_sampel`
  MODIFY `js_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jenis_wadah`
--
ALTER TABLE `tbl_jenis_wadah`
  MODIFY `jw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  MODIFY `kontak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_layanan`
--
ALTER TABLE `tbl_layanan`
  MODIFY `layanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_parameter_uji`
--
ALTER TABLE `tbl_parameter_uji`
  MODIFY `pu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_parameter_us`
--
ALTER TABLE `tbl_parameter_us`
  MODIFY `parameter_us` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengambilan_sampel`
--
ALTER TABLE `tbl_pengambilan_sampel`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `pengguna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  MODIFY `pengunjung_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_setting_email`
--
ALTER TABLE `tbl_setting_email`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_sifat_pengujian`
--
ALTER TABLE `tbl_sifat_pengujian`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_tentang`
--
ALTER TABLE `tbl_tentang`
  MODIFY `tentang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_parameter_uji`
--
ALTER TABLE `tbl_parameter_uji`
  ADD CONSTRAINT `tbl_parameter_uji_ibfk_1` FOREIGN KEY (`pu_sp_id`) REFERENCES `tbl_sifat_pengujian` (`sp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
