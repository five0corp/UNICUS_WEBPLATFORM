-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2022 at 10:47 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unicus_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `created_at`, `updated_at`) VALUES
(1, 'UNICUS', 'admin@unicus.co.kr', 'admin', NULL, '620236a2de3ca1644312226.jpg', '$2y$10$ZW/slanH1iJxhQRNiWB2lOQqReRNYQwYvCV0E23Xh8uaYKJkAr4zq', NULL, '2022-02-08 14:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
CREATE TABLE IF NOT EXISTS `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0',
  `click_url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `user_id`, `title`, `read_status`, `click_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'New member registered', 0, '/admin/user/detail/1', '2021-10-30 00:46:28', '2021-10-30 00:46:28'),
(2, 2, 'New member registered', 0, '/admin/user/detail/2', '2021-11-07 22:51:34', '2021-11-07 22:51:34'),
(3, 3, 'New member registered', 0, '/admin/user/detail/3', '2021-11-12 22:38:48', '2021-11-12 22:38:48'),
(4, 8, 'New member registered', 0, '/admin/user/detail/8', '2021-12-18 09:48:57', '2021-12-18 09:48:57'),
(5, 9, 'New member registered', 0, '/admin/user/detail/9', '2021-12-18 11:06:40', '2021-12-18 11:06:40'),
(6, 11, 'New member registered', 0, '/admin/user/detail/11', '2021-12-21 10:27:12', '2021-12-21 10:27:12'),
(7, 12, 'New member registered', 0, '/admin/user/detail/12', '2022-01-26 07:01:56', '2022-01-26 07:01:56'),
(8, 13, 'New member registered', 0, '/admin/user/detail/13', '2022-02-01 12:44:15', '2022-02-01 12:44:15'),
(9, 14, 'New member registered', 0, '/admin/user/detail/14', '2022-02-02 14:40:11', '2022-02-02 14:40:11'),
(10, 15, 'New member registered', 0, '/admin/user/detail/15', '2022-02-02 16:43:10', '2022-02-02 16:43:10'),
(11, 16, 'New member registered', 0, '/admin/user/detail/16', '2022-02-02 16:46:04', '2022-02-02 16:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

DROP TABLE IF EXISTS `admin_password_resets`;
CREATE TABLE IF NOT EXISTS `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

DROP TABLE IF EXISTS `advertisements`;
CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click` int(11) NOT NULL DEFAULT '0',
  `impression` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Banner : 1, Script : 2',
  `size` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Enable : 1, Disable : 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(200) NOT NULL DEFAULT '',
  `image` varchar(200) NOT NULL DEFAULT '',
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'C:community,P:pole,N:notice,A:Announcement',
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `image`, `description`, `created_at`, `updated_at`, `type`, `user_id`) VALUES
(8, 'NFT Blockchain & Art Platform', '61c008af877fe1639975087.jpg', '<div><font color=\"#000000\"><br></font></div><div><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span class=\"ql-size-large\" style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-size: 1.5em;\"><font color=\"#000000\">We\'re here for art NFT.</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span class=\"ql-size-large\" style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-size: 1.5em;\"><font color=\"#000000\">Launching a new platform.</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><strong class=\"ql-size-huge\" style=\"font-size: 2.5em;\"><font color=\"#000000\">UNICUS</font></strong></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span class=\"ql-size-large\" style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-size: 1.5em;\"><font color=\"#000000\">We\'re going to give creators innovative ecosystems</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span class=\"ql-size-large\" style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-size: 1.5em;\"><font color=\"#000000\">Provide complete ownership to the consumer.</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"></font></p></div>', '2021-12-02 15:07:17', '2021-12-20 09:38:07', 'N', 6),
(9, 'Introduce UNICUS', '61c008a644dce1639975078.jpg', '<p class=\"ql-align-justify\" style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><img src=\"https://i.imgur.com/iUhFmSN.png\" width=\"600\"><br></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\"><br></font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">UNICUS is a blockchain-based platform for artistic and creative endeavors.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">From the real world to metaverses, we provide innovative production and distribution for artists, as well as the opportunity for users to own virtual assets in metaverse via NFTs.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">UNICUS is not simply a platform for issuing and selling NFTs. </font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">It is also a communication and consultation environment for fans, creators, and influencers to collaborate on numerous NFT cross-fusion activities. </font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">This considers the added value of secondary creativity and the expanded environment, and it will be one of the muses given by UNICUS.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">All participants will lead to a stage of cooperation (display, auction, and investment), not only within the cross-convergence workplace, but also through offline commerce and relationships with other artists, all of which will be conducted solely through a governance process.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Additionally, it will be an ecosystem that encompasses more than investing in, accessing, and obtaining limited-edition material on existing platforms; it will encompass various UNICUS worldviews.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">UNICUS NFT WEB PLATFORM not only acts as a facilitator of artist-to-consumer transactions, but also manages and promotes artists through various projects such as artist management, promotion (exhibition planning management, etc.), online and offline marketing, and global artist scouting.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">We will invite artists from around the world to showcase their work and broaden the selection.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Anyone can contribute to the creation of UNICUS. </font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">The SOCIAL NFT Service enables anyone to create artwork, and contribute to the expansion of the UNICUS platform.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">The CREATOR COMMUNITY and the UNIC HOLDER COMMUNITY each have the ability to influence the community in proportion to the amount of UNIC Coin they own, and based on that decision, they set quarterly policies for the UNICUS PROJECT.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">We have developed a business model in collaboration with the community to guide the business\'s overall direction and decisions, and we will build an ecosystem that expands the scope of governance through UNICUS\'s unique system structure for community development.</font></span></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-justify\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: justify; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Ultimately, as a Platform, we want to create new cultures and industries while also providing innovative structures and opportunities for participation in a diverse range of artistic endeavors.</font></span></p>', '2021-12-20 09:08:09', '2021-12-20 09:37:58', 'N', 0),
(10, 'New partnership: Mobigraph', '61c007ebaadf31639974891.jpg', '<div style=\"text-align: center;\"><br></div><div style=\"text-align: center;\"><font color=\"#000000\"><br></font></div><div><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">UNICUS X MOBIGRAPH</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Mobigraph is a 3D Graphics Engine development and contents company located in San José, California, and Bengaluru in India. It is known as a famous supplying company of 3D Emoji on-board on Samsung’s Galaxy mobiles.</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Five Corporation Foundation signed an exclusive contract with Mobigraph about cooperating and supplying digital content and global artists.</font></span></p></div>', '2021-12-20 09:09:26', '2021-12-20 09:34:51', 'N', 0),
(11, 'New partnership: Kyodo Group', '61c0081f619841639974943.jpg', '<div><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><strong class=\"ql-size-large\" style=\"font-size: 1.5em;\"><font color=\"#000000\"><br></font></strong></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><strong class=\"ql-size-large\" style=\"font-size: 1.5em;\"><font color=\"#000000\">UNICUS x KYODO GROUP</font></strong></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span class=\"ql-size-large\" style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-size: 1.5em;\"><font color=\"#000000\">&nbsp;</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Kyodo Consulting Group have proceeded with a successful project</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">and numerous customers over 50 years based on plentiful cases since the year</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">1964.</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">&nbsp;</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Five Corporation Foundation contracted as prioritized strategy</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">cooperation with Kyodo Consulting Group and providing strategy development as</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">well as marketing consultant.</font></span></p></div>', '2021-12-20 09:10:53', '2021-12-20 09:35:43', 'N', 0),
(12, 'New partnership: Routela', '61c0082ace99a1639974954.jpg', '<p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span class=\"ql-size-large\" style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-size: 1.5em;\"><font color=\"#000000\"><br></font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span class=\"ql-size-large\" style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-size: 1.5em;\"><font color=\"#000000\">UNICUS X ROUTELA</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">‘Routela’ is a tourism interpretation audio guide app that is a new concept of contactless service that could be replaced with group tours.</font></span></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p class=\"ql-align-center\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Five Corporation Foundation secured time-lapse contents of famous places all over the world from Routela.</font></span></p>', '2021-12-20 09:11:54', '2021-12-20 09:35:54', 'N', 0),
(13, 'UNICUS COIN (UNIC) New Listing', '61c008f40cee81639975156.jpg', '<p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">Hello!</font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">Hanbitco is the start of a trusted investment.</font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">Hanbitco will be listed on UNIC on Thursday, August 19, 2021.</font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><img src=\"https://i.imgur.com/6CquJ55.png\" width=\"615\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">UNICUS COIN (UNIC) New Listed</font></p><ul style=\"padding-left: 1.5em; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><li style=\"text-align: center; margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px 0px 0px 1.5em; list-style: none;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Servicing :&nbsp;UNIC / BTC transactions and deposit / withdrawal wallets</font></span></li><li style=\"text-align: center; margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px 0px 0px 1.5em; list-style: none;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Deposit opening date : 2021.08.19 (THU) 11:00 (KST)</font></span></li><li style=\"text-align: center; margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px 0px 0px 1.5em; list-style: none;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Transaction opening date : 2021.08.19 (THU) 17:00 (KST)</font></span></li><li style=\"text-align: center; margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px 0px 0px 1.5em; list-style: none;\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\"><font color=\"#000000\">Withdrawal opening date : 2021.08.26 (THU) 11:00 (KST)</font></span></li></ul><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><br></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">UNICUS COIN (UNIC) COMMUNITY</font></p><ul style=\"padding-left: 1.5em; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><li style=\"text-align: center; margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px 0px 0px 1.5em; list-style: none;\"><font color=\"#000000\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\">Homepage : </span><a href=\"http://unic-a.io/\" target=\"_blank\" style=\"margin: 0px; padding: 0px; text-decoration-line: underline;\">http://unic-a.io/</a></font></li><li style=\"text-align: center; margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px 0px 0px 1.5em; list-style: none;\"><font color=\"#000000\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\">White Paper : </span><a href=\"http://unic-a.io/assets/whitepaper/UNICUS_whitepaper_kr.pdf\" target=\"_blank\" style=\"margin: 0px; padding: 0px; text-decoration-line: underline;\">http://unic-a.io/assets/whitepaper/UNICUS_whitepaper_kr.pdf</a></font></li><li style=\"text-align: center; margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px 0px 0px 1.5em; list-style: none;\"><font color=\"#000000\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\">Official Twitter : </span><a href=\"https://twitter.com/UNICUS91643983\" target=\"_blank\" style=\"margin: 0px; padding: 0px; text-decoration-line: underline;\">https://twitter.com/UNICUS91643983</a></font></li><li style=\"text-align: center; margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px 0px 0px 1.5em; list-style: none;\"><font color=\"#000000\"><span style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px;\">Official Telegram : </span><a href=\"https://t.me/UNICUSPROJECT\" target=\"_blank\" style=\"margin: 0px; padding: 0px; text-decoration-line: underline;\">https://t.me/UNICUSPROJECT</a></font></li></ul><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><br></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">Introduction to UNICUS COIN (UNIC)</font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">UNICUS is a new concept digital art management platform that can trade artworks using NFT of Ethereum Blockchain.</font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">The UNICUS ecosystem operates on the basis of the Ethereum blockchain, and the token UNIC issued by UNICUS serves as a key currency for the platform.</font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">UNIC allows you to participate in an auction of NFT artworks or purchase NFT artworks from within the platform.</font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">The NFT of the UNICUS platform is issued only through the Foundation and is minted based on ERC-721.</font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\"><br></font></p><p style=\"text-align: center; margin-right: 0px; margin-left: 0px; padding: 0px; cursor: text; counter-reset: list-1 0 list-2 0 list-3 0 list-4 0 list-5 0 list-6 0 list-7 0 list-8 0 list-9 0; font-family: Helvetica, Arial, sans-serif; font-size: 13px; white-space: pre-wrap;\"><font color=\"#000000\">Thank you.</font></p>', '2021-12-20 09:13:41', '2021-12-20 09:47:50', 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Enable : 1, Disable :2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'demoadmin', 1, '2021-11-07 22:54:33', '2021-11-07 22:54:33'),
(2, 'Testbrand', 1, '2022-02-02 11:37:56', '2022-02-02 11:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Enable : 1, Disable : 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, '3D model', '61e69327b05291642500903.jpg', 1, '2021-10-30 00:48:02', '2022-01-18 04:45:03'),
(2, 'Entertainment', '61e68149b7a2c1642496329.png', 0, '2021-11-09 06:22:40', '2022-02-08 11:14:50'),
(3, 'Video', '61e693807e9241642500992.jpg', 1, '2022-01-18 04:45:26', '2022-02-08 08:20:33'),
(4, 'Art', '61e6a0c6883e01642504390.jpg', 0, '2022-01-18 05:43:10', '2022-02-08 11:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
CREATE TABLE IF NOT EXISTS `collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `image` varchar(200) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(2, 'KANGKO', '62024ebd494d01644318397.jpg', '2022-01-28 03:50:54', '2022-02-08 05:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `community_categories`
--

DROP TABLE IF EXISTS `community_categories`;
CREATE TABLE IF NOT EXISTS `community_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Enable : 1, Disable : 0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `community_comments`
--

DROP TABLE IF EXISTS `community_comments`;
CREATE TABLE IF NOT EXISTS `community_comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `community_comments`
--

INSERT INTO `community_comments` (`id`, `user_id`, `blog_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 5, 7, 'hey', '2021-11-24 16:48:10', '2021-11-24 16:48:10'),
(2, 6, 3, 'test', '2021-12-02 12:44:48', '2021-12-02 12:44:48'),
(3, 6, 3, 'tesfefgge', '2021-12-02 12:44:52', '2021-12-02 12:44:52'),
(4, 6, 3, 'test is test sure', '2021-12-02 12:44:58', '2021-12-02 12:44:58'),
(5, 6, 8, 'asvqwefwqefwq', '2021-12-02 15:07:22', '2021-12-02 15:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_replies`
--

DROP TABLE IF EXISTS `contact_replies`;
CREATE TABLE IF NOT EXISTS `contact_replies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
CREATE TABLE IF NOT EXISTS `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `method_code` int(10) UNSIGNED NOT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `method_currency` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `final_amo` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `detail` text COLLATE utf8mb4_unicode_ci,
  `btc_amo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT '0',
  `admin_feedback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

DROP TABLE IF EXISTS `email_logs`;
CREATE TABLE IF NOT EXISTS `email_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `mail_sender` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_to` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_logs`
--

INSERT INTO `email_logs` (`id`, `user_id`, `mail_sender`, `email_from`, `email_to`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 10, 'php', 'Unicus do-not-reply@viserlab.com', 'unifysofttech@gmail.com', 'Your Account has been Credited', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello Unify SoftTech (unifysofttech)</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\"><div>100.00 USD has been added to your account .</div><div><br></div><div>Transaction Number : U8NBJ53F5VH5</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>100.00&nbsp; USD&nbsp;</b></font></td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">Website Name</a> . All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', '2022-02-04 14:35:14', '2022-02-04 14:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_templates`
--

DROP TABLE IF EXISTS `email_sms_templates`;
CREATE TABLE IF NOT EXISTS `email_sms_templates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci,
  `sms_body` text COLLATE utf8mb4_unicode_ci,
  `shortcodes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_sms_templates`
--

INSERT INTO `email_sms_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'PASS_RESET_CODE', 'Password Reset', 'Password Reset', '<div>We have received a request to reset the password for your account on <b>{{time}} .<br></b></div><div>Requested From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div><div><br></div><br><div><div><div>Your account recovery code is:&nbsp;&nbsp; <font size=\"6\"><b>{{code}}</b></font></div><div><br></div></div></div><div><br></div><div><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><br>', 'Your account recovery code is: {{code}}', ' {\"code\":\"Password Reset Code\",\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2021-01-06 00:49:06'),
(2, 'PASS_RESET_DONE', 'Password Reset Confirmation', 'You have Reset your password', '<div><p>\r\n    You have successfully reset your password.</p><p>You changed from&nbsp; IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}}&nbsp;</b> on <b>{{time}}</b></p><p><b><br></b></p><p><font color=\"#FF0000\"><b>If you did not changed that, Please contact with us as soon as possible.</b></font><br></p></div>', 'Your password has been changed successfully', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-07 10:23:47'),
(3, 'EVER_CODE', 'Email Verification', 'Please verify your email address', '<div><br></div><div>Thanks For join with us. <br></div><div>Please use below code to verify your email address.<br></div><div><br></div><div>Your email verification code is:<font size=\"6\"><b> {{code}}</b></font></div>', 'Your email verification code is: {{code}}', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2021-01-03 23:35:10'),
(4, 'SVER_CODE', 'SMS Verification ', 'Please verify your phone', 'Your phone verification code is: {{code}}', 'Your phone verification code is: {{code}}', '{\"code\":\"Verification code\"}', 0, 1, '2019-09-24 23:04:05', '2020-03-08 01:28:52'),
(5, '2FA_ENABLE', 'Google Two Factor - Enable', 'Google Two Factor Authentication is now  Enabled for Your Account', '<div>You just enabled Google Two Factor Authentication for Your Account.</div><div><br></div><div>Enabled at <b>{{time}} </b>From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div>', 'Your verification code is: {{code}}', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-08 01:42:59'),
(6, '2FA_DISABLE', 'Google Two Factor Disable', 'Google Two Factor Authentication is now  Disabled for Your Account', '<div>You just Disabled Google Two Factor Authentication for Your Account.</div><div><br></div><div>Disabled at <b>{{time}} </b>From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div>', 'Google two factor verification is disabled', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-08 01:43:46'),
(16, 'ADMIN_SUPPORT_REPLY', 'Support Ticket Reply ', 'Reply Support Ticket', '<div><p><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong>A member from our support team has replied to the following ticket:</strong></span></p><p><b><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong><br></strong></span></b></p><p><b>[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</b></p><p>----------------------------------------------</p><p>Here is the reply : <br></p><p> {{reply}}<br></p></div><div><br></div>', '{{subject}}\r\n\r\n{{reply}}\r\n\r\n\r\nClick here to reply:  {{link}}', '{\"ticket_id\":\"Support Ticket ID\", \"ticket_subject\":\"Subject Of Support Ticket\", \"reply\":\"Reply from Staff/Admin\",\"link\":\"Ticket URL For relpy\"}', 1, 1, '2020-06-08 18:00:00', '2020-05-04 02:24:40'),
(206, 'DEPOSIT_COMPLETE', 'Automated Deposit - Successful', 'Deposit Completed Successfully', '<div>Your deposit of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>has been completed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#000000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br></div>', '{{amount}} {{currrency}} Deposit successfully by {{gateway_name}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2020-06-24 18:00:00', '2020-11-17 03:10:00'),
(207, 'DEPOSIT_REQUEST', 'Manual Deposit - User Requested', 'Deposit Request Submitted Successfully', '<div>Your deposit request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>submitted successfully<b> .<br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div>', '{{amount}} Deposit requested by {{method}}. Charge: {{charge}} . Trx: {{trx}}\r\n', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\"}', 1, 1, '2020-05-31 18:00:00', '2020-06-01 18:00:00'),
(208, 'DEPOSIT_APPROVE', 'Manual Deposit - Admin Approved', 'Your Deposit is Approved', '<div>Your deposit request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>is Approved .<b><br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br></div>', 'Admin Approve Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}} transaction : {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2020-06-16 18:00:00', '2020-06-14 18:00:00'),
(209, 'DEPOSIT_REJECT', 'Manual Deposit - Admin Rejected', 'Your Deposit Request is Rejected', '<div>Your deposit request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} has been rejected</b>.<b><br></b></div><br><div>Transaction Number was : {{trx}}</div><div><br></div><div>if you have any query, feel free to contact us.<br></div><br><div><br><br></div>\r\n\r\n\r\n\r\n{{rejection_message}}', 'Admin Rejected Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\",\"rejection_message\":\"Rejection message\"}', 1, 1, '2020-06-09 18:00:00', '2020-06-14 18:00:00'),
(210, 'WITHDRAW_REQUEST', 'Withdraw  - User Requested', 'Withdraw Request Submitted Successfully', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been submitted Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You will get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"4\" color=\"#FF0000\"><b><br></b></font></div><div><font size=\"4\" color=\"#FF0000\"><b>This may take {{delay}} to process the payment.</b></font><br></div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br><br></div>', '{{amount}} {{currency}} withdraw requested by {{method_name}}. You will get {{method_amount}} {{method_currency}} in {{delay}}. Trx: {{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\", \"delay\":\"Delay time for processing\"}', 1, 1, '2020-06-07 18:00:00', '2021-05-08 06:49:06'),
(211, 'WITHDRAW_REJECT', 'Withdraw - Admin Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been Rejected.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You should get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div><div>----</div><div><font size=\"3\"><br></font></div><div><font size=\"3\"> {{amount}} {{currency}} has been <b>refunded </b>to your account and your current Balance is <b>{{post_balance}}</b><b> {{currency}}</b></font></div><div><br></div><div>-----</div><div><br></div><div><font size=\"4\">Details of Rejection :</font></div><div><font size=\"4\"><b>{{admin_details}}</b></font></div><div><br></div><div><br><br><br><br><br><br></div>', 'Admin Rejected Your {{amount}} {{currency}} withdraw request. Your Main Balance {{main_balance}}  {{method}} , Transaction {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\", \"admin_details\":\"Details Provided By Admin\"}', 1, 1, '2020-06-09 18:00:00', '2020-06-14 18:00:00'),
(212, 'WITHDRAW_APPROVE', 'Withdraw - Admin  Approved', 'Withdraw Request has been Processed and your money is sent', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been Processed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You will get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div>-----</div><div><br></div><div><font size=\"4\">Details of Processed Payment :</font></div><div><font size=\"4\"><b>{{admin_details}}</b></font></div><div><br></div><div><br><br><br><br><br></div>', 'Admin Approve Your {{amount}} {{currency}} withdraw request by {{method}}. Transaction {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"admin_details\":\"Details Provided By Admin\"}', 1, 1, '2020-06-10 18:00:00', '2020-06-06 18:00:00'),
(215, 'BAL_ADD', 'Balance Add by Admin', 'Your Account has been Credited', '<div>{{amount}} {{currency}} has been added to your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}&nbsp;</b></font>', '{{amount}} {{currency}} credited in your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 19:14:22', '2021-01-06 00:46:18'),
(216, 'BAL_SUB', 'Balance Subtracted by Admin', 'Your Account has been Debited', '<div>{{amount}} {{currency}} has been subtracted from your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}</b></font>', '{{amount}} {{currency}} debited from your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(217, 'PRODUCT_PAYMENT_COMPLETE', 'Product Payment complete', 'Product Payment complete', '<div>Your deposit of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>has been completed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#000000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br></div>', '{{amount}} {{currrency}} Deposit successfully by {{gateway_name}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Product Amount \",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Payment Method Name\",\"method_currency\":\"Payment Method Currency\",\"method_amount\":\"Payment Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, NULL, NULL),
(218, 'PAYMENT_USER', 'Payment User', 'Payment User', '<div>{{amount}} {{currency}} has been added to your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}&nbsp;</b></font>', '{{amount}} {{currency}} credited in your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Amount \",\"currency\":\"Site Currency\", \"order_number\" : \"Order Number\",\"charge\" : \"Charge\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, NULL, NULL),
(220, 'ORDER_REFUND', 'Order Refund', 'Order Refund', '<div>{{amount}} {{currency}} has been added to your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}&nbsp;</b></font>', '{{amount}} {{currency}} credited in your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Amount \",\"currency\":\"Site Currency\", \"order_number\" : \"Order Number\",\"post_balance\":\"Users Balance After this operation\"}', 1, 1, NULL, NULL),
(221, 'ORDER_BAL_SUB', 'Balance Sub for Order Refund', 'Balance Sub for Order Refund', '<div>{{amount}} {{currency}} has been added to your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}&nbsp;</b></font>', '{{amount}} {{currency}} credited in your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Amount \",\"currency\":\"Site Currency\", \"order_number\" : \"Order Number\",\"post_balance\":\"Users Balance After this operation\"}', 1, 1, NULL, NULL),
(222, 'PRODUCT_PAYMENT_WALLET', 'Product Payment wallet', 'Product Payment wallet', '<div>Your deposit of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>has been completed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#000000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br></div>', '{{amount}} {{currrency}} Deposit successfully by {{gateway_name}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Product Amount \",\"currency\":\"Site Currency\",\"post_balance\":\"Users Balance After this operation\"}', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

DROP TABLE IF EXISTS `extensions`;
CREATE TABLE IF NOT EXISTS `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci,
  `shortcode` text COLLATE utf8mb4_unicode_ci COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, NULL, '2019-10-18 23:16:05', '2021-05-18 05:37:12'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\r\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\r\n<div class=\"g-recaptcha\" data-sitekey=\"{{sitekey}}\" data-callback=\"verifyCaptcha\"></div>\r\n<div id=\"g-recaptcha-error\"></div>', '{\"sitekey\":{\"title\":\"Site Key\",\"value\":\"6Lfpm3cUAAAAAGIjbEJKhJNKS4X1Gns9ANjh8MfH\"}}', 'recaptcha.png', 0, NULL, '2019-10-18 23:16:05', '2021-09-11 10:09:16'),
(3, 'custom-captcha', 'Custom Captcha', 'Just Put Any Random String', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, NULL, '2019-10-18 23:16:05', '2021-09-11 10:09:13'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, NULL, '2021-05-04 10:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 1, NULL, NULL, '2021-09-07 09:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

DROP TABLE IF EXISTS `frontends`;
CREATE TABLE IF NOT EXISTS `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_keys` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_values` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"cryplab\",\"crypto\",\"crypto marketplace\",\"bitcoin market place\"],\"description\":\"111 Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit\",\"social_title\":\"CrypLab - Crypto Marketplace And Auction Platform\",\"social_description\":\"111 Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit ff\",\"image\":\"6147446669c3c1632060518.jpg\"}', '2020-07-04 23:42:52', '2021-12-01 10:46:48'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\",\"description\":\"fdg sdfgsdf g ggg\",\"about_icon\":\"<i class=\\\"las la-address-card\\\"><\\/i>\",\"background_image\":\"60951a84abd141620384388.png\",\"about_image\":\"5f9914e907ace1603867881.jpg\"}', '2020-10-28 00:51:20', '2021-05-07 10:16:28'),
(25, 'blog.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Hic tenetur nihil ex. Doloremque ipsa velit, ea molestias expedita sed voluptatem ex voluptatibus temporibus sequi. sddd\"}', '2020-10-28 00:51:34', '2020-10-28 00:52:52'),
(26, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Aspernatur tempore quisquam tempora eius incidunt dignissimos maxime\",\"description\":\"<div class=\\\"post__header\\\" style=\\\"margin-bottom:40px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;\\\"><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla213, sans-serif;\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla213, sans-serif;\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla213, sans-serif;\\\">Vitae optio minima nulla iusto, praesentium, natus exercitationem maiores qui temporibus consequatur, fuga repudiandae. Rem mollitia suscipit blanditiis, at porro recusandae vitae.<\\/p><\\/div><blockquote class=\\\"post__quote\\\" style=\\\"margin-bottom:30px;font-size:24px;line-height:1.5;font-family:\'Josefin Sans\', sans-serif;color:rgb(220,243,255);font-style:italic;text-align:center;padding:0px 30px;border-left:3px solid rgb(255,106,0);background-color:rgb(4,36,68);\\\">\\u201c Works together with striker consulting firms active in USA. Globally we work with more than 150 leading consulting firms and with a select number of partners. \\u201d<\\/blockquote><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Explicabo nobis dolorum, voluptates provident quasi harum optio nesciunt est accusantium eos soluta fugit illo vitae error numquam, sit ipsa quas nihil.<\\/span><\\/p>\",\"blog_image\":\"61373578e65cc1631008120.jpg\"}', '2020-10-28 00:57:19', '2021-11-16 05:11:05'),
(27, 'contact_us.content', '{\"title\":\"Drop Us Line\",\"short_details\":\"Placeat accusantium expedita vitae ducimus corrupti incidunt commodi laboriosam eum repellendus ullam perspiciatis quod est\",\"email_address\":\"demo@site.com\",\"contact_details\":\"1205 Park Avenue South, Kips Bay New York City\",\"contact_number\":\"+0123456789\",\"latitude\":\"43\",\"longitude\":\"656\"}', '2020-10-28 00:59:19', '2021-09-07 08:56:04'),
(28, 'counter.content', '{\"title\":\"Our Total Coverage\",\"heading\":\"We are All Over The World\",\"sub_heading\":\"Soluptatem praesentium dolor quae et perferendis? Tempore reprehenderit unde nam placeat sed, iure labore delectus vel non, accusamus repellendus.\"}', '2020-10-28 01:04:02', '2021-08-26 09:56:03'),
(30, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Aspernatur tempore quisquam tempora eius incidunt dignissimos maxime\",\"description\":\"<div class=\\\"post__header\\\" style=\\\"margin-bottom:40px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;\\\"><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla519, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla519, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla519, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Vitae optio minima nulla iusto, praesentium, natus exercitationem maiores qui temporibus consequatur, fuga repudiandae. Rem mollitia suscipit blanditiis, at porro recusandae vitae.<\\/span><\\/p><\\/div><blockquote class=\\\"post__quote\\\" style=\\\"margin-bottom:30px;font-size:24px;line-height:1.5;font-family:\'Josefin Sans\', sans-serif;color:rgb(220,243,255);font-style:italic;text-align:center;padding:0px 30px;border-left:3px solid rgb(255,106,0);background-color:rgb(4,36,68);\\\">\\u201c Works together with striker consulting firms active in USA. Globally we work with more than 150 leading consulting firms and with a select number of partners. \\u201d<\\/blockquote><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Explicabo nobis dolorum, voluptates provident quasi harum optio nesciunt est accusantium eos soluta fugit illo vitae error numquam, sit ipsa quas nihil.<\\/span><\\/p>\",\"blog_image\":\"613c878b7f61e1631356811.jpg\"}', '2020-10-31 00:39:05', '2021-11-16 05:10:22'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"lab la-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.google.com\\/\"}', '2020-11-12 04:07:30', '2021-09-08 12:47:42'),
(33, 'feature.content', '{\"heading\":\"asdf\",\"sub_heading\":\"asdf\"}', '2021-01-03 23:40:54', '2021-01-03 23:40:55'),
(34, 'feature.element', '{\"title\":\"asdf\",\"description\":\"asdf\",\"feature_icon\":\"asdf\"}', '2021-01-03 23:41:02', '2021-01-03 23:41:02'),
(35, 'service.element', '{\"trx_type\":\"withdraw\",\"service_icon\":\"<i class=\\\"las la-highlighter\\\"><\\/i>\",\"title\":\"asdfasdf\",\"description\":\"asdfasdfasdfasdf\"}', '2021-03-06 01:12:10', '2021-03-06 01:12:10'),
(36, 'service.content', '{\"trx_type\":\"withdraw\",\"heading\":\"asdf fffff\",\"sub_heading\":\"asdf asdfasdf\"}', '2021-03-06 01:27:34', '2021-03-06 02:19:39'),
(39, 'banner.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse voluptatum eaque earum quos quia? Id aspernatur ratione, voluptas nulla rerum laudantium neque ipsam eaque\"}', '2021-05-02 06:09:30', '2021-05-02 06:09:30'),
(41, 'cookie.data', '{\"link\":\"#\",\"description\":\"<font color=\\\"#ffffff\\\" face=\\\"Exo, sans-serif\\\"><span style=\\\"font-size: 18px;\\\">We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.<\\/span><\\/font><br>\",\"status\":1}', '2020-07-04 23:42:52', '2021-06-06 09:43:37'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">How do we protect your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">All provided delicate\\/credit data is sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Do we disclose any information to outside parties?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Changes to our Privacy Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">How long we retain your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">What we don\\u2019t do with your data<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\"}', '2021-06-09 08:50:42', '2021-06-09 08:50:42'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We claim all authority to dismiss, end, or handicap any help with or without cause per administrator discretion. This is a Complete independent facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by submitting solicitations or protests we will impair your record. The solitary time you should reach us about the seaward facilitating is if there is an issue with the worker. We have not many substance limitations and everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Configuration requests - If you have a fully managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs, DNS, and httpd configurations.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Software requests - Cpanel Extension Installation will be granted as long as it does not interfere with the security, stability, and performance of other users on the server.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Emergency Support - We do not provide emergency support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Webmaster help - We do not offer any support for webmaster related issues and difficulty including coding, &amp; installs, Error solving. if there is an issue where a library or configuration of the server then we can help you if it\'s possible from our end.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Backups - We keep backups but we are not responsible for data loss, you are fully responsible for all backups.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">We Don\'t support any child porn or such material.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No spam-related sites or material, such as email lists, mass mail programs, and scripts, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No harassing material that may cause people to retaliate against you.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No phishing pages.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">You may not run any exploitation script from the server. reason can be terminated immediately.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">If Anyone attempting to hack or exploit the server by using your script or hosting, we will terminate your account to keep safe other users.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious Botnets are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Spam, mass mailing, or email marketing in any way are strictly forbidden here.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious hacking materials, trojans, viruses, &amp; malicious bots running or for download are forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Resource and cronjob abuse is forbidden and will result in suspension or termination.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Php\\/CGI proxies are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">CGI-IRC is strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No fake or disposal mailers, mass mailing, mail bombers, SMS bombers, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">NO CREDIT OR REFUND will be granted for interruptions of service, due to User Agreement violations.<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Terms &amp; Conditions for Users<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Before getting to this site, you are consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Support<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Whenever you have downloaded our item, you may get in touch with us for help through email and we will give a valiant effort to determine your issue. We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and Livechat.<\\/p><p class=\\\"my-3 font-18 font-weight-bold\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">On the off chance that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Hang tight for additional update discharge.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Or on the other hand, enlist a specialist (We offer customization for extra charges).<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Ownership<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not guarantee scholarly or selective possession of any of our items, altered or unmodified. All items are property, we created them. Our items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no occasion will our juridical individual be subject to any harms including, however not restricted to, immediate, roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the utilization of or powerlessness to utilize our items.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Warranty<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t offer any guarantee or assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component, as we can not ensure that our systems will work with all program mixes.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Unauthorized\\/Illegal Usage<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not utilize our things for any illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale (counting yet not restricted to copyright laws) just as the laws of your nation and International law. Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality, illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of the offered on our things, or admittance to the administration without the express composed consent by us or item proprietor.<br \\/><br \\/>Our Members are liable for all substance posted on the discussion and demo and movement that happens under your record.<br \\/><br \\/>We hold the chance of hindering your participation account quickly if we will think about a particularly not allowed conduct.<br \\/><br \\/>If you make a record on our site, you are liable for keeping up the security of your record, and you are completely answerable for all exercises that happen under the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved employments of your record or some other penetrates of security.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Fiverr, Seoclerks Sellers Or Affiliates<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We do NOT ensure full SEO campaign conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires time touchy outcomes, utilize Our SEO Services at your own risk.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Payment\\/Refund Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">No refund or cash back will be made. After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t document a debate or a chargeback against us in any way, shape, or form.<br \\/><br \\/>If you document a debate or chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your record. There are no special cases.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Free Balance \\/ Coupon Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We offer numerous approaches to get FREE Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free Balance from your record balance, and your record balance becomes negative, at that point the record will naturally be suspended. If your record is suspended because of a negative Balance you can request to make a custom payment to settle your equilibrium to actuate your record.<\\/p><\\/div>\"}', '2021-06-09 08:51:18', '2021-06-09 08:51:18'),
(44, 'banner.element', '{\"has_image\":[\"1\"],\"heading\":\"Simple and Easy\",\"sub_heading\":\"Our Best Collection\",\"description\":\"Consectetur adipisicing elit. Officiis soluta sint quaerat sit pariatur molestias odit quo eveniet, at harum, illum aperiam qui fugiat debitis in iste. Explicabo, doloribus dolor.\",\"btn_name\":\"Start Shopping\",\"btn_url\":\"#\",\"banner_image\":\"6127634fd3c2e1629971279.png\"}', '2021-08-26 09:17:59', '2021-08-26 09:17:59'),
(45, 'banner.element', '{\"has_image\":[\"1\"],\"heading\":\"Simple and Easy\",\"sub_heading\":\"Our Best Collection\",\"description\":\"Consectetur adipisicing elit. Officiis soluta sint quaerat sit pariatur molestias odit quo eveniet, at harum, illum aperiam qui fugiat debitis in iste. Explicabo, doloribus dolor.\",\"btn_name\":\"Start Shopping\",\"btn_url\":\"#\",\"banner_image\":\"6127636d13fb31629971309.png\"}', '2021-08-26 09:18:29', '2021-08-26 09:18:29'),
(46, 'client.content', '{\"has_image\":\"1\",\"client_image\":\"612766c5bb7881629972165.png\"}', '2021-08-26 09:32:45', '2021-08-26 09:32:45'),
(47, 'client.element', '{\"testimonial\":\"Consectetur adipisicing elit. Placeat natus ipsa suscipit perferendis numquam, quaerat blanditiis repellat officia, totam tempore voluptatibus magni voluptate consequatur beatae consectetur? Numquam perspiciatis nihil distinctio?\",\"name\":\"Md jeo\"}', '2021-08-26 09:32:59', '2021-08-26 09:32:59'),
(48, 'client.element', '{\"testimonial\":\"Consectetur adipisicing elit. Placeat natus ipsa suscipit perferendis numquam, quaerat blanditiis repellat officia, totam tempore voluptatibus magni voluptate consequatur beatae consectetur? Numquam perspiciatis nihil distinctio?\",\"name\":\"Md Joni\"}', '2021-08-26 09:33:09', '2021-08-26 09:33:09'),
(49, 'client.element', '{\"testimonial\":\"Consectetur adipisicing elit. Placeat natus ipsa suscipit perferendis numquam, quaerat blanditiis repellat officia, totam tempore voluptatibus magni voluptate consequatur beatae consectetur? Numquam perspiciatis nihil distinctio?\",\"name\":\"Rx Razib\"}', '2021-08-26 09:33:26', '2021-08-26 09:33:26'),
(50, 'how_to_work.content', '{\"heading\":\"How to Start\",\"sub_heading\":\"Soluptatem praesentium dolor quae et perferendis? Tempore reprehenderit unde nam placeat sed, iure labore delectus vel non, accusamus repellendus.\"}', '2021-08-26 09:42:03', '2021-08-26 09:42:03'),
(51, 'how_to_work.element', '{\"title\":\"Create an Account\",\"sub_title\":\"Quibusdam eaque quod ipsa, expedita sit commodi quas\",\"work_icon\":\"<i class=\\\"las la-user\\\"><\\/i>\"}', '2021-08-26 09:42:19', '2021-08-26 09:42:19'),
(52, 'how_to_work.element', '{\"title\":\"Purchase Products\",\"sub_title\":\"Quibusdam eaque quod ipsa, expedita sit commodi quas\",\"work_icon\":\"<i class=\\\"las la-shopping-basket\\\"><\\/i>\"}', '2021-08-26 09:42:36', '2021-08-26 09:42:36'),
(53, 'how_to_work.element', '{\"title\":\"Enjoy Delivery\",\"sub_title\":\"Quibusdam eaque quod ipsa, expedita sit commodi quas\",\"work_icon\":\"<i class=\\\"las la-truck\\\"><\\/i>\"}', '2021-08-26 09:42:51', '2021-08-26 09:42:51'),
(54, 'counter.element', '{\"counter_digit\":\"100\",\"title\":\"Total Product\",\"counter_icon\":\"<i class=\\\"las la-history\\\"><\\/i>\"}', '2021-08-26 09:56:25', '2021-08-26 10:02:53'),
(55, 'counter.element', '{\"counter_digit\":\"99\",\"title\":\"Total User\",\"counter_icon\":\"<i class=\\\"lar la-user\\\"><\\/i>\"}', '2021-08-26 09:56:45', '2021-08-26 10:02:57'),
(56, 'counter.element', '{\"counter_digit\":\"5\",\"title\":\"Total Partner\",\"counter_icon\":\"<i class=\\\"las la-user-cog\\\"><\\/i>\"}', '2021-08-26 09:57:09', '2021-08-26 10:03:01'),
(57, 'counter.element', '{\"counter_digit\":\"45\",\"title\":\"Total Product\",\"counter_icon\":\"<i class=\\\"lab la-hire-a-helper\\\"><\\/i>\"}', '2021-08-26 09:57:28', '2021-08-26 10:03:05'),
(58, 'partner.content', '{\"title\":\"We have Global Sponsor\",\"heading\":\"Become a Partner\",\"sub_heading\":\"Soluptatem praesentium dolor quae et perferendis? Tempore reprehenderit unde nam placeat sed, iure labore delectus vel non, accusamus repellendus.\",\"description\":\"<ul class=\\\"partner--list\\\" style=\\\"color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;background-color:rgb(4,36,68);\\\"><li style=\\\"list-style:none;padding:5px 0px 5px 20px;\\\">Perspiciatis, asperiores numquam?<\\/li><li style=\\\"list-style:none;padding:5px 0px 5px 20px;\\\">Odit quaerat recusandae alias facilis<\\/li><li style=\\\"list-style:none;padding:5px 0px 0px 20px;\\\">Ex voluptas nihil culpa possimus<\\/li><\\/ul>\"}', '2021-08-26 10:11:49', '2021-08-26 10:11:49'),
(59, 'partner.element', '{\"has_image\":\"1\",\"patrner_image\":\"61276ff98b6ce1629974521.png\"}', '2021-08-26 10:12:01', '2021-08-26 10:12:01'),
(60, 'partner.element', '{\"has_image\":\"1\",\"patrner_image\":\"61277000838951629974528.png\"}', '2021-08-26 10:12:08', '2021-08-26 10:12:08'),
(61, 'partner.element', '{\"has_image\":\"1\",\"patrner_image\":\"61277006093e21629974534.png\"}', '2021-08-26 10:12:14', '2021-08-26 10:12:14'),
(62, 'partner.element', '{\"has_image\":\"1\",\"patrner_image\":\"6127700b7e0271629974539.png\"}', '2021-08-26 10:12:19', '2021-08-26 10:12:19'),
(63, 'partner.element', '{\"has_image\":\"1\",\"patrner_image\":\"61277010f0a101629974544.png\"}', '2021-08-26 10:12:24', '2021-08-26 10:12:25'),
(64, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Tempore quisquam tempora eius incidunt dignissimos maxime\",\"description\":\"<div class=\\\"post__header\\\" style=\\\"margin-bottom:40px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;\\\"><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Vitae optio minima nulla iusto, praesentium, natus exercitationem maiores qui temporibus consequatur, fuga repudiandae. Rem mollitia suscipit blanditiis, at porro recusandae vitae.<\\/span><\\/p><\\/div><blockquote class=\\\"post__quote\\\" style=\\\"margin-bottom:30px;font-size:24px;line-height:1.5;font-family:\'Josefin Sans\', sans-serif;color:rgb(220,243,255);font-style:italic;text-align:center;padding:0px 30px;border-left:3px solid rgb(255,106,0);background-color:rgb(4,36,68);\\\">\\u201c Works together with striker consulting firms active in USA. Globally we work with more than 150 leading consulting firms and with a select number of partners. \\u201d<\\/blockquote><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Explicabo nobis dolorum, voluptates provident quasi harum optio nesciunt est accusantium eos soluta fugit illo vitae error numquam, sit ipsa quas nihil<\\/span><\\/p>\",\"blog_image\":\"613c87971f7e21631356823.jpg\"}', '2021-09-07 09:20:26', '2021-11-16 05:10:03'),
(65, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Tempore quisquam tempora eius incidunt dignissimos maxime\",\"description\":\"<div class=\\\"post__header\\\" style=\\\"margin-bottom:40px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;\\\"><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Vitae optio minima nulla iusto, praesentium, natus exercitationem maiores qui temporibus consequatur, fuga repudiandae. Rem mollitia suscipit blanditiis, at porro recusandae vitae.<\\/span><\\/p><\\/div><blockquote class=\\\"post__quote\\\" style=\\\"margin-bottom:30px;font-size:24px;line-height:1.5;font-family:\'Josefin Sans\', sans-serif;color:rgb(220,243,255);font-style:italic;text-align:center;padding:0px 30px;border-left:3px solid rgb(255,106,0);background-color:rgb(4,36,68);\\\">\\u201c Works together with striker consulting firms active in USA. Globally we work with more than 150 leading consulting firms and with a select number of partners. \\u201d<\\/blockquote><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Explicabo nobis dolorum, voluptates provident quasi harum optio nesciunt est accusantium eos soluta fugit illo vitae error numquam, sit ipsa quas nihil<\\/span><\\/p>\",\"blog_image\":\"613c87a54976f1631356837.jpg\"}', '2021-09-07 09:20:26', '2021-11-16 05:11:30'),
(66, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Tempore quisquam tempora eius incidunt dignissimos maxime\",\"description\":\"<div class=\\\"post__header\\\" style=\\\"margin-bottom:40px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;\\\"><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Vitae optio minima nulla iusto, praesentium, natus exercitationem maiores qui temporibus consequatur, fuga repudiandae. Rem mollitia suscipit blanditiis, at porro recusandae vitae.<\\/span><\\/p><\\/div><blockquote class=\\\"post__quote\\\" style=\\\"margin-bottom:30px;font-size:24px;line-height:1.5;font-family:\'Josefin Sans\', sans-serif;color:rgb(220,243,255);font-style:italic;text-align:center;padding:0px 30px;border-left:3px solid rgb(255,106,0);background-color:rgb(4,36,68);\\\">\\u201c Works together with striker consulting firms active in USA. Globally we work with more than 150 leading consulting firms and with a select number of partners. \\u201d<\\/blockquote><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Explicabo nobis dolorum, voluptates provident quasi harum optio nesciunt est accusantium eos soluta fugit illo vitae error numquam, sit ipsa quas nihil<\\/span><\\/p>\",\"blog_image\":\"613c87ad143921631356845.jpg\"}', '2021-09-07 09:20:26', '2021-11-16 05:09:42'),
(67, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Tempore quisquam tempora eius incidunt dignissimos maxime\",\"description\":\"<div class=\\\"post__header\\\" style=\\\"margin-bottom:40px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;\\\"><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Vitae optio minima nulla iusto, praesentium, natus exercitationem maiores qui temporibus consequatur, fuga repudiandae. Rem mollitia suscipit blanditiis, at porro recusandae vitae.<\\/span><\\/p><\\/div><blockquote class=\\\"post__quote\\\" style=\\\"margin-bottom:30px;font-size:24px;line-height:1.5;font-family:\'Josefin Sans\', sans-serif;color:rgb(220,243,255);font-style:italic;text-align:center;padding:0px 30px;border-left:3px solid rgb(255,106,0);background-color:rgb(4,36,68);\\\">\\u201c Works together with striker consulting firms active in USA. Globally we work with more than 150 leading consulting firms and with a select number of partners. \\u201d<\\/blockquote><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Explicabo nobis dolorum, voluptates provident quasi harum optio nesciunt est accusantium eos soluta fugit illo vitae error numquam, sit ipsa quas nihil<\\/span><\\/p>\",\"blog_image\":\"613c87b4c53701631356852.jpg\"}', '2021-09-07 09:20:26', '2021-11-16 05:12:05');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(68, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Tempore quisquam tempora eius incidunt dignissimos maxime\",\"description\":\"<div class=\\\"post__header\\\" style=\\\"margin-bottom:40px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;\\\"><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Vitae optio minima nulla iusto, praesentium, natus exercitationem maiores qui temporibus consequatur, fuga repudiandae. Rem mollitia suscipit blanditiis, at porro recusandae vitae.<\\/span><\\/p><\\/div><blockquote class=\\\"post__quote\\\" style=\\\"margin-bottom:30px;font-size:24px;line-height:1.5;font-family:\'Josefin Sans\', sans-serif;color:rgb(220,243,255);font-style:italic;text-align:center;padding:0px 30px;border-left:3px solid rgb(255,106,0);background-color:rgb(4,36,68);\\\">\\u201c Works together with striker consulting firms active in USA. Globally we work with more than 150 leading consulting firms and with a select number of partners. \\u201d<\\/blockquote><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Explicabo nobis dolorum, voluptates provident quasi harum optio nesciunt est accusantium eos soluta fugit illo vitae error numquam, sit ipsa quas nihil<\\/span><\\/p>\",\"blog_image\":\"613c87bbe2cd81631356859.jpg\"}', '2021-09-07 09:20:26', '2021-11-16 05:12:32'),
(69, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Tempore quisquam tempora eius incidunt dignissimos maxime\",\"description\":\"<div class=\\\"post__header\\\" style=\\\"margin-bottom:40px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;\\\"><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Asperiores nisi voluptates enim numquam vel recusandae consequatur libero, laboriosam possimus hic officiis voluptatum reprehenderit placeat voluptatibus aspernatur tempore quisquam tempora eius incidunt dignissimos maxime praesentium veniam. Veniam, sapiente.<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;font-family:\'Fira Sans Condensed\', Bangla954, sans-serif;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Vitae optio minima nulla iusto, praesentium, natus exercitationem maiores qui temporibus consequatur, fuga repudiandae. Rem mollitia suscipit blanditiis, at porro recusandae vitae.<\\/span><\\/p><\\/div><blockquote class=\\\"post__quote\\\" style=\\\"margin-bottom:30px;font-size:24px;line-height:1.5;font-family:\'Josefin Sans\', sans-serif;color:rgb(220,243,255);font-style:italic;text-align:center;padding:0px 30px;border-left:3px solid rgb(255,106,0);background-color:rgb(4,36,68);\\\">\\u201c Works together with striker consulting firms active in USA. Globally we work with more than 150 leading consulting firms and with a select number of partners. \\u201d<\\/blockquote><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Architecto quis nobis repudiandae porro perferendis quisquam, ut exercitationem quae aliquid eveniet. Recusandae officia alias sapiente ullam quae veniam optio exercitationem incidunt nisi totam reiciendis expedita harum vel debitis ad quam ut rem porro ratione voluptatem quod, laboriosam ducimus magni. Molestias, distinctio!<\\/span><\\/p><p style=\\\"margin-top:-12px;margin-bottom:30px;color:rgb(164,189,206);font-family:\'Fira Sans Condensed\', sans-serif;font-size:16px;\\\"><span style=\\\"background-color:rgb(255,255,255);\\\">Explicabo nobis dolorum, voluptates provident quasi harum optio nesciunt est accusantium eos soluta fugit illo vitae error numquam, sit ipsa quas nihil<\\/span><\\/p>\",\"blog_image\":\"613c87c3c59791631356867.jpg\"}', '2021-09-07 09:20:26', '2021-11-16 05:09:01'),
(70, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"lab la-twitter\\\"><\\/i>\",\"url\":\"#\"}', '2021-09-08 12:48:39', '2021-09-08 12:48:39'),
(71, 'social_icon.element', '{\"title\":\"instagram\",\"social_icon\":\"<i class=\\\"lab la-instagram\\\"><\\/i>\",\"url\":\"#\"}', '2021-09-08 12:48:51', '2021-09-08 12:48:51'),
(72, 'social_icon.element', '{\"title\":\"behance\",\"social_icon\":\"<i class=\\\"lab la-behance\\\"><\\/i>\",\"url\":\"#\"}', '2021-09-08 12:49:02', '2021-09-08 12:49:02'),
(73, 'social_icon.element', '{\"title\":\"pinterest\",\"social_icon\":\"<i class=\\\"lab la-pinterest\\\"><\\/i>\",\"url\":\"#\"}', '2021-09-08 12:49:17', '2021-09-08 12:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

DROP TABLE IF EXISTS `gateways`;
CREATE TABLE IF NOT EXISTS `gateways` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` int(10) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text COLLATE utf8mb4_unicode_ci,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci,
  `crypto` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `input_form` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `code`, `name`, `alias`, `image`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `input_form`, `created_at`, `updated_at`) VALUES
(1, 101, 'Paypal', 'Paypal', '5f6f1bd8678601601117144.jpg', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:04:38'),
(2, 102, 'Perfect Money', 'PerfectMoney', '5f6f1d2a742211601117482.jpg', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:35:33'),
(3, 103, 'Stripe Hosted', 'Stripe', '5f6f1d4bc69e71601117515.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:48:36'),
(4, 104, 'Skrill', 'Skrill', '5f6f1d41257181601117505.jpg', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:30:16'),
(5, 105, 'PayTM', 'Paytm', '5f6f1d1d3ec731601117469.jpg', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 03:00:44'),
(6, 106, 'Payeer', 'Payeer', '5f6f1bc61518b1601117126.jpg', 0, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, NULL, '2019-09-14 13:14:22', '2020-12-28 01:26:58'),
(7, 107, 'PayStack', 'Paystack', '5f7096563dfb71601214038.jpg', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:49:51'),
(8, 108, 'VoguePay', 'Voguepay', '5f6f1d5951a111601117529.jpg', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:22:38'),
(9, 109, 'Flutterwave', 'Flutterwave', '5f6f1b9e4bb961601117086.jpg', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-06-05 11:37:45'),
(10, 110, 'RazorPay', 'Razorpay', '5f6f1d3672dd61601117494.jpg', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:51:32'),
(11, 111, 'Stripe Storefront', 'StripeJs', '5f7096a31ed9a1601214115.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:53:10'),
(12, 112, 'Instamojo', 'Instamojo', '5f6f1babbdbb31601117099.jpg', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:56:20'),
(13, 501, 'Blockchain', 'Blockchain', '5f6f1b2b20c6f1601116971.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:25:00'),
(14, 502, 'Block.io', 'Blockio', '5f6f19432bedf1601116483.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":false,\"value\":\"1658-8015-2e5e-9afb\"},\"api_pin\":{\"title\":\"API PIN\",\"global\":true,\"value\":\"75757575\"}}', '{\"BTC\":\"BTC\",\"LTC\":\"LTC\"}', 1, '{\"cron\":{\"title\": \"Cron URL\",\"value\":\"ipn.Blockio\"}}', NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:31:09'),
(15, 503, 'CoinPayments', 'Coinpayments', '5f6f1b6c02ecd1601117036.jpg', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:07:14'),
(16, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', '5f6f1b94e9b2b1601117076.jpg', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"6515561\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:07:44'),
(17, 505, 'Coingate', 'Coingate', '5f6f1b5fe18ee1601117023.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:49:30'),
(18, 506, 'Coinbase Commerce', 'CoinbaseCommerce', '5f6f1b4c774af1601117004.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:02:47'),
(24, 113, 'Paypal Express', 'PaypalSdk', '5f6f1bec255c61601117164.jpg', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-20 23:01:08'),
(25, 114, 'Stripe Checkout', 'StripeV3', '5f709684736321601214084.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:58:38'),
(27, 115, 'Mollie', 'Mollie', '5f6f1bb765ab11601117111.jpg', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:44:45'),
(30, 116, 'Cashmaal', 'Cashmaal', '60d1a0b7c98311624350903.png', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, NULL, '2021-06-22 08:05:04'),
(36, 119, 'Mercado Pago', 'MercadoPago', '60f2ad85a82951626516869.png', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"3Vee5S2F\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, NULL, '2021-07-17 09:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

DROP TABLE IF EXISTS `gateway_currencies`;
CREATE TABLE IF NOT EXISTS `gateway_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int(10) DEFAULT NULL,
  `gateway_alias` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `max_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) NOT NULL DEFAULT '0.00',
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_parameter` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sitename` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_price` decimal(28,8) DEFAULT '0.00000000',
  `coin_rate_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `percentage_charge` decimal(28,8) DEFAULT '0.00000000',
  `charge_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Enable : 1, Disable : 2',
  `fixed_charge` decimal(28,8) DEFAULT '0.00000000',
  `search_max` decimal(28,8) DEFAULT NULL,
  `featured_price` decimal(28,8) DEFAULT '0.00000000',
  `email_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci,
  `sms_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text COLLATE utf8mb4_unicode_ci COMMENT 'email configuration',
  `sms_config` text COLLATE utf8mb4_unicode_ci,
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms notification, 0 - dont send, 1 - send',
  `force_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `secure_password` tinyint(1) NOT NULL DEFAULT '0',
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `registration` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sys_version` text COLLATE utf8mb4_unicode_ci,
  `last_cron_run` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `sitename`, `btc_price`, `coin_rate_api`, `cur_text`, `cur_sym`, `percentage_charge`, `charge_status`, `fixed_charge`, `search_max`, `featured_price`, `email_from`, `email_template`, `sms_api`, `base_color`, `mail_config`, `sms_config`, `ev`, `en`, `sv`, `sn`, `force_ssl`, `secure_password`, `agree`, `registration`, `active_template`, `sys_version`, `last_cron_run`, `created_at`, `updated_at`) VALUES
(1, 'Unicus', '45250.69000000', '8403a4757392857364ba418cba68c812d3acc83bdcd0c6e0405ccf481ea1be80', 'USD', '$', '3.00000000', 1, '0.10000000', '65.00000000', '8.00000000', 'do-not-reply@viserlab.com', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">Website Name</a> . All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{name}}, {{message}}', 'FF6A00', '{\"name\":\"php\"}', '{\"clickatell_api_key\":\"----------------------------\",\"infobip_username\":\"--------------\",\"infobip_password\":\"----------------------\",\"message_bird_api_key\":\"-------------------\",\"nexmo_api_key\":\"----------------------\",\"nexmo_api_secret\":\"----------------------\",\"sms_broadcast_username\":\"----------------------\",\"sms_broadcast_password\":\"-----------------------------\",\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\",\"text_magic_username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\",\"name\":\"textMagic\"}', 0, 1, 0, 0, 0, 0, 1, 1, 'basic', NULL, '2021-09-15 11:40:12', NULL, '2021-09-19 08:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `home_text_editor`
--

DROP TABLE IF EXISTS `home_text_editor`;
CREATE TABLE IF NOT EXISTS `home_text_editor` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `body` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_text_editor`
--

INSERT INTO `home_text_editor` (`id`, `body`, `created_at`, `updated_at`) VALUES
(1, '<div class=\"ql-editor\" contenteditable=\"true\"><h1 class=\"ql-align-center\"><span class=\"ql-size-large\">UNICUS</span></h1><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">Lorem Ipsum</strong><span class=\"ql-size-large\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </span></p><p class=\"ql-align-center\"><br></p><iframe class=\"ql-video ql-align-center\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.youtube.com/embed/9xwazD5SyVg?showinfo=0\"></iframe><p class=\"ql-align-center\"><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', NULL, '2022-01-01 04:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `text_align`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '5f15968db08911595250317.png', 0, 0, '2020-07-06 03:47:55', '2021-05-18 05:37:23'),
(10, 'Spanish', 'es', NULL, 0, 0, '2021-09-11 10:16:41', '2021-09-11 10:16:41'),
(11, 'KOREA', 'kr', NULL, 0, 0, '2022-02-04 14:43:35', '2022-02-04 14:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `metamask_transactions`
--

DROP TABLE IF EXISTS `metamask_transactions`;
CREATE TABLE IF NOT EXISTS `metamask_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(250) NOT NULL DEFAULT '',
  `transaction_hash` varchar(250) NOT NULL DEFAULT '',
  `signature` varchar(250) NOT NULL DEFAULT '',
  `event` char(2) NOT NULL DEFAULT '' COMMENT 'AS: Auction Start, AE: Auction End, PB: Place Bid',
  `token_id` varchar(20) NOT NULL DEFAULT '',
  `account_address` varchar(250) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_bidding_id` int(11) NOT NULL DEFAULT '0',
  `block_no` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` varchar(200) NOT NULL DEFAULT '',
  `from_address` varchar(200) NOT NULL DEFAULT '',
  `to_address` varchar(200) NOT NULL DEFAULT '',
  `gas_price` varchar(150) NOT NULL DEFAULT '',
  `amount` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metamask_transactions`
--

INSERT INTO `metamask_transactions` (`id`, `product_id`, `hash`, `transaction_hash`, `signature`, `event`, `token_id`, `account_address`, `created_at`, `updated_at`, `product_bidding_id`, `block_no`, `status`, `timestamp`, `from_address`, `to_address`, `gas_price`, `amount`) VALUES
(1, 5, 'QmRQ8FLt38viRtqf9AMktrMfperyG21mtDkiyd9876', '0x39f55a0febed704cd19c34012f7459742088857af1013f9cbec9c889f11c0692', '0xaeeb4d2ec3a638905a8bd63e9e6e884d8048f914acf3289c675bf5f9b17e0fbc', 'AS', '', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '2021-12-23 06:12:37', '2021-12-23 06:12:37', 0, '11675749', 1, '1640259757', '0x79d544b3770270ffa6ab39b81c18ffdfc52b57b4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0001),
(2, 5, 'QmRQ8FLt38viRtqf9AMktrMfperyG21mtDkiyd9876', '0x85c8282b729730b74949dab7aab8bc99fe09889f42c476435ba93a06b0efd598', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', '2021-12-23 06:13:39', '2021-12-23 06:13:39', 1, '11675755', 1, '', '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0002),
(3, 5, 'QmRQ8FLt38viRtqf9AMktrMfperyG21mtDkiyd9876', '0x0b41d3893c58e915710f08fd3cb858fde1097fa6946d476718d38cabdacede3b', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', '2021-12-23 06:16:48', '2021-12-23 06:16:48', 2, '11675768', 1, '', '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0003),
(4, 5, 'QmRQ8FLt38viRtqf9AMktrMfperyG21mtDkiyd9876', '0x3ed6e5b8cee608dfcc3c27d858423c8a6d6fa6a9068790d0972b944d52c27c4d', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0x04f32dC916c1d820F9B88Ad6af8870129cfe422C', '2021-12-23 06:22:48', '2021-12-23 06:22:48', 3, '11675800', 1, '', '0x04f32dC916c1d820F9B88Ad6af8870129cfe422C', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0006),
(5, 5, 'QmRQ8FLt38viRtqf9AMktrMfperyG21mtDkiyd9876', '0x95b4ac325ad28f8140c5f20b48fef9c3f00ba737c576bfba2ec9bad7446c9683', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0xC7F0dE8CdF6162B614232172BB79806a79d179F0', '2021-12-23 06:28:47', '2021-12-23 06:28:47', 4, '11675825', 1, '', '0xC7F0dE8CdF6162B614232172BB79806a79d179F0', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0007),
(6, 5, 'QmRQ8FLt38viRtqf9AMktrMfperyG21mtDkiyd9876', '0x5bb335615f4d0fe1f456f72614d1c9a95565162d6dff119727d9d852780bd341', '0xa0c3e2a0d9d11474ad3ce1e47948ea798a639276208836ea8717d3792b129669', 'AE', '2', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '2021-12-23 06:30:56', '2021-12-23 06:30:56', 0, '11675831', 0, '', '0x79d544b3770270ffa6ab39b81c18ffdfc52b57b4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0007),
(7, 7, 'QmPT8gBHHhHHXvG1TRUTBtsiGGLjutohb4NF53MmbXhsV90', '0x547f526b42e4a81545f3ebea45150ff5eaf975485ef31734775e111ed0157853', '0xaeeb4d2ec3a638905a8bd63e9e6e884d8048f914acf3289c675bf5f9b17e0fbc', 'AS', '', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '2021-12-23 06:38:22', '2021-12-23 06:38:22', 0, '11675861', 1, '1640261257', '0x79d544b3770270ffa6ab39b81c18ffdfc52b57b4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0001),
(8, 7, 'QmPT8gBHHhHHXvG1TRUTBtsiGGLjutohb4NF53MmbXhsV90', '0xe333c0382c8b08abdbcfe37305a2460f89a96b091e2960c03895fdb4b87756ab', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', '2021-12-23 06:39:42', '2021-12-23 06:39:42', 5, '11675868', 1, '', '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0002),
(9, 7, 'QmPT8gBHHhHHXvG1TRUTBtsiGGLjutohb4NF53MmbXhsV90', '0xee1d871ad02779655a9d649edc4de46197d91c8bc480108b084633326294bedc', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0x04f32dC916c1d820F9B88Ad6af8870129cfe422C', '2021-12-23 06:44:45', '2021-12-23 06:44:45', 6, '11675889', 1, '', '0x04f32dC916c1d820F9B88Ad6af8870129cfe422C', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0003),
(10, 7, 'QmPT8gBHHhHHXvG1TRUTBtsiGGLjutohb4NF53MmbXhsV90', '0x174199fabcbed2ac63ad5888f5f6d715e1d3adc4c1cae8febea9b8e5a003ce9d', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0x04f32dC916c1d820F9B88Ad6af8870129cfe422C', '2021-12-23 06:46:52', '2021-12-23 06:46:52', 7, '11675897', 1, '', '0x04f32dC916c1d820F9B88Ad6af8870129cfe422C', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0003),
(11, 7, 'QmPT8gBHHhHHXvG1TRUTBtsiGGLjutohb4NF53MmbXhsV90', '0x77db58bd96b7228643aaf6da7ad3cc1ddb829f9f58cd332a15a2e037fb0c55af', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0xC7F0dE8CdF6162B614232172BB79806a79d179F0', '2021-12-23 06:48:27', '2021-12-23 06:48:27', 8, '11675903', 1, '', '0xC7F0dE8CdF6162B614232172BB79806a79d179F0', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0007),
(12, 7, 'QmPT8gBHHhHHXvG1TRUTBtsiGGLjutohb4NF53MmbXhsV90', '0x605836d0f670af6ea97c4a44782a97ef03d61320e960f389092287f1e6f6986f', '0xa0c3e2a0d9d11474ad3ce1e47948ea798a639276208836ea8717d3792b129669', 'AE', '4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '2021-12-23 06:58:48', '2021-12-23 06:58:48', 0, '11675949', 0, '', '0x79d544b3770270ffa6ab39b81c18ffdfc52b57b4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0007),
(13, 8, 'QmTAznyH583xUgEyY5zdrPB2LSGY7FUBPDddWKj58GmBgp', '0xe56c57a0fdf755209710a5c4a1a134d44f9aa592cb23ab230ed4e8e89816f4fa', '0xaeeb4d2ec3a638905a8bd63e9e6e884d8048f914acf3289c675bf5f9b17e0fbc', 'AS', '', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '2022-02-02 14:12:05', '2022-02-02 14:12:05', 0, '11909341', 1, '1643793099', '0x79d544b3770270ffa6ab39b81c18ffdfc52b57b4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0001),
(14, 11, 'QmTwQbBGzNfxXyS11keseiraTFRxn8HVMmLqVWTsGTNPpQ', '0x8552665913b3dbc3b485a78a0f8a1513f4681a36b89e1cc0491ee35b96b10586', '0xaeeb4d2ec3a638905a8bd63e9e6e884d8048f914acf3289c675bf5f9b17e0fbc', 'AS', '', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '2022-02-02 15:28:02', '2022-02-02 15:28:02', 0, '11909586', 1, '1643797676', '0x79d544b3770270ffa6ab39b81c18ffdfc52b57b4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0001),
(15, 12, 'QmSsba3SLnAEVGFaEcnpUeRuAb2vrJE2wpLpmRonf6aRrm', '0xda5e2dc492487193675d7bfc723a045ea8f4bdf92494d4576e49fade01a813e4', '0xaeeb4d2ec3a638905a8bd63e9e6e884d8048f914acf3289c675bf5f9b17e0fbc', 'AS', '', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '2022-02-02 15:48:07', '2022-02-02 15:48:07', 0, '11909644', 1, '1643798846', '0x79d544b3770270ffa6ab39b81c18ffdfc52b57b4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0001),
(16, 12, 'QmSsba3SLnAEVGFaEcnpUeRuAb2vrJE2wpLpmRonf6aRrm', '0xedadf8143689fee29e49faa87b8d8fe6640e3254b12c18cec2425bbf08b7267f', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0x47584ad76228D22f7c68A536Ed94dEEA67DD18A4', '2022-02-02 16:27:08', '2022-02-02 16:27:08', 9, '11909761', 1, '', '0x47584ad76228D22f7c68A536Ed94dEEA67DD18A4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.00011),
(17, 12, 'QmSsba3SLnAEVGFaEcnpUeRuAb2vrJE2wpLpmRonf6aRrm', '0x7b91691773560622450da039c5952a8f9a324e8d77f3aa92312fde257b420e8b', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', 'PB', '', '0x1b08fc1b7B0a47799c3BbcA26224908f3544C4C6', '2022-02-02 16:35:53', '2022-02-02 16:35:53', 10, '11909793', 1, '', '0x1b08fc1b7B0a47799c3BbcA26224908f3544C4C6', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.0002),
(18, 12, 'QmSsba3SLnAEVGFaEcnpUeRuAb2vrJE2wpLpmRonf6aRrm', '0xa6f9fb5a28f7e9d68f46e0a96279dd764fbe4dd1479150045648c4c1137d7de2', '0xa0c3e2a0d9d11474ad3ce1e47948ea798a639276208836ea8717d3792b129669', 'AE', '5', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '2022-02-02 16:55:39', '2022-02-02 16:55:39', 0, '11909856', 0, '', '0x79d544b3770270ffa6ab39b81c18ffdfc52b57b4', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '', 0.00032);

-- --------------------------------------------------------

--
-- Table structure for table `metamask_transaction_payments`
--

DROP TABLE IF EXISTS `metamask_transaction_payments`;
CREATE TABLE IF NOT EXISTS `metamask_transaction_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `hash` varchar(250) NOT NULL DEFAULT '',
  `from_address` varchar(250) NOT NULL DEFAULT '',
  `to_address` varchar(255) NOT NULL DEFAULT '',
  `amount` float NOT NULL DEFAULT '0',
  `signature` varchar(250) NOT NULL DEFAULT '',
  `transaction_hash` varchar(250) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `block_no` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metamask_transaction_payments`
--

INSERT INTO `metamask_transaction_payments` (`id`, `product_id`, `hash`, `from_address`, `to_address`, `amount`, `signature`, `transaction_hash`, `created_at`, `updated_at`, `block_no`, `status`) VALUES
(1, 5, 'QmRQ8FLt38viRtqf9AMktrMfperyG21mtDkiyd9876', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', 0.0005, '0x2215a369437b88d671d931e79e50f38883e88be90f664fc151aaa2ce46a6035a', '0x5bb335615f4d0fe1f456f72614d1c9a95565162d6dff119727d9d852780bd341', '2021-12-23 06:30:56', '2021-12-23 06:30:56', '11675831', 1),
(2, 7, 'QmPT8gBHHhHHXvG1TRUTBtsiGGLjutohb4NF53MmbXhsV90', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', 0.0002, '0x2215a369437b88d671d931e79e50f38883e88be90f664fc151aaa2ce46a6035a', '0x605836d0f670af6ea97c4a44782a97ef03d61320e960f389092287f1e6f6986f', '2021-12-23 06:58:48', '2021-12-23 06:58:48', '11675949', 1),
(3, 12, 'QmSsba3SLnAEVGFaEcnpUeRuAb2vrJE2wpLpmRonf6aRrm', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '0x47584ad76228D22f7c68A536Ed94dEEA67DD18A4', 0.00011, '0x2215a369437b88d671d931e79e50f38883e88be90f664fc151aaa2ce46a6035a', '0xa6f9fb5a28f7e9d68f46e0a96279dd764fbe4dd1479150045648c4c1137d7de2', '2022-02-02 16:55:39', '2022-02-02 16:55:39', '11909856', 1),
(4, 12, 'QmSsba3SLnAEVGFaEcnpUeRuAb2vrJE2wpLpmRonf6aRrm', '0x3706f0b1453cc400FDA761c5F5860246bc7Cd6D1', '0x47584ad76228D22f7c68A536Ed94dEEA67DD18A4', 0.00011, '0x2215a369437b88d671d931e79e50f38883e88be90f664fc151aaa2ce46a6035a', '0xa6f9fb5a28f7e9d68f46e0a96279dd764fbe4dd1479150045648c4c1137d7de2', '2022-02-02 16:55:39', '2022-02-02 16:55:39', '11909856', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_06_14_061757_create_support_tickets_table', 3),
(5, '2020_06_14_061837_create_support_messages_table', 3),
(6, '2020_06_14_061904_create_support_attachments_table', 3),
(7, '2020_06_14_062359_create_admins_table', 3),
(8, '2020_06_14_064604_create_transactions_table', 4),
(9, '2020_06_14_065247_create_general_settings_table', 5),
(12, '2014_10_12_100000_create_password_resets_table', 6),
(13, '2020_06_14_060541_create_user_logins_table', 6),
(14, '2020_06_14_071708_create_admin_password_resets_table', 7),
(15, '2020_09_14_053026_create_countries_table', 8),
(16, '2021_03_15_084721_create_admin_notifications_table', 9),
(17, '2016_06_01_000001_create_oauth_auth_codes_table', 10),
(18, '2016_06_01_000002_create_oauth_access_tokens_table', 10),
(19, '2016_06_01_000003_create_oauth_refresh_tokens_table', 10),
(20, '2016_06_01_000004_create_oauth_clients_table', 10),
(21, '2016_06_01_000005_create_oauth_personal_access_clients_table', 10),
(22, '2021_05_08_103925_create_sms_gateways_table', 11),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 12),
(24, '2021_05_23_111859_create_email_logs_table', 13),
(25, '2021_08_30_161210_create_categories_table', 14),
(26, '2021_08_30_163729_create_specifications_table', 15),
(27, '2021_08_30_172934_create_products_table', 16),
(28, '2021_08_31_145925_create_product_specifications_table', 17),
(29, '2021_09_02_103614_create_advertisements_table', 18),
(30, '2021_09_04_115533_create_orders_table', 19),
(31, '2021_09_04_154819_create_reviews_table', 20),
(32, '2021_09_05_110816_create_subcategories_table', 21),
(33, '2021_09_07_161343_create_brands_table', 22),
(34, '2021_09_12_170648_create_product_reports_table', 23),
(35, '2021_09_12_174543_create_contacts_table', 24),
(36, '2021_09_12_235638_create_contact_replies_table', 25),
(37, '2021_11_02_042607_create_slider', 26),
(38, '2021_11_08_061055_product_price', 27),
(39, '2021_11_08_061642_product_price', 28),
(40, '2021_11_09_110527_product_pieces', 29),
(41, '2021_11_10_083326_create_product_bidding', 30),
(42, '2021_11_10_083326_create_product_biddings', 31),
(43, '2021_11_16_114841_create_home_text_editor', 31),
(44, '2021_11_23_091112_create_community_categories', 32),
(45, '2021_11_23_091514_create_blogs', 32),
(46, '2021_11_23_110316_blog_type', 32),
(47, '2021_11_24_054845_blog_user_id', 32),
(48, '2021_11_24_065435_create_community_comments', 32),
(49, '2021_11_27_104832_image_type', 33),
(50, '2021_11_27_114858_glb_image', 33);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `order_number` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Unpaid : 0, Pending : 1, Complated : 2, In Process : 3, Shipped : 4, Disputed : 5, Cancelled  : 6, Refund : 7\r\n\r\n\r\n',
  `shipped_date` date DEFAULT NULL,
  `dispute` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', 'home', 'templates.basic.', '[\"featured_product\",\"latest_product\",\"ending_soon_product\",\"today_deal_product\",\"how_to_work\",\"client\",\"counter\",\"partner\"]', 1, '2020-07-11 06:23:58', '2021-09-15 06:36:56'),
(2, 'About', 'about-us', 'templates.basic.', '[\"client\",\"how_to_work\",\"partner\"]', 0, '2020-07-11 06:35:35', '2021-09-08 11:22:51'),
(4, 'Product', 'products', 'templates.basic.', NULL, 1, '2020-10-22 01:14:43', '2020-10-22 01:14:43'),
(5, 'Blog', 'blog', 'templates.basic.', NULL, 1, '2020-10-22 01:14:53', '2020-10-22 01:14:53'),
(12, 'Contact', 'contact', 'templates.basic.', NULL, 1, '2021-09-07 09:54:31', '2021-09-07 09:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `image`, `link`, `active`, `created_at`, `updated_at`) VALUES
(1, '61f7a3481ebc31643619144.png', 'https://google.com/', 1, '2022-01-31 03:05:15', '2022-01-31 03:22:24'),
(2, '61f7a00f8b5fc1643618319.png', 'https://google.com', 1, '2022-01-31 03:08:39', '2022-01-31 03:38:12'),
(3, '61f7a01c1c0f71643618332.png', 'https://google.com', 1, '2022-01-31 03:08:52', '2022-01-31 03:38:04'),
(4, '61f7a3f726ac41643619319.png', 'https://google.com', 1, '2022-01-31 03:09:00', '2022-01-31 03:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_pages`
--

DROP TABLE IF EXISTS `policy_pages`;
CREATE TABLE IF NOT EXISTS `policy_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `content` text,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `policy_pages`
--

INSERT INTO `policy_pages` (`id`, `title`, `slug`, `content`, `updated_at`, `created_at`) VALUES
(1, 'Privacy Policy', 'privacy-policy', '<p><strong style=\"color: rgb(0, 0, 0);\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0);\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '2022-01-24 04:19:57', '2022-01-24 02:03:48'),
(5, 'Service Policy', 'service-policy', '<p><strong style=\"color: rgb(0, 0, 0);\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0);\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '2022-01-24 04:20:03', '2022-01-24 03:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `featured` tinyint(4) DEFAULT NULL COMMENT 'Include : 1, Not-Include : 0',
  `latest` tinyint(4) DEFAULT NULL COMMENT 'Include : 1, Not-Include : 0',
  `brand_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `keyword` text COLLATE utf8mb4_unicode_ci,
  `time_duration` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Pending : 0, Approved : 1, Cancel : 2, Expired : 3, Sold: 4',
  `rating` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `start_price` float NOT NULL DEFAULT '0',
  `sale_price` float NOT NULL DEFAULT '0',
  `pieces` int(11) NOT NULL DEFAULT '0',
  `short_description` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image_type` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'I:image; G:glb; V:video',
  `image_hash` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `meta_hash` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `glb_filename` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_start_auction` tinyint(1) NOT NULL DEFAULT '0',
  `is_end_auction` tinyint(1) NOT NULL DEFAULT '0',
  `symbol` char(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `highest_bidding` float NOT NULL DEFAULT '0',
  `highest_bidder` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nft_id` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `featured`, `latest`, `brand_id`, `user_id`, `category_id`, `sub_category_id`, `title`, `sub_title`, `image`, `amount`, `keyword`, `time_duration`, `description`, `status`, `rating`, `created_at`, `updated_at`, `start_date`, `end_date`, `start_price`, `sale_price`, `pieces`, `short_description`, `image_type`, `image_hash`, `meta_hash`, `glb_filename`, `is_start_auction`, `is_end_auction`, `symbol`, `highest_bidding`, `highest_bidder`, `nft_id`, `created_by`) VALUES
(1, 1, 1, 1, 0, 1, 1, 'Ethereum', 'ETH', '61c01d65aba351639980389.png', '0.00000000', '[\"ETH\",\"ETHER\",\"ETHERIUM\"]', NULL, '<div>Ethereum is a decentralized, open-source blockchain with smart contract functionality. Ether (ETH) is the native cryptocurrency of the platform. Amongst cryptocurrencies, Ether is second only to Bitcoin in market capitalization.</div><div><br></div><div>Ethereum was conceived in 2013 by programmer Vitalik Buterin.Additional founders of Ethereum included Gavin Wood, Charles Hoskinson, Anthony Di Iorio and Joseph Lubin. In 2014, development work commenced and was crowdfunded, and the network went live on 30 July 2015. The platform allows anyone to deploy permanent and immutable decentralized applications onto it, with which users can interact. Decentralized finance (DeFi) applications provide a broad array of financial services without the need for typical financial intermediaries like brokerages, exchanges, or banks, such as allowing cryptocurrency users to borrow against their holdings or lend them out for interest. Ethereum also allows for the creation and exchange of NFTs, which are non-interchangeable tokens connected to digital works of art or other real-world items and sold as unique digital property. Additionally, many other cryptocurrencies operate as ERC-20 tokens on top of the Ethereum blockchain and have utilized the platform for initial coin offerings.</div><div><br></div><div>Ethereum has started implementing a series of upgrades called Ethereum 2.0, which includes a transition to proof of stake and aims to increase transaction throughput using sharding.</div>', 1, NULL, '2021-12-19 19:44:32', '2022-02-08 05:38:27', '2021-12-30 00:00:00', '2022-01-01 00:00:00', 0.1, 1, 1, '', 'G', 'QmfAZtvx2Z1Z2PsyT3vfP5DL8gfT8jaT4n7mZjYmkSotxx', 'QmWkgqaFYGwoCHNWwn6PJN3whVaC5izp5jGtULJMhrnFw3', '61bf454f653481639925071.glb', 0, 0, 'ETH', 0, '', '', 2),
(2, 1, 1, 1, 0, 1, 1, 'South Korean Won', 'KRW', '61c01d4d3f50e1639980365.png', '0.00000000', '[\"KRW\",\"WON\",\"SOUTH KOREA CURRENCY\"]', NULL, 'The Korean won (/wʌn/; Korean: 원 (圓), Korean pronunciation: [wʌn]) or Korean Empire won (Korean: 대한제국 원), was the official currency of the Korean Empire between 1902 and 1910. It was subdivided into 100 jeon (/dʒʌn/; Korean: 전 (錢), Korean pronunciation: [tɕʌn]).<br>', 1, NULL, '2021-12-19 20:17:08', '2022-01-18 04:43:30', '2021-12-30 00:00:00', '2022-01-01 00:00:00', 0.1, 1, 1, '', 'G', 'QmQ5asosiL8WZ96nfKXpRXRKZ5Vy1GEaioXrJfwFkDresm', '', '61bf4cf4515be1639927028.glb', 0, 0, 'ETH', 0, '', '', 0),
(3, NULL, NULL, 1, 1, 1, 1, 'Japanese Yen', 'JPY', '61c01d3a1985b1639980346.png', '0.00000000', '[\"JPY\",\"Japanese Yen\"]', NULL, 'The yen (Japanese: 円, symbol: ¥; code: JPY; also abbreviated as JP¥) is the official currency of Japan. It is the third most traded currency in the foreign exchange market, after the United States dollar and the Euro. It is also widely used as a third reserve currency after the United States dollar and the Euro.<br>', 1, NULL, '2021-12-19 20:23:08', '2021-12-20 11:05:46', '2021-12-30 00:00:00', '2022-01-01 00:00:00', 0.1, 1, 1, '', 'G', 'QmRGfxd7NHtS4CUME2XEqkYfVoDa1FWbefLWdbisDAEXSv', '', '61bf4e5b328e01639927387.glb', 0, 0, 'ETH', 0, '', '', 0),
(4, 1, 1, 1, 0, 1, 1, 'Chinese Yuan', 'CNY', '61c01d2a46b601639980330.png', '0.00000000', '[\"CNY\",\"Chinese Yuan\"]', NULL, 'The yuan (/juːˈɑːn, -æn/; sign: ¥; Chinese: 圓/元; pinyin: yuán; [ɥæ̌n] (About this soundlisten)) is the base unit of a number of former and present-day currencies in Chinese.The ISO code for the renminbi is CNY, an abbreviation of \"Chinese yuan\" as it is often referred to in international finance.The currency symbol is ¥, but because it is shared with the Japanese yen, CN¥ is sometimes used. However, in written Chinese contexts, the Chinese character for yuan (Chinese: 元; lit. \'beginning\') or, in formal contexts Chinese: 圆; lit. \'round\', usually follows the number in lieu of a currency symbol.<br>', 1, NULL, '2021-12-19 20:26:03', '2022-01-18 04:43:38', '2021-12-30 00:00:00', '2022-01-03 00:00:00', 0.1, 1, 1, '', 'G', 'QmW7mTcDA42obcpw9bXzXySEDZWx8Yv2q23bX2YE8MtERS', '', '61bf4f0b422ae1639927563.glb', 1, 0, 'ETH', 0, '', '', 0),
(5, 1, 1, 1, 0, 1, 1, 'Jong-un Kim', 'Supreme Leader of North Korea', '61c01cf154e881639980273.png', '0.00000000', '[\"Supreme Leader\",\"Jong-un Kim\",\"Supreme Leader of North Korea\"]', NULL, '<div>Kim Jong-un (/ˌkɪm dʒɒŋˈʊn, -ˈʌn/; Korean: 김정은; Korean: [kim.dzɔŋ.ɯn]; born 8 January 1982 or 1983) is a North Korean politician who has been Supreme Leader of North Korea since 2011 and the leader of the Workers\' Party of Korea (WPK) since 2012. He is the second child of Kim Jong-il, who was North Korea\'s second supreme leader from 1994 to 2011, and Ko Yong-hui. He is the grandson of Kim Il-sung, who was the founder and first supreme leader of North Korea from its establishment in 1948 until his death in 1994.</div><div><br></div><div>From late 2010, Kim Jong-un was viewed as successor to the leadership of North Korea. Following his father\'s death in December 2011, state television announced Kim Jong-un as the \"Great Successor\". Kim holds the titles of General Secretary of the Workers\' Party of Korea, Chairman of the Central Military Commission, and President of the State Affairs Commission. He is also a member of the Presidium of the Politburo of the Workers\' Party of Korea, the highest decision-making body. In July 2012, Kim was promoted to the highest rank of Marshal in the Korean People\'s Army, consolidating his position as Supreme Commander of the Armed Forces. North Korean state media often refer to him as \"the Marshal\" or \"Dear Respected Leader\". He has promoted the policy of byungjin, similar to Kim Il-sung\'s policy from the 1960s, referring to the simultaneous development of both the economy and the country\'s nuclear weapons program.</div><div><br></div><div>Kim\'s leadership has followed the same cult of personality as his grandfather and father. In 2014, a UNHRC report suggested that Kim could be put on trial for crimes against humanity. He has ordered the purge or execution of several North Korean officials; he is also widely believed to have ordered the 2017 assassination of his half-brother, Kim Jong-nam, in Malaysia. He has presided over an expansion of the consumer economy, construction projects and tourist attractions. Kim also expanded North Korea\'s nuclear program which led to heightened tensions with the United States and South Korea. In 2018 and 2019, Kim took part in summits with South Korean President Moon Jae-in and US President Donald Trump. He has claimed success in combatting the COVID-19 pandemic in North Korea, although many experts doubt the country has had no cases altogether.</div><div><br></div><div>He earned foreign currency from cryptocurrency. We guess.</div>', 4, NULL, '2021-12-19 20:29:43', '2022-01-18 04:43:48', '2021-12-23 00:00:00', '2022-01-01 00:00:00', 0.0001, 0.0045, 1, '', 'G', 'QmRQ8FLt38viRtqf9AMktrMfperyG21mtDkiyd9876', '', '61bf4fe5a132e1639927781.glb', 1, 1, 'ETH', 0.0007, '0xC7F0dE8CdF6162B614232172BB79806a79d179F0', '', 0),
(6, 1, NULL, 1, 1, 1, 1, 'Donald John Trump', '45th President of the United States of America', '61c01d1b3942e1639980315.png', '0.00000000', '[\"45th President of the United States of America\",\"Trump\"]', NULL, '<div>Donald John Trump (born June 14, 1946) is an American politician, media personality, and businessman who served as the 45th president of the United States from 2017 to 2021.</div><div><br></div><div>Born and raised in Queens, New York City, Trump graduated from the Wharton School of the University of Pennsylvania with a bachelor\'s degree in 1968. He became the president of his father Fred Trump\'s real estate business in 1971 and renamed it The Trump Organization. Trump expanded the company\'s operations to building and renovating skyscrapers, hotels, casinos, and golf courses. He later started various side ventures, mostly by licensing his name. Trump and his businesses have been involved in more than 4,000 state and federal legal actions, including six bankruptcies. He owned the Miss Universe brand of beauty pageants from 1996 to 2015. From 2004 to 2015, he co-produced and hosted the reality television series The Apprentice.</div><div><br></div><div>Trump\'s political positions have been described as populist, protectionist, isolationist, and nationalist. He entered the 2016 presidential race as a Republican and was elected in an upset victory over Democratic nominee Hillary Clinton while losing the popular vote,[a] becoming the first U.S. president without prior military or government service. The 2017–2019 special counsel investigation led by Robert Mueller established that Russia interfered in the 2016 election to benefit the Trump campaign, but not that members of the Trump campaign conspired or coordinated with Russian election interference activities. Trump\'s election and policies sparked numerous protests. Trump made many false and misleading statements during his campaigns and presidency, to a degree unprecedented in American politics, and promoted conspiracy theories. Many of his comments and actions have been characterized as racially charged or racist, and many as misogynistic.</div><div><br></div><div>Trump ordered a travel ban on citizens from several Muslim-majority countries, diverted funding towards building a wall on the U.S.–Mexico border, and implemented a policy of family separations for apprehended migrants. He signed the Tax Cuts and Jobs Act of 2017, which cut taxes for individuals and businesses and rescinded the individual health insurance mandate penalty of the Affordable Care Act. He appointed more than 200 federal judges, including three to the Supreme Court: Neil Gorsuch, Brett Kavanaugh and Amy Coney Barrett. In foreign policy, Trump pursued an America First agenda: he renegotiated the North American Free Trade Agreement as the United States–Mexico–Canada Agreement and withdrew the U.S. from the Trans-Pacific Partnership trade negotiations, the Paris Agreement on climate change and the Iran nuclear deal. He imposed import tariffs that triggered a trade war with China. Trump met three times with North Korean leader Kim Jong-un, but made no progress on denuclearization. He reacted slowly to the COVID-19 pandemic, ignored or contradicted many recommendations from health officials in his messaging, and promoted misinformation about unproven treatments and the availability of testing.</div><div><br></div><div>Trump lost the 2020 presidential election to Joe Biden but refused to concede. He falsely claimed that there was widespread electoral fraud and attempted to overturn the results, pressuring government officials, mounting scores of unsuccessful legal challenges, and obstructing the presidential transition. On January 6, 2021, Trump urged his supporters to march to the Capitol, which hundreds then attacked, resulting in multiple deaths and interrupting the electoral vote count.</div><div><br></div><div>Trump is the only federal officeholder in American history to have been impeached twice. After he pressured Ukraine to investigate his political rival Joe Biden in 2019, the House of Representatives impeached him for abuse of power and obstruction of Congress in December. The Senate acquitted him of both charges in February 2020. On January 13, 2021, the House of Representatives impeached Trump a second time, for incitement of insurrection. The Senate acquitted Trump on February 13, after he had already left office. Scholars and historians rank Trump as one of the worst presidents in American history.</div><div><br></div><div>He loved Cryptocurrency. We guess.</div>', 1, NULL, '2021-12-19 20:34:08', '2021-12-31 23:18:59', '2021-12-19 00:00:00', '2022-01-04 00:00:00', 0.1, 1, 1, '', 'G', 'QmPT8gBHHhHHXvG1TRUTBtsiGGLjutohb4NF53MmbXhsVQ', '', '61bf50f0892c81639928048.glb', 1, 0, 'ETH', 0, '', '', 0),
(7, 1, NULL, 1, 2, 1, 1, 'Donald John Trump 12', '45th President of the United States of America 12', '61c01d1b3942e1639980315.png', '0.00000000', '[\"45th President of the United States of America\",\"Trump\"]', NULL, '<div>Donald John Trump (born June 14, 1946) is an American politician, media personality, and businessman who served as the 45th president of the United States from 2017 to 2021.</div><div><br></div><div>Born and raised in Queens, New York City, Trump graduated from the Wharton School of the University of Pennsylvania with a bachelor\'s degree in 1968. He became the president of his father Fred Trump\'s real estate business in 1971 and renamed it The Trump Organization. Trump expanded the company\'s operations to building and renovating skyscrapers, hotels, casinos, and golf courses. He later started various side ventures, mostly by licensing his name. Trump and his businesses have been involved in more than 4,000 state and federal legal actions, including six bankruptcies. He owned the Miss Universe brand of beauty pageants from 1996 to 2015. From 2004 to 2015, he co-produced and hosted the reality television series The Apprentice.</div><div><br></div><div>Trump\'s political positions have been described as populist, protectionist, isolationist, and nationalist. He entered the 2016 presidential race as a Republican and was elected in an upset victory over Democratic nominee Hillary Clinton while losing the popular vote,[a] becoming the first U.S. president without prior military or government service. The 2017–2019 special counsel investigation led by Robert Mueller established that Russia interfered in the 2016 election to benefit the Trump campaign, but not that members of the Trump campaign conspired or coordinated with Russian election interference activities. Trump\'s election and policies sparked numerous protests. Trump made many false and misleading statements during his campaigns and presidency, to a degree unprecedented in American politics, and promoted conspiracy theories. Many of his comments and actions have been characterized as racially charged or racist, and many as misogynistic.</div><div><br></div><div>Trump ordered a travel ban on citizens from several Muslim-majority countries, diverted funding towards building a wall on the U.S.–Mexico border, and implemented a policy of family separations for apprehended migrants. He signed the Tax Cuts and Jobs Act of 2017, which cut taxes for individuals and businesses and rescinded the individual health insurance mandate penalty of the Affordable Care Act. He appointed more than 200 federal judges, including three to the Supreme Court: Neil Gorsuch, Brett Kavanaugh and Amy Coney Barrett. In foreign policy, Trump pursued an America First agenda: he renegotiated the North American Free Trade Agreement as the United States–Mexico–Canada Agreement and withdrew the U.S. from the Trans-Pacific Partnership trade negotiations, the Paris Agreement on climate change and the Iran nuclear deal. He imposed import tariffs that triggered a trade war with China. Trump met three times with North Korean leader Kim Jong-un, but made no progress on denuclearization. He reacted slowly to the COVID-19 pandemic, ignored or contradicted many recommendations from health officials in his messaging, and promoted misinformation about unproven treatments and the availability of testing.</div><div><br></div><div>Trump lost the 2020 presidential election to Joe Biden but refused to concede. He falsely claimed that there was widespread electoral fraud and attempted to overturn the results, pressuring government officials, mounting scores of unsuccessful legal challenges, and obstructing the presidential transition. On January 6, 2021, Trump urged his supporters to march to the Capitol, which hundreds then attacked, resulting in multiple deaths and interrupting the electoral vote count.</div><div><br></div><div>Trump is the only federal officeholder in American history to have been impeached twice. After he pressured Ukraine to investigate his political rival Joe Biden in 2019, the House of Representatives impeached him for abuse of power and obstruction of Congress in December. The Senate acquitted him of both charges in February 2020. On January 13, 2021, the House of Representatives impeached Trump a second time, for incitement of insurrection. The Senate acquitted Trump on February 13, after he had already left office. Scholars and historians rank Trump as one of the worst presidents in American history.</div><div><br></div><div>He loved Cryptocurrency. We guess.</div>', 4, NULL, '2021-12-19 20:34:08', '2021-12-31 23:18:49', '2021-12-19 00:00:00', '2022-01-04 00:00:00', 0.0001, 0.0045, 1, '', 'G', 'QmPT8gBHHhHHXvG1TRUTBtsiGGLjutohb4NF53MmbXhsV90', '', '61bf50f0892c81639928048.glb', 1, 1, 'ETH', 0.0007, '0xC7F0dE8CdF6162B614232172BB79806a79d179F0', '', 0),
(8, NULL, NULL, 1, 0, 3, NULL, 'Test', 'testingg', '61f3cca51167a1643367589.jpg', '0.00000000', '[\"video\"]', NULL, 'ghgyjg', 1, NULL, '2022-01-28 15:59:50', '2022-02-04 14:15:29', '2022-02-01 00:00:00', '2022-02-06 00:00:00', 0.0001, 0.0045, 12, '', 'I', 'Qmb1CcT641TwkMXkADQBtZWJTW3PzDesbHAYa8rEnNCgEa', 'QmSTENFNXpy1jgsQKXTxSaD2yZGxEgYyCW7xBhuHVep8Yq', '61fceeb0d948e1643966128.jpg', 1, 0, 'UNIC', 0, '', '', 2),
(9, 1, 1, 2, 0, 2, NULL, 'Nature', 'Nature in green', '61fa279c96fd11643784092.jpg', '0.00000000', '[\"nature\",\"green\",\"photography\"]', NULL, 'Nature at its best when its green', 1, NULL, '2022-02-02 11:41:32', '2022-02-02 11:49:20', '2022-02-02 00:00:00', '2022-02-03 00:00:00', 0.0001, 0.0001, 1, '', 'N', '', '', '', 1, 0, 'ETH', 0, '', '', 2),
(10, 1, 1, 2, 0, 2, NULL, 'Snow', 'Snowing mountains', '61fa4be1a88251643793377.jpg', '0.00000000', '[\"nature\",\"snow\"]', NULL, 'Snow is white beauty', 1, NULL, '2022-02-02 14:16:17', '2022-02-02 14:29:04', '2022-02-02 00:00:00', '2022-02-02 00:00:00', 0.0001, 0.0003, 1, '', 'N', '', '', '', 0, 0, 'ETH', 0, '', '', 2),
(11, 0, 1, 2, 0, 1, NULL, 'Duck', 'Yellow Ducking', '61fa5c46dd2701643797574.png', '0.00000000', NULL, NULL, 'Duck is the yellow duck', 1, NULL, '2022-02-02 15:26:15', '2022-02-02 15:39:23', '2022-02-02 00:00:00', '2022-02-02 00:00:00', 0.0001, 0.0002, 1, '', 'G', 'QmTwQbBGzNfxXyS11keseiraTFRxn8HVMmLqVWTsGTNPpQ', 'QmfSKrEs3wKJ5Uxyh4qdzDxchH4ikKiG3zHmjTdeGa374f', '61fa5c46e529b1643797574.glb', 1, 0, 'ETH', 0, '', '', 1),
(12, 1, 1, 2, 11, 1, NULL, 'Avacado', 'Green Avacado', '61fa5fee002461643798510.png', '0.00000000', '[\"avacado\"]', NULL, 'Avacado by nature', 4, NULL, '2022-02-02 15:41:51', '2022-02-02 16:55:39', '2022-02-02 00:00:00', '2022-02-03 00:00:00', 0.0001, 0.0002, 1, '', 'G', 'QmSsba3SLnAEVGFaEcnpUeRuAb2vrJE2wpLpmRonf6aRrm', 'QmbcE7Cwm99Csv8r4TevnA4n7XJKcpVNHGSG7zogz9RXcD', '61fa5fee0bebc1643798510.glb', 1, 1, 'ETH', 0.00032, '0x1b08fc1b7B0a47799c3BbcA26224908f3544C4C6', '5', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_biddings`
--

DROP TABLE IF EXISTS `product_biddings`;
CREATE TABLE IF NOT EXISTS `product_biddings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `account_address` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `bid_amount` float NOT NULL DEFAULT '0',
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'P' COMMENT 'P:pending, A:accepted, R:rejected',
  `signature` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `transaction_hash` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_biddings`
--

INSERT INTO `product_biddings` (`id`, `product_id`, `account_address`, `user_id`, `bid_amount`, `status`, `signature`, `transaction_hash`, `created_at`, `updated_at`) VALUES
(1, 5, '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', 3, 0.0002, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0x85c8282b729730b74949dab7aab8bc99fe09889f42c476435ba93a06b0efd598', '2021-12-23 06:13:39', '2021-12-23 06:13:39'),
(2, 5, '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', 3, 0.0003, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0x0b41d3893c58e915710f08fd3cb858fde1097fa6946d476718d38cabdacede3b', '2021-12-23 06:16:48', '2021-12-23 06:16:48'),
(3, 5, '0x04f32dC916c1d820F9B88Ad6af8870129cfe422C', 2, 0.0006, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0x3ed6e5b8cee608dfcc3c27d858423c8a6d6fa6a9068790d0972b944d52c27c4d', '2021-12-23 06:22:48', '2021-12-23 06:22:48'),
(4, 5, '0xC7F0dE8CdF6162B614232172BB79806a79d179F0', 8, 0.0007, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0x95b4ac325ad28f8140c5f20b48fef9c3f00ba737c576bfba2ec9bad7446c9683', '2021-12-23 06:28:47', '2021-12-23 06:28:47'),
(5, 7, '0xcA544342BD591126E76Eb5DD38d0591b7C4E8E79', 8, 0.0002, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0xe333c0382c8b08abdbcfe37305a2460f89a96b091e2960c03895fdb4b87756ab', '2021-12-23 06:39:42', '2021-12-23 06:39:42'),
(6, 7, '0x04f32dC916c1d820F9B88Ad6af8870129cfe422C', 3, 0.0003, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0xee1d871ad02779655a9d649edc4de46197d91c8bc480108b084633326294bedc', '2021-12-23 06:44:45', '2021-12-23 06:44:45'),
(7, 7, '0x04f32dC916c1d820F9B88Ad6af8870129cfe422C', 3, 0.0003, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0x174199fabcbed2ac63ad5888f5f6d715e1d3adc4c1cae8febea9b8e5a003ce9d', '2021-12-23 06:46:52', '2021-12-23 06:46:52'),
(8, 7, '0xC7F0dE8CdF6162B614232172BB79806a79d179F0', 2, 0.0007, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0x77db58bd96b7228643aaf6da7ad3cc1ddb829f9f58cd332a15a2e037fb0c55af', '2021-12-23 06:48:27', '2021-12-23 06:48:27'),
(9, 12, '0x47584ad76228D22f7c68A536Ed94dEEA67DD18A4', 13, 0.00011, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0xedadf8143689fee29e49faa87b8d8fe6640e3254b12c18cec2425bbf08b7267f', '2022-02-02 16:27:08', '2022-02-02 16:27:08'),
(10, 12, '0x1b08fc1b7B0a47799c3BbcA26224908f3544C4C6', 11, 0.0002, 'P', '0xe8fa72a80ec00cdfb7a21273eaad1fcb342b57d20bf64eebe37280213c2b8da6', '0x7b91691773560622450da039c5952a8f9a324e8d77f3aa92312fde257b420e8b', '2022-02-02 16:35:53', '2022-02-02 16:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_reports`
--

DROP TABLE IF EXISTS `product_reports`;
CREATE TABLE IF NOT EXISTS `product_reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_specifications`
--

DROP TABLE IF EXISTS `product_specifications`;
CREATE TABLE IF NOT EXISTS `product_specifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `specification_id` int(11) DEFAULT NULL,
  `value` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `starts` tinyint(4) NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sub_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `button_text` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `button_link` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `rank` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `sub_title`, `button_text`, `button_link`, `image`, `rank`, `created_at`, `updated_at`) VALUES
(1, 'Partnership', 'Unicus & Mobigraph', 'Read more', 'https://test.art-unic.com/blog/10/new-partnership-mobigraph', '61c00bc8c7ade1639975880.jpg', 2, '2021-11-02 00:09:42', '2022-02-03 13:57:01'),
(2, 'INTRODUCE', 'UNICUS', 'Read more', 'https://test.art-unic.com/blog/9/introduce-unicus', '61c00b5cb22c31639975772.jpg', 1, '2021-11-02 04:59:15', '2022-02-03 13:56:52'),
(3, 'Partnership', 'Unicus & Kyodo', 'Read more', 'https://test.art-unic.com/blog/11/new-partnership-kyodo-group', '61c00be71055c1639975911.jpg', 3, '2021-12-20 09:51:51', '2022-02-03 13:56:42'),
(4, 'Partnership', 'UNICUS & Routela', 'Read more', 'https://test.art-unic.com/blog/12/new-partnership-routela', '61c00c0b0a8c21639975947.jpg', 4, '2021-12-20 09:52:27', '2022-02-03 13:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `social_media_links`
--

DROP TABLE IF EXISTS `social_media_links`;
CREATE TABLE IF NOT EXISTS `social_media_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_link` varchar(200) NOT NULL DEFAULT '',
  `instagram_link` varchar(200) NOT NULL DEFAULT '',
  `twitter_link` varchar(200) NOT NULL DEFAULT '',
  `youtube_link` varchar(200) NOT NULL DEFAULT '',
  `telegram_link` varchar(200) NOT NULL DEFAULT '',
  `blog_link` varchar(200) NOT NULL DEFAULT '',
  `medium_link` varchar(200) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_media_links`
--

INSERT INTO `social_media_links` (`id`, `facebook_link`, `instagram_link`, `twitter_link`, `youtube_link`, `telegram_link`, `blog_link`, `medium_link`, `created_at`, `updated_at`) VALUES
(1, '', '', 'https://twitter.com/UNICUS91643983', '', 'https://t.me/UNICUSPROJECT', 'https://blog.naver.com/unicusproject', 'https://medium.com/@unicusproject', NULL, '2022-02-08 02:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

DROP TABLE IF EXISTS `specifications`;
CREATE TABLE IF NOT EXISTS `specifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'sub cat test', '2021-11-07 22:53:59', '2021-11-07 22:53:59'),
(2, 2, 'demoadmin', '2021-11-16 04:06:09', '2021-11-16 04:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

DROP TABLE IF EXISTS `support_attachments`;
CREATE TABLE IF NOT EXISTS `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `support_message_id` int(10) UNSIGNED NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

DROP TABLE IF EXISTS `support_messages`;
CREATE TABLE IF NOT EXISTS `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supportticket_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

DROP TABLE IF EXISTS `support_tickets`;
CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `top_banner`
--

DROP TABLE IF EXISTS `top_banner`;
CREATE TABLE IF NOT EXISTS `top_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `image` varchar(200) NOT NULL DEFAULT '',
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `top_banner`
--

INSERT INTO `top_banner` (`id`, `title`, `link`, `image`, `active`) VALUES
(1, '', 'https://www.google.com/', '61e6a7064810e1642505990.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `post_balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `charge`, `post_balance`, `trx_type`, `trx`, `details`, `created_at`, `updated_at`) VALUES
(1, 10, '100.00000000', '0.00000000', '100.00000000', '+', 'U8NBJ53F5VH5', 'Added Balance Via Admin', '2022-02-04 14:35:14', '2022-02-04 14:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci COMMENT 'contains full address',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: banned, 1: active',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: sms unverified, 1: sms verified',
  `ver_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `country_code`, `mobile`, `ref_by`, `balance`, `password`, `image`, `address`, `status`, `ev`, `sv`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ravi', 'manra', 'test12', 'test@mail.com', 'AF', '931212121212', 0, '0.00000000', '$2y$10$Ak2l4cy3bp8UNE8RjySmrurT5WZSb/XmdbKZG1ria3KdN5v8iI.fa', NULL, '{\"address\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"Afghanistan\",\"city\":\"\"}', 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-10-30 00:46:28', '2021-10-30 00:46:28'),
(2, 'sarita', 'sahota', 'sarroh', 'sarita@unifysofttech.com', 'AF', '93876543234', 0, '0.00000000', '$2y$10$pSfWJwvywQlq48hYQ8hzw.7stXZ9ekcb9Nuo/6zYkYb1ofIq./t8i', NULL, '{\"address\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"Afghanistan\",\"city\":\"\"}', 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-11-07 22:51:34', '2022-02-02 17:33:47'),
(3, 'demo', 'unify', 'demo12', 'demo@unifysofttech.com', 'IN', '919876543211', 0, '0.00000000', '$2y$10$fP8wS3kisp.7KDFSOdj0P.Tt9zmdf5qu7KFjQmmW5hPzThw7kQPFG', NULL, '{\"address\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"India\",\"city\":\"\"}', 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-11-12 22:38:48', '2021-11-12 22:38:48'),
(4, 'sarita', 'sahota', 'saritasahota', 'sarita.unify1@gmail.com', NULL, '5666564564645', 0, '0.00000000', '', '61962a78a74231637231224.jpg', '{\"address\":\"ppr\",\"state\":\"punjab\",\"zip\":\"144002\",\"country\":null,\"city\":\"jalandhar\"}', 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-11-18 05:00:00', '2021-11-18 15:34:41'),
(5, 'Ravi Kumar', 'Manra', 'ravikumarmanra', 'ravi.manra@gmail.com', NULL, NULL, 0, '0.00000000', '', 'https://lh3.googleusercontent.com/a-/AOh14GhdUCgaZcK-T7Yf1KxRWdvbd_M6uBlOrSwaepU-Pw=s96-c', NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-11-24 05:00:00', '2021-11-24 05:00:00'),
(6, 'test', 'Song', 'insusong', 'phyuzion@gmail.com', NULL, '2232', 0, '0.00000000', '', 'https://lh3.googleusercontent.com/a-/AOh14GhHQgbqt8QA6n6vwmpOp4IzHbGu7RPE24OwqcYLaw=s96-c', '{\"state\":\"123\",\"zip\":\"123123\",\"country\":null,\"city\":\"123123\"}', 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-11-25 05:00:00', '2021-12-02 12:47:06'),
(7, 'sarita', 'sahota', 'sarita.unify', 'sarita.unify2@gmail.com', NULL, NULL, 0, '0.00000000', '', 'https://lh3.googleusercontent.com/a/AATXAJxhNeTUmD6rbMHMaXpIwGJSy_4yDn4JJLc4md02=s96-c', NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-12-02 05:00:00', '2022-02-02 14:01:34'),
(8, 'John', 'Smith', 'vivek123', 'vivek123@gmail.com', NULL, NULL, 0, '0.00000000', '$2y$10$bHjZPJ4sxzqGP8qCrv5fEeqqNCBLhr.qKSZZf0PLqF3YlX0WO3cjG', NULL, NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-12-18 09:48:57', '2021-12-18 09:48:57'),
(9, 'Harry', 'Lee', 'user123', 'user123@gmail.com', NULL, NULL, 0, '0.00000000', '$2y$10$jfMUgx6/rF0fUS0vo3tMA.ZxnR.D9Pq3B.svG86rKYbnEbZ7C7TNq', NULL, NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-12-18 11:06:40', '2021-12-18 11:06:40'),
(10, 'Unify', 'SoftTech', 'unifysofttech', 'unifysofttech@gmail.com', NULL, NULL, 0, '100.00000000', '', 'https://lh3.googleusercontent.com/a-/AOh14GhBA73K5LOhW_CaRmqva_szh4vIFGv_HcIsLl0=s96-c', NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-12-20 05:00:00', '2022-02-04 14:35:14'),
(11, NULL, NULL, 'crsujith', 'sujith.kumar.c.r@gmail.com', NULL, NULL, 0, '0.00000000', '$2y$10$58ykzDslkrf4NBM98I/vGe8PRQaHBo81NCSrP6IZiJoeEdW5sdOCK', NULL, NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2021-12-21 10:27:11', '2021-12-21 10:27:11'),
(12, NULL, NULL, 'ississ', 'iss.song@five-corporation.com', NULL, NULL, 0, '0.00000000', '$2y$10$/cxeq9iR5/MlNQ8zh/ucsuZcZIBbibcbZcnJ7FAjEv7I0nvkvgde6', NULL, NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2022-01-26 07:01:56', '2022-01-26 07:01:56'),
(13, NULL, NULL, 'foparo9393', 'foparo9393@mxclip.com', NULL, NULL, 0, '0.00000000', '$2y$10$O/.O.EqA3lljHun1/cwLI.4LTCKFUcQ7zHhfgyi0ycCoTC1h9aGE2', '61f908f9946a21643710713.jpg', NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2022-02-01 12:44:15', '2022-02-01 15:18:33'),
(14, NULL, NULL, 'sarita', 'sarita.unify@gmail.com', NULL, NULL, 0, '0.00000000', '$2y$10$7aEbF/YjIyCA/wCJQPumkeb3BiCf2PHaADu5ZAmGArix854m4Kis6', NULL, NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2022-02-02 14:40:11', '2022-02-03 11:52:58'),
(15, NULL, NULL, 'yixenoh459', 'yixenoh459@porjoton.com', NULL, NULL, 0, '0.00000000', '$2y$10$xqBUEG4.Z73pDuZQWGh.He7ysmVo.VRbSs8P6oql35n1hjv/uneem', NULL, NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2022-02-02 16:43:10', '2022-02-02 16:43:40'),
(16, NULL, NULL, 'mytest', 'mytest@mytest.com', NULL, NULL, 0, '0.00000000', '$2y$10$xw724qVj2j.VmhbNaHVUTuav/bmFQIBygv283HlHw0VD/PTo/9JEi', NULL, NULL, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2022-02-02 16:46:04', '2022-02-02 16:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_ip` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `city`, `country`, `country_code`, `longitude`, `latitude`, `browser`, `os`, `created_at`, `updated_at`) VALUES
(1, 1, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-10-30 00:46:28', '2021-10-30 00:46:28'),
(2, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-07 22:51:34', '2021-11-07 22:51:34'),
(3, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-07 22:55:07', '2021-11-07 22:55:07'),
(4, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-09 23:54:34', '2021-11-09 23:54:34'),
(5, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-10 23:36:23', '2021-11-10 23:36:23'),
(6, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-11 23:00:48', '2021-11-11 23:00:48'),
(7, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-11 23:15:13', '2021-11-11 23:15:13'),
(8, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-12 01:37:45', '2021-11-12 01:37:45'),
(9, 3, 'fe80::385f:930c:f75d:e65a', '', '', '', '', '', 'Firefox', 'Windows 10', '2021-11-12 22:38:48', '2021-11-12 22:38:48'),
(10, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-12 22:43:27', '2021-11-12 22:43:27'),
(11, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-16 00:47:06', '2021-11-16 00:47:06'),
(12, 3, 'fe80::385f:930c:f75d:e65a', '', '', '', '', '', 'Firefox', 'Windows 10', '2021-11-16 00:49:20', '2021-11-16 00:49:20'),
(13, 3, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-11-16 03:57:14', '2021-11-16 03:57:14'),
(14, 3, 'fe80::385f:930c:f75d:e65a', '', '', '', '', '', 'Firefox', 'Windows 10', '2021-11-16 03:57:53', '2021-11-16 03:57:53'),
(15, 3, '203.134.200.192', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-11-16 17:30:18', '2021-11-16 17:30:18'),
(16, 2, '203.134.200.192', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-11-17 14:25:57', '2021-11-17 14:25:57'),
(17, 3, '203.134.200.192', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-11-18 10:09:28', '2021-11-18 10:09:28'),
(18, 3, '203.134.200.192', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-11-24 16:10:10', '2021-11-24 16:10:10'),
(19, 3, '203.134.200.192', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-11-26 12:00:22', '2021-11-26 12:00:22'),
(20, 3, '203.134.200.192', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-02 12:52:26', '2021-12-02 12:52:26'),
(21, 3, '162.158.227.203', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-03 13:45:40', '2021-12-03 13:45:40'),
(22, 3, '162.158.48.39', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-03 15:57:44', '2021-12-03 15:57:44'),
(23, 3, '162.158.227.253', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-07 11:41:12', '2021-12-07 11:41:12'),
(24, 3, '162.158.235.42', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-09 09:36:10', '2021-12-09 09:36:10'),
(25, 3, '162.158.235.42', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-09 09:39:54', '2021-12-09 09:39:54'),
(26, 3, '172.68.79.141', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-14 16:57:27', '2021-12-14 16:57:27'),
(27, 3, '172.68.79.143', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-15 09:23:12', '2021-12-15 09:23:12'),
(28, 3, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-15 13:38:05', '2021-12-15 13:38:05'),
(29, 3, '172.68.79.141', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-15 13:54:42', '2021-12-15 13:54:42'),
(30, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-15 14:17:26', '2021-12-15 14:17:26'),
(31, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-15 14:19:26', '2021-12-15 14:19:26'),
(32, 3, '172.70.218.213', 'Chandigarh', 'India', 'IN', '76.795', '30.7324', 'Chrome', 'Windows 10', '2021-12-15 20:28:06', '2021-12-15 20:28:06'),
(33, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-16 08:55:03', '2021-12-16 08:55:03'),
(34, 3, '172.70.218.81', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-16 09:16:01', '2021-12-16 09:16:01'),
(35, 3, '172.70.218.195', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Firefox', 'Windows 10', '2021-12-16 11:10:48', '2021-12-16 11:10:48'),
(36, 3, '172.68.79.143', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-16 14:23:43', '2021-12-16 14:23:43'),
(37, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-16 14:33:47', '2021-12-16 14:33:47'),
(38, 3, '172.70.218.213', 'Chandigarh', 'India', 'IN', '76.795', '30.7324', 'Chrome', 'Windows 10', '2021-12-16 14:39:38', '2021-12-16 14:39:38'),
(39, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-16 15:40:07', '2021-12-16 15:40:07'),
(40, 3, '172.68.79.141', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-17 09:38:59', '2021-12-17 09:38:59'),
(41, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-17 09:40:30', '2021-12-17 09:40:30'),
(42, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-17 17:35:16', '2021-12-17 17:35:16'),
(43, 3, '162.158.227.157', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-17 17:57:23', '2021-12-17 17:57:23'),
(44, 3, '162.158.48.75', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 08:34:43', '2021-12-18 08:34:43'),
(45, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 09:12:23', '2021-12-18 09:12:23'),
(46, 8, '172.68.79.143', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 09:48:57', '2021-12-18 09:48:57'),
(47, 9, '162.158.48.89', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 11:06:41', '2021-12-18 11:06:41'),
(48, 8, '172.70.218.81', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 11:12:35', '2021-12-18 11:12:35'),
(49, 9, '172.70.218.81', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 11:12:54', '2021-12-18 11:12:54'),
(50, 3, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 11:30:25', '2021-12-18 11:30:25'),
(51, 8, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 11:36:35', '2021-12-18 11:36:35'),
(52, 3, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 11:41:11', '2021-12-18 11:41:11'),
(53, 9, '172.68.79.141', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 11:48:15', '2021-12-18 11:48:15'),
(54, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 12:11:39', '2021-12-18 12:11:39'),
(55, 8, '162.158.227.157', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 12:24:06', '2021-12-18 12:24:06'),
(56, 9, '172.68.79.141', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 12:25:56', '2021-12-18 12:25:56'),
(57, 3, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 12:28:49', '2021-12-18 12:28:49'),
(58, 8, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 12:30:47', '2021-12-18 12:30:47'),
(59, 3, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 12:50:17', '2021-12-18 12:50:17'),
(60, 8, '172.68.79.141', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 12:53:33', '2021-12-18 12:53:33'),
(61, 9, '172.70.218.195', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 12:55:36', '2021-12-18 12:55:36'),
(62, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 13:00:27', '2021-12-18 13:00:27'),
(63, 8, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 13:01:32', '2021-12-18 13:01:32'),
(64, 9, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 13:03:34', '2021-12-18 13:03:34'),
(65, 3, '172.68.79.143', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 13:35:52', '2021-12-18 13:35:52'),
(66, 3, '172.70.218.195', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 13:42:30', '2021-12-18 13:42:30'),
(67, 3, '172.70.218.213', 'Chandigarh', 'India', 'IN', '76.795', '30.7324', 'Chrome', 'Windows 10', '2021-12-18 13:48:41', '2021-12-18 13:48:41'),
(68, 8, '162.158.48.75', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 15:57:01', '2021-12-18 15:57:01'),
(69, 9, '162.158.235.82', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 16:06:58', '2021-12-18 16:06:58'),
(70, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 16:48:14', '2021-12-18 16:48:14'),
(71, 8, '172.68.79.141', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 16:58:09', '2021-12-18 16:58:09'),
(72, 3, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 17:11:52', '2021-12-18 17:11:52'),
(73, 8, '162.158.235.12', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 17:15:48', '2021-12-18 17:15:48'),
(74, 3, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 17:26:41', '2021-12-18 17:26:41'),
(75, 8, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 17:28:13', '2021-12-18 17:28:13'),
(76, 8, '172.68.79.143', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 17:38:56', '2021-12-18 17:38:56'),
(77, 3, '172.70.218.223', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 17:48:31', '2021-12-18 17:48:31'),
(78, 8, '172.70.218.223', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 17:50:14', '2021-12-18 17:50:14'),
(79, 3, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 17:59:22', '2021-12-18 17:59:22'),
(80, 8, '172.68.79.143', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 18:01:01', '2021-12-18 18:01:01'),
(81, 3, '172.68.79.169', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 18:07:18', '2021-12-18 18:07:18'),
(82, 8, '172.68.79.143', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 18:08:29', '2021-12-18 18:08:29'),
(83, 3, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 18:15:28', '2021-12-18 18:15:28'),
(84, 8, '172.68.79.155', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-18 18:16:30', '2021-12-18 18:16:30'),
(85, 3, '172.68.79.175', 'Patiala', 'India', 'IN', '76.3922', '30.3362', 'Chrome', 'Windows 10', '2021-12-19 19:09:38', '2021-12-19 19:09:38'),
(86, 3, '162.158.227.127', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-20 17:09:25', '2021-12-20 17:09:25'),
(87, 3, '172.70.218.239', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-20 17:11:05', '2021-12-20 17:11:05'),
(88, 11, '172.68.154.149', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2021-12-21 10:27:12', '2021-12-21 10:27:12'),
(89, 11, '172.68.154.149', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2021-12-21 10:28:03', '2021-12-21 10:28:03'),
(90, 3, '172.68.79.163', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2021-12-21 10:32:29', '2021-12-21 10:32:29'),
(91, 11, '172.68.154.139', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2021-12-21 10:36:55', '2021-12-21 10:36:55'),
(92, 11, '172.68.154.149', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2021-12-21 10:38:37', '2021-12-21 10:38:37'),
(93, 11, '172.68.154.139', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2021-12-21 10:41:21', '2021-12-21 10:41:21'),
(94, 3, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-21 01:40:31', '2021-12-21 01:40:31'),
(95, 3, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-21 03:08:32', '2021-12-21 03:08:32'),
(96, 3, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-21 03:29:17', '2021-12-21 03:29:17'),
(97, 3, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-21 03:29:41', '2021-12-21 03:29:41'),
(98, 3, '192.168.100.116', '', '', '', '', '', 'Handheld Browser', 'Android', '2021-12-21 05:52:36', '2021-12-21 05:52:36'),
(99, 3, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-23 01:01:19', '2021-12-23 01:01:19'),
(100, 2, '192.168.100.116', '', '', '', '', '', 'Handheld Browser', 'Android', '2021-12-23 01:31:37', '2021-12-23 01:31:37'),
(101, 3, '192.168.100.116', '', '', '', '', '', 'Handheld Browser', 'Android', '2021-12-23 01:51:55', '2021-12-23 01:51:55'),
(102, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-23 05:33:37', '2021-12-23 05:33:37'),
(103, 3, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-23 05:38:05', '2021-12-23 05:38:05'),
(104, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-23 06:21:33', '2021-12-23 06:21:33'),
(105, 8, '192.168.100.116', '', '', '', '', '', 'Handheld Browser', 'Android', '2021-12-23 06:24:43', '2021-12-23 06:24:43'),
(106, 3, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-23 06:40:05', '2021-12-23 06:40:05'),
(107, 2, '192.168.100.116', '', '', '', '', '', 'Chrome', 'Windows 10', '2021-12-23 06:47:40', '2021-12-23 06:47:40'),
(108, 3, '192.168.100.116', '', '', '', '', '', 'Handheld Browser', 'Android', '2021-12-28 02:08:53', '2021-12-28 02:08:53'),
(109, 3, '172.70.162.201', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-01-20 17:40:09', '2022-01-20 17:40:09'),
(110, 3, '172.70.162.201', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-01-22 16:15:28', '2022-01-22 16:15:28'),
(111, 12, '172.68.118.31', 'Daejeon', 'South Korea', 'KR', '127.4316', '36.3269', 'Chrome', 'Windows 10', '2022-01-26 07:01:56', '2022-01-26 07:01:56'),
(112, 12, '172.68.118.31', 'Daejeon', 'South Korea', 'KR', '127.4316', '36.3269', 'Chrome', 'Windows 10', '2022-01-26 07:02:40', '2022-01-26 07:02:40'),
(113, 3, '172.70.86.4', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-01-27 17:35:16', '2022-01-27 17:35:16'),
(114, 11, '172.68.154.139', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2022-01-29 12:05:15', '2022-01-29 12:05:15'),
(115, 11, '172.68.154.139', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2022-01-29 12:05:44', '2022-01-29 12:05:44'),
(116, 13, '172.70.147.103', 'Bengaluru', 'India', 'IN', '77.5937', '12.9719', 'Chrome', 'Mac OS X', '2022-02-01 12:44:15', '2022-02-01 12:44:15'),
(117, 13, '172.70.92.217', 'Bengaluru', 'India', 'IN', '77.5937', '12.9719', 'Chrome', 'Mac OS X', '2022-02-01 12:45:18', '2022-02-01 12:45:18'),
(118, 13, '172.70.142.55', 'Bengaluru', 'India', 'IN', '77.5937', '12.9719', 'Chrome', 'Mac OS X', '2022-02-01 12:51:42', '2022-02-01 12:51:42'),
(119, 3, '162.158.159.133', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-01 17:00:06', '2022-02-01 17:00:06'),
(120, 3, '172.70.85.137', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-01 17:00:34', '2022-02-01 17:00:34'),
(121, 13, '172.70.188.11', 'Bengaluru', 'India', 'IN', '77.5937', '12.9719', 'Chrome', 'Mac OS X', '2022-02-01 19:39:19', '2022-02-01 19:39:19'),
(122, 3, '172.70.90.25', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-02 09:30:56', '2022-02-02 09:30:56'),
(123, 11, '172.68.154.147', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2022-02-02 11:53:17', '2022-02-02 11:53:17'),
(124, 11, '172.68.154.147', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2022-02-02 11:54:29', '2022-02-02 11:54:29'),
(125, 13, '162.158.162.149', '', 'India', 'IN', '77', '20', 'Chrome', 'Mac OS X', '2022-02-02 12:56:29', '2022-02-02 12:56:29'),
(126, 14, '172.70.90.25', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-02 14:40:11', '2022-02-02 14:40:11'),
(127, 14, '172.70.90.3', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-02 15:02:12', '2022-02-02 15:02:12'),
(128, 11, '172.68.154.147', 'Coimbatore', 'India', 'IN', '76.9661', '11.0055', 'Chrome', 'Mac OS X', '2022-02-02 16:31:55', '2022-02-02 16:31:55'),
(129, 15, '172.70.92.147', '', 'India', 'IN', '77', '20', 'Safari', 'Mac OS X', '2022-02-02 16:43:11', '2022-02-02 16:43:11'),
(130, 15, '172.70.92.147', '', 'India', 'IN', '77', '20', 'Safari', 'Mac OS X', '2022-02-02 16:43:59', '2022-02-02 16:43:59'),
(131, 16, '172.70.92.147', '', 'India', 'IN', '77', '20', 'Safari', 'Mac OS X', '2022-02-02 16:46:05', '2022-02-02 16:46:05'),
(132, 16, '172.70.92.147', '', 'India', 'IN', '77', '20', 'Safari', 'Mac OS X', '2022-02-02 16:46:23', '2022-02-02 16:46:23'),
(133, 2, '172.70.162.47', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-02 17:29:28', '2022-02-02 17:29:28'),
(134, 2, '172.70.85.227', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-02 17:31:44', '2022-02-02 17:31:44'),
(135, 2, '172.70.85.137', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-02 17:33:30', '2022-02-02 17:33:30'),
(136, 2, '172.70.85.137', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-02 17:33:58', '2022-02-02 17:33:58'),
(137, 13, '172.70.142.243', '', 'India', 'IN', '77', '20', 'Chrome', 'Mac OS X', '2022-02-03 10:16:50', '2022-02-03 10:16:50'),
(138, 14, '162.158.159.99', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-03 11:51:48', '2022-02-03 11:51:48'),
(139, 14, '162.158.159.99', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-03 11:52:30', '2022-02-03 11:52:30'),
(140, 14, '162.158.159.99', 'Bathinda', 'India', 'IN', '74.9389', '30.2075', 'Chrome', 'Windows 10', '2022-02-03 11:53:11', '2022-02-03 11:53:11'),
(141, 13, '172.70.147.13', 'Nagercoil', 'India', 'IN', '77.4323', '8.179', 'Chrome', 'Mac OS X', '2022-02-04 10:58:10', '2022-02-04 10:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

DROP TABLE IF EXISTS `withdrawals`;
CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `method_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `after_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `withdraw_information` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

DROP TABLE IF EXISTS `withdraw_methods`;
CREATE TABLE IF NOT EXISTS `withdraw_methods` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_limit` decimal(28,8) DEFAULT '0.00000000',
  `max_limit` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `delay` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charge` decimal(28,8) DEFAULT '0.00000000',
  `rate` decimal(28,8) DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_data` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_transactions`
--

DROP TABLE IF EXISTS `withdraw_transactions`;
CREATE TABLE IF NOT EXISTS `withdraw_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_hash` varchar(250) NOT NULL DEFAULT '',
  `signature` varchar(250) NOT NULL DEFAULT '',
  `block_no` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` varchar(200) NOT NULL DEFAULT '',
  `from_address` varchar(200) NOT NULL DEFAULT '',
  `to_address` varchar(200) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `symbol` char(4) NOT NULL DEFAULT '',
  `amount` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
