-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2017 at 06:35 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE `acos` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, '', NULL, 'controllers', 1, 450),
(2, 1, '', NULL, 'Acl', 2, 25),
(3, 2, '', NULL, 'AclActions', 3, 16),
(4, 3, '', NULL, 'admin_index', 4, 5),
(5, 3, '', NULL, 'admin_add', 6, 7),
(6, 3, '', NULL, 'admin_edit', 8, 9),
(7, 3, '', NULL, 'admin_delete', 10, 11),
(8, 3, '', NULL, 'admin_move', 12, 13),
(9, 3, '', NULL, 'admin_generate', 14, 15),
(10, 2, '', NULL, 'AclPermissions', 17, 24),
(11, 10, '', NULL, 'admin_index', 18, 19),
(12, 10, '', NULL, 'admin_toggle', 20, 21),
(13, 10, '', NULL, 'admin_upgrade', 22, 23),
(14, 1, '', NULL, 'Blocks', 26, 55),
(15, 14, '', NULL, 'Blocks', 27, 44),
(16, 15, '', NULL, 'admin_toggle', 28, 29),
(17, 15, '', NULL, 'admin_index', 30, 31),
(18, 15, '', NULL, 'admin_add', 32, 33),
(19, 15, '', NULL, 'admin_edit', 34, 35),
(20, 15, '', NULL, 'admin_delete', 36, 37),
(21, 15, '', NULL, 'admin_moveup', 38, 39),
(22, 15, '', NULL, 'admin_movedown', 40, 41),
(23, 15, '', NULL, 'admin_process', 42, 43),
(24, 14, '', NULL, 'Regions', 45, 54),
(25, 24, '', NULL, 'admin_index', 46, 47),
(26, 24, '', NULL, 'admin_add', 48, 49),
(27, 24, '', NULL, 'admin_edit', 50, 51),
(28, 24, '', NULL, 'admin_delete', 52, 53),
(29, 1, '', NULL, 'Comments', 56, 73),
(30, 29, '', NULL, 'Comments', 57, 72),
(31, 30, '', NULL, 'admin_index', 58, 59),
(32, 30, '', NULL, 'admin_edit', 60, 61),
(33, 30, '', NULL, 'admin_delete', 62, 63),
(34, 30, '', NULL, 'admin_process', 64, 65),
(35, 30, '', NULL, 'index', 66, 67),
(36, 30, '', NULL, 'add', 68, 69),
(37, 30, '', NULL, 'delete', 70, 71),
(38, 1, '', NULL, 'Contacts', 74, 97),
(39, 38, '', NULL, 'Contacts', 75, 86),
(40, 39, '', NULL, 'admin_index', 76, 77),
(41, 39, '', NULL, 'admin_add', 78, 79),
(42, 39, '', NULL, 'admin_edit', 80, 81),
(43, 39, '', NULL, 'admin_delete', 82, 83),
(44, 39, '', NULL, 'view', 84, 85),
(45, 38, '', NULL, 'Messages', 87, 96),
(46, 45, '', NULL, 'admin_index', 88, 89),
(47, 45, '', NULL, 'admin_edit', 90, 91),
(48, 45, '', NULL, 'admin_delete', 92, 93),
(49, 45, '', NULL, 'admin_process', 94, 95),
(50, 1, '', NULL, 'Croogo', 98, 99),
(51, 1, '', NULL, 'Extensions', 100, 149),
(52, 51, '', NULL, 'ExtensionsLocales', 101, 114),
(53, 52, '', NULL, 'admin_index', 102, 103),
(54, 52, '', NULL, 'admin_activate', 104, 105),
(55, 52, '', NULL, 'admin_add', 106, 107),
(56, 52, '', NULL, 'admin_edit', 108, 109),
(57, 52, '', NULL, 'admin_delete', 110, 111),
(58, 51, '', NULL, 'ExtensionsPlugins', 115, 130),
(59, 58, '', NULL, 'admin_index', 116, 117),
(60, 58, '', NULL, 'admin_add', 118, 119),
(61, 58, '', NULL, 'admin_delete', 120, 121),
(62, 58, '', NULL, 'admin_toggle', 122, 123),
(63, 58, '', NULL, 'admin_migrate', 124, 125),
(64, 51, '', NULL, 'ExtensionsThemes', 131, 144),
(65, 64, '', NULL, 'admin_index', 132, 133),
(66, 64, '', NULL, 'admin_activate', 134, 135),
(67, 64, '', NULL, 'admin_add', 136, 137),
(68, 64, '', NULL, 'admin_editor', 138, 139),
(69, 64, '', NULL, 'admin_save', 140, 141),
(70, 64, '', NULL, 'admin_delete', 142, 143),
(71, 1, '', NULL, 'FileManager', 150, 185),
(72, 71, '', NULL, 'Attachments', 151, 162),
(73, 72, '', NULL, 'admin_index', 152, 153),
(74, 72, '', NULL, 'admin_add', 154, 155),
(75, 72, '', NULL, 'admin_edit', 156, 157),
(76, 72, '', NULL, 'admin_delete', 158, 159),
(77, 72, '', NULL, 'admin_browse', 160, 161),
(78, 71, '', NULL, 'FileManager', 163, 184),
(79, 78, '', NULL, 'admin_index', 164, 165),
(80, 78, '', NULL, 'admin_browse', 166, 167),
(81, 78, '', NULL, 'admin_editfile', 168, 169),
(82, 78, '', NULL, 'admin_upload', 170, 171),
(83, 78, '', NULL, 'admin_delete_file', 172, 173),
(84, 78, '', NULL, 'admin_delete_directory', 174, 175),
(85, 78, '', NULL, 'admin_rename', 176, 177),
(86, 78, '', NULL, 'admin_create_directory', 178, 179),
(87, 78, '', NULL, 'admin_create_file', 180, 181),
(88, 78, '', NULL, 'admin_chmod', 182, 183),
(89, 1, '', NULL, 'Install', 186, 199),
(90, 89, '', NULL, 'Install', 187, 198),
(91, 90, '', NULL, 'index', 188, 189),
(92, 90, '', NULL, 'database', 190, 191),
(93, 90, '', NULL, 'data', 192, 193),
(94, 90, '', NULL, 'adminuser', 194, 195),
(95, 90, '', NULL, 'finish', 196, 197),
(96, 1, '', NULL, 'Menus', 200, 233),
(97, 96, '', NULL, 'Links', 201, 220),
(98, 97, '', NULL, 'admin_toggle', 202, 203),
(99, 97, '', NULL, 'admin_index', 204, 205),
(100, 97, '', NULL, 'admin_add', 206, 207),
(101, 97, '', NULL, 'admin_edit', 208, 209),
(102, 97, '', NULL, 'admin_delete', 210, 211),
(103, 97, '', NULL, 'admin_moveup', 212, 213),
(104, 97, '', NULL, 'admin_movedown', 214, 215),
(105, 97, '', NULL, 'admin_process', 216, 217),
(106, 96, '', NULL, 'Menus', 221, 232),
(107, 106, '', NULL, 'admin_index', 222, 223),
(108, 106, '', NULL, 'admin_add', 224, 225),
(109, 106, '', NULL, 'admin_edit', 226, 227),
(110, 106, '', NULL, 'admin_delete', 228, 229),
(111, 1, '', NULL, 'Meta', 234, 241),
(112, 1, '', NULL, 'Migrations', 242, 243),
(113, 1, '', NULL, 'Nodes', 244, 283),
(114, 113, '', NULL, 'Nodes', 245, 282),
(115, 114, '', NULL, 'admin_toggle', 246, 247),
(116, 114, '', NULL, 'admin_index', 248, 249),
(117, 114, '', NULL, 'admin_create', 250, 251),
(118, 114, '', NULL, 'admin_add', 252, 253),
(119, 114, '', NULL, 'admin_edit', 254, 255),
(120, 114, '', NULL, 'admin_update_paths', 256, 257),
(121, 114, '', NULL, 'admin_delete', 258, 259),
(122, 114, '', NULL, 'admin_delete_meta', 260, 261),
(123, 114, '', NULL, 'admin_add_meta', 262, 263),
(124, 114, '', NULL, 'admin_process', 264, 265),
(125, 114, '', NULL, 'index', 266, 267),
(126, 114, '', NULL, 'term', 268, 269),
(127, 114, '', NULL, 'promoted', 270, 271),
(128, 114, '', NULL, 'search', 272, 273),
(129, 114, '', NULL, 'view', 274, 275),
(130, 1, '', NULL, 'Search', 284, 285),
(131, 1, '', NULL, 'Settings', 286, 321),
(132, 131, '', NULL, 'Languages', 287, 302),
(133, 132, '', NULL, 'admin_index', 288, 289),
(134, 132, '', NULL, 'admin_add', 290, 291),
(135, 132, '', NULL, 'admin_edit', 292, 293),
(136, 132, '', NULL, 'admin_delete', 294, 295),
(137, 132, '', NULL, 'admin_moveup', 296, 297),
(138, 132, '', NULL, 'admin_movedown', 298, 299),
(139, 132, '', NULL, 'admin_select', 300, 301),
(140, 131, '', NULL, 'Settings', 303, 320),
(142, 140, '', NULL, 'admin_index', 304, 305),
(143, 140, '', NULL, 'admin_view', 306, 307),
(144, 140, '', NULL, 'admin_add', 308, 309),
(145, 140, '', NULL, 'admin_edit', 310, 311),
(146, 140, '', NULL, 'admin_delete', 312, 313),
(147, 140, '', NULL, 'admin_prefix', 314, 315),
(148, 140, '', NULL, 'admin_moveup', 316, 317),
(149, 140, '', NULL, 'admin_movedown', 318, 319),
(150, 1, '', NULL, 'Taxonomy', 322, 361),
(151, 150, '', NULL, 'Terms', 323, 336),
(152, 151, '', NULL, 'admin_index', 324, 325),
(153, 151, '', NULL, 'admin_add', 326, 327),
(154, 151, '', NULL, 'admin_edit', 328, 329),
(155, 151, '', NULL, 'admin_delete', 330, 331),
(156, 151, '', NULL, 'admin_moveup', 332, 333),
(157, 151, '', NULL, 'admin_movedown', 334, 335),
(158, 150, '', NULL, 'Types', 337, 346),
(159, 158, '', NULL, 'admin_index', 338, 339),
(160, 158, '', NULL, 'admin_add', 340, 341),
(161, 158, '', NULL, 'admin_edit', 342, 343),
(162, 158, '', NULL, 'admin_delete', 344, 345),
(163, 150, '', NULL, 'Vocabularies', 347, 360),
(164, 163, '', NULL, 'admin_index', 348, 349),
(165, 163, '', NULL, 'admin_add', 350, 351),
(166, 163, '', NULL, 'admin_edit', 352, 353),
(167, 163, '', NULL, 'admin_delete', 354, 355),
(168, 163, '', NULL, 'admin_moveup', 356, 357),
(169, 163, '', NULL, 'admin_movedown', 358, 359),
(170, 1, '', NULL, 'Ckeditor', 362, 363),
(171, 1, '', NULL, 'Users', 364, 409),
(172, 171, '', NULL, 'Roles', 365, 374),
(173, 172, '', NULL, 'admin_index', 366, 367),
(174, 172, '', NULL, 'admin_add', 368, 369),
(175, 172, '', NULL, 'admin_edit', 370, 371),
(176, 172, '', NULL, 'admin_delete', 372, 373),
(177, 171, '', NULL, 'Users', 375, 408),
(178, 177, '', NULL, 'admin_index', 376, 377),
(179, 177, '', NULL, 'admin_add', 378, 379),
(180, 177, '', NULL, 'admin_edit', 380, 381),
(181, 177, '', NULL, 'admin_reset_password', 382, 383),
(182, 177, '', NULL, 'admin_delete', 384, 385),
(183, 177, '', NULL, 'admin_login', 386, 387),
(184, 177, '', NULL, 'admin_logout', 388, 389),
(185, 177, '', NULL, 'index', 390, 391),
(186, 177, '', NULL, 'add', 392, 393),
(187, 177, '', NULL, 'activate', 394, 395),
(188, 177, '', NULL, 'edit', 396, 397),
(189, 177, '', NULL, 'forgot', 398, 399),
(190, 177, '', NULL, 'reset', 400, 401),
(191, 177, '', NULL, 'login', 402, 403),
(192, 177, '', NULL, 'logout', 404, 405),
(193, 177, '', NULL, 'view', 406, 407),
(194, 51, NULL, NULL, 'ExtensionsDashboard', 145, 148),
(195, 194, NULL, NULL, 'admin_index', 146, 147),
(196, 52, NULL, NULL, 'admin_reset_locale', 112, 113),
(197, 58, NULL, NULL, 'admin_moveup', 126, 127),
(198, 58, NULL, NULL, 'admin_movedown', 128, 129),
(199, 1, NULL, NULL, 'Managers', 410, 439),
(200, 199, NULL, NULL, 'Projects', 411, 418),
(201, 200, NULL, NULL, 'index', 412, 413),
(202, 200, NULL, NULL, 'add', 414, 415),
(203, 97, NULL, NULL, 'admin_link_chooser', 218, 219),
(204, 106, NULL, NULL, 'admin_toggle', 230, 231),
(205, 111, NULL, NULL, 'Meta', 235, 240),
(206, 205, NULL, NULL, 'admin_delete_meta', 236, 237),
(207, 205, NULL, NULL, 'admin_add_meta', 238, 239),
(208, 114, NULL, NULL, 'admin_hierarchy', 276, 277),
(209, 114, NULL, NULL, 'admin_moveup', 278, 279),
(210, 114, NULL, NULL, 'admin_movedown', 280, 281),
(211, NULL, NULL, NULL, 'api', 451, 466),
(212, 211, NULL, NULL, 'v1_0', 452, 465),
(213, 212, NULL, NULL, 'Nodes', 453, 458),
(214, 213, NULL, NULL, 'Nodes', 454, 457),
(215, 214, NULL, NULL, 'lookup', 455, 456),
(216, 212, NULL, NULL, 'Users', 459, 464),
(217, 216, NULL, NULL, 'Users', 460, 463),
(218, 217, NULL, NULL, 'lookup', 461, 462),
(219, 1, NULL, NULL, 'Wysiwyg', 440, 441),
(220, 200, NULL, NULL, 'view', 416, 417),
(221, 199, NULL, NULL, 'Tasks', 419, 430),
(222, 221, NULL, NULL, 'index', 420, 421),
(223, 221, NULL, NULL, 'add', 422, 423),
(224, 221, NULL, NULL, 'change_status', 424, 425),
(225, 1, NULL, NULL, 'ClearCache', 442, 449),
(226, 225, NULL, NULL, 'ClearCachesApp', 443, 444),
(227, 225, NULL, NULL, 'ClearCaches', 445, 448),
(228, 227, NULL, NULL, 'admin_clear', 446, 447),
(229, 221, NULL, NULL, 'my_tasks', 426, 427),
(230, 221, NULL, NULL, 'edit', 428, 429),
(231, 199, NULL, NULL, 'Errors', 431, 438),
(232, 231, NULL, NULL, 'add', 432, 433),
(233, 231, NULL, NULL, 'my_errors', 434, 435),
(234, 231, NULL, NULL, 'change_status', 436, 437);

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE `aros` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, 2, 'Role', 1, 'Role-admin', 3, 6),
(2, 3, 'Role', 2, 'Role-registered', 2, 25),
(3, NULL, 'Role', 3, 'Role-public', 1, 26),
(4, 1, 'User', 1, 'admin', 4, 5),
(5, 2, 'User', 2, 'khacduy', 7, 8),
(6, 2, 'User', 3, 'ngocmy', 9, 10),
(7, 2, 'User', 4, 'tailich', 11, 12),
(8, 2, 'User', 5, 'phankhanh', 13, 14),
(9, 2, 'User', 6, 'hoangtung', 15, 16),
(10, 2, 'User', 7, 'donghiep', 17, 18),
(11, 2, 'User', 8, 'vietdung', 19, 20),
(12, 2, 'User', 9, 'tuanxitrum', 21, 22),
(13, 2, 'User', 10, 'trieudola', 23, 24),
(14, NULL, 'Role', 4, 'Role-client', 27, 28);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `_read` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `_update` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `_delete` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 3, 35, '1', '1', '1', '1'),
(2, 3, 36, '1', '1', '1', '1'),
(3, 2, 37, '1', '1', '1', '1'),
(4, 3, 44, '1', '1', '1', '1'),
(5, 3, 125, '1', '1', '1', '1'),
(6, 3, 126, '1', '1', '1', '1'),
(7, 3, 127, '1', '1', '1', '1'),
(8, 3, 128, '1', '1', '1', '1'),
(9, 3, 129, '1', '1', '1', '1'),
(10, 2, 185, '1', '1', '1', '1'),
(11, 3, 186, '1', '1', '1', '1'),
(12, 3, 187, '1', '1', '1', '1'),
(13, 2, 188, '1', '1', '1', '1'),
(14, 3, 189, '1', '1', '1', '1'),
(15, 3, 190, '1', '1', '1', '1'),
(16, 3, 191, '1', '1', '1', '1'),
(17, 2, 192, '1', '1', '1', '1'),
(18, 2, 193, '1', '1', '1', '1'),
(19, 3, 183, '1', '1', '1', '1'),
(20, 2, 201, '1', '1', '1', '1'),
(21, 3, 201, '1', '1', '1', '1'),
(22, 2, 202, '1', '1', '1', '1'),
(23, 2, 224, '1', '1', '1', '1'),
(24, 2, 223, '1', '1', '1', '1'),
(25, 2, 222, '1', '1', '1', '1'),
(26, 3, 222, '1', '1', '1', '1'),
(27, 2, 220, '1', '1', '1', '1'),
(28, 3, 220, '1', '1', '1', '1'),
(29, 2, 229, '1', '1', '1', '1'),
(30, 3, 224, '-1', '-1', '-1', '-1'),
(31, 2, 230, '1', '1', '1', '1'),
(32, 14, 232, '1', '1', '1', '1'),
(33, 14, 220, '1', '1', '1', '1'),
(34, 2, 233, '1', '1', '1', '1'),
(35, 2, 234, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int(20) NOT NULL,
  `region_id` int(20) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `show_title` tinyint(1) NOT NULL DEFAULT '1',
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `element` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visibility_roles` text COLLATE utf8_unicode_ci,
  `visibility_paths` text COLLATE utf8_unicode_ci,
  `visibility_php` text COLLATE utf8_unicode_ci,
  `params` text COLLATE utf8_unicode_ci,
  `publish_start` datetime DEFAULT NULL,
  `publish_end` datetime DEFAULT NULL,
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `region_id`, `title`, `alias`, `body`, `show_title`, `class`, `status`, `weight`, `element`, `visibility_roles`, `visibility_paths`, `visibility_php`, `params`, `publish_start`, `publish_end`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(3, 4, 'About', 'about', 'This is the content of your block. Can be modified in admin panel.', 1, '', 1, 2, '', '', '', '', '', NULL, NULL, '2009-12-20 03:07:39', NULL, '2009-07-26 17:13:14', NULL),
(5, 4, 'Meta', 'meta', '[menu:meta]', 1, '', 1, 6, '', '', '', '', '', NULL, NULL, '2009-12-22 05:17:39', NULL, '2009-09-12 06:36:22', NULL),
(6, 4, 'Blogroll', 'blogroll', '[menu:blogroll]', 1, '', 1, 4, '', '', '', '', '', NULL, NULL, '2009-12-20 03:07:33', NULL, '2009-09-12 23:33:27', NULL),
(7, 4, 'Categories', 'categories', '[vocabulary:categories type="blog"]', 1, '', 1, 3, '', '', '', '', '', NULL, NULL, '2009-12-20 03:07:36', NULL, '2009-10-03 16:52:50', NULL),
(8, 4, 'Search', 'search', '', 0, '', 1, 1, 'Nodes.search', '', '', '', '', NULL, NULL, '2009-12-20 03:07:39', NULL, '2009-12-20 03:07:27', NULL),
(9, 4, 'Recent Posts', 'recent_posts', '[node:recent_posts conditions="Node.type:blog" order="Node.id DESC" limit="5"]', 1, '', 1, 5, '', '', '', '', '', NULL, NULL, '2010-04-08 21:09:31', NULL, '2009-12-22 05:17:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(20) NOT NULL,
  `parent_id` int(20) DEFAULT NULL,
  `model` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Node',
  `foreign_key` int(20) NOT NULL,
  `user_id` int(20) NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'comment',
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `model`, `foreign_key`, `user_id`, `name`, `email`, `website`, `ip`, `title`, `body`, `rating`, `status`, `notify`, `type`, `comment_type`, `lft`, `rght`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(1, NULL, 'Node', 1, 0, 'Mr Croogo', 'email@example.com', 'http://www.croogo.org', '127.0.0.1', '', 'Hi, this is the first comment.', NULL, 1, 0, 'blog', 'comment', 1, 2, '2009-12-25 12:00:00', NULL, '2009-12-25 12:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `address2` text COLLATE utf8_unicode_ci,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message_status` tinyint(1) NOT NULL DEFAULT '1',
  `message_archive` tinyint(1) NOT NULL DEFAULT '1',
  `message_count` int(11) NOT NULL DEFAULT '0',
  `message_spam_protection` tinyint(1) NOT NULL DEFAULT '0',
  `message_captcha` tinyint(1) NOT NULL DEFAULT '0',
  `message_notify` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `title`, `alias`, `body`, `name`, `position`, `address`, `address2`, `state`, `country`, `postcode`, `phone`, `fax`, `email`, `message_status`, `message_archive`, `message_count`, `message_spam_protection`, `message_captcha`, `message_notify`, `status`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(1, 'Contact', 'contact', '', '', '', '', '', '', '', '', '', '', 'you@your-site.com', 1, 0, 0, 0, 0, 1, 1, '2009-10-07 22:07:49', NULL, '2009-09-16 01:45:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

CREATE TABLE `dashboards` (
  `id` int(20) NOT NULL,
  `alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_id` int(20) NOT NULL DEFAULT '0',
  `column` int(20) NOT NULL DEFAULT '0',
  `weight` int(20) NOT NULL DEFAULT '0',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

CREATE TABLE `errors` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `task_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `errors`
--

INSERT INTO `errors` (`id`, `title`, `body`, `task_id`, `status`, `created`, `updated`) VALUES
(1, 'SP version ko đúng thiết kế', 'SP version ko đúng thiết kế', 11, 0, '2017-05-02 21:38:40', '2017-05-02 21:38:40'),
(2, 'Bản SP ko giống tk', 'Bản SP ko giống tk', 16, 0, '2017-05-02 22:14:31', '2017-05-02 22:14:31'),
(3, 'Bản SP ko giống tk', 'Bản SP ko giống tk', 14, 0, '2017-05-02 22:18:55', '2017-05-02 22:18:55'),
(4, 'SP version ko đúng thiết kế', 'SP version ko đúng thiết kế', 19, 0, '2017-05-02 22:22:28', '2017-05-02 22:22:28'),
(5, 'SP version ko đúng thiết kế', 'SP version ko đúng thiết kế', 7, 0, '2017-05-02 22:22:53', '2017-05-02 22:22:53'),
(6, 'SP version ko đúng thiết kế', 'SP version ko đúng thiết kế', 9, 0, '2017-05-02 22:23:19', '2017-05-02 22:23:19'),
(7, 'Layout ko giống tk', 'Layout ko giống tk', 6, 1, '2017-05-02 22:40:07', '2017-05-02 23:28:55'),
(8, 'SP version ko đúng thiết kế', 'SP version ko đúng thiết kế', 2, 1, '2017-05-02 23:00:53', '2017-05-02 23:31:39'),
(9, 'Ko giống thiết kế', 'Layout ko giống tk', 30, 1, '2017-05-02 23:02:00', '2017-05-02 23:04:43'),
(10, 'SP version ko đúng thiết kế', 'SP version ko đúng thiết kế', 30, 1, '2017-05-02 23:21:04', '2017-05-02 23:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `native` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `weight` int(11) DEFAULT NULL,
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `title`, `native`, `alias`, `status`, `weight`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(1, 'English', 'English', 'eng', 1, 1, '2009-11-02 21:37:38', NULL, '2009-11-02 20:52:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(20) NOT NULL,
  `parent_id` int(20) DEFAULT NULL,
  `menu_id` int(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `visibility_roles` text COLLATE utf8_unicode_ci,
  `params` text COLLATE utf8_unicode_ci,
  `publish_start` datetime DEFAULT NULL,
  `publish_end` datetime DEFAULT NULL,
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `parent_id`, `menu_id`, `title`, `class`, `description`, `link`, `target`, `rel`, `status`, `lft`, `rght`, `visibility_roles`, `params`, `publish_start`, `publish_end`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(5, NULL, 4, 'About', 'about', '', 'plugin:nodes/controller:nodes/action:view/type:page/slug:about', '', '', 1, 3, 4, '', '', NULL, NULL, '2009-10-06 23:14:21', NULL, '2009-08-19 12:23:33', NULL),
(6, NULL, 4, 'Contact', 'contact', '', 'plugin:contacts/controller:contacts/action:view/contact', '', '', 1, 5, 6, '', '', NULL, NULL, '2009-10-06 23:14:45', NULL, '2009-08-19 12:34:56', NULL),
(7, NULL, 3, 'Home', 'home', '', 'plugin:nodes/controller:nodes/action:promoted', '', '', 1, 5, 6, '', '', NULL, NULL, '2009-10-06 21:17:06', NULL, '2009-09-06 21:32:54', NULL),
(8, NULL, 3, 'About', 'about', '', 'plugin:nodes/controller:nodes/action:view/type:page/slug:about', '', '', 1, 7, 10, '', '', NULL, NULL, '2009-09-12 03:45:53', NULL, '2009-09-06 21:34:57', NULL),
(9, 8, 3, 'Child link', 'child-link', '', '#', '', '', 0, 8, 9, '', '', NULL, NULL, '2009-10-06 23:13:06', NULL, '2009-09-12 03:52:23', NULL),
(10, NULL, 5, 'Site Admin', 'site-admin', '', '/admin', '', '', 1, 1, 2, '', '', NULL, NULL, '2009-09-12 06:34:09', NULL, '2009-09-12 06:34:09', NULL),
(11, NULL, 5, 'Log out', 'log-out', '', '/plugin:users/controller:users/action:logout', '', '', 1, 7, 8, '["1","2"]', '', NULL, NULL, '2009-09-12 06:35:22', NULL, '2009-09-12 06:34:41', NULL),
(12, NULL, 6, 'Croogo', 'croogo', '', 'http://www.croogo.org', '', '', 1, 3, 4, '', '', NULL, NULL, '2009-09-12 23:31:59', NULL, '2009-09-12 23:31:59', NULL),
(14, NULL, 6, 'CakePHP', 'cakephp', '', 'http://www.cakephp.org', '', '', 1, 1, 2, '', '', NULL, NULL, '2009-10-07 03:25:25', NULL, '2009-09-12 23:38:43', NULL),
(15, NULL, 3, 'Contact', 'contact', '', '/plugin:contacts/controller:contacts/action:view/contact', '', '', 1, 11, 12, '', '', NULL, NULL, '2009-09-16 07:54:13', NULL, '2009-09-16 07:53:33', NULL),
(16, NULL, 5, 'Entries (RSS)', 'entries-rss', '', '/promoted.rss', '', '', 1, 3, 4, '', '', NULL, NULL, '2009-10-27 17:46:22', NULL, '2009-10-27 17:46:22', NULL),
(17, NULL, 5, 'Comments (RSS)', 'comments-rss', '', '/comments.rss', '', '', 1, 5, 6, '', '', NULL, NULL, '2009-10-27 17:46:54', NULL, '2009-10-27 17:46:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` int(1) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `link_count` int(11) NOT NULL,
  `params` text COLLATE utf8_unicode_ci,
  `publish_start` datetime DEFAULT NULL,
  `publish_end` datetime DEFAULT NULL,
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `alias`, `class`, `description`, `status`, `weight`, `link_count`, `params`, `publish_start`, `publish_end`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(3, 'Main Menu', 'main', '', '', 1, NULL, 4, '', NULL, NULL, '2009-08-19 12:21:06', NULL, '2009-07-22 01:49:53', NULL),
(4, 'Footer', 'footer', '', '', 1, NULL, 2, '', NULL, NULL, '2009-08-19 12:22:42', NULL, '2009-08-19 12:22:42', NULL),
(5, 'Meta', 'meta', '', '', 1, NULL, 4, '', NULL, NULL, '2009-09-12 06:33:29', NULL, '2009-09-12 06:33:29', NULL),
(6, 'Blogroll', 'blogroll', '', '', 1, NULL, 2, '', NULL, NULL, '2009-09-12 23:30:24', NULL, '2009-09-12 23:30:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `message_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `id` int(20) NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Node',
  `foreign_key` int(20) DEFAULT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `weight` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(20) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `model`, `foreign_key`, `key`, `value`, `weight`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'Node', 1, 'meta_keywords', 'key1, key2', NULL, '2017-04-29 07:34:22', NULL, '2017-04-29 07:34:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `model_taxonomies`
--

CREATE TABLE `model_taxonomies` (
  `id` int(20) NOT NULL,
  `model` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Node',
  `foreign_key` int(20) NOT NULL DEFAULT '0',
  `taxonomy_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_taxonomies`
--

INSERT INTO `model_taxonomies` (`id`, `model`, `foreign_key`, `taxonomy_id`) VALUES
(1, 'Node', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nodes`
--

CREATE TABLE `nodes` (
  `id` int(20) NOT NULL,
  `parent_id` int(20) DEFAULT NULL,
  `user_id` int(20) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8_unicode_ci,
  `status` int(1) DEFAULT NULL,
  `mime_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_status` int(1) NOT NULL DEFAULT '1',
  `comment_count` int(11) DEFAULT '0',
  `promote` tinyint(1) NOT NULL DEFAULT '0',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `terms` text COLLATE utf8_unicode_ci,
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `visibility_roles` text COLLATE utf8_unicode_ci,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'node',
  `publish_start` datetime DEFAULT NULL,
  `publish_end` datetime DEFAULT NULL,
  `updated` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nodes`
--

INSERT INTO `nodes` (`id`, `parent_id`, `user_id`, `title`, `slug`, `body`, `excerpt`, `status`, `mime_type`, `comment_status`, `comment_count`, `promote`, `path`, `terms`, `sticky`, `lft`, `rght`, `visibility_roles`, `type`, `publish_start`, `publish_end`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(1, NULL, 1, 'Hello World', 'hello-world', '<p>Welcome to Croogo. This is your first post. You can edit or delete it from the admin panel.</p>', '', 1, '', 2, 1, 1, '/blog/hello-world', '{"1":"uncategorized"}', 0, 1, 2, '', 'blog', NULL, NULL, '2009-12-25 11:00:00', NULL, '2009-12-25 11:00:00', NULL),
(2, NULL, 1, 'About', 'about', '<p>This is an example of a Croogo page, you could edit this to put information about yourself or your site.</p>', '', 1, '', 0, 0, 0, '/about', '', 0, 1, 2, '', 'page', NULL, NULL, '2009-12-25 22:00:00', NULL, '2009-12-25 22:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `demo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `host` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `title`, `body`, `start`, `end`, `created`, `updated`, `demo`, `domain`, `host`, `account`, `pass`) VALUES
(1, 1, 'Free sale no 05', '- Làm đúng quy tắc của các site free sale.<br>\r\n- Làm chuẩn từng px theo file thiết kế<br>\r\n- Hoàn thành đúng tiến độ được giao và hạn chế lỗi', '2017-04-24', '2017-04-28', '2017-04-29 16:10:36', '2017-04-29 16:10:36', 'http://dev.projecthtml.com/free-sale/no05/new/', NULL, NULL, NULL, NULL),
(2, 2, 'Grande-suono.com', 'Yêu cầu làm chính xác như thiết kế file AI', '2017-04-24', '2017-04-27', '2017-04-30 07:55:39', '2017-04-30 07:55:39', 'http://dev.projecthtml.com/grande-suono/en/', NULL, NULL, NULL, NULL),
(3, 1, 'Candy site project', 'Làm đúng yêu cầu chuẩn px như file thiết kế', '2017-04-18', '2017-04-21', '2017-04-30 07:59:42', '2017-04-30 07:59:42', 'http://dev.projecthtml.com/candy/', NULL, NULL, NULL, NULL),
(4, 1, 'Natura project', '- Làm đúng quy trình và chuẩn file thiết kế', '2017-04-17', '2017-04-21', '2017-04-30 08:01:30', '2017-04-30 08:01:30', 'http://dev.projecthtml.com/natura/index.php', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `block_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `created_by` int(20) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `title`, `alias`, `description`, `block_count`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(3, 'none', 'none', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(4, 'right', 'right', '', 6, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(6, 'left', 'left', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(7, 'header', 'header', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(8, 'footer', 'footer', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(9, 'region1', 'region1', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(10, 'region2', 'region2', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(11, 'region3', 'region3', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(12, 'region4', 'region4', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(13, 'region5', 'region5', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(14, 'region6', 'region6', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(15, 'region7', 'region7', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(16, 'region8', 'region8', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(17, 'region9', 'region9', '', 0, '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(20) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `alias`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'Admin', 'admin', '2009-04-05 00:10:34', NULL, '2009-04-05 00:10:34', NULL),
(2, 'Registered', 'registered', '2009-04-05 00:10:50', NULL, '2009-04-06 05:20:38', NULL),
(3, 'Public', 'public', '2009-04-05 00:12:38', NULL, '2009-04-07 01:41:45', NULL),
(4, 'Client', 'client', '2017-05-02 21:41:06', 1, '2017-05-02 21:41:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles_users`
--

CREATE TABLE `roles_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `granted_by` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schema_migrations`
--

CREATE TABLE `schema_migrations` (
  `id` int(11) NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schema_migrations`
--

INSERT INTO `schema_migrations` (`id`, `class`, `type`, `created`) VALUES
(1, 'InitMigrations', 'Migrations', '2017-04-29 07:34:01'),
(2, 'ConvertVersionToClassNames', 'Migrations', '2017-04-29 07:34:01'),
(3, 'IncreaseClassNameLength', 'Migrations', '2017-04-29 07:34:02'),
(4, 'FirstMigrationSettings', 'Settings', '2017-04-29 07:34:02'),
(5, 'SettingsTrackableFields', 'Settings', '2017-04-29 07:34:03'),
(6, 'AddedAssetTimestampSetting', 'Settings', '2017-04-29 07:34:03'),
(7, 'ExposeSiteThemeAndLocaleAndHomeUrl', 'Settings', '2017-04-29 07:34:03'),
(8, 'FirstMigrationAcl', 'Acl', '2017-04-29 07:34:04'),
(9, 'SplitSession', 'Acl', '2017-04-29 07:34:04'),
(10, 'FirstMigrationBlocks', 'Blocks', '2017-04-29 07:34:04'),
(11, 'BlocksTrackableFields', 'Blocks', '2017-04-29 07:34:05'),
(12, 'BlocksPublishingFields', 'Blocks', '2017-04-29 07:34:06'),
(13, 'FirstMigrationComments', 'Comments', '2017-04-29 07:34:06'),
(14, 'CommentsTrackableFields', 'Comments', '2017-04-29 07:34:06'),
(15, 'AddCommentsForeignKeys', 'Comments', '2017-04-29 07:34:07'),
(16, 'FirstMigrationContacts', 'Contacts', '2017-04-29 07:34:07'),
(17, 'ContactsTrackableFields', 'Contacts', '2017-04-29 07:34:08'),
(18, 'FirstMigrationMenus', 'Menus', '2017-04-29 07:34:08'),
(19, 'MenusTrackableFields', 'Menus', '2017-04-29 07:34:09'),
(20, 'MenusPublishingFields', 'Menus', '2017-04-29 07:34:10'),
(21, 'FirstMigrationMeta', 'Meta', '2017-04-29 07:34:10'),
(22, 'MetaTrackableFields', 'Meta', '2017-04-29 07:34:11'),
(23, 'FirstMigrationNodes', 'Nodes', '2017-04-29 07:34:11'),
(24, 'NodesTrackableFields', 'Nodes', '2017-04-29 07:34:11'),
(25, 'NodesPublishingFields', 'Nodes', '2017-04-29 07:34:12'),
(26, 'FirstMigrationTaxonomy', 'Taxonomy', '2017-04-29 07:34:13'),
(27, 'TaxonomyTrackableFields', 'Taxonomy', '2017-04-29 07:34:15'),
(28, 'RenameNodesTaxonomy', 'Taxonomy', '2017-04-29 07:34:15'),
(29, 'AddModelTaxonomyForeignKey', 'Taxonomy', '2017-04-29 07:34:16'),
(30, 'AddWysisygEnableField', 'Taxonomy', '2017-04-29 07:34:16'),
(31, 'FirstMigrationUsers', 'Users', '2017-04-29 07:34:16'),
(32, 'UsersTrackableFields', 'Users', '2017-04-29 07:34:17'),
(33, 'UsersEnlargeTimezone', 'Users', '2017-04-29 07:34:17'),
(34, 'FirstMigrationDashboard', 'Dashboards', '2017-04-29 07:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(20) NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `input_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'text',
  `editable` tinyint(1) NOT NULL DEFAULT '1',
  `weight` int(11) DEFAULT NULL,
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(20) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `title`, `description`, `input_type`, `editable`, `weight`, `params`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(6, 'Site.title', 'Hệ thống quản lý dự án', '', '', '', 1, 1, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:54:16', 1),
(7, 'Site.tagline', 'Hệ thống quản lý dự án công ty Oison Việt Nam', '', '', 'textarea', 1, 2, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:54:16', 1),
(8, 'Site.email', 'you@your-site.com', '', '', '', 1, 3, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:54:16', 1),
(9, 'Site.status', '1', '', '', 'checkbox', 1, 6, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:54:16', 1),
(12, 'Meta.robots', 'index, follow', '', '', '', 1, 6, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(13, 'Meta.keywords', 'croogo, Croogo', '', '', 'textarea', 1, 7, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(14, 'Meta.description', 'Croogo - A CakePHP powered Content Management System', '', '', 'textarea', 1, 8, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(15, 'Meta.generator', 'Croogo - Content Management System', '', '', '', 0, 9, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(16, 'Service.akismet_key', 'your-key', '', '', '', 1, 11, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(17, 'Service.recaptcha_public_key', 'your-public-key', '', '', '', 1, 12, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(18, 'Service.recaptcha_private_key', 'your-private-key', '', '', '', 1, 13, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(19, 'Service.akismet_url', 'http://your-blog.com', '', '', '', 1, 10, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(20, 'Site.theme', '', '', '', '', 0, 14, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(21, 'Site.feed_url', '', '', '', '', 0, 15, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(22, 'Reading.nodes_per_page', '5', '', '', '', 1, 16, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(23, 'Writing.wysiwyg', '1', 'Enable WYSIWYG editor', '', 'checkbox', 1, 17, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(24, 'Comment.level', '1', '', 'levels deep (threaded comments)', '', 1, 18, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(25, 'Comment.feed_limit', '10', '', 'number of comments to show in feed', '', 1, 19, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(26, 'Site.locale', 'eng', '', '', 'text', 1, 20, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:54:16', 1),
(27, 'Reading.date_time_format', 'D, M d Y H:i:s', '', '', '', 1, 21, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(28, 'Comment.date_time_format', 'M d, Y', '', '', '', 1, 22, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(29, 'Site.timezone', 'Asia/Ho_Chi_Minh', '', 'Provide a valid timezone identifier as specified in https://php.net/manual/en/timezones.php', '', 1, 4, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:54:16', 1),
(32, 'Hook.bootstraps', 'Settings,Contacts,Nodes,Meta,Menus,Users,Blocks,Taxonomy,FileManager,Wysiwyg,Ckeditor,ClearCache', '', '', '', 0, 23, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', 1),
(33, 'Comment.email_notification', '1', 'Enable email notification', '', 'checkbox', 1, 24, '', '2017-04-29 07:34:23', NULL, '2017-04-29 07:34:23', NULL),
(34, 'Access Control.multiRole', '0', 'Enable Multiple Roles', '', 'checkbox', 1, 25, '', '2017-04-29 07:34:24', NULL, '2017-04-29 07:34:24', NULL),
(35, 'Access Control.rowLevel', '0', 'Row Level Access Control', '', 'checkbox', 1, 26, '', '2017-04-29 07:34:24', NULL, '2017-04-29 07:34:24', NULL),
(36, 'Access Control.autoLoginDuration', '+1 week', '"Remember Me" Duration', 'Eg: +1 day, +1 week. Leave empty to disable.', 'text', 1, 27, '', '2017-04-29 07:34:24', NULL, '2017-04-29 07:34:24', NULL),
(37, 'Access Control.models', '', 'Models with Row Level Acl', 'Select models to activate Row Level Access Control on', 'multiple', 1, 26, 'multiple=checkbox\noptions={"Nodes.Node": "Node", "Blocks.Block": "Block", "Menus.Menu": "Menu", "Menus.Link": "Link"}', '2017-04-29 07:34:24', NULL, '2017-04-29 07:34:24', NULL),
(38, 'Site.ipWhitelist', '127.0.0.1', 'Whitelisted IP Addresses', 'Separate multiple IP addresses with comma', 'text', 1, 27, '', '2017-04-29 07:34:24', NULL, '2017-04-29 07:54:16', 1),
(39, 'Site.asset_timestamp', 'force', 'Asset timestamp', 'Appends a timestamp which is last modified time of the particular file at the end of asset files URLs (CSS, JavaScript, Image). Useful to prevent visitors to visit the site with an outdated version of these files in their browser cache.', 'radio', 1, 28, 'options={"0": "Disabled", "1": "Enabled in debug mode only", "force": "Always enabled"}', '2017-04-29 07:34:24', NULL, '2017-04-29 07:54:16', 1),
(40, 'Site.admin_theme', '', 'Administration Theme', '', 'text', 1, 29, '', '2017-04-29 07:34:24', NULL, '2017-04-29 07:54:16', 1),
(41, 'Site.home_url', '', 'Home Url', 'Default action for home page in link string format.', 'text', 1, 30, '', '2017-04-29 07:34:24', NULL, '2017-04-29 07:54:16', 1),
(42, 'Croogo.installed', '1', '', '', '', 0, 31, '', '2017-04-29 07:34:49', NULL, '2017-04-29 07:34:49', NULL),
(43, 'Croogo.version', '2.3.2', '', '', '', 0, 32, '', '2017-04-29 07:53:40', 1, '2017-04-29 07:53:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `body`, `url`, `user_id`, `project_id`, `start`, `end`, `status`, `created`, `updated`) VALUES
(1, 'Created home page', 'Created home page', 'http://dev.projecthtml.com/natura/index.php', 1, 4, '2017-04-17 08:00:00', '2017-04-17 17:30:00', 1, '2017-04-30 08:32:44', '2017-05-02 14:39:03'),
(2, 'Created Q&A page', 'Created Q&A page', 'http://dev.projecthtml.com/candy/q&a.php', 1, 3, '2017-04-19 08:00:00', '2017-04-19 17:30:00', 1, '2017-04-30 09:00:47', '2017-05-02 23:01:42'),
(3, 'Created contact page', 'Created contact page<br>\r\nCreated confirm page and send mail<br>\r\nCreated thankyou page', 'http://dev.projecthtml.com/grande-suono/jp/contact/', 1, 2, '2017-04-27 08:00:00', '2017-04-27 17:30:00', 1, '2017-05-02 08:29:54', '2017-05-02 15:44:09'),
(4, 'Create home page', 'Create home page<br>\r\nCreated header<br>\r\nCreated footer', 'http://dev.projecthtml.com/grande-suono/jp/', 2, 2, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 08:32:41', '2017-05-02 16:02:25'),
(5, 'Create introduction page', 'Create introduction page with Japanese', 'http://dev.projecthtml.com/grande-suono/jp/introduction/', 1, 2, '2017-04-25 08:00:00', '2017-04-25 17:30:00', 1, '2017-05-02 09:14:09', '2017-05-02 14:39:16'),
(6, 'Create layout', 'header, footer and index', 'http://dev.projecthtml.com/free-sale/no05/new/', 1, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 14:57:15', '2017-05-02 23:29:18'),
(7, 'Cost page', 'Cost page', 'http://dev.projecthtml.com/free-sale/no05/new/cost/', 4, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:03:21', '2017-05-02 22:26:50'),
(8, 'Cost saving page', 'Cost saving page', 'http://dev.projecthtml.com/free-sale/no05/new/cost/saving/', 4, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:04:29', '2017-05-02 16:28:37'),
(9, 'Service page', 'Service page', 'http://dev.projecthtml.com/free-sale/no05/new/service/index.php', 3, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:06:11', '2017-05-02 22:23:30'),
(10, 'Example page', 'Example page', 'http://dev.projecthtml.com/free-sale/no05/new/example/index.php', 3, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:07:17', '2017-05-02 16:28:34'),
(11, 'About page', 'Create about page', 'http://dev.projecthtml.com/free-sale/no05/new/about/index.php', 6, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:18:55', '2017-05-02 22:29:23'),
(12, 'Reason about page', 'Reason about page', 'http://dev.projecthtml.com/free-sale/no05/new/about/reason/index.php', 5, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:20:36', '2017-05-02 16:28:32'),
(13, 'Staff page', 'Staff page', 'http://dev.projecthtml.com/free-sale/no05/new/about/staff/index.php', 8, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:21:17', '2017-05-02 16:34:11'),
(14, 'Warranty syste page', 'Warranty syste page', 'http://dev.projecthtml.com/free-sale/no05/new/about/warrantysyste/index.php', 8, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:23:20', '2017-05-02 16:28:27'),
(15, 'Contact page', 'Contact page + Confirm + Thank you + Send mail', 'http://dev.projecthtml.com/free-sale/no05/new/contact/', 1, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:30:30', '2017-05-02 16:30:44'),
(16, 'Q&A page', 'Q&A page', 'http://dev.projecthtml.com/free-sale/no05/new/about/q&a/index.php', 6, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:31:56', '2017-05-02 16:32:06'),
(17, 'Flow page', 'Flow page', 'http://dev.projecthtml.com/free-sale/no05/new/about/flow/index.php', 5, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:33:20', '2017-05-02 16:33:52'),
(18, 'Highfunction page', 'Highfunction page', 'http://dev.projecthtml.com/free-sale/no05/new/cost/highfunction/index.php', 8, 1, '2017-04-25 08:00:00', '2017-04-25 17:30:00', 1, '2017-05-02 16:38:42', '2017-05-02 16:44:56'),
(19, 'Barrier-free page', 'Barrier-free page', 'http://dev.projecthtml.com/free-sale/no05/new/cost/barrier-free/index.php', 8, 1, '2017-04-24 08:00:00', '2017-04-24 17:30:00', 1, '2017-05-02 16:39:44', '2017-05-02 20:22:44'),
(20, 'Hair style gallery', 'Hair style gallery', 'http://dev.projecthtml.com/candy/hair-style-gallery.php', 9, 3, '2017-04-19 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 16:42:13', '2017-05-02 16:42:41'),
(21, 'Home page', 'index + header + footer', 'http://dev.projecthtml.com/candy/', 2, 3, '2017-04-18 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 16:44:14', '2017-05-02 21:51:44'),
(22, 'Special menu page', 'Special menu page', 'http://dev.projecthtml.com/candy/special-menu.php', 3, 3, '2017-04-19 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 19:57:19', '2017-05-02 19:57:26'),
(23, 'Special menu detail page', 'Special menu detail page', 'http://dev.projecthtml.com/candy/special-menu-1.php', 3, 3, '2017-04-19 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 19:58:10', '2017-05-02 23:21:57'),
(24, 'Create main layout', 'header and footer', 'http://dev.projecthtml.com/candy/', 7, 3, '2017-04-18 08:00:00', '2017-04-18 17:30:00', 1, '2017-05-02 19:59:13', '2017-05-02 23:21:49'),
(25, 'Menu page', 'Menu page', 'http://dev.projecthtml.com/candy/menu.php', 3, 3, '2017-04-18 08:00:00', '2017-04-18 17:30:00', 1, '2017-05-02 19:59:55', '2017-05-02 23:21:55'),
(26, 'Shop infomation page', 'Shop infomation page', 'http://dev.projecthtml.com/candy/shop-information.php', 3, 3, '2017-04-18 08:00:00', '2017-04-18 17:30:00', 1, '2017-05-02 20:00:36', '2017-05-02 23:21:53'),
(27, 'Staff profile page', 'Staff profile page', 'http://dev.projecthtml.com/candy/staff-profile.php', 8, 3, '2017-04-18 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 20:01:20', '2017-05-02 23:21:46'),
(28, 'Coupon page', 'Coupon page', 'http://dev.projecthtml.com/candy/coupon.php', 8, 3, '2017-04-18 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 20:01:58', '2017-05-02 23:21:48'),
(29, 'News page', 'News page', 'http://dev.projecthtml.com/candy/news.php', 1, 3, '2017-04-18 08:00:00', '2017-04-18 17:30:00', 1, '2017-05-02 20:02:34', '2017-05-02 20:02:40'),
(30, 'News detail page', 'News detail page', 'http://dev.projecthtml.com/candy/news-detail.php', 1, 3, '2017-04-19 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 20:03:17', '2017-05-02 23:21:22'),
(31, 'Hair style gallery detail page', 'Hair style gallery detail page', 'http://dev.projecthtml.com/candy/hair-style-gallery-1.php', 9, 3, '2017-04-19 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 20:04:24', '2017-05-02 23:02:32'),
(32, 'Blog page', 'Blog page', 'http://dev.projecthtml.com/candy/blog.php', 4, 3, '2017-04-19 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 20:05:01', '2017-05-02 23:22:01'),
(33, 'Blog detail', 'Blog detail page', 'http://dev.projecthtml.com/candy/blog-1.php', 4, 3, '2017-04-19 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 20:05:37', '2017-05-02 23:22:00'),
(34, 'Contact form', 'Contact page + Confirm page + Thankyou page + Send mail', 'http://dev.projecthtml.com/candy/contact.php', 1, 3, '2017-04-18 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 20:07:07', '2017-05-02 20:07:13'),
(35, 'Recruit page', 'Recruit page', 'http://dev.projecthtml.com/candy/recruit.php', 4, 3, '2017-04-19 08:00:00', '2017-04-19 17:30:00', 1, '2017-05-02 20:07:51', '2017-05-02 23:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `taxonomies`
--

CREATE TABLE `taxonomies` (
  `id` int(20) NOT NULL,
  `parent_id` int(20) DEFAULT NULL,
  `term_id` int(10) NOT NULL,
  `vocabulary_id` int(10) NOT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taxonomies`
--

INSERT INTO `taxonomies` (`id`, `parent_id`, `term_id`, `vocabulary_id`, `lft`, `rght`) VALUES
(1, NULL, 1, 1, 1, 2),
(2, NULL, 2, 1, 3, 4),
(3, NULL, 3, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `title`, `slug`, `description`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(1, 'Uncategorized', 'uncategorized', '', '2009-07-22 03:38:43', NULL, '2009-07-22 03:34:56', NULL),
(2, 'Announcements', 'announcements', '', '2010-05-16 23:57:06', NULL, '2009-07-22 03:45:37', NULL),
(3, 'mytag', 'mytag', '', '2009-08-26 14:42:43', NULL, '2009-08-26 14:42:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `format_show_author` tinyint(1) NOT NULL DEFAULT '1',
  `format_show_date` tinyint(1) NOT NULL DEFAULT '1',
  `format_use_wysiwyg` tinyint(1) NOT NULL DEFAULT '1',
  `comment_status` int(1) NOT NULL DEFAULT '1',
  `comment_approve` tinyint(1) NOT NULL DEFAULT '1',
  `comment_spam_protection` tinyint(1) NOT NULL DEFAULT '0',
  `comment_captcha` tinyint(1) NOT NULL DEFAULT '0',
  `params` text COLLATE utf8_unicode_ci,
  `plugin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `title`, `alias`, `description`, `format_show_author`, `format_show_date`, `format_use_wysiwyg`, `comment_status`, `comment_approve`, `comment_spam_protection`, `comment_captcha`, `params`, `plugin`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(1, 'Page', 'page', 'A page is a simple method for creating and displaying information that rarely changes, such as an "About us" section of a website. By default, a page entry does not allow visitor comments.', 0, 0, 1, 0, 1, 0, 0, '', NULL, '2009-09-09 00:23:24', NULL, '2009-09-02 18:06:27', NULL),
(2, 'Blog', 'blog', 'A blog entry is a single post to an online journal, or blog.', 1, 1, 1, 2, 1, 0, 0, '', NULL, '2009-09-15 12:15:43', NULL, '2009-09-02 18:20:44', NULL),
(4, 'Node', 'node', 'Default content type.', 1, 1, 1, 2, 1, 0, 0, '', NULL, '2009-10-06 21:53:15', NULL, '2009-09-05 23:51:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types_vocabularies`
--

CREATE TABLE `types_vocabularies` (
  `id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  `vocabulary_id` int(10) NOT NULL,
  `weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types_vocabularies`
--

INSERT INTO `types_vocabularies` (`id`, `type_id`, `vocabulary_id`, `weight`) VALUES
(24, 4, 1, NULL),
(25, 4, 2, NULL),
(30, 2, 1, NULL),
(31, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activation_key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `timezone` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `name`, `email`, `website`, `activation_key`, `image`, `color`, `bio`, `status`, `updated`, `updated_by`, `created`, `timezone`, `created_by`) VALUES
(1, 1, 'admin', 'e03b53330e649d4a6ea4e0b203f650933f5f8db7', 'Trần Huy Du', 'dankatran@gmail.com', '', '24c834526d5894b375bffe97d3704ea4', NULL, '#398439', NULL, 1, '2017-04-29 15:01:25', 1, '2017-04-29 07:34:48', 'Asia/Ho_Chi_Minh', NULL),
(2, 2, 'khacduy', '3903fd4e6b75a62111066649f288f1a3c01b1fc7', 'Nguyễn Khắc Duy', 'khacduy@gmail.com', '', '5d78dc67547847c5071f2056b1608218', NULL, '#ff9805', NULL, 1, '2017-04-30 07:54:36', 1, '2017-04-30 07:54:36', 'Asia/Ho_Chi_Minh', 1),
(3, 2, 'ngocmy', '3903fd4e6b75a62111066649f288f1a3c01b1fc7', 'Trần Thị Ngọc Mỹ', 'ngocmy@gmail.com', '', 'ca6c8db8e2ebc7ad7b945d114957b5fb', NULL, '#0a8f8e', NULL, 1, '2017-05-02 16:00:22', 1, '2017-05-02 16:00:22', 'Asia/Ho_Chi_Minh', 1),
(4, 2, 'tailich', '3903fd4e6b75a62111066649f288f1a3c01b1fc7', 'Vương Quốc Tài', 'tailich@gmail.com', '', 'ca5eedbbc6dfef7c15a919b378a1fa75', NULL, '#f65859', NULL, 1, '2017-05-02 16:01:50', 1, '2017-05-02 16:01:50', 'Asia/Ho_Chi_Minh', 1),
(5, 2, 'phankhanh', '3903fd4e6b75a62111066649f288f1a3c01b1fc7', 'Phan Trung Khánh', 'phankhanh@gmail.com', '', 'e21681e80a5ebdbfc79db746180c54c5', NULL, '#b24fb2', NULL, 1, '2017-05-02 16:08:03', 1, '2017-05-02 16:08:03', 'Asia/Ho_Chi_Minh', 1),
(6, 2, 'hoangtung', '3903fd4e6b75a62111066649f288f1a3c01b1fc7', 'Lê Hoàng Tùng', 'hoangtung@gmail.com', '', '2969ad14df95e0770ab663432ed40b8f', NULL, '#80582d', NULL, 1, '2017-05-02 16:10:12', 1, '2017-05-02 16:10:12', 'Asia/Ho_Chi_Minh', 1),
(7, 2, 'donghiep', '3903fd4e6b75a62111066649f288f1a3c01b1fc7', 'Mai Xuân Đông', 'donghiep@gmail.com', '', 'f22c826e755af23bb5a4d32164dc7a5d', NULL, '#4c7fec', NULL, 1, '2017-05-02 16:11:54', 1, '2017-05-02 16:11:54', 'Asia/Ho_Chi_Minh', 1),
(8, 2, 'vietdung', '3903fd4e6b75a62111066649f288f1a3c01b1fc7', 'Lương Viết Dung', 'vietdung@gmail.com', '', '2904ebe299c2bb4950a397130468a688', NULL, '#c3be00', NULL, 1, '2017-05-02 16:22:21', 1, '2017-05-02 16:22:21', 'Asia/Ho_Chi_Minh', 1),
(9, 2, 'tuanxitrum', '3903fd4e6b75a62111066649f288f1a3c01b1fc7', 'Nguyễn Anh Tuấn', 'tuanxitrum@gmail.com', '', '747dd644f4754c115faabd22536dbede', NULL, '#8166c6', NULL, 1, '2017-05-02 16:40:46', 1, '2017-05-02 16:40:46', 'Asia/Ho_Chi_Minh', 1),
(10, 2, 'trieudola', '3903fd4e6b75a62111066649f288f1a3c01b1fc7', 'Lê Văn Triệu', 'trieudola@gmail.com', '', 'c60cb0207aaa6361a95ab34595c242cd', NULL, '#000', NULL, 1, '2017-05-02 20:32:00', 1, '2017-05-02 20:32:00', 'Asia/Ho_Chi_Minh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vocabularies`
--

CREATE TABLE `vocabularies` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `multiple` tinyint(1) NOT NULL DEFAULT '0',
  `tags` tinyint(1) NOT NULL DEFAULT '0',
  `plugin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `updated` datetime NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vocabularies`
--

INSERT INTO `vocabularies` (`id`, `title`, `alias`, `description`, `required`, `multiple`, `tags`, `plugin`, `weight`, `updated`, `updated_by`, `created`, `created_by`) VALUES
(1, 'Categories', 'categories', '', 0, 1, 0, NULL, 1, '2010-05-17 20:03:11', NULL, '2009-07-22 02:16:21', NULL),
(2, 'Tags', 'tags', '', 0, 1, 0, NULL, 2, '2010-05-17 20:03:11', NULL, '2009-07-22 02:16:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acos`
--
ALTER TABLE `acos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aros`
--
ALTER TABLE `aros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aros_acos`
--
ALTER TABLE `aros_acos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `block_alias` (`alias`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_fk` (`model`,`foreign_key`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboards`
--
ALTER TABLE `dashboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `errors`
--
ALTER TABLE `errors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_alias` (`alias`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_taxonomies`
--
ALTER TABLE `model_taxonomies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nodes`
--
ALTER TABLE `nodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `region_alias` (`alias`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_alias` (`alias`);

--
-- Indexes for table `roles_users`
--
ALTER TABLE `roles_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pk_role_users` (`user_id`,`role_id`);

--
-- Indexes for table `schema_migrations`
--
ALTER TABLE `schema_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxonomies`
--
ALTER TABLE `taxonomies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_alias` (`alias`);

--
-- Indexes for table `types_vocabularies`
--
ALTER TABLE `types_vocabularies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vocabularies`
--
ALTER TABLE `vocabularies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vocabulary_alias` (`alias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acos`
--
ALTER TABLE `acos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;
--
-- AUTO_INCREMENT for table `aros`
--
ALTER TABLE `aros`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `aros_acos`
--
ALTER TABLE `aros_acos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dashboards`
--
ALTER TABLE `dashboards`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `errors`
--
ALTER TABLE `errors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `model_taxonomies`
--
ALTER TABLE `model_taxonomies`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `nodes`
--
ALTER TABLE `nodes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles_users`
--
ALTER TABLE `roles_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schema_migrations`
--
ALTER TABLE `schema_migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `taxonomies`
--
ALTER TABLE `taxonomies`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `types_vocabularies`
--
ALTER TABLE `types_vocabularies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vocabularies`
--
ALTER TABLE `vocabularies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
