-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2014 at 10:36 PM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nx3`
--

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_activity`
--

CREATE TABLE IF NOT EXISTS `core_nx3_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(150) NOT NULL,
  `activity_code` varchar(100) NOT NULL,
  `activity_description` varchar(255) NOT NULL,
  `activity_sql` varchar(4000) NOT NULL,
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`activity_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_activity_security`
--

CREATE TABLE IF NOT EXISTS `core_nx3_activity_security` (
  `activity_security_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`activity_security_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `activity_id` (`activity_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_article`
--

CREATE TABLE IF NOT EXISTS `core_nx3_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_code` varchar(100) NOT NULL,
  `article_name` varchar(150) NOT NULL,
  `article_description` varchar(255) NOT NULL,
  `article_folder_id` int(11) NOT NULL,
  `order_by` int(11) NOT NULL DEFAULT '1',
  `hidden_yn` varchar(1) NOT NULL DEFAULT 'N',
  `article_text` text NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `allow_comments_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `deleted_yn` varchar(1) NOT NULL DEFAULT 'N',
  `image_res_id` int(11) NOT NULL DEFAULT '-1',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `article_code` (`article_code`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `article_folder_id` (`article_folder_id`),
  KEY `image_res_id` (`image_res_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=437 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_article_attachment`
--

CREATE TABLE IF NOT EXISTS `core_nx3_article_attachment` (
  `article_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `attachment_blob` longblob NOT NULL,
  `attachment_file_name` varchar(255) NOT NULL,
  `attachment_description` varchar(255) NOT NULL,
  `attachment_content_type` varchar(50) NOT NULL,
  `deleted_yn` varchar(1) NOT NULL DEFAULT 'N',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`article_attachment_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_article_comment`
--

CREATE TABLE IF NOT EXISTS `core_nx3_article_comment` (
  `article_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `comment_text` varchar(50000) NOT NULL,
  `deleted_yn` varchar(1) NOT NULL DEFAULT 'N',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`article_comment_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_article_folder`
--

CREATE TABLE IF NOT EXISTS `core_nx3_article_folder` (
  `article_folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_folder_code` varchar(100) NOT NULL,
  `article_folder_name` varchar(150) NOT NULL,
  `parent_article_folder_id` int(11) NOT NULL,
  `show_top_articles` int(11) NOT NULL DEFAULT '10',
  `order_by` int(11) NOT NULL DEFAULT '1',
  `hidden_yn` varchar(1) NOT NULL DEFAULT 'N',
  `deleted_yn` varchar(1) NOT NULL DEFAULT 'N',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`article_folder_id`),
  UNIQUE KEY `article_folder_code` (`article_folder_code`),
  UNIQUE KEY `article_folder_name` (`article_folder_name`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `article_folder_id` (`article_folder_id`),
  KEY `parent_article_folder_id` (`parent_article_folder_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_article_folder_security`
--

CREATE TABLE IF NOT EXISTS `core_nx3_article_folder_security` (
  `article_folder_security_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_folder_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`article_folder_security_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `article_folder_id` (`article_folder_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_feed`
--

CREATE TABLE IF NOT EXISTS `core_nx3_feed` (
  `feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_code` varchar(100) NOT NULL,
  `feed_name` varchar(150) NOT NULL,
  `feed_description` varchar(255) NOT NULL,
  `feed_sql` varchar(4000) NOT NULL,
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`feed_id`),
  UNIQUE KEY `feed_code` (`feed_code`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_feed_external`
--

CREATE TABLE IF NOT EXISTS `core_nx3_feed_external` (
  `feed_external_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_external_code` varchar(100) NOT NULL,
  `feed_external_name` varchar(150) NOT NULL,
  `feed_external_description` varchar(255) NOT NULL,
  `feed_external_url` varchar(1024) NOT NULL,
  `last_cache_success` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `last_cache_attempt` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `auto_index_enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`feed_external_id`),
  UNIQUE KEY `feed_code` (`feed_external_code`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_feed_external_cache`
--

CREATE TABLE IF NOT EXISTS `core_nx3_feed_external_cache` (
  `feed_external_cache_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_external_id` int(11) NOT NULL,
  `feed_external_code` varchar(150) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `pubDate` datetime DEFAULT NULL,
  `guid` varchar(200) DEFAULT 'Y',
  `link` varchar(200) DEFAULT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`feed_external_cache_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `feed_external_id` (`feed_external_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_feed_external_security`
--

CREATE TABLE IF NOT EXISTS `core_nx3_feed_external_security` (
  `feed_external_security_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_external_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`feed_external_security_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `group_id` (`group_id`),
  KEY `feed_external_id` (`feed_external_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_feed_security`
--

CREATE TABLE IF NOT EXISTS `core_nx3_feed_security` (
  `feed_security_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`feed_security_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `group_id` (`group_id`),
  KEY `feed_id` (`feed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_function`
--

CREATE TABLE IF NOT EXISTS `core_nx3_function` (
  `function_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `function_code` varchar(100) NOT NULL,
  `function_name` varchar(150) NOT NULL,
  `function_description` varchar(255) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`function_id`),
  UNIQUE KEY `function_code` (`function_code`),
  UNIQUE KEY `function_name` (`function_name`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_function_security`
--

CREATE TABLE IF NOT EXISTS `core_nx3_function_security` (
  `function_security_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`function_security_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `group_id` (`group_id`),
  KEY `function_id` (`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_group`
--

CREATE TABLE IF NOT EXISTS `core_nx3_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `group_description` varchar(255) NOT NULL,
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `attribute1` varchar(255) NOT NULL,
  `attribute2` varchar(255) NOT NULL,
  `attribute3` varchar(255) NOT NULL,
  `attribute4` varchar(255) NOT NULL,
  `attribute5` varchar(255) NOT NULL,
  `attribute6` varchar(255) NOT NULL,
  `attribute7` varchar(255) NOT NULL,
  `attribute8` varchar(255) NOT NULL,
  `attribute9` varchar(255) NOT NULL,
  `attribute10` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_name` (`group_name`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_group_membership`
--

CREATE TABLE IF NOT EXISTS `core_nx3_group_membership` (
  `group_membership_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) NOT NULL,
  `attribute2` varchar(255) NOT NULL,
  `attribute3` varchar(255) NOT NULL,
  `attribute4` varchar(255) NOT NULL,
  `attribute5` varchar(255) NOT NULL,
  `attribute6` varchar(255) NOT NULL,
  `attribute7` varchar(255) NOT NULL,
  `attribute8` varchar(255) NOT NULL,
  `attribute9` varchar(255) NOT NULL,
  `attribute10` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`group_membership_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_log`
--

CREATE TABLE IF NOT EXISTS `core_nx3_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `severity` int(11) NOT NULL,
  `source` varchar(150) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_log_usage`
--

CREATE TABLE IF NOT EXISTS `core_nx3_log_usage` (
  `request_id` varchar(50) NOT NULL,
  `request_datetime` datetime NOT NULL,
  `remote_ip` varchar(15) DEFAULT NULL,
  `remote_domain` varchar(250) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `url_referrer` varchar(2048) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `template` varchar(100) DEFAULT NULL,
  `render_time` int(11) NOT NULL DEFAULT '0',
  `query_count` int(11) NOT NULL DEFAULT '0',
  `error_level` varchar(20) NOT NULL,
  `content_length` int(11) NOT NULL DEFAULT '0',
  `notes` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_menu`
--

CREATE TABLE IF NOT EXISTS `core_nx3_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_code` varchar(50) NOT NULL,
  `menu_name` varchar(150) NOT NULL,
  `menu_description` varchar(255) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`menu_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_menu_item`
--

CREATE TABLE IF NOT EXISTS `core_nx3_menu_item` (
  `menu_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `caption` varchar(50) NOT NULL,
  `link` varchar(150) NOT NULL,
  `order_by` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`menu_item_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_menu_item_security`
--

CREATE TABLE IF NOT EXISTS `core_nx3_menu_item_security` (
  `menu_item_security_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_item_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`menu_item_security_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `menu_item_id` (`menu_item_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_module`
--

CREATE TABLE IF NOT EXISTS `core_nx3_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_code` varchar(50) NOT NULL,
  `module_name` varchar(150) NOT NULL,
  `module_description` varchar(255) NOT NULL,
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `module_type` varchar(10) NOT NULL,
  `custom_yn` varchar(1) NOT NULL DEFAULT 'N',
  `module_file` varchar(150) NOT NULL,
  `module_order` int(11) NOT NULL DEFAULT '1',
  `template_file` varchar(150) DEFAULT NULL,
  `admin_link` varchar(255) DEFAULT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_code` (`module_code`),
  UNIQUE KEY `module_name` (`module_name`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_module_security`
--

CREATE TABLE IF NOT EXISTS `core_nx3_module_security` (
  `module_security_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`module_security_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `group_id` (`group_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_photo_gallery`
--

CREATE TABLE IF NOT EXISTS `core_nx3_photo_gallery` (
  `photo_gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_gallery_code` varchar(150) NOT NULL,
  `photo_gallery_name` varchar(200) NOT NULL,
  `image_path` varchar(1000) NOT NULL,
  `thumb_path` varchar(1000) NOT NULL,
  `order_by` int(11) NOT NULL DEFAULT '1',
  `hidden_yn` varchar(1) NOT NULL DEFAULT 'N',
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`photo_gallery_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=208 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_photo_image`
--

CREATE TABLE IF NOT EXISTS `core_nx3_photo_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(150) NOT NULL,
  `photo_gallery_id` int(11) NOT NULL,
  `image_description` varchar(1000) NOT NULL,
  `image_file_name` varchar(255) NOT NULL,
  `order_by` bigint(11) NOT NULL DEFAULT '1',
  `date_taken` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `deleted_yn` varchar(1) NOT NULL DEFAULT 'N',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`image_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `photo_gallery_id` (`photo_gallery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4988 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_res`
--

CREATE TABLE IF NOT EXISTS `core_nx3_res` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_blob` longblob,
  `res_file_name` varchar(255) NOT NULL DEFAULT '',
  `res_description` varchar(255) NOT NULL DEFAULT '',
  `res_content_type` varchar(50) NOT NULL DEFAULT '',
  `res_content_expiry` int(11) NOT NULL DEFAULT '0',
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`res_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_res_security`
--

CREATE TABLE IF NOT EXISTS `core_nx3_res_security` (
  `res_security_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`res_security_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `res_id` (`res_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_search_index`
--

CREATE TABLE IF NOT EXISTS `core_nx3_search_index` (
  `search_index_id` int(11) NOT NULL AUTO_INCREMENT,
  `search_subject_id` int(11) NOT NULL,
  `search_value` varchar(100) NOT NULL,
  `search_object_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`search_index_id`),
  KEY `search_value` (`search_value`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `search_subject_id` (`search_subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_search_security`
--

CREATE TABLE IF NOT EXISTS `core_nx3_search_security` (
  `search_security_id` int(11) NOT NULL AUTO_INCREMENT,
  `search_subject_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`search_security_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `group_id` (`group_id`),
  KEY `search_subject_id` (`search_subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_search_stop_word`
--

CREATE TABLE IF NOT EXISTS `core_nx3_search_stop_word` (
  `stop_word_id` int(11) NOT NULL AUTO_INCREMENT,
  `stop_word` varchar(100) NOT NULL,
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`stop_word_id`),
  UNIQUE KEY `stop_word` (`stop_word`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=660 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_search_subject`
--

CREATE TABLE IF NOT EXISTS `core_nx3_search_subject` (
  `search_subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `search_subject_name` varchar(150) NOT NULL,
  `search_subject_code` varchar(100) NOT NULL,
  `search_subject_description` varchar(255) NOT NULL,
  `search_subject_sql` varchar(4000) NOT NULL,
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `auto_index_enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `last_index_attempt` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `last_index_success` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`search_subject_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_setting`
--

CREATE TABLE IF NOT EXISTS `core_nx3_setting` (
  `field` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`field`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_smiley`
--

CREATE TABLE IF NOT EXISTS `core_nx3_smiley` (
  `smiley_id` int(11) NOT NULL AUTO_INCREMENT,
  `target` varchar(20) NOT NULL DEFAULT '',
  `url` varchar(50) NOT NULL DEFAULT '',
  `enabled_yn` varchar(1) NOT NULL DEFAULT 'Y',
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`smiley_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_user`
--

CREATE TABLE IF NOT EXISTS `core_nx3_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `display_name` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL,
  `activation_code` varchar(30) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(10) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `phone3` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `last_active` datetime NOT NULL,
  `post_count` int(11) NOT NULL DEFAULT '0',
  `avatar` blob NOT NULL,
  `avatar_content_type` varchar(150) NOT NULL,
  `tag_line` varchar(100) NOT NULL,
  `attribute1` varchar(255) NOT NULL,
  `attribute2` varchar(255) NOT NULL,
  `attribute3` varchar(255) NOT NULL,
  `attribute4` varchar(255) NOT NULL,
  `attribute5` varchar(255) NOT NULL,
  `attribute6` varchar(255) NOT NULL,
  `attribute7` varchar(255) NOT NULL,
  `attribute8` varchar(255) NOT NULL,
  `attribute9` text NOT NULL,
  `attribute10` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `display_name` (`display_name`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_nx3_yell`
--

CREATE TABLE IF NOT EXISTS `core_nx3_yell` (
  `yell_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL COMMENT 'Only used for guest users.',
  `comment` varchar(200) NOT NULL DEFAULT '',
  `request_id` varchar(100) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `attribute6` varchar(255) DEFAULT NULL,
  `attribute7` varchar(255) DEFAULT NULL,
  `attribute8` varchar(255) DEFAULT NULL,
  `attribute9` varchar(255) DEFAULT NULL,
  `attribute10` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '-1',
  `updated_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`yell_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2733 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `core_nx3_activity`
--
ALTER TABLE `core_nx3_activity`
  ADD CONSTRAINT `core_nx3_activity_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_activity_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_activity_security`
--
ALTER TABLE `core_nx3_activity_security`
  ADD CONSTRAINT `core_nx3_activity_security_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_activity_security_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_activity_security_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `core_nx3_activity` (`activity_id`),
  ADD CONSTRAINT `core_nx3_activity_security_ibfk_4` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`);

--
-- Constraints for table `core_nx3_article`
--
ALTER TABLE `core_nx3_article`
  ADD CONSTRAINT `core_nx3_article_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_ibfk_3` FOREIGN KEY (`article_folder_id`) REFERENCES `core_nx3_article_folder` (`article_folder_id`),
  ADD CONSTRAINT `core_nx3_article_ibfk_4` FOREIGN KEY (`image_res_id`) REFERENCES `core_nx3_res` (`res_id`);

--
-- Constraints for table `core_nx3_article_attachment`
--
ALTER TABLE `core_nx3_article_attachment`
  ADD CONSTRAINT `core_nx3_article_attachment_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_attachment_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_attachment_ibfk_3` FOREIGN KEY (`article_id`) REFERENCES `core_nx3_article` (`article_id`);

--
-- Constraints for table `core_nx3_article_comment`
--
ALTER TABLE `core_nx3_article_comment`
  ADD CONSTRAINT `core_nx3_article_comment_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_comment_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_comment_ibfk_3` FOREIGN KEY (`article_id`) REFERENCES `core_nx3_article` (`article_id`);

--
-- Constraints for table `core_nx3_article_folder`
--
ALTER TABLE `core_nx3_article_folder`
  ADD CONSTRAINT `core_nx3_article_folder_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_folder_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_folder_ibfk_3` FOREIGN KEY (`parent_article_folder_id`) REFERENCES `core_nx3_article_folder` (`article_folder_id`);

--
-- Constraints for table `core_nx3_article_folder_security`
--
ALTER TABLE `core_nx3_article_folder_security`
  ADD CONSTRAINT `core_nx3_article_folder_security_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_folder_security_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_article_folder_security_ibfk_3` FOREIGN KEY (`article_folder_id`) REFERENCES `core_nx3_article_folder` (`article_folder_id`),
  ADD CONSTRAINT `core_nx3_article_folder_security_ibfk_4` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`);

--
-- Constraints for table `core_nx3_feed`
--
ALTER TABLE `core_nx3_feed`
  ADD CONSTRAINT `core_nx3_feed_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_feed_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_feed_external`
--
ALTER TABLE `core_nx3_feed_external`
  ADD CONSTRAINT `core_nx3_feed_external_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_feed_external_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_feed_external_cache`
--
ALTER TABLE `core_nx3_feed_external_cache`
  ADD CONSTRAINT `core_nx3_feed_external_cache_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_feed_external_cache_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_feed_external_cache_ibfk_3` FOREIGN KEY (`feed_external_id`) REFERENCES `core_nx3_feed_external` (`feed_external_id`);

--
-- Constraints for table `core_nx3_feed_external_security`
--
ALTER TABLE `core_nx3_feed_external_security`
  ADD CONSTRAINT `core_nx3_feed_external_security_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_feed_external_security_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_feed_external_security_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`),
  ADD CONSTRAINT `core_nx3_feed_external_security_ibfk_4` FOREIGN KEY (`feed_external_id`) REFERENCES `core_nx3_feed_external` (`feed_external_id`);

--
-- Constraints for table `core_nx3_feed_security`
--
ALTER TABLE `core_nx3_feed_security`
  ADD CONSTRAINT `core_nx3_feed_security_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_feed_security_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_feed_security_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`),
  ADD CONSTRAINT `core_nx3_feed_security_ibfk_4` FOREIGN KEY (`feed_id`) REFERENCES `core_nx3_feed` (`feed_id`);

--
-- Constraints for table `core_nx3_function`
--
ALTER TABLE `core_nx3_function`
  ADD CONSTRAINT `core_nx3_function_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_function_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_function_ibfk_3` FOREIGN KEY (`module_id`) REFERENCES `core_nx3_module` (`module_id`);

--
-- Constraints for table `core_nx3_function_security`
--
ALTER TABLE `core_nx3_function_security`
  ADD CONSTRAINT `core_nx3_function_security_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_function_security_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_function_security_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`),
  ADD CONSTRAINT `core_nx3_function_security_ibfk_4` FOREIGN KEY (`function_id`) REFERENCES `core_nx3_function` (`function_id`);

--
-- Constraints for table `core_nx3_group`
--
ALTER TABLE `core_nx3_group`
  ADD CONSTRAINT `core_nx3_group_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_group_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_group_membership`
--
ALTER TABLE `core_nx3_group_membership`
  ADD CONSTRAINT `core_nx3_group_membership_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_group_membership_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_group_membership_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`),
  ADD CONSTRAINT `core_nx3_group_membership_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_log`
--
ALTER TABLE `core_nx3_log`
  ADD CONSTRAINT `core_nx3_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_menu`
--
ALTER TABLE `core_nx3_menu`
  ADD CONSTRAINT `core_nx3_menu_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_menu_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_menu_item`
--
ALTER TABLE `core_nx3_menu_item`
  ADD CONSTRAINT `core_nx3_menu_item_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_menu_item_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_menu_item_ibfk_3` FOREIGN KEY (`menu_id`) REFERENCES `core_nx3_menu` (`menu_id`);

--
-- Constraints for table `core_nx3_menu_item_security`
--
ALTER TABLE `core_nx3_menu_item_security`
  ADD CONSTRAINT `core_nx3_menu_item_security_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_menu_item_security_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_menu_item_security_ibfk_3` FOREIGN KEY (`menu_item_id`) REFERENCES `core_nx3_menu_item` (`menu_item_id`),
  ADD CONSTRAINT `core_nx3_menu_item_security_ibfk_4` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`);

--
-- Constraints for table `core_nx3_module`
--
ALTER TABLE `core_nx3_module`
  ADD CONSTRAINT `core_nx3_module_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_module_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_module_security`
--
ALTER TABLE `core_nx3_module_security`
  ADD CONSTRAINT `core_nx3_module_security_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_module_security_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_module_security_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`),
  ADD CONSTRAINT `core_nx3_module_security_ibfk_4` FOREIGN KEY (`module_id`) REFERENCES `core_nx3_module` (`module_id`);

--
-- Constraints for table `core_nx3_photo_gallery`
--
ALTER TABLE `core_nx3_photo_gallery`
  ADD CONSTRAINT `core_nx3_photo_gallery_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_photo_gallery_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_photo_image`
--
ALTER TABLE `core_nx3_photo_image`
  ADD CONSTRAINT `core_nx3_photo_image_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_photo_image_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_photo_image_ibfk_3` FOREIGN KEY (`photo_gallery_id`) REFERENCES `core_nx3_photo_gallery` (`photo_gallery_id`);

--
-- Constraints for table `core_nx3_res`
--
ALTER TABLE `core_nx3_res`
  ADD CONSTRAINT `core_nx3_res_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_res_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_res_security`
--
ALTER TABLE `core_nx3_res_security`
  ADD CONSTRAINT `core_nx3_res_security_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_res_security_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_res_security_ibfk_3` FOREIGN KEY (`res_id`) REFERENCES `core_nx3_res` (`res_id`),
  ADD CONSTRAINT `core_nx3_res_security_ibfk_4` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`);

--
-- Constraints for table `core_nx3_search_index`
--
ALTER TABLE `core_nx3_search_index`
  ADD CONSTRAINT `core_nx3_search_index_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_search_index_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_search_index_ibfk_3` FOREIGN KEY (`search_subject_id`) REFERENCES `core_nx3_search_subject` (`search_subject_id`);

--
-- Constraints for table `core_nx3_search_security`
--
ALTER TABLE `core_nx3_search_security`
  ADD CONSTRAINT `core_nx3_search_security_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_search_security_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_search_security_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `core_nx3_group` (`group_id`),
  ADD CONSTRAINT `core_nx3_search_security_ibfk_4` FOREIGN KEY (`search_subject_id`) REFERENCES `core_nx3_search_subject` (`search_subject_id`);

--
-- Constraints for table `core_nx3_search_stop_word`
--
ALTER TABLE `core_nx3_search_stop_word`
  ADD CONSTRAINT `core_nx3_search_stop_word_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_search_stop_word_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_search_subject`
--
ALTER TABLE `core_nx3_search_subject`
  ADD CONSTRAINT `core_nx3_search_subject_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_search_subject_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_setting`
--
ALTER TABLE `core_nx3_setting`
  ADD CONSTRAINT `core_nx3_setting_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_setting_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_smiley`
--
ALTER TABLE `core_nx3_smiley`
  ADD CONSTRAINT `core_nx3_smiley_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_smiley_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_user`
--
ALTER TABLE `core_nx3_user`
  ADD CONSTRAINT `core_nx3_user_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_user_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

--
-- Constraints for table `core_nx3_yell`
--
ALTER TABLE `core_nx3_yell`
  ADD CONSTRAINT `core_nx3_yell_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `core_nx3_user` (`user_id`),
  ADD CONSTRAINT `core_nx3_yell_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `core_nx3_user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
