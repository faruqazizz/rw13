-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2024 at 04:29 PM
-- Server version: 8.0.36-cll-lve
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rwcipmel_profil`
--

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id` int NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id`, `nama`) VALUES
(1, 'Islam'),
(2, 'Kristen Protestan'),
(3, 'Kristen Katholik'),
(4, 'Hindu'),
(5, 'Buddha'),
(6, 'Konghucu'),
(7, 'Ketuhanan YME');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id` int NOT NULL,
  `nama_pengadu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subjek_aduan` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi_aspirasi` text COLLATE utf8mb4_general_ci,
  `ip_address` text COLLATE utf8mb4_general_ci,
  `tanggal_dibuat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_group`
--

CREATE TABLE `auth_group` (
  `id` int NOT NULL,
  `group` varchar(100) NOT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_group`
--

INSERT INTO `auth_group` (`id`, `group`, `definition`) VALUES
(1, 'xadmin', 'Admin Master'),
(2, 'rw', 'Ketua Rukun Warga'),
(3, 'warga', 'Warga Biasa'),
(4, 'rt001', 'Rukun Tetangga 001 (RT001)'),
(7, 'rt002', 'Rukun Tetangga 002 (RT002)'),
(8, 'rt003', 'Rukun Tetangga 003 (RT003)'),
(9, 'rt004', 'Rukun Tetangga 004 (RT004)'),
(10, 'rt005', 'Rukun Tetangga 005 (RT005)'),
(11, 'rt006', 'Rukun Tetangga 006 (RT006)'),
(12, 'rt007', 'Rukun Tetangga 007 (RT007)'),
(13, 'rt008', 'Rukun Tetangga 008 (RT008)'),
(14, 'rt009', 'Rukun Tetangga 009 (RT009)');

-- --------------------------------------------------------

--
-- Table structure for table `auth_permission`
--

