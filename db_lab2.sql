-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 02, 2020 at 02:26 PM
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
-- Database: `db_lab2`
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
(3, 'PerMenLHK No 59 Tahun 2016 - Baku Mutu Lindi Bagi Usaha dan/atau Kegiatan TPA Sampah', '1a8e67476ef803738fa4ef3ff3de50b3.pdf'),
(4, 'PerMenLHK No 68 Tahun 2016 - Baku Mutu Air Limbah Domestik', 'e10892db425646d2a15d6280759292e5.pdf'),
(5, 'PerMenKes No 32 Tahun 2017 - Standar Baku Mutu Kesehatan Lingkungan dan Persyaratan Kesehatan Air', '02c9f9117bcbfaa21d551e51c7738db7.pdf');

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
  `anggota_level` varchar(3) NOT NULL DEFAULT '3',
  `reset_key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`anggota_id`, `anggota_nama`, `anggota_username`, `anggota_password`, `anggota_email`, `anggota_alamat`, `anggota_personil`, `anggota_jenis_kelamin`, `anggota_kontak`, `anggota_level`, `reset_key`) VALUES
(6, 'xyz', 'andi', '827ccb0eea8a706c4c34a16891f84e7b', 'yusufxyx114@gmail.com', 'Jl. Banda', 's', 'Laki-laki', '+6281258535938', '3', 'ew2RmQKxNoJsHiv3MfgXYOV5r9Clp1WhjEy48FAaTU7SbZnqtD'),
(7, 'sekar', 'sekar_anggota', 'e10adc3949ba59abbe56e057f20f883e', 'sekarlangittt@gmail.com', 'jalan merpati', 'sekarlangit', 'Perempuan', '085349474857', '3', ''),
(8, 'testing_ang', 'tang', '827ccb0eea8a706c4c34a16891f84e7b', 'backupsekarlangit@gmail.com', 'Jalan Tjilik Riwut', 'Testing Dulu Ya', 'Perempuan', '085349474857', '3', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_golongan`
--

