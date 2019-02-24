-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019-02-24 06:06:55
-- 服务器版本： 5.6.36
-- PHP Version: 7.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo_site`
--

-- --------------------------------------------------------

--
-- 表的结构 `ps_comments`
--

CREATE TABLE `ps_comments` (
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `comment_author_system` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'windows',
  `comment_author_location` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '北京市朝阳区',
  `comment_author_photo_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_software_tool` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'Chrome 15.0.0.12',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `author_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'comment user id',
  `author_name` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '游客' COMMENT 'author name '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- 转存表中的数据 `ps_comments`
--

INSERT INTO `ps_comments` (`comment_id`, `comment_author_system`, `comment_author_location`, `comment_author_photo_url`, `comment_author_software_tool`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `author_id`, `author_name`) VALUES
(1, '一位WordPress评论者', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2018-03-05 00:25:47', '2018-03-04 16:25:47', '嗨，这是一条评论。\n要开始审核、编辑及删除评论，请访问仪表盘的“评论”页面。\n评论者头像来自<a href=\"https://gravatar.com\">Gravatar</a>。', 0, '1', '', '', 0, 0, '游客'),
(2, '1095905081', '1095905081@qq.com', '', '171.88.83.22', '2018-06-15 19:36:22', '2018-06-15 11:36:22', 'while(1)alert(\'1095905081\')', 0, '0', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', '', 0, 0, '游客');

-- --------------------------------------------------------

--
-- 表的结构 `ps_load_history`
--

CREATE TABLE `ps_load_history` (
  `load_id` bigint(20) NOT NULL COMMENT 'the main download id',
  `user_id` bigint(20) NOT NULL,
  `photo_id` bigint(20) NOT NULL,
  `load_time` datetime NOT NULL,
  `load_type` int(5) DEFAULT '0' COMMENT '0 is download,1 is  upload'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='this table is about download history';

-- --------------------------------------------------------

--
-- 表的结构 `ps_photo2targets`
--

CREATE TABLE `ps_photo2targets` (
  `photo2target_id` bigint(20) UNSIGNED NOT NULL COMMENT 'link photo and targets',
  `photo_id` bigint(20) UNSIGNED NOT NULL COMMENT 'photo id',
  `target_id` bigint(20) UNSIGNED NOT NULL COMMENT 'target id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='link photo and target';

-- --------------------------------------------------------

--
-- 表的结构 `ps_photos`
--

CREATE TABLE `ps_photos` (
  `photo_id` bigint(20) UNSIGNED NOT NULL COMMENT 'photo id',
  `photo_name` varchar(100) NOT NULL COMMENT 'the photo name',
  `photo_message` text NOT NULL COMMENT 'photo message',
  `photo_address` varchar(200) NOT NULL DEFAULT 'http://meisupic.com/themes/meisu2017/imgs/1-中.jpg' COMMENT 'photo link and address',
  `photo_width` int(10) NOT NULL COMMENT 'image width to process',
  `photo_height` int(10) NOT NULL COMMENT 'image height to process',
  `ueser_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'the author id is the auther',
  `photo_format` varchar(50) NOT NULL DEFAULT '照片' COMMENT 'photo format ',
  `photo_eigenvalues` varchar(30) NOT NULL DEFAULT '25,36,75,66,99,44,55,88,11' COMMENT 'images'' eigenvalues',
  `photo_topic_id` bigint(20) DEFAULT NULL COMMENT 'photo''s topic id '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ps_targets`
--

CREATE TABLE `ps_targets` (
  `target_id` bigint(20) NOT NULL COMMENT 'target id ',
  `target_name` varchar(80) NOT NULL COMMENT 'target name',
  `target_message` text NOT NULL COMMENT 'target main explain',
  `create_time` datetime NOT NULL DEFAULT '2018-12-09 08:56:23' COMMENT 'the target create time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='this table is created to write down photos'' target ';

-- --------------------------------------------------------

--
-- 表的结构 `ps_topics`
--

CREATE TABLE `ps_topics` (
  `topic_id` bigint(20) NOT NULL COMMENT 'main topic id',
  `topic_name` varchar(80) NOT NULL COMMENT 'the topic main name',
  `topic_message` text NOT NULL COMMENT 'to say the detail about topic',
  `create_time` datetime NOT NULL COMMENT 'create time',
  `display_photo_id` bigint(20) NOT NULL COMMENT 'main display photo id ',
  `topic_target` varchar(20) NOT NULL COMMENT 'topic target '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ps_users`
--

CREATE TABLE `ps_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'users id',
  `user_name` varchar(100) NOT NULL DEFAULT '' COMMENT 'users name',
  `user_phone_number` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'user phone number',
  `user_little_name` varchar(80) NOT NULL DEFAULT '' COMMENT 'user little name ',
  `user_real_name` varchar(80) NOT NULL DEFAULT '' COMMENT 'user really name',
  `user_qq` bigint(25) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'users qq number',
  `user_email` varchar(100) NOT NULL DEFAULT '' COMMENT 'users email',
  `user_pwd` varchar(255) NOT NULL DEFAULT '' COMMENT 'users password',
  `user_register_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'users_register time',
  `user_state` int(5) NOT NULL DEFAULT '0' COMMENT 'check the user ''s state avoid again login',
  `user_company` varchar(100) NOT NULL DEFAULT '' COMMENT 'uers compauny name',
  `user_head_image` varchar(150) NOT NULL DEFAULT '' COMMENT 'user head image link',
  `user_download_number` bigint(100) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'users down load number',
  `user_upload_number` bigint(100) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='photo site user information to help us ';

--
-- 转存表中的数据 `ps_users`
--

INSERT INTO `ps_users` (`user_id`, `user_name`, `user_phone_number`, `user_little_name`, `user_real_name`, `user_qq`, `user_email`, `user_pwd`, `user_register_time`, `user_state`, `user_company`, `user_head_image`, `user_download_number`, `user_upload_number`) VALUES
(1, 'wangpengcheng', 0, '王鹏程', '王鹏程', 0, '673018396@qq.com', 'wang123!', '2019-02-16 00:00:00', 0, 'sichuan ', 'www.baidu.com', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ps_user_browserecord`
--

CREATE TABLE `ps_user_browserecord` (
  `record_id` bigint(20) UNSIGNED NOT NULL COMMENT 'record id',
  `user_id` bigint(20) NOT NULL COMMENT 'user_id',
  `photo_id` bigint(20) NOT NULL COMMENT 'photo_id',
  `record_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ps_user_favorites`
--

CREATE TABLE `ps_user_favorites` (
  `favorites_id` bigint(20) NOT NULL COMMENT 'favorutes id',
  `folder_id` bigint(20) NOT NULL DEFAULT '0' COMMENT ' set favorites folder',
  `user_id` bigint(20) DEFAULT '0' COMMENT 'user id',
  `photo_id` bigint(20) DEFAULT '0' COMMENT 'photo id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ps_user_favorites_folder`
--

CREATE TABLE `ps_user_favorites_folder` (
  `folder_id` bigint(20) UNSIGNED NOT NULL COMMENT 'folder id ',
  `folder_name` varchar(100) NOT NULL DEFAULT '默认1' COMMENT 'folder name',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'user id ',
  `folder_create_time` datetime NOT NULL COMMENT 'this time folder create '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ps_comments`
--
ALTER TABLE `ps_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_location`(10));

--
-- Indexes for table `ps_load_history`
--
ALTER TABLE `ps_load_history`
  ADD PRIMARY KEY (`load_id`);

--
-- Indexes for table `ps_photo2targets`
--
ALTER TABLE `ps_photo2targets`
  ADD PRIMARY KEY (`photo2target_id`);

--
-- Indexes for table `ps_photos`
--
ALTER TABLE `ps_photos`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `ps_targets`
--
ALTER TABLE `ps_targets`
  ADD PRIMARY KEY (`target_id`);

--
-- Indexes for table `ps_topics`
--
ALTER TABLE `ps_topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `ps_users`
--
ALTER TABLE `ps_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ps_user_browserecord`
--
ALTER TABLE `ps_user_browserecord`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `ps_user_favorites`
--
ALTER TABLE `ps_user_favorites`
  ADD PRIMARY KEY (`favorites_id`);

--
-- Indexes for table `ps_user_favorites_folder`
--
ALTER TABLE `ps_user_favorites_folder`
  ADD PRIMARY KEY (`folder_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ps_comments`
--
ALTER TABLE `ps_comments`
  MODIFY `comment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `ps_load_history`
--
ALTER TABLE `ps_load_history`
  MODIFY `load_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'the main download id', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `ps_photo2targets`
--
ALTER TABLE `ps_photo2targets`
  MODIFY `photo2target_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'link photo and targets';
--
-- 使用表AUTO_INCREMENT `ps_photos`
--
ALTER TABLE `ps_photos`
  MODIFY `photo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'photo id';
--
-- 使用表AUTO_INCREMENT `ps_targets`
--
ALTER TABLE `ps_targets`
  MODIFY `target_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'target id ';
--
-- 使用表AUTO_INCREMENT `ps_topics`
--
ALTER TABLE `ps_topics`
  MODIFY `topic_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'main topic id';
--
-- 使用表AUTO_INCREMENT `ps_users`
--
ALTER TABLE `ps_users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'users id', AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `ps_user_browserecord`
--
ALTER TABLE `ps_user_browserecord`
  MODIFY `record_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'record id';
--
-- 使用表AUTO_INCREMENT `ps_user_favorites`
--
ALTER TABLE `ps_user_favorites`
  MODIFY `favorites_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'favorutes id';
--
-- 使用表AUTO_INCREMENT `ps_user_favorites_folder`
--
ALTER TABLE `ps_user_favorites_folder`
  MODIFY `folder_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'folder id ';COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