CREATE TABLE `auth_permission` (
  `id` int NOT NULL,
  `permission` varchar(100) NOT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_permission`
--

INSERT INTO `auth_permission` (`id`, `permission`, `definition`) VALUES
(1, 'config_view_default', 'Module config'),
(2, 'config_view_logo', 'Module config'),
(3, 'config_view_sosmed', 'Module config'),
(4, 'config_view_core', 'Module config'),
(5, 'config_update_web_name', 'Module config'),
(6, 'config_update_web_domain', 'Module config'),
(7, 'config_update_web_owner', 'Module config'),
(8, 'config_update_email', 'Module config'),
(9, 'config_update_telepon', 'Module config'),
(10, 'config_update_address', 'Module config'),
(11, 'config_update_logo', 'Module config'),
(12, 'config_update_logo_mini', 'Module config'),
(13, 'config_update_favicon', 'Module config'),
(14, 'config_update_facebook', 'Module config'),
(15, 'config_update_instagram', 'Module config'),
(16, 'config_update_youtube', 'Module config'),
(17, 'config_update_twitter', 'Module config'),
(18, 'config_update_language', 'Module config'),
(19, 'config_update_time_zone', 'Module config'),
(20, 'config_update_max_upload', 'Module config'),
(21, 'config_update_route_admin', 'Module config'),
(22, 'config_update_route_login', 'Module config'),
(23, 'config_update_encryption_key', 'Module config'),
(24, 'config_update_encryption_url', 'Module config'),
(25, 'config_update_url_suffix', 'Module config'),
(26, 'config_update_user_log_status', 'Module config'),
(27, 'config_update_maintenance_status', 'Module config'),
(28, 'menu_list', 'Module menu'),
(29, 'menu_add', 'Module menu'),
(30, 'menu_update', 'Module menu'),
(31, 'menu_delete', 'Module menu'),
(32, 'menu_drag_positions', 'Module menu'),
(33, 'user_list', 'Module user'),
(34, 'user_add', 'Module user'),
(35, 'user_update', 'Module user'),
(36, 'user_detail', 'Module user'),
(37, 'user_delete', 'Module user'),
(38, 'groups_list', 'Module groups'),
(39, 'groups_add', 'Module groups'),
(40, 'groups_access', 'Module groups'),
(41, 'groups_update', 'Module groups'),
(42, 'groups_delete', 'Module groups'),
(43, 'permission_list', 'Module permission'),
(44, 'permission_add', 'Module permission'),
(45, 'permission_update', 'Module permission'),
(46, 'permission_delete', 'Module permission'),
(47, 'dashboard__view_profile_user', 'Module dashboard'),
(48, 'dashboard_view_total_user', 'Module dashboard'),
(49, 'dashboard_view_total_group', 'Module dashboard'),
(50, 'dashboard_view_total_permission', 'Module dashboard'),
(51, 'dashboard_view_total_filemanager', 'Module dashboard'),
(52, 'filemanager_list', 'Module filemanager'),
(53, 'filemanager_add', 'Module filemanager'),
(54, 'filemanager_delete', 'Module filemanager'),
(55, 'sidebar_view_dashboard', 'Module sidebar'),
(56, 'sidebar_view_auth', 'Module sidebar'),
(57, 'sidebar_view_user', 'Module sidebar'),
(58, 'sidebar_view_groups', 'Module sidebar'),
(59, 'sidebar_view_permission', 'Module sidebar'),
(60, 'sidebar_view_config', 'Module sidebar'),
(61, 'sidebar_view_system', 'Module sidebar'),
(62, 'sidebar_view_management_menu', 'Module sidebar'),
(63, 'sidebar_view_file_manager', 'Module sidebar'),
(64, 'sidebar_view_m-crud_generator', 'Module Sidebar'),
(65, 'crud_generator_list', 'Module crud generator'),
(66, 'crud_generator_add', 'Module crud generator'),
(67, 'crud_generator_delete', 'Module crud generator'),
(68, 'sidebar_view_configuration', 'Module sidebar'),
(69, 'sidebar_view_settings', 'Module sidebar'),
(75, 'sidebar_view_artikel', 'Module sidebar'),
(76, 'kategori_konten_list', 'Module kategori_konten'),
(77, 'kategori_konten_detail', 'Module kategori_konten'),
(78, 'kategori_konten_add', 'Module kategori_konten'),
(79, 'kategori_konten_update', 'Module kategori_konten'),
(80, 'kategori_konten_delete', 'Module kategori_konten'),
(81, 'sidebar_view_kategori_konten', 'Module sidebar'),
(97, 'konten_list', 'Module konten'),
(98, 'konten_detail', 'Module konten'),
(99, 'konten_add', 'Module konten'),
(100, 'konten_update', 'Module konten'),
(101, 'konten_delete', 'Module konten'),
(107, 'sidebar_view_aspirasi', 'Module sidebar'),
(113, 'stts_list', 'Module stts'),
(114, 'stts_detail', 'Module stts'),
(115, 'stts_add', 'Module stts'),
(116, 'stts_update', 'Module stts'),
(117, 'stts_delete', 'Module stts'),
(118, 'sidebar_view_status', 'Module sidebar'),
(124, 'sidebar_view_link_youtube', 'Module sidebar'),
(130, 'sidebar_view_berkas', 'Module sidebar'),
(151, 'link_youtube_list', 'Module link_youtube'),
(152, 'link_youtube_detail', 'Module link_youtube'),
(153, 'link_youtube_add', 'Module link_youtube'),
(154, 'link_youtube_update', 'Module link_youtube'),
(155, 'link_youtube_delete', 'Module link_youtube'),
(156, 'sidebar_view_pengaturan', 'Module sidebar'),
(199, 'slider_list', 'Module slider'),
(200, 'slider_detail', 'Module slider'),
(201, 'slider_add', 'Module slider'),
(202, 'slider_update', 'Module slider'),
(203, 'slider_delete', 'Module slider'),
(204, 'sidebar_view_slider', 'Module sidebar'),
(215, 'sidebar_view_setting_extra', 'Module sidebar'),
(221, 'aspirasi_list', 'Module aspirasi'),
(222, 'aspirasi_detail', 'Module aspirasi'),
(223, 'aspirasi_add', 'Module aspirasi'),
(224, 'aspirasi_update', 'Module aspirasi'),
(225, 'aspirasi_delete', 'Module aspirasi'),
(226, 'halaman_list', 'Module halaman'),
(227, 'halaman_detail', 'Module halaman'),
(228, 'halaman_add', 'Module halaman'),
(229, 'halaman_update', 'Module halaman'),
(230, 'halaman_delete', 'Module halaman'),
(231, 'sidebar_view_halaman', 'Module sidebar'),
(237, 'sidebar_view_foto_dokumen', 'Module sidebar'),
(243, 'fotofoto_list', 'Module fotofoto'),
(244, 'fotofoto_detail', 'Module fotofoto'),
(245, 'fotofoto_add', 'Module fotofoto'),
(246, 'fotofoto_update', 'Module fotofoto'),
(247, 'fotofoto_delete', 'Module fotofoto'),
(253, 'sidebar_view_menu_halaman_depan', 'Module sidebar'),
(274, 'menu_frontend_list', 'Module menu_frontend'),
(275, 'menu_frontend_detail', 'Module menu_frontend'),
(276, 'menu_frontend_add', 'Module menu_frontend'),
(277, 'menu_frontend_update', 'Module menu_frontend'),
(278, 'menu_frontend_delete', 'Module menu_frontend'),
(279, 'sidebar_view_menu_tambahan', 'Module sidebar'),
(280, 'sidebar_view_daftar', 'Module sidebar'),
(281, 'sidebar_view_menu_ekstra', 'Module sidebar'),
(282, 'sidebar_view_konten', 'Module sidebar'),
(283, 'config_update_tiktok', 'Module config'),
(284, 'config_view_database', 'Module config'),
(285, 'config_database_backup', 'Module config'),
(286, 'config_database_import', 'Module config'),
(287, 'config_database_restore', 'Module config'),
(288, 'config_database_delete', 'Module config'),
(289, 'config_database_download', 'Module config'),
(295, 'menu_halaman_list', 'Module menu_halaman'),
(296, 'menu_halaman_detail', 'Module menu_halaman'),
(297, 'menu_halaman_add', 'Module menu_halaman'),
(298, 'menu_halaman_update', 'Module menu_halaman'),
(299, 'menu_halaman_delete', 'Module menu_halaman'),
(375, 'status_warga_list', 'Module status_warga'),
(376, 'status_warga_detail', 'Module status_warga'),
(377, 'status_warga_add', 'Module status_warga'),
(378, 'status_warga_update', 'Module status_warga'),
(379, 'status_warga_delete', 'Module status_warga'),
(380, 'profesi_list', 'Module profesi'),
(381, 'profesi_detail', 'Module profesi'),
(382, 'profesi_add', 'Module profesi'),
(383, 'profesi_update', 'Module profesi'),
(384, 'profesi_delete', 'Module profesi'),
(385, 'agama_list', 'Module agama'),
(386, 'agama_detail', 'Module agama'),
(387, 'agama_add', 'Module agama'),
(388, 'agama_update', 'Module agama'),
(389, 'agama_delete', 'Module agama'),
(390, 'kelamin_list', 'Module kelamin'),
(391, 'kelamin_detail', 'Module kelamin'),
(392, 'kelamin_add', 'Module kelamin'),
(393, 'kelamin_update', 'Module kelamin'),
(394, 'kelamin_delete', 'Module kelamin'),
(395, 'pendidikan_terakhir_list', 'Module pendidikan_terakhir'),
(396, 'pendidikan_terakhir_detail', 'Module pendidikan_terakhir'),
(397, 'pendidikan_terakhir_add', 'Module pendidikan_terakhir'),
(398, 'pendidikan_terakhir_update', 'Module pendidikan_terakhir'),
(399, 'pendidikan_terakhir_delete', 'Module pendidikan_terakhir'),
(405, 'sidebar_view_data_warga', 'Module sidebar'),
(406, 'sidebar_view_status_warga', 'Module sidebar'),
(407, 'sidebar_view_agama', 'Module sidebar'),
(408, 'sidebar_view_jenis_kelamin', 'Module sidebar'),
(409, 'sidebar_view_pendidikan_terakhir', 'Module sidebar'),
(410, 'sidebar_view_profesi_/_pekerjaan', 'Module sidebar'),
(411, 'sidebar_view_daftar_warga', 'Module sidebar'),
(412, 'sidebar_view_manajemen_warga', 'Module sidebar'),
(438, 'sidebar_view_surat-menyurat', 'Module sidebar'),
(439, 'sidebar_view_jenis_surat', 'Module sidebar'),
(440, 'sidebar_view_status_surat', 'Module sidebar'),
(441, 'tb_status_surat_list', 'Module tb_status_surat'),
(442, 'tb_status_surat_detail', 'Module tb_status_surat'),
(443, 'tb_status_surat_add', 'Module tb_status_surat'),
(444, 'tb_status_surat_update', 'Module tb_status_surat'),
(445, 'tb_status_surat_delete', 'Module tb_status_surat'),
(446, 'tb_jenis_surat_list', 'Module tb_jenis_surat'),
(447, 'tb_jenis_surat_detail', 'Module tb_jenis_surat'),
(448, 'tb_jenis_surat_add', 'Module tb_jenis_surat'),
(449, 'tb_jenis_surat_update', 'Module tb_jenis_surat'),
(450, 'tb_jenis_surat_delete', 'Module tb_jenis_surat'),
(464, 'warga_list', 'Module warga'),
(465, 'warga_detail', 'Module warga'),
(466, 'warga_add', 'Module warga'),
(467, 'warga_update', 'Module warga'),
(468, 'warga_delete', 'Module warga'),
(478, 'sidebar_view_rt', 'Module sidebar'),
(494, 'warga_syarat_dokumen_list', 'Module warga_syarat_dokumen'),
(495, 'warga_syarat_dokumen_detail', 'Module warga_syarat_dokumen'),
(496, 'warga_syarat_dokumen_add', 'Module warga_syarat_dokumen'),
(497, 'warga_syarat_dokumen_update', 'Module warga_syarat_dokumen'),
(498, 'warga_syarat_dokumen_delete', 'Module warga_syarat_dokumen'),
(499, 'sidebar_view_syarat_dokumen', 'Module sidebar'),
(500, 'warga_dokumen_list', 'Module warga_dokumen'),
(501, 'warga_dokumen_detail', 'Module warga_dokumen'),
(502, 'warga_dokumen_add', 'Module warga_dokumen'),
(503, 'warga_dokumen_update', 'Module warga_dokumen'),
(504, 'warga_dokumen_delete', 'Module warga_dokumen'),
(505, 'tb_surat_list', 'Module tb_surat'),
(506, 'tb_surat_detail', 'Module tb_surat'),
(507, 'tb_surat_add', 'Module tb_surat'),
(508, 'tb_surat_update', 'Module tb_surat'),
(509, 'tb_surat_delete', 'Module tb_surat'),
(510, 'sidebar_view_ajuan_surat', 'Module sidebar'),
(511, 'sidebar_view_validasi_surat', 'Module sidebar'),
(512, 'sidebar_view_data_diri', 'Module sidebar'),
(513, 'sidebar_view_identitas_diri', 'Module sidebar'),
(514, 'sidebar_view_dokumen', 'Module sidebar'),
(515, 'tb_surat_filter', 'Module tb'),
(516, 'sidebar_view_statistik', 'Module sidebar'),
(517, 'halaman_filter', 'Module halaman'),
(518, 'tb_kopsurat_list', 'Module tb_kopsurat'),
(519, 'tb_kopsurat_detail', 'Module tb_kopsurat'),
(520, 'tb_kopsurat_add', 'Module tb_kopsurat'),
(521, 'tb_kopsurat_update', 'Module tb_kopsurat'),
(522, 'tb_kopsurat_delete', 'Module tb_kopsurat'),
(523, 'sidebar_view_kop_surat', 'Module sidebar'),
(524, 'config_update_emailnya', 'Module config'),
(530, 'tb_galeri_detail_list', 'Module tb_galeri_detail'),
(531, 'tb_galeri_detail_detail', 'Module tb_galeri_detail'),
(532, 'tb_galeri_detail_add', 'Module tb_galeri_detail'),
(533, 'tb_galeri_detail_update', 'Module tb_galeri_detail'),
(534, 'tb_galeri_detail_delete', 'Module tb_galeri_detail'),
(535, 'sidebar_view_galeri', 'Module sidebar'),
(536, 'tb_galeri_list', 'Module tb_galeri'),
(537, 'tb_galeri_detail', 'Module tb_galeri'),
(538, 'tb_galeri_add', 'Module tb_galeri'),
(539, 'tb_galeri_update', 'Module tb_galeri'),
(540, 'tb_galeri_delete', 'Module tb_galeri'),
(546, 'pengaturan_list', 'Module pengaturan'),
(547, 'pengaturan_detail', 'Module pengaturan'),
(548, 'pengaturan_update', 'Module pengaturan'),
(549, 'pengaturan_delete', 'Module pengaturan'),
(550, 'sambutan_list', 'Module sambutan'),
(551, 'sambutan_detail', 'Module sambutan'),
(552, 'sambutan_update', 'Module sambutan'),
(553, 'sambutan_delete', 'Module sambutan'),
(554, 'sidebar_view_sambutan', 'Module sidebar');

-- --------------------------------------------------------

--
-- Table structure for table `auth_permission_to_group`
--

CREATE TABLE `auth_permission_to_group` (
  `permission_id` int NOT NULL,
  `group_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_permission_to_group`
--

INSERT INTO `auth_permission_to_group` (`permission_id`, `group_id`) VALUES
(35, 3),
(36, 3),
(55, 3),
(57, 3),
(438, 3),
(510, 3),
(512, 3),
(513, 3),
(514, 3),
(505, 3),
(506, 3),
(507, 3),
(508, 3),
(509, 3),
(465, 3),
(467, 3),
(500, 3),
(501, 3),
(502, 3),
(503, 3),
(504, 3),
(33, 4),
(36, 4),
(37, 4),
(55, 4),
(57, 4),
(411, 4),
(478, 4),
(511, 4),
(505, 4),
(506, 4),
(507, 4),
(508, 4),
(464, 4),
(465, 4),
(466, 4),
(467, 4),
(468, 4),
(1, 2),
(2, 2),
(3, 2),
(5, 2),
(6, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(283, 2),
(284, 2),
(285, 2),
(286, 2),
(287, 2),
(289, 2),
(274, 2),
(275, 2),
(276, 2),
(277, 2),
(278, 2),
(295, 2),
(296, 2),
(297, 2),
(298, 2),
(299, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(47, 2),
(48, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(60, 2),
(61, 2),
(63, 2),
(69, 2),
(75, 2),
(107, 2),
(124, 2),
(130, 2),
(156, 2),
(204, 2),
(215, 2),
(237, 2),
(253, 2),
(279, 2),
(280, 2),
(281, 2),
(282, 2),
(405, 2),
(406, 2),
(407, 2),
(408, 2),
(409, 2),
(410, 2),
(411, 2),
(412, 2),
(438, 2),
(439, 2),
(440, 2),
(499, 2),
(510, 2),
(516, 2),
(523, 2),
(535, 2),
(554, 2),
(97, 2),
(98, 2),
(99, 2),
(100, 2),
(101, 2),
(151, 2),
(152, 2),
(153, 2),
(154, 2),
(155, 2),
(199, 2),
(200, 2),
(201, 2),
(202, 2),
(203, 2),
(221, 2),
(222, 2),
(243, 2),
(244, 2),
(245, 2),
(246, 2),
(247, 2),
(375, 2),
(376, 2),
(377, 2),
(378, 2),
(379, 2),
(380, 2),
(381, 2),
(382, 2),
(383, 2),
(384, 2),
(385, 2),
(386, 2),
(387, 2),
(388, 2),
(389, 2),
(390, 2),
(391, 2),
(392, 2),
(393, 2),
(394, 2),
(395, 2),
(396, 2),
(397, 2),
(398, 2),
(399, 2),
(441, 2),
(442, 2),
(443, 2),
(444, 2),
(445, 2),
(446, 2),
(447, 2),
(448, 2),
(449, 2),
(450, 2),
(505, 2),
(506, 2),
(507, 2),
(508, 2),
(518, 2),
(519, 2),
(520, 2),
(521, 2),
(522, 2),
(530, 2),
(531, 2),
(532, 2),
(533, 2),
(534, 2),
(536, 2),
(537, 2),
(538, 2),
(539, 2),
(540, 2),
(464, 2),
(465, 2),
(466, 2),
(467, 2),
(468, 2),
(494, 2),
(495, 2),
(496, 2),
(497, 2),
(498, 2),
(500, 2),
(501, 2),
(502, 2),
(503, 2),
(504, 2),
(546, 2),
(547, 2),
(548, 2),
(550, 2),
(551, 2),
(552, 2),
(553, 2),
(33, 7),
(36, 7),
(37, 7),
(55, 7),
(57, 7),
(411, 7),
(478, 7),
(511, 7),
(505, 7),
(506, 7),
(507, 7),
(508, 7),
(464, 7),
(465, 7),
(466, 7),
(467, 7),
(468, 7),
(33, 8),
(36, 8),
(37, 8),
(55, 8),
(57, 8),
(411, 8),
(478, 8),
(511, 8),
(505, 8),
(506, 8),
(507, 8),
(508, 8),
(464, 8),
(465, 8),
(466, 8),
(467, 8),
(468, 8),
(33, 9),
(36, 9),
(37, 9),
(55, 9),
(57, 9),
(411, 9),
(478, 9),
(511, 9),
(505, 9),
(506, 9),
(507, 9),
(508, 9),
(464, 9),
(465, 9),
(466, 9),
(467, 9),
(468, 9),
(33, 10),
(36, 10),
(37, 10),
(55, 10),
(57, 10),
(411, 10),
(478, 10),
(511, 10),
(505, 10),
(506, 10),
(507, 10),
(508, 10),
(464, 10),
(465, 10),
(466, 10),
(467, 10),
(468, 10),
(33, 11),
(36, 11),
(37, 11),
(55, 11),
(57, 11),
(411, 11),
(478, 11),
(511, 11),
(505, 11),
(506, 11),
(507, 11),
(508, 11),
(464, 11),
(465, 11),
(466, 11),
(467, 11),
(468, 11),
(33, 12),
(36, 12),
(37, 12),
(55, 12),
(57, 12),
(411, 12),
(478, 12),
(511, 12),
(505, 12),
(506, 12),
(507, 12),
(508, 12),
(464, 12),
(465, 12),
(466, 12),
(467, 12),
(468, 12),
(33, 13),
(36, 13),
(37, 13),
(55, 13),
(57, 13),
(411, 13),
(478, 13),
(511, 13),
(505, 13),
(506, 13),
(507, 13),
(508, 13),
(464, 13),
(465, 13),
(466, 13),
(467, 13),
(468, 13),
(33, 14),
(36, 14),
(37, 14),
(55, 14),
(57, 14),
(411, 14),
(478, 14),
(511, 14),
(505, 14),
(506, 14),
(507, 14),
(508, 14),
(464, 14),
(465, 14),
(466, 14),
(467, 14),
(468, 14);

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `id_user` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` text,
  `email` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `token` text NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `is_active` char(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `is_delete` char(1) NOT NULL DEFAULT '0',
  `id_warga` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`id_user`, `name`, `photo`, `email`, `password`, `token`, `last_login`, `ip_address`, `is_active`, `created`, `modified`, `is_delete`, `id_warga`) VALUES
(1, 'Faservice', '', 'faruq.fqs@nusamandiri.ac.id', '$2y$10$BOwm0u14np9P0r82lqRUEujpro5UAB1Dw3yoTvQifNWvOl2LPIc1m', 'ed9bf6c1e3f2c8b87ace11afcbc4f98b', '2024-06-13 14:05:00', '101.255.125.150', '1', '2023-04-11 18:51:00', '2020-11-24 04:25:27', '0', 0),
(2, 'Khotibul Umam', '', '3175081302910005@cipmel013.com', '$2y$10$zn7ETjgd/Jz0e6tOeBTS8OFRO2nQvWrbH3tuClEPo5TMmkLNBmqfi', '86ec4a22907be692dd5822e7afd007f8', '2024-06-14 13:20:00', '2001:448a:2077:2ba5:5c79:fbac:a4ae:8066', '1', '2023-06-10 13:58:32', '2023-09-12 11:53:27', '0', 1),
(3, 'Dadang Supriyadi', '', '1111111111111111@cipmel013.com', '$2y$10$RYkMcREAtt3JpquHOU6zeOpLo17salhjLqSnLfyqEGRGElgeg6sKu', 'f340fe1555f2e2f6f5d746690ef9e8d0', '2023-12-17 10:10:00', '115.124.73.129', '1', '2023-12-16 22:49:42', '2023-12-16 23:30:42', '0', 3),
(4, 'Sri Mardianah', '', '3175086406840001@cipmel013.com', '$2y$10$iq8yEz2aqPP/nqDI.fvC7OKJrara/lrF1pe/tE6P3z6XO71/Jnqwq', '0caf209100d2c9d173d3bfd4d1bbd675', '2023-12-17 00:02:00', '2001:67c:2628:647:94af:c9ff:feb7:fd6f', '1', '2023-12-16 23:56:51', '2023-12-16 23:57:12', '0', 4),
(5, 'Abdul Aziz', '', 'warga-rt002@cipmel013.com', '$2y$10$C7X.UnftBBvEsLl/2Ttk6eAOsXEt6IHO9knUqn.UD7EwfEbgNm.mW', 'e2bf0be632ad097951f0f65f65e5ea2e', '2023-12-17 00:04:00', '182.2.165.188', '1', '2023-12-17 00:04:00', '2023-12-17 00:07:59', '0', 5),
(6, 'Faruq Aziz', '', 'warga2@cipmel013.com', '$2y$10$27gtflcxJbvcl0sqKxKVpOAuHaIpxfsna2dlyBcPS/ri3Q6ueDny2', 'a9fd37b592c08dfc82016f914f094cd9', '2024-06-13 14:07:00', '101.255.125.150', '1', '2023-12-17 09:34:05', '2024-06-13 14:06:37', '0', 6),
(7, 'Netty Setyaningsih', '', '3175087009840001@cipmel013.com', '$2y$10$O1KavJuNjCHH6/WqT4Fv6OJ9UTlUs7M2LmDt3dq./m3hfoHamVnn6', '10eb3387035c8577182fdc55e223e812', '2023-12-17 09:50:00', '120.188.5.91', '1', '2023-12-17 09:47:42', '2023-12-17 09:48:35', '0', 10),
(8, 'hana', '', '3175084905020008@cipmel013.com', '$2y$10$cvoZWE5qFzIbjHyETCZs8OhrSVa1.x4TBr/9LAhDoZ5phl46988Z6', '2bbc293d488d244f046b548f986d58cc', '2023-12-17 10:02:00', '114.10.116.139', '1', '2023-12-17 09:56:32', '2023-12-17 10:03:12', '0', 11),
(9, 'Mulyani Havizo', NULL, '3175085804710003@cipmel013.com', '$2y$10$GrVPfhntr8LNlHkFDF4sPePECjAqwwzhFB6mRSG6OJSmWGgBXFhKa', 'd70904ab404e88b45d6bf4c19c846e7c', '2023-12-17 10:01:00', '114.10.25.215', '1', '2023-12-17 09:59:01', '2023-12-17 09:59:01', '0', 15),
(10, 'Siti sadiyah', NULL, '3175087103810006@cipmel013.com', '$2y$10$reWFKQjbd7ogwFjAPGSEyuiP5Js4GbdgrU/Mw429g08hqoCkqCiKq', '7c8123b26429976444d1fa142426a175', '2023-12-17 10:01:00', '140.213.9.24', '1', '2023-12-17 10:00:54', '2023-12-17 10:00:54', '0', 14),
(11, 'ANIS SURYANI', NULL, '3175084712810005@cipmel013.com', '$2y$10$Q6zAK4hQDJ6EfRTu93z2BO1spzrDkBb3lM0ZW3w3yCGGo87rzJ3Nq', '88fc70438bc21757dc4bbd686b4501bd', '2023-12-17 10:13:00', '140.213.9.88', '1', '2023-12-17 10:01:18', '2023-12-17 10:01:18', '0', 7),
(12, 'Yuli ernawati', '', '3175085902730001@cipmel013.com', '$2y$10$w9OHIfGucvIkfwIdYQZ7nuO/sqtuDtpEj6DjyPrBOryY0tlSbqA3W', '87a0482665ae7001438c01d21d415fc8', '2023-12-17 10:03:00', '182.2.136.179', '1', '2023-12-17 10:01:53', '2023-12-17 10:02:32', '0', 8),
(13, 'Virgin Putery Chinta', NULL, '3175084504050006@cipmel013.com', '$2y$10$D7J4mNCl1ZdmfgIW2Vk2J.2jCS38tcl/jdBbLstQh4H6HMmDLc416', 'b6d680722737e5fae8986220d9d53ca5', '2023-12-17 10:04:00', '115.124.73.129', '1', '2023-12-17 10:03:22', '2023-12-17 10:03:22', '0', 12);

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_to_group`
--

CREATE TABLE `auth_user_to_group` (
  `id_user` int NOT NULL,
  `id_group` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_user_to_group`
--

INSERT INTO `auth_user_to_group` (`id_user`, `id_group`) VALUES
(1, 1),
(2, 2),
(3, 4),
(4, 7),
(5, 3),
(6, 3),
(7, 8),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 9),
(13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ci_user_log`
--

CREATE TABLE `ci_user_log` (
  `id` int NOT NULL,
  `user` int DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `url` text,
  `data` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `db_sambutan`
--

CREATE TABLE `db_sambutan` (
  `id` int NOT NULL,
  `judul_sambutan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_rw` int DEFAULT NULL,
  `foto_diri` text COLLATE utf8mb4_general_ci,
  `sambutan_teks` text COLLATE utf8mb4_general_ci,
  `dokumentasi_lain` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_sambutan`
--

INSERT INTO `db_sambutan` (`id`, `judul_sambutan`, `slug`, `nama_rw`, `foto_diri`, `sambutan_teks`, `dokumentasi_lain`) VALUES
(1, 'Sambutan', 'sambutan', 2, '210923044055_39afa98ed38199817d2f53bf2b789ea202cbb40d.webp', '<div xss=\"removed\">Assalamu\'alaikum Warahmatullahi Wabarakatuh, </div><div xss=\"removed\"><span xss=removed>Salam Sejahtera untuk Kita Semua, Shalom, Om Swastyastu, Namo Buddhaya, Salam Kebajikan.</span></div><div xss=\"removed\"><br></div><div xss=\"removed\">Puja dan puji syukur senantiasa kita ucapkan kepada Allah Subhanahu wa Ta\'ala, Maha Pemberi segala nikmat dan rahmat-Nya kepada kita semua. Sholawat dan Salam semoga terlimpahkan kepada Nabi Muhammad SAW Beserta keluarganya, para sahabatnya, serta para pengikutnya termasuk kita. Mudah-mudahan kita semua akan mendapatkan syafaatnya di Yaumiljaza nanti. Aamiin ya Rabb. </div><div xss=\"removed\"><br></div><div xss=\"removed\">Kami ucapkan selamat datang di website Rukun Warga (RW) 013 Cipinang Melayu Kec. Makasar Kota Administrasi Jakarta Timur Provinsi DKI Jakarta.</div><div xss=\"removed\"><br></div><div xss=\"removed\">Website ini kami buat sebagai sarana keterbukaan informasi dan layanan kepada seluruh warga RW 013 Cipinang Melayu khususnya dan seluruh pihak yang berkepentingan. Selain memberikan informasi berupa foto dan video setiap kegiatan, kami juga menyampaikan laporan keuangan digital secara berkala melalui website ini dan kemudian akan sempurnakan dengan aplikasi untuk pelayanan warga RW 013.</div><div xss=\"removed\"><br></div><div xss=\"removed\">Tentu kami menyadari masih banyak kekurangan dan kelemahan dalam website ini, sehingga sekiranya terdapat kritik, saran, dan masukan yang berkaitan dengan fungsi website ini agar menjadi lebih baik, Saudara dapat menyampaikannya melalui email yang tertera di website ini.</div><div xss=\"removed\"><br></div><div xss=\"removed\">Ucapan Terima kasih sebesar-besarnya kepada Universitas Nusa Mandiri selaku mitra yang telah memfasilitasi sarana website ini. Semoga dapat selalu bermanfaat dan dimanfaatkan warga untuk kebutuhan Administrasi Berbasi Informasi dan Teknologi (IT). </div><div xss=\"removed\"><br></div><div xss=\"removed\">Demikian kami sampaikan dan akhir kata kami memohon doa dan dukungan dari segenap pihak terutama warga RW 013 agar kami dapat amanah dan istiqomah dalam menjalankan kepengurusan RW 013 masa bakti 2022-2025 sebagai pelayan masyarakat.</div><div xss=\"removed\"><br></div><div xss=\"removed\">Wallohul Muwafiq ila Aqwamith Thariq,</div><div xss=\"removed\">Wassalamu\'alaikum Warahmatullah Wabarakatuh</div>', 'dokumentasi-lain');

-- --------------------------------------------------------

--
-- Table structure for table `filemanager`
--

CREATE TABLE `filemanager` (
  `id` int NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `ket` text,
  `created` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `filemanager`
--

INSERT INTO `filemanager` (`id`, `file_name`, `ket`, `created`, `update`) VALUES
(30, '180423120810_favicon.ico', 'Favicon', '2023-04-18 12:08:10', NULL),
(182, '100623143032_b77815bf98a3916a6af2b246d33d6b4b289a26b9.webp', 'Di upload melalui module File manager', '2023-06-10 14:30:32', NULL),
(183, '100623171351_b77815bf98a3916a6af2b246d33d6b4b289a26b9.webp', 'Di upload melalui module File manager', '2023-06-10 17:13:51', NULL),
(185, '100623204702_856e49142f87106537a59895c7d0bf7c1b2b5861.webp', 'Di upload melalui module Galeri Detail', '2023-06-10 20:47:00', NULL),
(186, '100623210732_856e49142f87106537a59895c7d0bf7c1b2b5861.webp', 'Di upload melalui module Galeri Detail', '2023-06-10 21:07:00', NULL),
(187, '100623210849_856e49142f87106537a59895c7d0bf7c1b2b5861.webp', 'Di upload melalui module Galeri Detail', '2023-06-10 21:08:00', NULL),
(188, '100623210917_851cefed08a76e3f926e1ef25943f7abb2405d8c.webp', 'Di upload melalui module Galeri Detail', '2023-06-10 21:09:00', NULL),
(189, '100623210933_851cefed08a76e3f926e1ef25943f7abb2405d8c.webp', 'Di upload melalui module Galeri Detail', '2023-06-10 21:09:00', NULL),
(190, '100623211035_851cefed08a76e3f926e1ef25943f7abb2405d8c.webp', 'Di upload melalui module Galeri Detail', '2023-06-10 21:10:00', NULL),
(199, '110623103920_3856f1b7955273a4bdfd200e41aaecf6ae264c71.webp', 'Di upload melalui module Konten', '2023-06-11 10:39:00', NULL),
(201, '110623141126_Surat_Pengantar.docx', 'Di upload melalui module Jenis Surat', '2023-06-11 14:11:00', NULL),
(202, '110623141318_a47547ad52066b5344c31e800f8880c172b0c3e1.webp', 'Di upload melalui module Kop Surat', '2023-06-11 14:13:00', NULL),
(203, '110623141353_KTP.pdf', 'Di upload melalui module Dokumen Warga', '2023-06-11 14:13:00', NULL),
(204, '110623141439_KTP.pdf', 'Di upload melalui module Dokumen Warga', '2023-06-11 14:14:00', NULL),
(205, '110623141512_86955323db24ecbdac8ed2fa2279c9fd20a68c27.webp', 'Di upload melalui module Dokumen Warga', '2023-06-11 14:15:00', NULL),
(209, '120923124939_5389519d7b319f83c9d057c3680ddb559c2a097d.webp', 'Di upload melalui module Foto Dokumen', '2023-09-12 12:49:00', NULL),
(213, '130923105635_a0acf7316a00cd2b1a696a07c319472db96d585c.webp', 'Di upload melalui module Foto Dokumen', '2023-09-13 10:56:00', NULL),
(215, '150923121342_c6da2b929169c09c66aac085cc6d1470cc5d4f79.webp', 'Di upload melalui module Konten', '2023-09-15 12:13:00', NULL),
(222, '170923032828_8b6d30a85e0389fdff90552a47a568640d66f50b.webp', 'Di upload melalui module Galeri Detail', '2023-09-17 03:28:00', NULL),
(240, '200923155433_panflet_bank_sam.png', 'Di upload melalui module Konten (text-editor)', '2023-09-20 15:54:00', NULL),
(247, '210923011715_Kegiatan_Poslan.png', 'Di upload melalui module Konten (text-editor)', '2023-09-21 01:17:00', NULL),
(248, '210923011725_Kegiatan_Poslan.png', 'Di upload melalui module Konten (text-editor)', '2023-09-21 01:17:00', NULL),
(249, '210923012045_IMG_20230226_WA0.png', 'Di upload melalui module Konten (text-editor)', '2023-09-21 01:20:00', NULL),
(250, '210923012057_097b898ed5db81a50dc5627a4dd7450bf4f2b61c.webp', 'Di upload melalui module Konten', '2023-09-21 01:20:00', NULL),
(253, '210923014730_482f5508208e8ba457c75da8a8a525772e72cdd5.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 01:47:00', NULL),
(254, '210923014754_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 01:47:00', NULL),
(255, '210923014816_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 01:48:00', NULL),
(256, '210923014839_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 01:48:00', NULL),
(257, '210923014908_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 01:49:00', NULL),
(259, '210923014953_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 01:49:00', NULL),
(261, '210923015442_e7fec49193fcd19248204dbcee61117d281bd760.webp', 'Di upload melalui module Galeri', '2023-09-21 01:54:00', NULL),
(262, '210923015537_3135c5c7784a661164762186ec7b7a74295c0181.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 01:55:00', NULL),
(263, '210923015652_413db65eee9adb129fe0bdd4ddb22fb5d65577a2.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 01:56:00', NULL),
(264, '210923015811_c4665aa2f57f5561cca24bcdfadeb711ba8fa557.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 01:58:00', NULL),
(265, '210923020150_e0257eb59d70df61aa78522cf421ce72e5776f05.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 02:01:00', NULL),
(266, '210923020725_770a6a0a668fed4a67a1f307cb90d1a7c34e7a18.webp', 'Di upload melalui module Galeri', '2023-09-21 02:07:00', NULL),
(267, '210923021656_770a6a0a668fed4a67a1f307cb90d1a7c34e7a18.webp', 'Di upload melalui module Galeri Detail', '2023-09-21 02:16:00', NULL),
(268, '210923022001_770a6a0a668fed4a67a1f307cb90d1a7c34e7a18.webp', 'Di upload melalui module Galeri', '2023-09-21 02:20:00', NULL),
(269, '210923023753_IMG_20230105_160.png', 'Di upload melalui module Konten (text-editor)', '2023-09-21 02:37:00', NULL),
(270, '210923023813_IMG_20230111_101.png', 'Di upload melalui module Konten (text-editor)', '2023-09-21 02:38:00', NULL),
(271, '210923023845_IMG_20230128_071.png', 'Di upload melalui module Konten (text-editor)', '2023-09-21 02:38:00', NULL),
(272, '210923023851_e6eca798a803cd08fcf0741b138078f97466fb1d.webp', 'Di upload melalui module Konten', '2023-09-21 02:38:00', NULL),
(274, '210923024718_264776ee74f6296d953bef292f90d6e4abcfb6f7.webp', 'Di upload melalui module Konten', '2023-09-21 02:47:00', NULL),
(275, '210923025206_264776ee74f6296d953bef292f90d6e4abcfb6f7.webp', 'Di upload melalui module Konten', '2023-09-21 02:52:00', NULL),
(276, '210923033955_b2effc384bbdffb0850e09092fb8a311c6edefe0.webp', 'Di upload melalui module Pengaturan', '2023-09-21 03:39:00', NULL),
(277, '210923044055_39afa98ed38199817d2f53bf2b789ea202cbb40d.webp', 'Di upload melalui module Sambutan', '2023-09-21 04:40:00', NULL),
(278, '210923215617_2da67febbaa2e9104af75d31999f8e9837d37125.webp', 'Di upload melalui module Slider', '2023-09-21 21:56:00', NULL),
(279, '220923053140_4e4547e85479d74d66ddf48481bfbf1aa75d67dc.webp', 'Di upload melalui module Slider', '2023-09-22 05:31:00', NULL),
(280, '220923053619_c94cdc33d52a745ec75840eca25ff1b03fce90df.webp', 'Di upload melalui module Slider', '2023-09-22 05:36:00', NULL),
(281, '220923054309_6f41d1ea38db664e0f1a0a4d32e067d3e9ad978b.webp', 'Di upload melalui module Slider', '2023-09-22 05:43:00', NULL),
(282, '220923054445_2ed5e6d32d47797d521315b8bcfa143d458db1e8.webp', 'Di upload melalui module Slider', '2023-09-22 05:44:00', NULL),
(283, '220923054811_ce0293e12f1477326121726bd71424ddb9ca52d2.webp', 'Di upload melalui module Slider', '2023-09-22 05:48:00', NULL),
(284, '220923054945_9089bd2d8b613795c154f97bc3fee2e1d790d07f.webp', 'Di upload melalui module Slider', '2023-09-22 05:49:00', NULL),
(285, '220923055019_e8e0739317b67bf0a9034ec299584646254811e8.webp', 'Di upload melalui module Slider', '2023-09-22 05:50:00', NULL),
(286, '220923055510_d19b0fa692dadd1e3d8bf1e1f3245be3e119b7c4.webp', 'Di upload melalui module Pengaturan', '2023-09-22 05:55:00', NULL),
(287, '171223002359_cd38ef12be3eb190809a6c60ea8ceaa0371e5e2f.webp', 'Di upload melalui module Dokumen Warga', '2023-12-17 00:23:00', NULL),
(288, '171223002430_817248fb77fb5c2cef3f2c732ad257cb1fb9c5e4.webp', 'Di upload melalui module Dokumen Warga', '2023-12-17 00:24:00', NULL),
(289, '171223002452_c12aea658925f3a91d4261e93f1d19764925b307.webp', 'Di upload melalui module Dokumen Warga', '2023-12-17 00:24:00', NULL),
(290, '171223003535_147f102c97c54c5ebdda4a99cd91fcb13ed5d7b8.webp', 'Di upload melalui module Kop Surat', '2023-12-17 00:35:00', NULL),
(291, '171223093639_bukti_Modul_1922.pdf', 'Di upload melalui module Dokumen Warga', '2023-12-17 09:36:00', NULL),
(292, '171223093706_bukti_Modul_1922.pdf', 'Di upload melalui module Dokumen Warga', '2023-12-17 09:37:00', NULL),
(293, '171223094032_bukti_Modul_1922.pdf', 'Di upload melalui module Dokumen Warga', '2023-12-17 09:40:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fotofoto`
--

CREATE TABLE `fotofoto` (
  `id` int NOT NULL,
  `judul_foto` text COLLATE utf8mb4_general_ci,
  `lokasi_foto` text COLLATE utf8mb4_general_ci,
  `link_berkas` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_halaman` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fotofoto`
--

INSERT INTO `fotofoto` (`id`, `judul_foto`, `lokasi_foto`, `link_berkas`, `id_halaman`) VALUES
(1, 'Peta Wilayah', '120923124939_5389519d7b319f83c9d057c3680ddb559c2a097d.webp', '', 1),
(2, 'Struktur Organisasi', '130923105635_a0acf7316a00cd2b1a696a07c319472db96d585c.webp', 'https://drive.google.com/file/d/1zc7_wrk_PYlrSDOFHwfz5PX0K0BcEqJU/view?usp=sharing', 4);

-- --------------------------------------------------------

--
-- Table structure for table `halaman`
--

CREATE TABLE `halaman` (
  `id` int NOT NULL,
  `nama_halaman` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `halaman`
--

INSERT INTO `halaman` (`id`, `nama_halaman`) VALUES
(1, 'profil'),
(2, 'visi-misi'),
(3, 'proker'),
(4, 'struktur-organisasi'),
(5, 'profil-dewan-penasehat'),
(6, 'profil-pengurus-rw'),
(7, 'profil-pengurus-rt'),
(8, 'profil-karang-taruna'),
(9, 'profil-security'),
(10, 'galeri'),
(14, 'petadaerah');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_konten`
--

CREATE TABLE `kategori_konten` (
  `id` int NOT NULL,
  `nama_kategori` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_konten`
--

INSERT INTO `kategori_konten` (`id`, `nama_kategori`) VALUES
(1, 'Artikel'),
(2, 'Kegiatan'),
(3, 'Pengumuman');

-- --------------------------------------------------------

--
-- Table structure for table `kelamin`
--

CREATE TABLE `kelamin` (
  `id` int NOT NULL,
  `nama` varchar(9) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelamin`
--

INSERT INTO `kelamin` (`id`, `nama`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `id` int NOT NULL,
  `judul` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug` text COLLATE utf8mb4_general_ci,
  `kata_kunci` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `konten` longtext COLLATE utf8mb4_general_ci,
  `id_kategori` int DEFAULT NULL,
  `cover` text COLLATE utf8mb4_general_ci NOT NULL,
  `status_konten` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`id`, `judul`, `slug`, `kata_kunci`, `konten`, `id_kategori`, `cover`, `status_konten`, `tanggal_dibuat`) VALUES
(1, 'Pentingnya Administrasi dalam Kehidupan Warga', 'pentingnya-administrasi-dalam-kehidupan-warga', 'Administrasi, RW, RT', '<p style=\"text-align: justify; \">Pentingnya Administrasi dalam Kehidupan Warga</p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">Dalam setiap masyarakat, baik yang kecil maupun besar, administrasi memainkan peran penting dalam menjaga ketertiban, efisiensi, dan transparansi. Administrasi memastikan bahwa kegiatan sehari-hari berjalan dengan lancar dan menyediakan kerangka kerja yang diperlukan untuk pengambilan keputusan yang baik. Bagi setiap warga, memiliki administrasi yang baik adalah kunci untuk mencapai kemajuan dan meningkatkan kualitas hidup. Artikel ini akan menjelaskan mengapa administrasi penting dalam kehidupan warga.</p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">1. Menjaga Ketertiban dan Kepatuhan</p><p style=\"text-align: justify; \">Administrasi membantu menjaga ketertiban dalam masyarakat. Melalui pembuatan peraturan dan prosedur yang jelas, administrasi membantu mencegah kekacauan dan mempromosikan disiplin. Misalnya, administrasi dapat melibatkan pengaturan jadwal pengumpulan sampah, pembuatan peraturan lalu lintas, atau aturan-aturan lainnya yang membantu menjaga keamanan dan kenyamanan warga. Dengan adanya administrasi yang baik, warga diingatkan untuk mematuhi aturan tersebut, menciptakan lingkungan yang lebih harmonis.</p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">2. Meningkatkan Efisiensi dan Produktivitas</p><p style=\"text-align: justify; \">Administrasi yang efektif membantu meningkatkan efisiensi dan produktivitas dalam kehidupan sehari-hari. Ketika proses administrasi seperti pengumpulan data, pengelolaan inventaris, atau pembayaran tagihan dilakukan dengan baik, waktu dan sumber daya dapat digunakan secara optimal. Hal ini memungkinkan masyarakat untuk fokus pada kegiatan yang lebih penting, seperti bekerja, belajar, atau berkontribusi pada komunitas. Dengan administrasi yang efisien, warga dapat mencapai hasil yang lebih baik dalam waktu yang lebih singkat.</p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">3. Memfasilitasi Pembangunan dan Pelayanan Publik</p><p style=\"text-align: justify; \">Administrasi yang kuat merupakan landasan penting untuk pembangunan dan pelayanan publik yang baik. Dengan administrasi yang baik, pemerintah dapat mengumpulkan data yang diperlukan untuk merencanakan dan mengimplementasikan program-program publik yang bermanfaat bagi warga. Misalnya, administrasi yang efisien dapat memungkinkan identifikasi kebutuhan infrastruktur yang perlu ditingkatkan, pengelolaan layanan kesehatan yang efektif, atau penyediaan fasilitas pendidikan yang memadai. Administrasi juga membantu meningkatkan transparansi dalam pengelolaan anggaran publik dan meningkatkan akuntabilitas dalam penggunaan dana publik.</p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">4. Meningkatkan Partisipasi Warga</p><p style=\"text-align: justify; \">Administrasi yang baik mendorong partisipasi warga dalam pengambilan keputusan yang berkaitan dengan masyarakat. Melalui pengelolaan informasi yang transparan dan akses yang mudah, warga dapat terlibat dalam perencanaan, pelaksanaan, dan evaluasi program-program publik. Dengan demikian, administrasi yang baik membantu memperkuat ikatan antara pemerintah dan masyarakat, sehingga menciptakan kesempatan untuk mewujudkan aspirasi dan<span style=\"font-size: 0.875rem; font-weight: initial;\">&nbsp;kebutuhan warga.</span></p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">5. Mendorong Pertumbuhan Ekonomi</p><p style=\"text-align: justify; \">Administrasi yang efisien dan transparan juga mendukung pertumbuhan ekonomi. Melalui administrasi yang baik, warga dapat dengan mudah mengakses izin, perijinan, dan layanan lainnya yang diperlukan untuk memulai atau mengembangkan bisnis. Administrasi yang efektif juga membantu dalam pengelolaan keuangan pribadi, termasuk pembayaran pajak dan keuangan lainnya. Dengan adanya administrasi yang solid, lingkungan bisnis menjadi lebih kondusif, meningkatkan kesempatan kerja, investasi, dan kemakmuran warga.</p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">Dalam kesimpulannya, administrasi yang baik memainkan peran penting dalam kehidupan warga. Dari menjaga ketertiban dan kepatuhan, meningkatkan efisiensi dan produktivitas, memfasilitasi pembangunan dan pelayanan publik, mendorong partisipasi warga, hingga mendorong pertumbuhan ekonomi, administrasi adalah pondasi penting untuk kemajuan dan kesejahteraan masyarakat. Dengan memahami pentingnya administrasi, setiap warga dapat berperan aktif dalam mendukung sistem administrasi yang baik dalam lingkungan mereka, sehingga menciptakan masyarakat yang lebih baik dan berkelanjutan.</p>', 1, '110623103920_3856f1b7955273a4bdfd200e41aaecf6ae264c71.webp', '1', '2023-09-12'),
(2, 'Pengabdian Masyarakat antara RW013 Cipinang Melayu dan Kampus Universitas Nusa Mandiri', 'pengabdian-masyarakat-antara-rw013-cipinang-melayu-dan-kampus-universitas-nusa-mandiri', 'PM, UNM, RW013', '<p><b>Pengumuman: Pengabdian Masyarakat antara RW013 Cipinang Melayu dan Kampus Universitas Nusa Mandiri Jatiwaringin</b></p><p><br></p><p>Dalam rangka memperkuat sinergi antara masyarakat dan institusi pendidikan, kami dengan bangga mengumumkan adanya program pengabdian masyarakat antara RW13 Cipinang Melayu dan Kampus Universitas Nusa Mandiri Jatiwaringin. Program ini bertujuan untuk saling mendukung dan meningkatkan kualitas hidup serta pembangunan di lingkungan sekitar.</p><p><br></p><p>Kerjasama ini akan melibatkan para mahasiswa dan tenaga pengajar dari Universitas Nusa Mandiri yang akan berkontribusi dalam berbagai kegiatan pengabdian masyarakat di RW13 Cipinang Melayu. Kami berkomitmen untuk bekerja sama dalam membangun komunitas yang lebih baik, dengan melibatkan warga RW13 sebagai mitra utama dalam setiap kegiatan yang akan dilakukan.</p><p><br></p><p>Adapun tujuan dari program pengabdian masyarakat ini antara lain:</p><p><br></p><p>1. Meningkatkan kualitas pendidikan dan pengetahuan masyarakat sekitar melalui kegiatan pelatihan, workshop, dan seminar.</p><p><br></p><p>2. Memperkuat kesadaran akan pentingnya lingkungan yang bersih dan sehat melalui program kebersihan dan pengelolaan sampah.</p><p><br></p><p>3. Mendorong kewirausahaan dan pengembangan ekonomi masyarakat melalui pelatihan keterampilan dan pendampingan usaha mikro.</p><p><br></p><p>4. Memberikan bantuan dan dukungan dalam hal kesehatan masyarakat, seperti penyuluhan kesehatan, pemeriksaan kesehatan gratis, dan kampanye kesehatan.</p><p><br></p><p>Kami mengundang semua warga RW13 Cipinang Melayu untuk ikut berpartisipasi dalam program pengabdian masyarakat ini. Dukungan dan partisipasi aktif dari seluruh warga sangat berarti untuk keberhasilan program ini. Bersama-sama, kita dapat menciptakan perubahan positif dan memberikan dampak yang nyata bagi lingkungan sekitar kita.</p><p><br></p><p>Informasi lebih lanjut tentang jadwal dan kegiatan program pengabdian masyarakat ini akan segera diumumkan. Kami harap, kerjasama ini dapat menjadi langkah awal dalam membangun hubungan yang kuat dan berkelanjutan antara masyarakat RW13 Cipinang Melayu dan Universitas Nusa Mandiri.</p><p><br></p><p>Mari bergandengan tangan dan berkontribusi dalam membangun lingkungan yang lebih baik untuk kita semua. Terima kasih atas perhatian dan partisipasi aktif Anda.</p>', 1, '150923121342_c6da2b929169c09c66aac085cc6d1470cc5d4f79.webp', '1', '2023-09-15'),
(3, 'BANK SAMPAH GERBANG DARLING 013', 'bank-sampah-gerbang-darling-013', 'Jadwal Penimbangan Sampah Kering Warga', '<p class=\"MsoNormal\"><span style=\"font-size: 10.5pt; line-height: 107%; font-family: &quot;Segoe UI&quot;, sans-serif; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><br><b><i>Ayo Warga Semangat Mengubah\r\nSAMPAH jadi BERKAH</i></b>.</span><span style=\"font-size: 10.5pt; line-height: 107%; font-family: &quot;Segoe UI&quot;, sans-serif;\"><br>\r\n<i><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Satu sampah yang kau buang sembarangan, akan\r\nmenimbulkan seribu satu macam bencana.</span><br>\r\n<span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Satu sampah yang kau buang ke tempatnya, akan\r\nmenyelamatkan seluruh alam semesta.</span><br>\r\n</i><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><i>Semangat terus para warga menjadi pejuang\r\nlingkungan. <br>\r\nMari kita tularkan hal baik, agar hidup kita semakin berkah dan penuh manfaat.</i><o:p></o:p></span></span></p><p>\r\n\r\n</p><p class=\"MsoNormal\"><span style=\"font-size: 10.5pt; line-height: 107%; font-family: &quot;Segoe UI&quot;, sans-serif; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><b>MARI DATANG DAN BAWA SAMPAH\r\nPILAHAN WARGA<br>\r\nKE BANK SAMPAH GERBANG DARLING RW 013.<br>\r\nPADA AGENDA YANG TELAH TERJADWALKAN.<br></b>\r\n<br><b>\r\nPelayanan Penjemputan Sampah Pilahan oleh Petugas, <br>\r\nSilahkan Hubungin PIC yang tersedia untuk koordinasi titik rutenya.</b></span><o:p></o:p></p>', 3, '210923024718_264776ee74f6296d953bef292f90d6e4abcfb6f7.webp', '1', '2023-09-21'),
(4, 'POSBINDU RW 013 BERSAMA RS HARUM', 'posbindu-rw-013-bersama-rs-harum', 'Posbindu, Poslan, RW013, RSHarum', '<p><span style=\"color: rgb(137, 137, 137); font-family: Arial; font-size: 13px;\">Kegiatan Posbindu di RW 013 Cipinang Melayu.</span><br style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 13px; line-height: 20px; font-family: Arial; color: rgb(137, 137, 137);\"><span style=\"color: rgb(137, 137, 137); font-family: Arial; font-size: 13px;\">Pos Binaan Terpadu (POSBINDU) adalah kegiatan monitoring dan deteksi dini faktor resiko penyakit tidak menular terintegrasi serta gangguan akibat kecelakaan dan tindakan kekerasan dalam rumah tangga yang dikelola oleh masyarakat melalui pembinaan terpadu.<br></span><a href=\"https://harumsismamedika.com/kegiatan-posbindu-di-rw-013-cipinang-melayu/\" target=\"_blank\">https://harumsismamedika.com/kegiatan-posbindu-di-rw-013-c</a><a href=\"https://harumsismamedika.com/kegiatan-posbindu-di-rw-013-cipinang-melayu/\" target=\"_blank\">ipinang-melayu/</a></p><p><br><img src=\"https://www.rw013cipmel.com/_temp/uploads/img/210923011715_Kegiatan_Poslan.png\" style=\"width: 600px;\"><img src=\"https://www.rw013cipmel.com/_temp/uploads/img/210923011725_Kegiatan_Poslan.png\" style=\"width: 600px;\"><img src=\"https://www.rw013cipmel.com/_temp/uploads/img/210923012045_IMG_20230226_WA0.png\" style=\"width: 800px;\"><br></p>', 1, '210923012057_097b898ed5db81a50dc5627a4dd7450bf4f2b61c.webp', '1', '2023-09-21'),
(5, 'Urban Farming Gerbang Darling RW 13 Kelurahan Cipinang Melayu', 'urban-farming-gerbang-darling-rw-13-kelurahan-cipinang-melayu', 'beritajakarta, Gerbangdarling, RW013', '<div class=\"content\" style=\"box-sizing: inherit; margin: 10px; padding: 10px; color: rgba(0, 0, 0, 0.87); font-family: Poppins, sans-serif; font-size: 15px;\"><p style=\"box-sizing: inherit; font-size: 16px;\">Petugas PPSU Kelurahan Cipinang Melayu memanfaatkan lahan kosong di kolong Tol Becakayu menjadi area pertanian perkotaan (urban farming), . Kegiatan cocok tanam ini merupakan program dari kelurahan setempat agar lahan tersebut tidak dijadikan tempat pembuangan sampah (TPS) liar. Beragam jenis sayuran mulai dari cabai, bayam, kembang kol, sawi hingga selada dapat dijumpai di kawasan RW 13 Kelurahan Cipinang Melayu ini. Mereka adalah Aang dan Hasanudin, yang tiap harinya melakukan perawatan sayuran di sela-sela pekerjaannya sebagai anggota PPSU. Hasil panen sayuran nantinya akan dibagikan ke sejumlah anggota PPSU dan warga sekitar secara gratis. (Foto: Mochamad Tresna Suheryanto/beritajakarta.id)</p></div><div class=\"row\" style=\"box-sizing: inherit; margin-left: auto; margin-right: auto; margin-bottom: 20px; color: rgba(0, 0, 0, 0.87); font-family: Poppins, sans-serif; font-size: 15px;\"><div class=\"col s12\" style=\"float: left; padding: 0px 0.75rem; min-height: 1px; width: 1263.33px; margin-left: auto; left: auto; right: auto;\"><div class=\"card\" style=\"box-sizing: inherit; box-shadow: rgba(0, 0, 0, 0.14) 0px 2px 2px 0px, rgba(0, 0, 0, 0.12) 0px 3px 1px -2px, rgba(0, 0, 0, 0.2) 0px 1px 5px 0px; margin: 0.5rem 0px 1rem; transition: box-shadow 0.25s ease 0s, -webkit-box-shadow 0.25s ease 0s; border-radius: 2px;\"><div class=\"card-image\" style=\"box-sizing: inherit; position: relative;\"></div></div></div></div><p><a href=\"https://m.beritajakarta.id/potret/album/9169/urban-farming-rw-13-kelurahan-cipinang-melayu\" target=\"_blank\">https://m.beritajakarta.id/potret/album/9169/urban-farming-rw-13-kelurahan-cipinang-melayu</a><a href=\"https://m.beritajakarta.id/potret/album/9169/urban-farming-rw-13-kelurahan-cipinang-melayu\" target=\"_blank\"></a></p><p><img src=\"https://rw013cipmel.com/_temp/uploads/img/210923023753_IMG_20230105_160.png\" style=\"width: 50%;\"><img src=\"https://rw013cipmel.com/_temp/uploads/img/210923023813_IMG_20230111_101.png\" style=\"width: 50%;\"><img src=\"https://rw013cipmel.com/_temp/uploads/img/210923023845_IMG_20230128_071.png\" style=\"width: 50%;\"><br><br></p>', 1, '210923023851_e6eca798a803cd08fcf0741b138078f97466fb1d.webp', '1', '2023-09-21'),
(6, 'PELATIHAN UMKM', 'pelatihan-umkm', 'UMKM, RW013, PKK013, JAKPRENEUR', '<p class=\"MsoNormal\" style=\"margin-bottom:.25in;line-height:normal\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n&quot;Times New Roman&quot;\">Pelatihan digital marketing adalah program pembelajaran yang\r\nbertujuan untuk membekali peserta dengan pengetahuan dan keterampilan dalam\r\nbidang pemasaran digital. Pelatihan ini biasanya mencakup berbagai materi,\r\nseperti:<o:p></o:p></span></p><ul type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l1 level1 lfo1;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Pemasaran digital dasar, yang meliputi pengertian\r\n     pemasaran digital, sejarah pemasaran digital, dan elemen-elemen pemasaran\r\n     digital.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l1 level1 lfo1;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Strategi pemasaran digital, yang meliputi cara menyusun\r\n     strategi pemasaran digital yang efektif.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l1 level1 lfo1;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Pemasaran konten, yang meliputi cara membuat dan\r\n     mendistribusikan konten yang menarik dan bermanfaat bagi target pasar.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l1 level1 lfo1;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Pemasaran media sosial, yang meliputi cara menggunakan\r\n     media sosial untuk mempromosikan produk atau jasa.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l1 level1 lfo1;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Pemasaran mesin pencari, yang meliputi cara\r\n     meningkatkan visibilitas website di mesin pencari.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l1 level1 lfo1;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Pemasaran email, yang meliputi cara menggunakan email\r\n     untuk membangun hubungan dengan pelanggan.<o:p></o:p></span></li>\r\n</ul><p class=\"MsoNormal\" style=\"margin-top:.25in;margin-right:0in;margin-bottom:.25in;\r\nmargin-left:0in;line-height:normal\"><span style=\"font-size:12.0pt;font-family:\r\n&quot;Arial&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;\">Pelatihan digital\r\nmarketing dapat diikuti oleh berbagai kalangan, mulai dari pemula hingga\r\nprofesional. Bagi pemula, pelatihan ini dapat menjadi sarana untuk mempelajari\r\ndasar-dasar pemasaran digital. Bagi profesional, pelatihan ini dapat menjadi\r\nsarana untuk meningkatkan keterampilan dan pengetahuan dalam bidang pemasaran\r\ndigital.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-top:.25in;margin-right:0in;margin-bottom:.25in;\r\nmargin-left:0in;line-height:normal\"><span style=\"font-size:12.0pt;font-family:\r\n&quot;Arial&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;\">Berikut adalah\r\nbeberapa manfaat mengikuti pelatihan digital marketing:<o:p></o:p></span></p><ul type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l2 level1 lfo2;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Meningkatkan pengetahuan dan keterampilan dalam bidang\r\n     pemasaran digital<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l2 level1 lfo2;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Mendapat informasi terbaru tentang perkembangan\r\n     pemasaran digital<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l2 level1 lfo2;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Memperluas jaringan dengan praktisi pemasaran digital<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l2 level1 lfo2;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Meningkatkan peluang kerja atau promosi<o:p></o:p></span></li>\r\n</ul><p class=\"MsoNormal\" style=\"margin-top:.25in;margin-right:0in;margin-bottom:.25in;\r\nmargin-left:0in;line-height:normal\"><span style=\"font-size:12.0pt;font-family:\r\n&quot;Arial&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;\">Ada berbagai\r\njenis pelatihan digital marketing yang tersedia, mulai dari pelatihan online\r\nhingga pelatihan offline. Pelatihan online biasanya lebih terjangkau dan\r\nfleksibel, sedangkan pelatihan offline biasanya lebih interaktif dan memberikan\r\nkesempatan untuk praktik langsung.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-top:.25in;margin-right:0in;margin-bottom:.25in;\r\nmargin-left:0in;line-height:normal\"><span style=\"font-size:12.0pt;font-family:\r\n&quot;Arial&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;\">Berikut adalah\r\nbeberapa tips memilih pelatihan digital marketing:<o:p></o:p></span></p><ul type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l0 level1 lfo3;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Pastikan pelatihan tersebut memberikan materi yang\r\n     sesuai dengan kebutuhan Anda<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l0 level1 lfo3;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Cari tahu reputasi penyelenggara pelatihan<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l0 level1 lfo3;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Baca ulasan dari peserta pelatihan sebelumnya<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:7.5pt;\r\n     line-height:normal;mso-list:l0 level1 lfo3;tab-stops:list .5in\"><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;mso-fareast-font-family:\r\n     &quot;Times New Roman&quot;\">Bandingkan biaya pelatihan dari berbagai penyelenggara<o:p></o:p></span></li>\r\n</ul><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<span style=\"font-size:12.0pt;line-height:107%;font-family:&quot;Arial&quot;,sans-serif;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">Pelatihan digital marketing merupakan investasi\r\nyang berharga untuk mengembangkan karier di bidang pemasaran digital. Dengan\r\nmengikuti pelatihan ini, Anda dapat meningkatkan pengetahuan dan keterampilan\r\nAnda, sehingga dapat lebih efektif dalam mempromosikan produk atau jasa Anda.</span><br></p>', 3, '210923025206_264776ee74f6296d953bef292f90d6e4abcfb6f7.webp', '1', '2023-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `link_youtube`
--

CREATE TABLE `link_youtube` (
  `id` int NOT NULL,
  `nama_berkas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lokasi_berkas` text COLLATE utf8mb4_general_ci,
  `id_stts` int NOT NULL,
  `tanggal_dibuat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `link_youtube`
--

INSERT INTO `link_youtube` (`id`, `nama_berkas`, `lokasi_berkas`, `id_stts`, `tanggal_dibuat`) VALUES
(1, 'Welcome to RW013 Cipinang Melayu', 'https://youtu.be/GkSqwr96GjU?si=Wydno5N_TB9OxWq7', 1, '2023-09-19'),
(2, 'Panen Sayuran', 'https://youtu.be/xjqlBU1F4w8?si=zC36EgsasbebrLVz', 1, '2023-09-15'),
(3, 'PANEN DI URBAN FARMING GERBANG DARLING RW 013 (IND', 'https://www.youtube.com/watch?v=jBf-Vbolab4', 1, '2024-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE `main_menu` (
  `id_menu` int NOT NULL,
  `is_parent` int DEFAULT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `type` enum('controller','url') DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT NULL,
  `sort` int DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`id_menu`, `is_parent`, `menu`, `slug`, `type`, `controller`, `target`, `icon`, `is_active`, `sort`, `created`, `modified`) VALUES
(3, 7, 'management menu', 'management-menu', 'controller', 'main_menu', '', '', '1', 8, '2020-02-15 06:48:31', '2020-11-02 13:33:26'),
(7, 0, 'configuration', 'configuration', 'controller', '', '', 'fa fa-cogs', '1', 6, '2020-02-26 06:42:29', '2020-11-23 05:20:01'),
(34, 61, 'settings', 'settings', 'controller', 'setting', '', '', '1', 36, '2020-10-19 00:25:57', '2020-11-23 05:20:11'),
(36, 0, 'dashboard', 'dashboard', 'controller', 'dashboard', '', 'mdi mdi-laptop', '1', 1, '2020-10-27 08:18:55', '2020-11-09 23:07:13'),
(37, 0, 'auth', 'auth', NULL, '', NULL, 'mdi mdi-account-settings-variant', '1', 2, '2020-10-27 08:45:17', NULL),
(38, 37, 'user', 'user', 'controller', 'user', NULL, 'mdi mdi-account-star', '1', 3, '2020-10-27 08:46:10', '2020-10-27 09:38:05'),
(39, 37, 'groups', 'groups', 'controller', 'group', NULL, '', '1', 4, '2020-10-27 08:48:28', '2020-10-27 20:24:12'),
(40, 37, 'permission', 'permission', 'controller', 'permission', NULL, '', '1', 5, '2020-10-27 08:49:49', '2020-10-29 22:47:10'),
(48, 7, 'm-crud generator', 'm-crud-generator', 'controller', 'm_crud_generator', '', 'mdi mdi-xml', '1', 7, '2020-11-01 12:23:11', '2020-11-22 00:06:35'),
(54, 61, 'file manager', 'file-manager', 'controller', 'filemanager', '', 'mdi mdi-folder-multiple-image', '1', 38, '2020-11-08 00:44:38', NULL),
(55, 70, 'artikel', 'artikel', 'controller', 'konten', '', 'fa fa-bandcamp', '1', 30, '2023-04-11 18:56:31', '2023-04-11 21:23:51'),
(56, 70, 'kategori konten', 'kategori-konten', 'controller', 'kategori_konten', '', 'mdi mdi-stackexchange', '1', 29, '2023-04-11 21:28:03', NULL),
(57, 0, 'aspirasi', 'aspirasi', 'controller', 'aspirasi', '', 'mdi mdi-comment-text-outline', '1', 27, '2023-04-11 23:34:37', NULL),
(58, 7, 'status', 'status', 'controller', 'stts', '', 'fa fa-handshake-o', '1', 9, '2023-04-11 23:51:47', NULL),
(59, 70, 'link youtube', 'link-youtube', 'controller', 'link_youtube', '', 'mdi mdi-video', '1', 32, '2023-04-13 10:15:07', '2023-04-13 10:31:40'),
(61, 0, 'pengaturan', 'pengaturan', 'controller', '', '', 'mdi mdi-settings-box', '1', 33, '2023-04-13 10:47:12', NULL),
(62, 61, 'slider', 'slider', 'controller', 'slider', '', 'mdi mdi-file-image', '1', 34, '2023-04-13 14:42:11', '2023-04-14 14:47:49'),
(63, 61, 'setting extra', 'setting-extra', 'controller', 'pengaturan', '', '', '1', 37, '2023-04-13 15:44:45', NULL),
(64, 7, 'halaman', 'halaman', 'controller', 'halaman', '', 'mdi mdi-apple-keyboard-command', '1', 10, '2023-04-16 14:23:38', NULL),
(65, 61, 'foto dokumen', 'foto-dokumen', 'controller', 'fotofoto', '', 'mdi mdi-file-document', '1', 35, '2023-04-16 14:37:59', NULL),
(67, 0, 'menu tambahan', 'menu-tambahan', 'controller', '', '', 'mdi mdi-arrange-send-backward', '1', 24, '2023-04-17 10:30:38', '2023-04-17 10:32:23'),
(68, 67, 'daftar', 'daftar', 'controller', 'menu_halaman', '', '', '1', 25, '2023-04-17 10:31:17', NULL),
(69, 67, 'menu ekstra', 'menu-ekstra', 'controller', 'menu_frontend', '', '', '1', 26, '2023-04-17 10:32:50', NULL),
(70, 0, 'konten', 'konten', 'controller', '', '', 'mdi mdi-file-document-box', '1', 28, '2023-04-17 15:26:57', NULL),
(71, 0, 'manajemen warga', 'manajemen-warga', 'controller', '#', '', 'fa fa-address-book', '1', 11, '2023-05-04 08:13:08', '2023-05-04 08:21:32'),
(72, 71, 'status warga', 'status-warga', 'controller', 'status_warga', '', '', '1', 13, '2023-05-04 08:14:53', NULL),
(73, 71, 'agama', 'agama', 'controller', 'agama', '', '', '1', 14, '2023-05-04 08:15:37', NULL),
(74, 71, 'jenis kelamin', 'jenis-kelamin', 'controller', 'kelamin', '', '', '1', 15, '2023-05-04 08:16:05', NULL),
(75, 71, 'pendidikan terakhir', 'pendidikan-terakhir', 'controller', 'pendidikan_terakhir', '', '', '1', 16, '2023-05-04 08:16:30', NULL),
(76, 71, 'profesi / pekerjaan', 'profesi-pekerjaan', 'controller', 'profesi', '', '', '1', 17, '2023-05-04 08:18:02', '2023-05-04 08:18:44'),
(77, 71, 'daftar warga', 'daftar-warga', 'controller', 'warga', '', 'fa fa-address-card-o', '1', 12, '2023-05-04 08:19:36', '2023-05-04 08:21:57'),
(79, 0, 'surat-menyurat', 'surat-menyurat', 'controller', '', '', 'fa fa-envelope-open', '1', 18, '2023-05-08 08:19:03', '2023-05-08 08:21:18'),
(80, 79, 'jenis surat', 'jenis-surat', 'controller', 'tb_jenis_surat', '', '', '1', 22, '2023-05-08 08:20:47', NULL),
(81, 79, 'status surat', 'status-surat', 'controller', 'tb_status_surat', '', '', '1', 21, '2023-05-08 08:21:54', NULL),
(83, 0, 'rt', 'rt', 'controller', '', '', 'mdi mdi-account-key', '1', 39, '2023-05-12 07:47:04', NULL),
(84, 83, 'user', 'user', 'controller', 'user', '', '', '1', 42, '2023-05-12 07:47:39', NULL),
(85, 83, 'daftar warga', 'daftar-warga', 'controller', 'warga', '', '', '1', 41, '2023-05-12 07:48:25', NULL),
(86, 79, 'syarat dokumen', 'syarat-dokumen', 'controller', 'warga_syarat_dokumen', '', '', '1', 20, '2023-05-13 17:30:31', NULL),
(87, 79, 'ajuan surat', 'ajuan-surat', 'controller', 'tb_surat', '', '', '1', 19, '2023-05-15 10:04:28', NULL),
(88, 83, 'validasi surat', 'validasi-surat', 'controller', 'tb_surat', '', '', '1', 40, '2023-05-15 11:01:21', NULL),
(89, 0, 'data diri', 'data-diri', 'controller', '', '', 'fa fa-address-card', '1', 43, '2023-05-15 11:07:54', '2023-05-15 11:08:18'),
(90, 89, 'user', 'user', 'controller', 'user', '', '', '1', 44, '2023-05-15 11:09:06', '2023-12-17 00:06:55'),
(91, 89, 'identitas diri', 'identitas-diri', 'controller', 'warga/lihat', '', '', '1', 45, '2023-05-15 11:09:26', '2023-12-17 00:07:20'),
(92, 89, 'dokumen', 'dokumen', 'controller', 'warga_dokumen/lihat/', '', '', '1', 46, '2023-05-15 11:10:01', '2023-12-17 00:23:29'),
(93, 0, 'statistik', 'statistik', 'controller', '', '', 'mdi mdi-chart-histogram', '1', 47, '2023-05-23 17:15:54', NULL),
(94, 93, 'jenis kelamin', 'jenis-kelamin', 'url', 'http://localhost/rw13/laporan/bar/gender', '_blank', '', '1', 48, '2023-05-23 17:17:04', '2023-05-23 17:18:04'),
(95, 79, 'kop surat', 'kop-surat', 'controller', 'tb_kopsurat', '', '', '1', 23, '2023-06-07 14:41:54', NULL),
(96, 70, 'galeri', 'galeri', 'controller', 'tb_galeri', '', '', '1', 31, '2023-06-10 18:00:53', NULL),
(97, 61, 'sambutan', 'sambutan', 'controller', 'sambutan', '', '', '1', 0, '2023-09-18 19:43:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_frontend`
--

CREATE TABLE `menu_frontend` (
  `id` int NOT NULL,
  `nama_menu` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tautan_menu` text COLLATE utf8mb4_general_ci,
  `id_halaman` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_halaman`
--

CREATE TABLE `menu_halaman` (
  `id` int NOT NULL,
  `nama_halaman` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tautan_menu` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `modules_crud_generator`
--

CREATE TABLE `modules_crud_generator` (
  `id` int NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `modules_crud_generator`
--

INSERT INTO `modules_crud_generator` (`id`, `module`, `module_name`, `table`, `created_at`) VALUES
(2, 'Kategori_konten', 'Kategori Konten', 'kategori_konten', '2023-04-11 21:22:00'),
(6, 'Konten', 'Konten', 'konten', '2023-04-11 22:24:00'),
(9, 'Stts', 'Stts', 'stts', '2023-04-11 23:50:00'),
(16, 'Link_youtube', 'Link Youtube', 'link_youtube', '2023-04-13 10:41:00'),
(25, 'Slider', 'Slider', 'slider', '2023-04-14 14:47:00'),
(29, 'Aspirasi', 'Aspirasi', 'aspirasi', '2023-04-15 20:49:00'),
(30, 'Halaman', 'Halaman', 'halaman', '2023-04-16 14:22:00'),
(33, 'Fotofoto', 'Foto Dokumen', 'fotofoto', '2023-04-16 16:17:00'),
(39, 'Menu_frontend', 'Menu Halaman Depan', 'menu_frontend', '2023-04-17 10:29:00'),
(41, 'Menu_halaman', 'Menu Halaman Depan', 'menu_halaman', '2023-04-23 08:04:00'),
(57, 'Status_warga', 'Status Warga', 'status_warga', '2023-05-03 14:57:00'),
(58, 'Profesi', 'Profesi', 'profesi', '2023-05-03 14:58:00'),
(59, 'Agama', 'Agama', 'agama', '2023-05-03 15:12:00'),
(60, 'Kelamin', 'Kelamin', 'kelamin', '2023-05-03 15:14:00'),
(61, 'Pendidikan_terakhir', 'Pendidikan Terakhir', 'pendidikan_terakhir', '2023-05-03 15:17:00'),
(68, 'Tb_status_surat', 'Status Surat', 'tb_status_surat', '2023-05-08 08:29:00'),
(69, 'Tb_jenis_surat', 'Jenis Surat', 'tb_jenis_surat', '2023-05-08 08:32:00'),
(72, 'Warga', 'Warga', 'warga', '2023-05-10 15:29:00'),
(78, 'Warga_syarat_dokumen', 'Warga Syarat Dokumen', 'warga_syarat_dokumen', '2023-05-13 17:29:00'),
(79, 'Warga_dokumen', 'Dokumen Warga', 'warga_dokumen', '2023-05-13 17:41:00'),
(80, 'Tb_surat', 'Surat', 'tb_surat', '2023-05-15 09:17:00'),
(81, 'Tb_kopsurat', 'Kop Surat', 'tb_kopsurat', '2023-06-07 14:41:00'),
(83, 'Tb_galeri_detail', 'Galeri Detail', 'tb_galeri_detail', '2023-06-10 18:00:00'),
(84, 'Tb_galeri', 'Galeri', 'tb_galeri', '2023-06-11 10:08:00'),
(86, 'Pengaturan', 'Pengaturan', 'pengaturan', '2023-09-18 14:07:00'),
(87, 'Sambutan', 'Sambutan', 'db_sambutan', '2023-09-18 19:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_terakhir`
--

CREATE TABLE `pendidikan_terakhir` (
  `id` int NOT NULL,
  `nama` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendidikan_terakhir`
--

INSERT INTO `pendidikan_terakhir` (`id`, `nama`) VALUES
(1, 'Belum Sekolah'),
(2, 'TK / PAUD / Sederajat'),
(3, 'SD / MI / Sederajat'),
(4, 'SMP / MTS / Sederajat'),
(5, 'SMA / SMK / Sederajat'),
(6, 'D1'),
(7, 'D2'),
(8, 'D3'),
(9, 'D4'),
(10, 'S1'),
(11, 'S2'),
(12, 'S3'),
(13, 'Tidak Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int NOT NULL,
  `deskripsi_web` text COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_gmaps` text COLLATE utf8mb4_general_ci,
  `visi` text COLLATE utf8mb4_general_ci NOT NULL,
  `misi` text COLLATE utf8mb4_general_ci NOT NULL,
  `foto` text COLLATE utf8mb4_general_ci NOT NULL,
  `header` text COLLATE utf8mb4_general_ci NOT NULL,
  `marquee` text COLLATE utf8mb4_general_ci NOT NULL,
  `tagline` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `motto` text COLLATE utf8mb4_general_ci NOT NULL,
  `tujuan` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `deskripsi_web`, `alamat_gmaps`, `visi`, `misi`, `foto`, `header`, `marquee`, `tagline`, `motto`, `tujuan`) VALUES
(1, 'Ini merupakan website informasi, Sarana Sosialisasi, Dokumentasi, Publikasi dan Layanan Warga Masyarakat RW 013 Kelurahan Cipinang Melayu Kecamatan Makasar Kota Administrasi Jakarta Timur.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1170336236655!2d106.90488297368431!3d-6.248305543740092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f32c3733482f:0x6c67c5cd62e95d39!2sRW.13, Cipinang Melayu, Kec. Makasar, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta!5e0!3m2!1sid!2sid!4v1681543515247!5m2!1sid!2sid', 'Terwujudnya Masyarakat Rukun Warga (RW) 013 Kelurahan Cipinang Melayu yang Kreatif, Mandiri, Berdaya saing dan Bermartabat.', '<ol>\r\n    <li>Membangun Kualitas Sumber Daya Manusia di bidang Pendidikan, Kesehatan, dan Memantapkan Kesalehan Sosial Berlandaskan Iman dan Taqwa;</li>\r\n    <li>Meningkatkan Pelayanan Publik dan Membangun Pelayanan Kebutuhan Administrasi Berbasis Informasi dan Teknologi (IT);</li>\r\n    <li>Memperkuat Komunikasi, Koordinasi, Kolaborasi dengan berbagai pihak terkait, baik internal RW 013 maupun eksternal;</li>\r\n    <li>Pemantaban Pembangunan Lingkungan RW 013 dan Pemulihan Keseimbangan Lingkungan yang berkelanjutan;</li>\r\n    <li>Menggali dan Menumbuhkembangkan Potensi Masyarakat serta Melestarikan Budaya Tradisional dan Kearifan Lokal;</li>\r\n    <li>Memelihara Ketersediaan dan Kualitas Infrastruktur serta Keterpaduan Pemanfaatan Tata Ruang Wilayah RW 013;</li>\r\n    <li>Meningkatkan Partisipasi Sektor Swasta dan Pemberdayaan Ekonomi Kerakyatan yang berdaya saing;</li>\r\n    <li>Membangun dan Meningkatkan hubungan Kemasyarakatan dengan Nilai Gotong Royong dan Kepedulian Sosial.</li>\r\n</ol>', '220923055510_d19b0fa692dadd1e3d8bf1e1f3245be3e119b7c4.webp', '210923033955_b2effc384bbdffb0850e09092fb8a311c6edefe0.webp', 'SELAMAT DATANG DI RW 013 CIPINANG MELAYU', 'RW013 SINERGI : Saya Bisa, Anda Bisa, Kita Semua. YES! YES! YES!', 'Sinergi bersama untuk membangun RW 013 menjadi Kreatif, Mandiri,  Berdaya Saing dan Bermartabat', '1.Mengelola sumber daya manusia ( SDM ) di lingkungan RW 013 secara optimal.\r\n2.Mewujudkan tata kelola informasi data yang cepat, tepat dan aman.\r\n3.Pengembangan Komputerisasi sistem data yang terpadu agar menjadi nilai tambah kualitas kehidupan  masyarakat.\r\n4.Meningkatkan partisipasi publik terhadap informasi.\r\n5.Meningkatkan pelayanan masyarakat sebagai peran serta kita dalam menunjang program.');

-- --------------------------------------------------------

--
-- Table structure for table `profesi`
--

CREATE TABLE `profesi` (
  `id` int NOT NULL,
  `nama_profesi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profesi`
--

INSERT INTO `profesi` (`id`, `nama_profesi`) VALUES
(1, 'PNS atau Pegawai Negeri'),
(2, 'Pegawai Swasta');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int NOT NULL,
  `group` varchar(50) NOT NULL,
  `options` varchar(100) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `group`, `options`, `value`) VALUES
(0, 'null', 'null', 'null'),
(1, 'general', 'web_name', 'RW 013 Cipinang Melayu'),
(2, 'general', 'web_domain', 'https://rw013cipmel.com'),
(3, 'general', 'web_owner', 'Faservice'),
(4, 'general', 'email', 'rukunwarga013cipmel@gmail.com'),
(5, 'general', 'telepon', '087776981246'),
(6, 'general', 'address', 'RW 013 - Cipinang Melayu.\nKecamatan Makasar.\nKota Jakarta Timur.\nDaerah Khusus Ibukota Jakarta,\n13620.'),
(7, 'general', 'logo', '100623171351_b77815bf98a3916a6af2b246d33d6b4b289a26b9.webp'),
(8, 'general', 'logo_mini', '100623143032_b77815bf98a3916a6af2b246d33d6b4b289a26b9.webp'),
(9, 'general', 'favicon', '180423120810_favicon.ico'),
(10, 'general', 'emailnya', '@cipmel013.com'),
(50, 'sosmed', 'facebook', 'https://facebook.com/rw013cipmel'),
(51, 'sosmed', 'instagram', 'https://instagram.com/rw013cipmel?igshid=ZDdkNTZiNTM='),
(52, 'sosmed', 'youtube', 'https://www.youtube.com/@RW013cipmel'),
(53, 'sosmed', 'twitter', 'https://www.twitter.com/@rw013cipmel'),
(54, 'sosmed', 'tiktok', 'https://www.tiktok.com/@pangjat13?_t=8aYoi04mYRr&amp;_r=1'),
(60, 'config', 'maintenance_status', 'N'),
(61, 'config', 'user_log_status', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int NOT NULL,
  `judul_foto` text COLLATE utf8mb4_general_ci,
  `lokasi_foto` text COLLATE utf8mb4_general_ci,
  `id_stts` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `judul_foto`, `lokasi_foto`, `id_stts`) VALUES
(1, 'Youtube RW013 Cipmel', '210923215617_2da67febbaa2e9104af75d31999f8e9837d37125.webp', 1),
(2, 'Pawai Sukacita RW 013 2023', '220923053140_4e4547e85479d74d66ddf48481bfbf1aa75d67dc.webp', 1),
(4, 'PANEN BERSAMA DI URBAN FARMING GERBANG DARLING 013 CIPINANG MELAYU', '220923053619_c94cdc33d52a745ec75840eca25ff1b03fce90df.webp', 1),
(5, 'PELANTIKAN PENGURUS RT RW 013 CIPINANG MELAYU', '220923054309_6f41d1ea38db664e0f1a0a4d32e067d3e9ad978b.webp', 1),
(6, 'DISKUSI &amp;amp; SHARING', '220923054811_ce0293e12f1477326121726bd71424ddb9ca52d2.webp', 1),
(7, 'OLAHRAGA WARGA', '220923054445_2ed5e6d32d47797d521315b8bcfa143d458db1e8.webp', 1),
(9, 'PEMBANGUNAN KANTOR RW 013', '220923054945_9089bd2d8b613795c154f97bc3fee2e1d790d07f.webp', 1),
(10, 'JARING #1', '220923055019_e8e0739317b67bf0a9034ec299584646254811e8.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status_warga`
--

CREATE TABLE `status_warga` (
  `id` int NOT NULL,
  `nama_stts_warga` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_warga`
--

INSERT INTO `status_warga` (`id`, `nama_stts_warga`) VALUES
(1, 'Belum Menikah'),
(2, 'Menikah'),
(3, 'Duda/Janda'),
(4, 'Pindah'),
(5, 'Meninggal');

-- --------------------------------------------------------

--
-- Table structure for table `stts`
--

CREATE TABLE `stts` (
  `id` int NOT NULL,
  `keterangan` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stts`
--

INSERT INTO `stts` (`id`, `keterangan`) VALUES
(1, 'Publik'),
(2, 'Draft');

-- --------------------------------------------------------

--
-- Table structure for table `tb_galeri`
--

CREATE TABLE `tb_galeri` (
  `id` int NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `nama_galeri` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug` text COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_kegiatan` text COLLATE utf8mb4_general_ci,
  `cover` text COLLATE utf8mb4_general_ci NOT NULL,
  `status_galeri` int NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_galeri`
--

INSERT INTO `tb_galeri` (`id`, `id_kategori`, `nama_galeri`, `slug`, `deskripsi_kegiatan`, `cover`, `status_galeri`, `tgl_dibuat`) VALUES
(1, 2, 'FORUM KOMUNIKASI RW 013', 'forum-komunikasi-rw-013', 'Forum Komunikasi (FORKOM) RW 013 adalah wadah komunikasi dan kerja sama antar Tokoh Masyarakat, LMK, Rukun Tetangga (RT), Kader-Kader Lingkungan (PKK, PAUD, POSLAN, POSBAL, JUMANTIK, DASAWISMA) dan Element Masyarakat dilingkungan . Forkom RW dibentuk untuk meningkatkan peran serta masyarakat dalam pembangunan dan pemberdayaan masyarakat di tingkat lingkungan RW.\r\n\r\nForkom RW memiliki beberapa tujuan, antara lain:\r\n\r\nMeningkatkan peran serta masyarakat dalam pembangunan dan pemberdayaan masyarakat;\r\nMeningkatkan koordinasi dan kerja sama antar Pengurus;\r\nMeningkatkan kesadaran masyarakat akan pentingnya menjaga keamanan dan ketertiban lingkungan;\r\nMeningkatkan kesadaran masyarakat akan pentingnya menjaga kebersihan dan keindahan lingkungan;\r\nMeningkatkan kesadaran masyarakat akan pentingnya menjaga kesehatan lingkungan;\r\nMeningkatkan kesadaran masyarakat akan pentingnya pendidikan dan kesejahteraan masyarakat.\r\n\r\nFORKOM RW 013 beranggotakan  Seluruh Element Masyarakat RW antara lain Tokoh Masyarakat, LMK, Rukun Tetangga (RT), dan Kader-Kader Lingkungan (PKK, PAUD, POSLAN, POSBAL, JUMANTIK, DASAWISMA) . FORKOM RW 013 dipimpin oleh seorang ketua RW 013 dan dibantu oleh beberapa wakil ketua, sekretaris, dan bendahara.', '210923022001_770a6a0a668fed4a67a1f307cb90d1a7c34e7a18.webp', 1, '2023-09-20 19:20:01'),
(2, 2, 'POSYANDU BALITA RW 013', 'posyandu-balita-rw-013', 'Posyandu Balita (POSBAL) RW 013 adalah merupakan pelayanan kepada balita dan anak dengan melakukan penimbangan agar bisa dipantau pertumbuhan dan perkembangan balita dan anak. Manfaat posyandu balita ialah memberikan layanan kesehatan anak, imunisasi, pemberian makanan tambahan, dan penyuluhan tentang kesehatan.', '210923015442_e7fec49193fcd19248204dbcee61117d281bd760.webp', 1, '2023-09-20 19:40:13'),
(3, 2, 'BANK SAMPAH GERBANG DARLING RW 013', 'bank-sampah-gerbang-darling-rw-013', 'Bank sampah Gerbang Darling RW 013 Cipinang Melayu adalah suatu tempat yang digunakan untuk mengumpulkan sampah yang sudah dipilah-pilah. Sampah yang sudah dipilah kemudian diolah menjadi barang-barang yang memiliki nilai ekonomis, seperti kerajinan tangan, bahan bakar, atau pupuk.\r\nBank sampah menerapkan sistem konversi dari sampah menjadi uang, untuk meningkatkan partisipasi warga dalam memilah serta mendaur ulang sampah. Warga yang menyetorkan sampah akan mendapatkan poin atau uang sesuai dengan berat dan jenis sampah yang disetorkan. Poin atau uang tersebut dapat digunakan untuk membeli barang-barang atau jasa yang disediakan oleh bank sampah.\r\nBank sampah memiliki beberapa manfaat, antara lain:\r\n• Mengurangi volume sampah yang dibuang ke tempat pembuangan akhir (TPA);\r\n• Meningkatkan kesadaran masyarakat akan pentingnya memilah dan mendaur ulang sampah;\r\n• Menciptakan lapangan kerja dan meningkatkan kesejahteraan masyarakat;\r\n• Menjaga kelestarian lingkungan.\r\nBank sampah Gerbang Darling RW 013 dilaksanakan setiap bulan sekali oleh warga masyarakat RW 013 dengan bimbingan Dinas Lingkungan Hidup Kec. Makasar\r\nBank sampah Gerbang Darling RW 013 adalah suatu tempat yang digunakan untuk mengumpulkan sampah yang sudah dipilah-pilah. Sampah yang sudah dipilah kemudian diolah menjadi barang-barang yang memiliki nilai ekonomis, seperti kerajinan tangan, bahan bakar, atau pupuk.\r\nBank sampah menerapkan sistem konversi dari sampah menjadi uang, untuk meningkatkan partisipasi warga dalam memilah serta mendaur ulang sampah. Warga yang menyetorkan sampah akan mendapatkan poin atau uang sesuai dengan berat dan jenis sampah yang disetorkan. Poin atau uang tersebut dapat digunakan untuk membeli barang-barang atau jasa yang disediakan oleh bank sampah.\r\nBank sampah memiliki beberapa manfaat, antara lain:\r\n• Mengurangi volume sampah yang dibuang ke tempat pembuangan akhir (TPA);\r\n• Meningkatkan kesadaran masyarakat akan pentingnya memilah dan mendaur ulang sampah;\r\n• Menciptakan lapangan kerja dan meningkatkan kesejahteraan masyarakat;\r\n• Menjaga kelestarian lingkungan.\r\nBank sampah Gerbang Darling RW 013 dilaksanakan setiap bulan sekali oleh warga masyarakat RW 013 dengan bimbingan Dinas Lingkungan Hidup Kec. Makasar', '210923020725_770a6a0a668fed4a67a1f307cb90d1a7c34e7a18.webp', 1, '2023-09-20 19:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_galeri_detail`
--

CREATE TABLE `tb_galeri_detail` (
  `id` bigint NOT NULL,
  `id_galeri` int NOT NULL,
  `file` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_galeri_detail`
--

INSERT INTO `tb_galeri_detail` (`id`, `id_galeri`, `file`) VALUES
(2, 1, '100623204702_856e49142f87106537a59895c7d0bf7c1b2b5861.webp'),
(3, 1, '100623210732_856e49142f87106537a59895c7d0bf7c1b2b5861.webp'),
(4, 1, '100623210849_856e49142f87106537a59895c7d0bf7c1b2b5861.webp'),
(5, 1, '100623210917_851cefed08a76e3f926e1ef25943f7abb2405d8c.webp'),
(6, 1, '100623210933_851cefed08a76e3f926e1ef25943f7abb2405d8c.webp'),
(7, 1, '100623211035_851cefed08a76e3f926e1ef25943f7abb2405d8c.webp'),
(9, 2, '170923032828_8b6d30a85e0389fdff90552a47a568640d66f50b.webp'),
(10, 3, '210923014730_482f5508208e8ba457c75da8a8a525772e72cdd5.webp'),
(11, 3, '210923014754_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp'),
(12, 3, '210923014816_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp'),
(13, 3, '210923014839_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp'),
(14, 3, '210923014908_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp'),
(16, 3, '210923014953_f6c1c3881ead3937fc36cc76c0d3341721784c41.webp'),
(17, 2, '210923015537_3135c5c7784a661164762186ec7b7a74295c0181.webp'),
(18, 2, '210923015652_413db65eee9adb129fe0bdd4ddb22fb5d65577a2.webp'),
(19, 2, '210923015811_c4665aa2f57f5561cca24bcdfadeb711ba8fa557.webp'),
(20, 2, '210923020150_e0257eb59d70df61aa78522cf421ce72e5776f05.webp'),
(21, 1, '210923021656_770a6a0a668fed4a67a1f307cb90d1a7c34e7a18.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_surat`
--

CREATE TABLE `tb_jenis_surat` (
  `id` int NOT NULL,
  `nama_surat` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contoh_dokumen` text COLLATE utf8mb4_general_ci,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jenis_surat`
--

INSERT INTO `tb_jenis_surat` (`id`, `nama_surat`, `contoh_dokumen`, `date_created`) VALUES
(1, 'Surat Pengantar', '110623141126_Surat_Pengantar.docx', '2023-06-11 14:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kopsurat`
--

CREATE TABLE `tb_kopsurat` (
  `id` int NOT NULL,
  `id_group` int DEFAULT NULL,
  `gambar_kop` text COLLATE utf8mb4_general_ci,
  `nama` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kopsurat`
--

INSERT INTO `tb_kopsurat` (`id`, `id_group`, `gambar_kop`, `nama`, `alamat`) VALUES
(1, 4, '110623141318_a47547ad52066b5344c31e800f8880c172b0c3e1.webp', 'RT001', 'JL. Jatiwaringin'),
(2, 7, '171223003535_147f102c97c54c5ebdda4a99cd91fcb13ed5d7b8.webp', 'RT002', 'RT 002, RW 013 - Cipinang Melayu, Kecamatan Makasar, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta, 13620');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status_surat`
--

CREATE TABLE `tb_status_surat` (
  `id` int NOT NULL,
  `nama_status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_status_surat`
--

INSERT INTO `tb_status_surat` (`id`, `nama_status`, `date_created`) VALUES
(1, 'Tahap 1 (Pengajuan baru)', '2023-05-17 08:32:00'),
(2, 'Tahap 2 (Sudah disahkan RT)', '2023-05-17 08:32:00'),
(3, 'Revisi RT', '2023-05-17 08:33:00'),
(4, 'Revisi RW', '2023-05-17 08:33:00'),
(5, 'Tahap 3 (Disahkan RW)', '2023-05-17 08:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat`
--

CREATE TABLE `tb_surat` (
  `id` bigint NOT NULL,
  `id_jenis_surat` int DEFAULT NULL,
  `id_warga` bigint NOT NULL,
  `nomor_surat` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_ajuan` date DEFAULT NULL,
  `keperluan` text COLLATE utf8mb4_general_ci,
  `id_status_surat` int DEFAULT NULL,
  `tgl_keputusan` date DEFAULT NULL,
  `id_group` int DEFAULT NULL,
  `revisi` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `no_surat_rw` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_surat`
--

INSERT INTO `tb_surat` (`id`, `id_jenis_surat`, `id_warga`, `nomor_surat`, `tgl_ajuan`, `keperluan`, `id_status_surat`, `tgl_keputusan`, `id_group`, `revisi`, `date_created`, `date_updated`, `no_surat_rw`) VALUES
(1, 1, 3, '', '2023-07-18', 'Bekerja', 1, '1970-01-01', 4, '', '2023-07-18 07:48:00', '2023-07-18 07:48:00', ''),
(2, 1, 5, '001/RT002/RW013/2023', '2023-12-17', 'Untuk mendapat SKCK', 5, '2023-12-17', 7, '-', '2023-12-16 17:26:00', '2023-12-16 17:29:00', '001/XII/RW013/2023'),
(3, 1, 6, '001/8/001/013/XII/2023', '2023-12-17', 'Untuk izin membuat SKCK', 5, '2023-12-17', 4, '-', '2023-12-17 03:10:00', '2023-12-17 03:22:00', '001/8/RW/013/XII/2023');

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id` bigint NOT NULL,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_ktp` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `hp` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` int DEFAULT NULL,
  `agama` int DEFAULT NULL,
  `pendidikan_terakhir` int DEFAULT NULL,
  `id_profesi` int DEFAULT NULL,
  `id_group` int NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `foto_profil` text COLLATE utf8mb4_unicode_ci,
  `ttd_digital` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_drive` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_warga` int DEFAULT NULL,
  `tgl_dibuat` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id`, `no_kk`, `no_ktp`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `hp`, `jenis_kelamin`, `agama`, `pendidikan_terakhir`, `id_profesi`, `id_group`, `alamat`, `foto_profil`, `ttd_digital`, `link_drive`, `status_warga`, `tgl_dibuat`) VALUES
(1, '3175081302910005', '3175081302910005', 'Khotibul Umam', 'Jakarta', '2023-01-01', '085695526265', 1, 1, 10, 2, 4, 'RW 013 - Cipinang Melayu\r\nKecamatan Makasar\r\nKota Jakarta Timur\r\nDaerah Khusus Ibukota Jakarta', '', '', '', 2, '2023-09-20 08:34'),
(3, '1111111111111111', '1111111111111111', 'Dadang Supriyadi', 'Jakarta', '2023-12-16', '081290269529', 1, 1, 10, 2, 4, '-', '', '', '', 2, '2023-12-16 22:48'),
(4, '2222222222222222', '3175086406840001', 'Sri Mardianah', 'Jakarta', '2023-12-16', '085889306031', 2, 1, 10, 2, 7, 'rt002', '', '', '', 2, '2023-12-16 23:56'),
(5, '0000000000000000', '9999999999999999', 'Abdul Aziz', 'Jakarta', '2023-12-16', '085161525273', 1, 1, 1, 2, 8, '005 Rw013', '', '', '', 1, '2023-12-17 09:53'),
(6, '0000000000000000', '8888888888888888', 'Faruq Aziz', 'Jakarta', '2023-11-30', '082289889087', 1, 1, 10, 2, 4, '001', '', '', '', 2, '2023-12-17 09:33'),
(7, '3175080601092932', '3175084712810005', 'ANIS SURYANI', '', '1981-12-07', '087887002365', 2, 1, 5, 2, 11, NULL, NULL, '', '', 2, ''),
(8, '3175085902730001', '3175085902730001', 'Yuli ernawati', '', '1973-02-19', '082114631294', 2, 1, 10, 1, 9, NULL, NULL, '', '', 2, ''),
(9, '0000000000000000', '3185087103810006', 'Siti sadiyah', '', '1981-03-31', '081935504420', 2, 1, 10, 2, 7, NULL, NULL, '', '', 2, ''),
(10, '3175082103121006', '3175087009840001', 'Netty Setyaningsih', '', '1984-09-30', '08568000013', 2, 1, 10, 2, 8, NULL, NULL, '', '', 2, ''),
(11, '3175678309005892', '3175084905020008', 'hana', 'jakarta', '2002-12-17', '087887825832', 2, 1, 5, 2, 8, 'pangkalan jati', '', '', '', 1, '2023-12-17 10:04'),
(12, '3175080701090250', '3175084504050006', 'Virgin Putery Chinta', '', '2005-04-05', '087817073021', 2, 1, 5, 2, 14, NULL, NULL, '', '', 1, ''),
(13, '3175065610011005', '3175065610011005', 'Celline', '', '2001-10-16', '0895701804212', 2, 1, 5, 1, 8, NULL, NULL, '', '', 1, ''),
(14, '0000000000000000', '3175087103810006', 'Siti sadiyah', '', '1981-03-31', '081935504420', 2, 1, 10, 2, 7, NULL, NULL, '', '', 2, ''),
(15, '3175080501096273', '3175085804710003', 'Mulyani Havizo', '', '1971-04-18', '085888216208', 2, 1, 4, 2, 14, NULL, NULL, '', '', 2, ''),
(16, '3175080501096241', '3175084302720004', 'Rahmawati', '', '1972-02-03', '0895383137603', 2, 1, 10, 2, 13, NULL, NULL, '', '', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `warga_dokumen`
--

CREATE TABLE `warga_dokumen` (
  `id` bigint NOT NULL,
  `id_warga` bigint DEFAULT NULL,
  `id_syarat_dokumen` int DEFAULT NULL,
  `lokasi_dokumen` text COLLATE utf8mb4_general_ci,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga_dokumen`
--

INSERT INTO `warga_dokumen` (`id`, `id_warga`, `id_syarat_dokumen`, `lokasi_dokumen`, `datecreated`, `datemodified`) VALUES
(1, 3, 1, '110623141353_KTP.pdf', '2023-06-11 07:13:00', '2023-06-11 07:13:00'),
(2, 3, 2, '110623141439_KTP.pdf', '2023-06-11 07:14:00', '2023-06-11 07:14:00'),
(3, 3, 3, '110623141512_86955323db24ecbdac8ed2fa2279c9fd20a68c27.webp', '2023-06-11 07:15:00', '2023-06-11 07:15:00'),
(4, 5, 1, '171223002359_cd38ef12be3eb190809a6c60ea8ceaa0371e5e2f.webp', '2023-12-16 17:23:00', '2023-12-16 17:23:00'),
(5, 5, 2, '171223002430_817248fb77fb5c2cef3f2c732ad257cb1fb9c5e4.webp', '2023-12-16 17:24:00', '2023-12-16 17:24:00'),
(6, 5, 3, '171223002452_c12aea658925f3a91d4261e93f1d19764925b307.webp', '2023-12-16 17:24:00', '2023-12-16 17:24:00'),
(7, 6, 1, '171223093639_bukti_Modul_1922.pdf', '2023-12-17 02:36:00', '2023-12-17 02:36:00'),
(8, 6, 2, '171223093706_bukti_Modul_1922.pdf', '2023-12-17 02:37:00', '2023-12-17 02:37:00'),
(9, 6, 3, '171223094032_bukti_Modul_1922.pdf', '2023-12-17 02:40:00', '2023-12-17 02:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `warga_syarat_dokumen`
--

CREATE TABLE `warga_syarat_dokumen` (
  `id` int NOT NULL,
  `syarat_dokumen` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga_syarat_dokumen`
--

INSERT INTO `warga_syarat_dokumen` (`id`, `syarat_dokumen`) VALUES
(1, 'KTP'),
(2, 'Kartu Keluarga'),
(3, 'Pas Foto 4x6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `ci_user_log`
--
ALTER TABLE `ci_user_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_sambutan`
--
ALTER TABLE `db_sambutan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filemanager`
--
ALTER TABLE `filemanager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fotofoto`
--
ALTER TABLE `fotofoto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halaman`
--
ALTER TABLE `halaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_konten`
--
ALTER TABLE `kategori_konten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelamin`
--
ALTER TABLE `kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_youtube`
--
ALTER TABLE `link_youtube`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_frontend`
--
ALTER TABLE `menu_frontend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_halaman`
--
ALTER TABLE `menu_halaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules_crud_generator`
--
ALTER TABLE `modules_crud_generator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendidikan_terakhir`
--
ALTER TABLE `pendidikan_terakhir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profesi`
--
ALTER TABLE `profesi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_warga`
--
ALTER TABLE `status_warga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stts`
--
ALTER TABLE `stts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_galeri_detail`
--
ALTER TABLE `tb_galeri_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jenis_surat`
--
ALTER TABLE `tb_jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kopsurat`
--
ALTER TABLE `tb_kopsurat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_status_surat`
--
ALTER TABLE `tb_status_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warga_dokumen`
--
ALTER TABLE `warga_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warga_syarat_dokumen`
--
ALTER TABLE `warga_syarat_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_group`
--
ALTER TABLE `auth_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `auth_permission`
--
ALTER TABLE `auth_permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=555;

--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ci_user_log`
--
ALTER TABLE `ci_user_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_sambutan`
--
ALTER TABLE `db_sambutan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `filemanager`
--
ALTER TABLE `filemanager`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `fotofoto`
--
ALTER TABLE `fotofoto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `halaman`
--
ALTER TABLE `halaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategori_konten`
--
ALTER TABLE `kategori_konten`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelamin`
--
ALTER TABLE `kelamin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `konten`
--
ALTER TABLE `konten`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `link_youtube`
--
ALTER TABLE `link_youtube`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `menu_frontend`
--
ALTER TABLE `menu_frontend`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_halaman`
--
ALTER TABLE `menu_halaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modules_crud_generator`
--
ALTER TABLE `modules_crud_generator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `pendidikan_terakhir`
--
ALTER TABLE `pendidikan_terakhir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `profesi`
--
ALTER TABLE `profesi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `status_warga`
--
ALTER TABLE `status_warga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stts`
--
ALTER TABLE `stts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_galeri_detail`
--
ALTER TABLE `tb_galeri_detail`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_jenis_surat`
--
ALTER TABLE `tb_jenis_surat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kopsurat`
--
ALTER TABLE `tb_kopsurat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_status_surat`
--
ALTER TABLE `tb_status_surat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_surat`
--
ALTER TABLE `tb_surat`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warga`
--
ALTER TABLE `warga`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `warga_dokumen`
--
ALTER TABLE `warga_dokumen`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warga_syarat_dokumen`
--
ALTER TABLE `warga_syarat_dokumen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