CREATE TABLE `tbl_golongan` (
  `golongan_kode` varchar(6) NOT NULL,
  `golongan_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_golongan`
--

INSERT INTO `tbl_golongan` (`golongan_kode`, `golongan_nama`) VALUES
('I a', 'Juru Muda'),
('I b', 'Juru Muda Tk I'),
('I c', 'Juru'),
('I d', 'Juru Tk I'),
('II a', 'Pengatur Muda'),
('II b', 'Pengatur Muda Tk I'),
('II c', 'Pengatur'),
('II d', 'Pengatur Tk I'),
('III a', 'Penata Muda'),
('III b', 'Penata Muda Tk I'),
('III c', 'Penata'),
('III d', 'Penata Tk I'),
('IV a', 'Pembina'),
('IV b', 'Pembina Tk I');

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

--
-- Dumping data for table `tbl_inbox`
--

INSERT INTO `tbl_inbox` (`inbox_id`, `inbox_nama`, `inbox_email`, `inbox_kontak`, `inbox_pesan`, `inbox_tanggal`, `inbox_status`) VALUES
(1, 'xyz', 'yusufxyx114@gmail.com', NULL, 'ASASSA', '2020-06-30 06:40:27', 0),
(2, 'sese', 'sekarlangittt@gmail.com', NULL, 'testing', '2020-07-17 06:38:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_informasi_sampel`
--

CREATE TABLE `tbl_informasi_sampel` (
  `is_id` int(11) NOT NULL,
  `is_us_id` varchar(20) NOT NULL,
  `tanggal_sampel` date DEFAULT NULL,
  `no_identifikasi` varchar(100) NOT NULL DEFAULT '-',
  `kondisi` varchar(100) DEFAULT '-',
  `tanggal_pengujian_awal` date DEFAULT NULL,
  `tanggal_pengujian_akhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_informasi_sampel`
--

INSERT INTO `tbl_informasi_sampel` (`is_id`, `is_us_id`, `tanggal_sampel`, `no_identifikasi`, `kondisi`, `tanggal_pengujian_awal`, `tanggal_pengujian_akhir`) VALUES
(1, '5f28d82b2795f', '2020-09-09', 'dsd', '-', '2020-09-22', '2020-09-22'),
(2, '5f28f6cf3771f', '2020-08-03', 'lab01', 'kering', '2020-08-04', '2020-08-04'),
(3, '5f2b93ea8575d', '2020-08-04', 'lab02', 'lembab', '2020-08-11', '2020-08-11'),
(4, '5f3fd2d627144', '2020-09-09', 'aw', '-', '2020-08-21', '2020-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_interpretasi_hasil`
--

CREATE TABLE `tbl_interpretasi_hasil` (
  `ih_id` int(11) NOT NULL,
  `ih_us_id` varchar(30) NOT NULL,
  `ih_penyimpangan` varchar(100) NOT NULL DEFAULT '-',
  `ih_persyaratan` varchar(100) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_interpretasi_hasil`
--

INSERT INTO `tbl_interpretasi_hasil` (`ih_id`, `ih_us_id`, `ih_penyimpangan`, `ih_persyaratan`) VALUES
(1, '5f28d82b2795f', '-', '-'),
(2, '5f28f6cf3771f', '-', '-'),
(3, '5f2b93ea8575d', '-', '-'),
(4, '5f3fd2d627144', '-', '-');

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
(1, 'Plastik', 'P'),
(2, 'Kaca', 'KC');

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
(4, 'Uji Sampel Udara', '869f1889b2b6aa33aba2a7e4add074f0.png', '<p>Peralatan sampling umumnya terdiri dari collector, flowmeter dan vacuum pump.&nbsp; Untuk mengumpulkan sampel gas dapat digunakan collector &nbsp;seperti impinger, fritted bubbler atau tube adsorber dimana sampel akan bereaksi terhadap penyerap yang spesifik. &nbsp;Sedangkan untuk mengumpulkan sampel berupa partikel diperlukan filter. Flowmeter berfungsi untuk mengetahui volume udara yang terkumpul, dapat berupa dry gas meter, wet gas meter atau rotameter. Vacuum pump digunakan untuk menghisap udara ke dalam collector. Ketelusuran data hasil pengukuran umumnya tergantung kepada alat ukur flow meter.</p>\r\n\r\n<p>Lokasi pemantauan kualitas udara ambien ditetapkan dengan mempertimbangkan faktor-faktor arah angin, tata guna lahan, tinggi cerobong dan luas sebaran bahan pencemar (dispersi polutan). Adapun penentuan lokasi pemantauan mempertimbangkan apakah pemantauan dilakukan secara kontinyu (stasiun pemantauan) ataukah pemantauan secara grab atau sesaat dalam kaitannya dengan penaatan terhadap peraturan-peraturan lingkungan, pemenuhan dokumen AMDAL (dokumen RKL/RPL), verifikasi pengaduan, dll.</p>\r\n'),
(5, 'Tarif Pengujian Sampel', '39fb63d079ab2f441d71c00f23848372.png', '<p>Berikut Tarif Pengujian Sampel UPT Laboratorium Lingkungan Dinas Lingkungan Hidup Kota Palangka Raya</p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_outbox`
--

CREATE TABLE `tbl_outbox` (
  `outbox_id` int(3) NOT NULL,
  `inbox_id` int(3) NOT NULL,
  `outbox_sub` text NOT NULL,
  `outbox_msg` text NOT NULL,
  `outbox_tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_outbox`
--

INSERT INTO `tbl_outbox` (`outbox_id`, `inbox_id`, `outbox_sub`, `outbox_msg`, `outbox_tanggal`) VALUES
(1, 1, 'aas', '<p>xxxx</p>\r\n', '2020-06-30 07:15:45');

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
  `pu_satuan_id` int(11) NOT NULL,
  `pu_status_alat_bahan` enum('Tersedia','Tidak Tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_parameter_uji`
--

INSERT INTO `tbl_parameter_uji` (`pu_id`, `pu_nama`, `pu_sp_id`, `pu_tarif`, `pu_mutu`, `pu_satuan_id`, `pu_status_alat_bahan`) VALUES
(8, 'Derajat Keasaman (pH) Lindi', 2, 13000, '6-9', 3, 'Tersedia'),
(10, 'Kebutuhan Oksigen Biologis (BOD) Lindi', 2, 120000, '150', 1, 'Tersedia'),
(11, 'Kebutuhan Oksigen Kimia (COD) Lindi', 2, 84999, '300', 1, 'Tersedia'),
(12, 'Zat Padat Tersuspensi (TSS) Lindi', 1, 40000, '100', 1, 'Tersedia'),
(13, 'Merkuri (Hg) Lindi', 2, 120000, '0,005', 1, 'Tersedia'),
(14, 'Kadmium (Cd) Lindi', 2, 70000, '0,1', 1, 'Tersedia'),
(15, 'Derajat Keasaman (pH) Limbah Domestik', 2, 13000, '6-9', 3, 'Tersedia'),
(16, 'Kebutuhan Oksigen Biologis (BOD) Limbah Domestik', 2, 120000, '30', 1, 'Tersedia'),
(17, 'Kebutuhan Oksigen Kimia (COD) Limbah Domestik', 2, 85000, '100', 1, 'Tersedia'),
(18, 'Zat Padat Tersuspensi (TSS) Limbah Domestik', 1, 40000, '30', 1, 'Tersedia'),
(19, 'Minyak dan Lemak Limbah Domestik', 1, 75000, '5', 1, 'Tersedia'),
(20, 'Amoniak Limbah Domestik', 2, 45000, '10', 1, 'Tersedia');

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

--
-- Dumping data for table `tbl_parameter_us`
--

INSERT INTO `tbl_parameter_us` (`parameter_us`, `parameter_us_id`, `parameter_us_uji_id`, `parameter_us_metode_id`, `parameter_us_hasil`) VALUES
(1, '5f28d82b2795f', 12, 4, '3'),
(2, '5f28f6cf3771f', 18, 4, '28'),
(3, '5f28f6cf3771f', 19, 4, '5'),
(4, '5f28f6cf3771f', 15, 4, '8'),
(5, '5f28f6cf3771f', 16, 4, '35'),
(6, '5f28f6cf3771f', 17, 4, '90'),
(7, '5f2b93ea8575d', 18, 4, '30'),
(8, '5f2b93ea8575d', 15, 4, '8'),
(9, '5f2b93ea8575d', 16, 4, '29'),
(10, '5f2b93ea8575d', 17, 4, '101'),
(11, '5f3fd2d627144', 18, 4, '30'),
(12, '5f3fd2d627144', 15, 4, '8'),
(13, '5f3fd2d627144', 16, 4, '30'),
(14, '5f3fd2d627144', 17, 4, '100');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengambilan_sampel`
--

CREATE TABLE `tbl_pengambilan_sampel` (
  `ps_id` int(11) NOT NULL,
  `ps_us_id` varchar(20) NOT NULL,
  `lokasi` text NOT NULL,
  `metode_id` int(11) NOT NULL,
  `rincian` varchar(500) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengambilan_sampel`
--

INSERT INTO `tbl_pengambilan_sampel` (`ps_id`, `ps_us_id`, `lokasi`, `metode_id`, `rincian`) VALUES
(1, '5f28f6cf3771f', 'tempat makan / kantin ', 4, '-'),
(2, '5f2b93ea8575d', 'tempat usaha ', 4, '-');

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
(1, 'Administrator', 'P', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'sekarlangittt@outlook.com', '081254738486', 1, '1', '2016-09-03 06:07:55', 'e837eca5dc644a7a5033888b6a004713.jpg'),
(2, 'Operator Satu', 'L', 'operator1', 'ced15df040f56f2ff3d011e9f0b4bc43', 'operator@admin.com', '081277159401', 1, '2', '2020-04-29 03:47:46', 'f93fe4f7cf91ccf00e4f8a3ed422b3ff.jpg'),
(3, 'sekar', 'P', 'sekar_opt', '19eb3d3e675939b64f27d4d86588a423', 'sekarlangittt@gmail.com', '085349474857', 1, '2', '2020-07-17 06:45:34', '643bb760a2dfc9102b84d52cd5b2805f.jpg');

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

--
-- Dumping data for table `tbl_pengunjung`
--

INSERT INTO `tbl_pengunjung` (`pengunjung_id`, `pengunjung_tanggal`, `pengunjung_ip`, `pengunjung_perangkat`) VALUES
(1, '2020-05-25 10:05:54', '::1', 'Chrome'),
(2, '2020-06-06 11:47:32', '::1', 'Chrome'),
(3, '2020-06-15 07:04:38', '::1', 'Chrome'),
(4, '2020-06-19 06:27:54', '::1', 'Chrome'),
(5, '2020-06-30 04:34:48', '::1', 'Chrome'),
(6, '2020-07-01 02:19:59', '::1', 'Chrome'),
(7, '2020-07-01 02:19:59', '::1', 'Chrome'),
(8, '2020-07-07 04:33:09', '::1', 'Chrome'),
(9, '2020-07-17 05:44:11', '::1', 'Chrome'),
(10, '2020-07-19 05:00:58', '::1', 'Firefox'),
(11, '2020-08-02 12:50:34', '::1', 'Chrome'),
(12, '2020-08-04 03:22:57', '::1', 'Chrome'),
(13, '2020-08-06 05:01:59', '::1', 'Chrome'),
(14, '2020-08-11 08:58:43', '::1', 'Chrome'),
(15, '2020-08-15 08:22:53', '::1', 'Chrome'),
(16, '2020-08-21 14:01:49', '::1', 'Firefox'),
(17, '2020-08-23 02:45:38', '::1', 'Chrome'),
(18, '2020-09-07 11:42:14', '::1', 'Chrome'),
(19, '2020-09-09 11:10:43', '::1', 'Chrome'),
(20, '2020-09-22 11:00:57', '::1', 'Chrome'),
(21, '2020-09-22 17:15:59', '::1', 'Chrome'),
(22, '2020-09-25 13:59:33', '::1', 'Chrome'),
(23, '2020-10-01 15:29:42', '::1', 'Chrome');

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
(3, '-'),
(4, 'jumlah/100ml'),
(5, 'L');

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
-- Table structure for table `tbl_setting_ttd`
--

CREATE TABLE `tbl_setting_ttd` (
  `st_id` int(3) NOT NULL,
  `st_posisi` enum('Kepala UPTD','Manajer Teknis') NOT NULL,
  `st_nama` varchar(100) NOT NULL,
  `st_golongan` varchar(6) NOT NULL,
  `st_nip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting_ttd`
--

INSERT INTO `tbl_setting_ttd` (`st_id`, `st_posisi`, `st_nama`, `st_golongan`, `st_nip`) VALUES
(1, 'Kepala UPTD', 'BOWO BUDIARSO, S.T', 'III d', '19680504 199603 1 007'),
(2, 'Manajer Teknis', 'AHMAD RIADI, S.Si', 'III c', '19830311 200802 1 002');

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
(2, 'Skema', 'skema-alur-sistem-dropship-pemesanan-barang-produk-herbal-Tazakka-GRATIS.jpg', '', ''),
(3, ' ', 'b4a8806552636b1e599f185356af6975.jpg', '', '');

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
(7, 'Sudah Melakukan Pembayaran', 'alert-success', 6),
(8, 'Tutup', 'alert-danger', 6);

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

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`transaksi_id`, `transaksi_us`, `transaksi_bayar`, `transaksi_tgl`) VALUES
(1, '5f28f6cf3771f', 333000, '2020-08-04 06:01:19'),
(2, '5f2b93ea8575d', 258000, '2020-08-06 07:15:19'),
(3, '5f3fd2d627144', 258000, '2020-08-21 14:09:43'),
(4, '5f28d82b2795f', 4000, '2020-09-09 11:17:43'),
(5, '5f28d82b2795f', 36000, '2020-09-09 11:18:43'),
(6, '5f28d82b2795f', 4000, '2020-09-09 11:23:59'),
(7, '5f28d82b2795f', 4000, '2020-09-09 11:25:44'),
(8, '5f28d82b2795f', 4000, '2020-09-09 11:25:58'),
(9, '5f28d82b2795f', 36000, '2020-09-22 11:28:14');

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
-- Dumping data for table `tbl_us`
--

INSERT INTO `tbl_us` (`us_id`, `us_anggota`, `us_kode_sampel`, `us_fk_js`, `us_fk_jw`, `us_pengambilan`, `us_total`, `us_uang_muka`, `us_sisa`, `us_file`, `us_catatan`, `us_catatan_status`, `us_status_id`, `us_laporan`, `us_notif_status`) VALUES
('5f28d82b2795f', 7, 'KC', 1, 2, 'Pelanggan', 40000, 4000, 0, '09a1a089b1660f0f6b3569578ebc38bb.pdf', '', '', 8, 'doc5f28d82b2795f.pdf', '1'),
('5f28f6cf3771f', 7, '01', 1, 1, 'Laboratorium', 333000, 33300, 0, '9669cee10eae5e7f4d84426bdeb32f74.pdf', '', '', 8, '', '1'),
('5f2b93ea8575d', 7, '02', 1, 2, 'Laboratorium', 258000, 25800, 0, '04606b57c1a017a11fb46856fd44bed5.pdf', '', '', 8, '', '1'),
('5f3fd2d627144', 8, 'air parit', 1, 1, 'Pelanggan', 258000, 25800, 0, 'cffc1b0eff3fb4fcfc2f6172f6768cd1.pdf', '', '', 5, 'doc5f3fd2d627144.pdf', '1');

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
-- Indexes for table `tbl_golongan`
--
ALTER TABLE `tbl_golongan`
  ADD PRIMARY KEY (`golongan_kode`);

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
-- Indexes for table `tbl_interpretasi_hasil`
--
ALTER TABLE `tbl_interpretasi_hasil`
  ADD PRIMARY KEY (`ih_id`);

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
-- Indexes for table `tbl_outbox`
--
ALTER TABLE `tbl_outbox`
  ADD PRIMARY KEY (`outbox_id`);

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
-- Indexes for table `tbl_setting_ttd`
--
ALTER TABLE `tbl_setting_ttd`
  ADD PRIMARY KEY (`st_id`);

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
  MODIFY `acuan_metode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  MODIFY `anggota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_inbox`
--
ALTER TABLE `tbl_inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_informasi_sampel`
--
ALTER TABLE `tbl_informasi_sampel`
  MODIFY `is_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_interpretasi_hasil`
--
ALTER TABLE `tbl_interpretasi_hasil`
  MODIFY `ih_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_jenis_sampel`
--
ALTER TABLE `tbl_jenis_sampel`
  MODIFY `js_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jenis_wadah`
--
ALTER TABLE `tbl_jenis_wadah`
  MODIFY `jw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `tbl_outbox`
--
ALTER TABLE `tbl_outbox`
  MODIFY `outbox_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_parameter_uji`
--
ALTER TABLE `tbl_parameter_uji`
  MODIFY `pu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_parameter_us`
--
ALTER TABLE `tbl_parameter_us`
  MODIFY `parameter_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_pengambilan_sampel`
--
ALTER TABLE `tbl_pengambilan_sampel`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `pengguna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  MODIFY `pengunjung_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `tbl_setting_ttd`
--
ALTER TABLE `tbl_setting_ttd`
  MODIFY `st_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sifat_pengujian`
--
ALTER TABLE `tbl_sifat_pengujian`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
