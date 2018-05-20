-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 Mei 2018 pada 10.09
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basic_blog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tw_blog`
--

CREATE TABLE `tw_blog` (
  `blog_id` int(11) NOT NULL,
  `blog_user` varchar(32) NOT NULL,
  `blog_cat_id` int(11) NOT NULL,
  `blog_date` date NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tw_blog`
--

INSERT INTO `tw_blog` (`blog_id`, `blog_user`, `blog_cat_id`, `blog_date`, `blog_title`, `blog_body`) VALUES
(10, 'cyberko', 8, '2018-05-20', 'Apa Itu HTML?', 'HTML adalah kepanjangan dari Hypertext Markup Language dan merupakan salah satu bahasa yang paling banyak digunakan dalam mebuat halaman web.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tw_category`
--

CREATE TABLE `tw_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tw_category`
--

INSERT INTO `tw_category` (`cat_id`, `cat_name`) VALUES
(8, 'HTML');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tw_comment`
--

CREATE TABLE `tw_comment` (
  `com_id` int(11) NOT NULL,
  `com_blog_id` int(11) NOT NULL,
  `com_date` date NOT NULL,
  `com_name` varchar(32) NOT NULL,
  `com_email` varchar(32) NOT NULL,
  `com_body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tw_guestbook`
--

CREATE TABLE `tw_guestbook` (
  `guest_id` int(11) NOT NULL,
  `guest_date` date NOT NULL,
  `guest_name` varchar(50) NOT NULL,
  `guest_email` varchar(50) NOT NULL,
  `guest_website` varchar(100) NOT NULL,
  `guest_comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tw_page`
--

CREATE TABLE `tw_page` (
  `page_id` int(11) NOT NULL,
  `page_user` varchar(32) NOT NULL,
  `page_date` date NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_body` text NOT NULL,
  `page_top` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tw_page`
--

INSERT INTO `tw_page` (`page_id`, `page_user`, `page_date`, `page_title`, `page_body`, `page_top`) VALUES
(1, '01', '2018-05-08', 'Tentang Kami', 'Kelas Pemrograman Web-VII\r\n<br>\r\n<br>\r\nMuhammad afandi           5150411331\r\n<br>\r\nMuhammad Arif Tegar Sakti 5150411334\r\n<br>\r\nDwi Budi Ardhani          5150411335\r\n<br>\r\nFajar Cahyono             5150411350', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tw_user`
--

CREATE TABLE `tw_user` (
  `user_id` int(11) NOT NULL,
  `user_date` date NOT NULL,
  `user_username` varchar(32) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `user_email` varchar(32) NOT NULL,
  `user_active` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tw_user`
--

INSERT INTO `tw_user` (`user_id`, `user_date`, `user_username`, `user_password`, `user_name`, `user_email`, `user_active`) VALUES
(6, '2018-05-20', 'cyberko', '827ccb0eea8a706c4c34a16891f84e7b', 'Fajar Cahyono', 'dbacyberko@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tw_blog`
--
ALTER TABLE `tw_blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `tw_category`
--
ALTER TABLE `tw_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tw_comment`
--
ALTER TABLE `tw_comment`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `tw_guestbook`
--
ALTER TABLE `tw_guestbook`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `tw_page`
--
ALTER TABLE `tw_page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `tw_user`
--
ALTER TABLE `tw_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tw_blog`
--
ALTER TABLE `tw_blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tw_category`
--
ALTER TABLE `tw_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tw_comment`
--
ALTER TABLE `tw_comment`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tw_guestbook`
--
ALTER TABLE `tw_guestbook`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tw_page`
--
ALTER TABLE `tw_page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tw_user`
--
ALTER TABLE `tw_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
