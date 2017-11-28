-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2017 at 10:23 PM
-- Server version: 5.6.38
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zorzis_blogit`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `pubdate` date NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `seo_page_title` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `views_counter` int(22) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `pubdate`, `body`, `created`, `created_by`, `modified`, `modified_by`, `is_published`, `deleted`, `author_id`, `category_id`, `meta_keywords`, `meta_description`, `seo_page_title`, `tags`, `views_counter`) VALUES
(1, 'Hello World!', 'hello_world', '2015-06-14', '<h2>Hello people. This is our very first post in our webpage, using the blogit cms of our comany!.</h2>\r\n\r\n<h1>Nice to see that everything wokrs just fine.</h1>\r\n\r\n<p><strong>Almost ;)</strong></p>', '2015-06-14 22:19:09', 1, '2015-07-27 22:39:37', 1, 1, 0, 1, 1, 'hello, dev, article, world', 'article meta description content', 'Hello World!', 'hello, dev, article, world', 206),
(2, 'Hello Lilikas! Hello world!', 'hello-lilikas', '2015-07-27', '<p>Lilikas and sun is shining</p>', '2015-07-27 09:26:22', 1, '2016-09-19 00:38:59', 1, 1, 0, 1, 1, '', '', 'Hello Lilikas', '', 139),
(3, 'post for demo purposes', 'post-for-demo-purposes', '2015-09-02', '<p>Comments are <strong>not moderated</strong>. If, for example, you are offended by people saying unicorns are the best mythical creatures, and someone makes a post about how dragons eat</p>\n\n<p>&nbsp;</p>\n\n<p><img alt=\"\" src=\"/filemanager/userfiles/portfolio/single02.jpg\" /> unicorns all the time &mdash; delete that comment. And if you are still pissed, I suggest deleting all the comments. Then you can post 100 comments about how one unicorn can slay at least 20 dragons by impaling them with their magical horn. With that said, would you care to <a href=\"http://localhost/hierarchy/#add_comment\">add a comment</a>?Comments are <strong>not moderated</strong>. If, for example, you are offended by people saying unicorns are the best mythical creatures, and someone makes a post about how dragons eat unicorns all the time &mdash; delete that comment. And if you are still pissed, I suggest deleting all the comments. Then you can post 100 comments about how one unicorn can slay at least 20 dragons by impaling them with their magical horn. With that said, would you care to <a href=\"http://localhost/hierarchy/#add_comment\">add a comment</a>?</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p><img alt=\"\" src=\"/filemanager/userfiles/portfolio/single03.jpg\" />Comments are <strong>not moderated</strong>. If, for example, you are offended by people saying unicorns are the best mythical creatures, and someone makes a post about how dragons eat unicorns all the time &mdash; delete that comment. And if you are still pissed, I suggest deleting all the comments. Then you can post 100 comments about how one unicorn can slay at least 20 dragons by impaling them with their magical horn. With that said, would you care to <a href=\"http://localhost/hierarchy/#add_comment\">add a comment</a>?Comments are <strong>not moderated</strong>. If, for example, you are offended by people saying unicorns are the best mythical creatures, and someone makes a post about how dragons eat unicorns all the time &mdash; delete that comment. And if you are still pissed, I suggest deleting all the comments. Then you can post 100 comments about how one unicorn can slay at least 20 dragons by impaling them with their magical horn. With that said, would you care to <a href=\"http://localhost/hierarchy/#add_comment\">add a comment</a>?Comments are <strong>not moderated</strong>. If, for example, you are offended by people saying unicorns are the best mythical creatures, and someone makes a post about how dragons eat unicorns all the time &mdash; delete that comment. And if you are still pissed, I suggest deleting all the comments. Then you can post 100 comments about how one unicorn can slay at least 20 dragons by impaling them with their magical horn. With that said, would you care to <a href=\"http://localhost/hierarchy/#add_comment\">add a comment</a>?Comments are <strong>not moderated</strong>. If, for example, you are offended by people saying unicorns are the best mythical creatures, and someone makes a post about how dragons eat unicorns all the time &mdash; delete that comment. And if you are still pissed, I suggest deleting all the comments. Then you can post 100 comments about how one unicorn can slay at least 20 dragons by impaling them with their magical horn. With that said, would you care to <a href=\"http://localhost/hierarchy/#add_comment\">add a comment</a>?lalallalalallala</p>', '2015-09-02 17:37:23', 1, '2015-09-15 23:46:48', 1, 1, 0, 1, 1, '', '', 'post for demo purposes', '', 132);

-- --------------------------------------------------------

--
-- Table structure for table `articles_media`
--

CREATE TABLE `articles_media` (
  `id` int(100) UNSIGNED NOT NULL,
  `article_id` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_caption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles_media`
--

INSERT INTO `articles_media` (`id`, `article_id`, `image_path`, `image_caption`) VALUES
(8, 1, 'filemanager/userfiles/blog_posts/post01.jpg', 'post01'),
(12, 3, 'filemanager/userfiles/12-Courses-for-Starting-Your-Web-Development-Journey.jpg', ''),
(13, 2, 'filemanager/userfiles/blog_posts/post02.jpg', 'post02');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_title` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `seo_page_title` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `category_title`, `category_slug`, `category_description`, `created`, `created_by`, `modified`, `modified_by`, `is_published`, `deleted`, `meta_keywords`, `meta_description`, `seo_page_title`, `tags`) VALUES
(1, 'News', 'news', '<p>Here we announce the fresh news of our focuses on the web and much more</p>', '2015-06-14 22:16:32', 1, NULL, NULL, 1, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('072ee33908a14fc1c115348915ff4100', '178.154.171.62', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 1511543973, 'a:2:{s:9:\"user_data\";s:0:\"\";s:10:\"flexi_auth\";a:7:{s:15:\"user_identifier\";b:0;s:7:\"user_id\";b:0;s:5:\"admin\";b:0;s:5:\"group\";b:0;s:10:\"privileges\";b:0;s:22:\"logged_in_via_password\";b:0;s:19:\"login_session_token\";b:0;}}'),
('ea04d19d4497ff428fb071a5330ec3ac', '212.251.28.209', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', 1511554868, 'a:4:{s:9:\"user_data\";s:0:\"\";s:25:\"upload_image_file_manager\";b:1;s:10:\"flexi_auth\";a:7:{s:15:\"user_identifier\";s:15:\"admin@gmail.com\";s:7:\"user_id\";s:1:\"1\";s:5:\"admin\";b:1;s:5:\"group\";a:1:{i:3;s:12:\"Master Admin\";}s:10:\"privileges\";a:71:{i:1;s:10:\"View Users\";i:2;s:16:\"View User Groups\";i:3;s:15:\"View Privileges\";i:4;s:18:\"Insert User Groups\";i:5;s:17:\"Insert Privileges\";i:6;s:12:\"Update Users\";i:7;s:18:\"Update User Groups\";i:8;s:17:\"Update Privileges\";i:9;s:12:\"Delete Users\";i:10;s:18:\"Delete User Groups\";i:11;s:17:\"Delete Privileges\";i:12;s:11:\"Block Users\";i:13;s:13:\"Unblock Users\";i:14;s:12:\"Insert Users\";i:15;s:18:\"View Blog Articles\";i:16;s:20:\"Create Blog Articles\";i:17;s:20:\"Delete Blog Articles\";i:18;s:20:\"Update Blog Articles\";i:19;s:31:\"Publish/Unpublish Blog Articles\";i:20;s:20:\"View Blog Categories\";i:21;s:22:\"Create Blog Categories\";i:22;s:22:\"Update Blog Categories\";i:23;s:22:\"Delete Blog Categories\";i:24;s:33:\"Publish/Unpublish Blog Categories\";i:25;s:10:\"View Pages\";i:26;s:12:\"Update Pages\";i:27;s:12:\"Create Pages\";i:28;s:12:\"Delete Pages\";i:29;s:23:\"Publish/Unpublish Pages\";i:30;s:10:\"View Menus\";i:31;s:12:\"Update Menus\";i:32;s:12:\"Create Menus\";i:33;s:12:\"Delete Menus\";i:34;s:23:\"Publish/Unpublish Menus\";i:35;s:12:\"View Modules\";i:36;s:13:\"Create Module\";i:37;s:14:\"Update Modules\";i:38;s:14:\"Delete Modules\";i:39;s:25:\"Publish/Unpublish Modules\";i:40;s:23:\"View Template Positions\";i:41;s:36:\"Publish/Unpublish Template Positions\";i:42;s:25:\"Delete Template Positions\";i:43;s:25:\"Update Template Positions\";i:44;s:25:\"Create Template Positions\";i:45;s:15:\"View Menu Items\";i:46;s:17:\"Update Menu Items\";i:47;s:17:\"Delete Menu Items\";i:48;s:28:\"Publish/Unpublish Menu Items\";i:49;s:17:\"Create Menu Items\";i:50;s:13:\"Set Home Page\";i:51;s:15:\"Modify Settings\";i:52;s:14:\"View Templates\";i:53;s:16:\"Update Templates\";i:54;s:16:\"Delete Templates\";i:55;s:27:\"Publish/Unpublish Templates\";i:56;s:20:\"Set Default Template\";i:57;s:16:\"Create Templates\";i:58;s:16:\"View Media Files\";i:59;s:18:\"Delete Media Files\";i:60;s:18:\"Upload Media Files\";i:61;s:20:\"Create Media Folders\";i:62;s:23:\"View Portfolio Projects\";i:63;s:25:\"Create Portfolio Projects\";i:64;s:25:\"Delete Portfolio Projects\";i:65;s:25:\"Update Portfolio Projects\";i:66;s:36:\"Publish/Unpublish Portfolio Projects\";i:67;s:25:\"View Portfolio Categories\";i:68;s:27:\"Create Portfolio Categories\";i:69;s:27:\"Update Portfolio Categories\";i:70;s:27:\"Delete Portfolio Categories\";i:71;s:38:\"Publish/Unpublish Portfolio Categories\";}s:22:\"logged_in_via_password\";b:1;s:19:\"login_session_token\";s:40:\"467c50f4cc75d28cc1d8479350c2979651f4e6ea\";}s:17:\"flash:old:message\";s:63:\"<p class=\"status_msg\">You have been successfully logged in.</p>\";}');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `privilege_id` int(11) NOT NULL DEFAULT '0',
  `priority_order` int(11) DEFAULT NULL,
  `show_title` tinyint(1) NOT NULL DEFAULT '1',
  `is_global` tinyint(1) NOT NULL DEFAULT '1',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `created`, `created_by`, `modified`, `modified_by`, `privilege_id`, `priority_order`, `show_title`, `is_global`, `is_published`, `deleted`) VALUES
(1, 'Main Menu Nav', '2015-06-12 15:07:31', 1, '2015-07-29 12:50:22', 1, 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `menu_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL DEFAULT '0',
  `priority_order` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `page_id`, `privilege_id`, `priority_order`, `parent_id`) VALUES
(1, 1, 1, 0, 1, 0),
(2, 1, 2, 0, 2, 0),
(3, 1, 3, 0, 4, 0),
(4, 1, 5, 0, 3, 0),
(5, 1, 4, 0, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(22);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `module_type` varchar(255) NOT NULL,
  `module_layout` varchar(255) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `limit_articles_number` int(11) DEFAULT NULL,
  `limit_projects_number` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `set_order` int(11) DEFAULT NULL,
  `show_title` tinyint(1) NOT NULL DEFAULT '1',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `module_type`, `module_layout`, `privilege_id`, `limit_articles_number`, `limit_projects_number`, `created`, `created_by`, `modified`, `modified_by`, `position`, `set_order`, `show_title`, `is_published`, `deleted`) VALUES
(1, 'Main Menu', 'menu_module', 'header_menu_module_layout.php', 0, NULL, NULL, '2015-07-23 15:56:56', 1, '2015-07-23 16:10:26', 1, 'nav', 0, 0, 1, 0),
(2, 'Bootstrap HTML Temlpate', 'image_slider_module', 'default_image_slider_module_layout.php', 0, NULL, NULL, '2015-07-23 16:28:11', 1, '2015-08-04 17:49:10', 1, 'after_header_headerwrap', 0, 0, 1, 0),
(3, '1st servicc', 'custom_module', 'default_custom_module_layout.php', 0, NULL, NULL, '2015-07-23 17:03:32', 1, NULL, NULL, 'services_section', 0, 0, 1, 0),
(4, '2nd service', 'custom_module', 'default_custom_module_layout.php', 0, NULL, NULL, '2015-07-23 17:04:23', 1, NULL, NULL, 'services_section', 0, 0, 1, 0),
(5, '3rd service', 'custom_module', 'default_custom_module_layout.php', 0, NULL, NULL, '2015-07-23 17:04:51', 1, NULL, NULL, 'services_section', 0, 0, 1, 0),
(6, 'Portfolio After Header 2', 'custom_module', 'default_custom_module_layout.php', 0, NULL, NULL, '2015-07-27 18:37:07', 1, '2015-07-27 19:00:33', 1, 'after_header_2_blue_wrap', 0, 0, 1, 0),
(7, 'Our Clients', 'image_slider_module', 'our_clients.php', 0, NULL, NULL, '2015-07-27 19:29:16', 1, '2015-07-27 19:33:31', 1, 'our_clients', 0, 0, 1, 0),
(8, 'WEB DESIGNER - BLACKTIE.CO', 'image_slider_module', 'testimonials.php', 0, NULL, NULL, '2015-07-27 19:45:22', 1, NULL, NULL, 'testimonials', 0, 0, 1, 0),
(9, 'Portfolio After Header TITLE & CONTENT', 'custom_module', 'default_custom_module_layout.php', 0, NULL, NULL, '2015-07-27 19:53:10', 1, '2015-07-27 19:55:57', 1, 'after_header_3_title_and_content', 0, 0, 1, 0),
(10, 'Footer 1 Left', 'custom_module', 'default_custom_module_layout.php', 0, NULL, NULL, '2015-07-27 20:01:36', 1, '2015-07-27 20:03:34', 1, 'footer', 1, 0, 1, 0),
(11, 'Footer 2 Center Social Links', 'custom_module', 'default_custom_module_layout.php', 0, NULL, NULL, '2015-07-27 20:02:24', 1, '2015-07-27 20:07:40', 1, 'footer', 2, 0, 1, 0),
(12, 'Footer 3 Right', 'custom_module', 'default_custom_module_layout.php', 0, NULL, NULL, '2015-07-27 20:03:11', 1, '2015-07-27 20:03:50', 1, 'footer', 3, 0, 1, 0),
(13, 'Blog After Header 2', 'custom_module', 'default_custom_module_layout.php', 0, NULL, NULL, '2015-07-27 20:13:05', 1, NULL, NULL, 'after_header_2_blue_wrap', 0, 0, 1, 0),
(14, 'Recent Posts', 'latest_blog_articles_module', 'latest_articles_right_column_blog_module_layout.php', 0, 10, NULL, '2015-07-27 22:48:02', 1, '2015-07-28 10:22:10', 1, 'right_sidebar', 2, 0, 1, 0),
(15, 'Popular Posts', 'popular_blog_articles_module', 'popular_articles_right_column_blog_module_layout.php', 0, 10, NULL, '2015-07-28 10:21:44', 1, '2015-07-28 12:02:12', 1, 'right_sidebar', 1, 0, 1, 0),
(16, 'Latest Works', 'portfolio_module', 'default_portfolio_module_layout.php', 0, NULL, 10, '2015-07-28 12:07:03', 1, '2015-07-28 13:14:14', 1, 'portfolio', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_blog_content`
--

CREATE TABLE `module_blog_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `module_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_blog_content`
--

INSERT INTO `module_blog_content` (`id`, `module_id`, `category_id`) VALUES
(1, 14, 1),
(2, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_custom_content`
--

CREATE TABLE `module_custom_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `module_id` int(11) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_custom_content`
--

INSERT INTO `module_custom_content` (`id`, `module_id`, `body`) VALUES
(1, 3, '<div class=\"col-md-4\">\r\n      <i class=\"fa fa-heart-o\"></i>\r\n      <h4>Handsomely Crafted</h4>\r\n      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n      <p><br/><a href=\"#\" class=\"btn btn-theme\">More Info</a></p>\r\n     </div>'),
(2, 4, '<div class=\"col-md-4\">\r\n      <i class=\"fa fa-flask\"></i>\r\n      <h4>Retina Ready</h4>\r\n      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n      <p><br/><a href=\"#\" class=\"btn btn-theme\">More Info</a></p>\r\n     </div>'),
(3, 5, '<div class=\"col-md-4\">\r\n      <i class=\"fa fa-trophy\"></i>\r\n      <h4>Quality Theme</h4>\r\n      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n      <p><br/><a href=\"#\" class=\"btn btn-theme\">More Info</a></p>\r\n     </div>'),
(4, 6, '<div id=\"blue\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<h3>Portfolio.</h3>\r\n</div>\r\n</div>\r\n</div>'),
(5, 9, '<div class=\"container mtb\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-8 col-lg-offset-2 centered\">\r\n<h2>We create awesome designs to standout your site or product. Check some of our latest works.</h2>\r\n&nbsp;\r\n\r\n<div class=\"hline\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>'),
(6, 10, '<div class=\"col-lg-4\">\r\n<h4>About</h4>\r\n\r\n<div class=\"hline-w\">&nbsp;</div>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s.</p>\r\n</div>'),
(7, 11, '<div class=\"col-lg-4\">\r\n<h4>Social Links</h4>\r\n\r\n<div class=\"hline-w\">&nbsp;</div>\r\n\r\n<p>&nbsp;</p>\r\n</div>'),
(8, 12, '<div class=\"col-lg-4\">\r\n<h4>Our Bunker</h4>\r\n\r\n<div class=\"hline-w\">&nbsp;</div>\r\n\r\n<p>Some Ave, 987,<br />\r\n23890, New York,<br />\r\nUnited States.</p>\r\n</div>'),
(9, 13, '<div id=\"blue\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<h3>Blog.</h3>\r\n</div>\r\n</div>\r\n</div>');

-- --------------------------------------------------------

--
-- Table structure for table `module_image_slider`
--

CREATE TABLE `module_image_slider` (
  `id` int(11) UNSIGNED NOT NULL,
  `module_id` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_caption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_image_slider`
--

INSERT INTO `module_image_slider` (`id`, `module_id`, `image_path`, `image_caption`) VALUES
(12, 7, 'filemanager/userfiles/Our_Clients/client01.png', 'dribble'),
(13, 7, 'filemanager/userfiles/Our_Clients/client02.png', 'CODE IS POETRY'),
(14, 7, 'filemanager/userfiles/Our_Clients/client03.png', 'ON DEMAND'),
(15, 7, 'filemanager/userfiles/Our_Clients/client04.png', 'vimeoPRO'),
(16, 8, 'filemanager/userfiles/testimonials/t-back.jpg', '  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has '),
(17, 2, 'filemanager/userfiles/browser.png', 'Blogit Free Template for Blogit CMS');

-- --------------------------------------------------------

--
-- Table structure for table `module_menu_content`
--

CREATE TABLE `module_menu_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `module_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_menu_content`
--

INSERT INTO `module_menu_content` (`id`, `module_id`, `menu_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_portfolio_content`
--

CREATE TABLE `module_portfolio_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `module_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_portfolio_content`
--

INSERT INTO `module_portfolio_content` (`id`, `module_id`, `category_id`) VALUES
(1, 16, 2),
(3, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) UNSIGNED NOT NULL,
  `page_type` int(11) NOT NULL,
  `is_home` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `privilege_id` int(11) NOT NULL DEFAULT '0',
  `modules` varchar(255) NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `seo_page_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_type`, `is_home`, `title`, `slug`, `created`, `created_by`, `modified`, `modified_by`, `privilege_id`, `modules`, `is_published`, `deleted`, `meta_keywords`, `meta_description`, `seo_page_title`) VALUES
(1, 1, 1, 'Home', 'home', '2015-06-12 15:07:02', 1, '2015-07-28 13:14:30', 1, 0, '1,2,3,4,5,7,8,10,11,12,16', 1, 0, '', '', 'Home'),
(2, 1, 0, 'About', 'about', '2015-06-14 15:40:03', 1, '2015-07-24 12:01:54', 1, 0, '1,2,3,4,5', 1, 0, '', '', 'About'),
(3, 2, 0, 'Blog', 'blog', '2015-06-14 22:19:43', 1, '2015-07-28 10:21:57', 1, 0, '1,10,11,12,13,14,15', 1, 0, '', '', 'Blog'),
(4, 3, 0, 'Admin Backend', 'admin-backend', '2015-07-26 16:08:46', 1, '2015-07-29 12:50:05', 1, 0, '', 1, 0, '', '', ''),
(5, 4, 0, 'Portfolio', 'portfolio', '2015-07-26 16:49:13', 1, '2015-07-27 20:04:25', 1, 0, '1,6,9,10,11,12', 1, 0, 'portfolio, projects, haze lab, haze web dev studio', 'haze Web Dev Studio Portfolio', 'Portfolio');

-- --------------------------------------------------------

--
-- Table structure for table `page_blog_content`
--

CREATE TABLE `page_blog_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `blog_categories` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_blog_content`
--

INSERT INTO `page_blog_content` (`id`, `page_id`, `blog_categories`) VALUES
(1, 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `page_custom_content`
--

CREATE TABLE `page_custom_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_custom_content`
--

INSERT INTO `page_custom_content` (`id`, `page_id`, `body`) VALUES
(1, 1, ''),
(2, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `page_external_url_content`
--

CREATE TABLE `page_external_url_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `external_url` varchar(455) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_external_url_content`
--

INSERT INTO `page_external_url_content` (`id`, `page_id`, `external_url`) VALUES
(1, 4, 'http://blogit.haze.gr/admin');

-- --------------------------------------------------------

--
-- Table structure for table `page_portfolio_content`
--

CREATE TABLE `page_portfolio_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `portfolio_categories` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_portfolio_content`
--

INSERT INTO `page_portfolio_content` (`id`, `page_id`, `portfolio_categories`) VALUES
(1, 5, '2,1');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `project_slug` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_description` varchar(255) NOT NULL,
  `client_url` varchar(255) NOT NULL,
  `project_url` varchar(255) NOT NULL,
  `company_proposal` text NOT NULL,
  `developer` varchar(255) NOT NULL,
  `date_project_done` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `project_category_id` int(11) NOT NULL DEFAULT '0',
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `seo_page_title` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `views_counter` int(22) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `project_title`, `project_slug`, `project_description`, `client_name`, `client_description`, `client_url`, `project_url`, `company_proposal`, `developer`, `date_project_done`, `created`, `created_by`, `modified`, `modified_by`, `is_published`, `deleted`, `project_category_id`, `meta_keywords`, `meta_description`, `seo_page_title`, `tags`, `views_counter`) VALUES
(1, 'Project1', 'project1', 'Some Amazing work for web design', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Bootstraped webpage layout, with new product catalogue to attract new customers. \r\nAlso a new email campaign with metrics from google analytics.', 'haze web studio', '2014-06-03', '2015-07-25 12:48:43', 1, '2015-07-28 10:39:53', 1, 1, 0, 2, 'project1,web design, web dev', 'Project from haze web dev studio', 'Project1', 'project1,web design, web dev', 107),
(2, 'Project2', 'project2', 'Amazing work for Project2', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project2', 'haze web studio', '2013-06-13', '2015-07-27 14:12:25', 1, '2015-07-28 10:39:58', 1, 1, 0, 2, 'project2,web design, web dev', 'The Project we developed', 'Project2', 'project2,web design, web dev', 107),
(3, 'Project3', 'project3', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:13:25', 1, '2015-07-28 10:58:23', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 116),
(4, 'Project4', 'project4', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:14:25', 1, '2015-07-28 10:58:58', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 107),
(5, 'Project5', 'project5', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:15:25', 1, '2015-12-07 21:56:29', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 108),
(6, 'Project6', 'project6', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:16:25', 1, '2015-07-28 10:59:51', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 95),
(7, 'Project7', 'project7', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:17:25', 1, '2015-07-28 11:00:37', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 143),
(8, 'Project8', 'project8', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:18:25', 1, '2015-07-28 11:01:09', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 117),
(9, 'Project9', 'project9', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:19:25', 1, '2015-07-28 11:01:38', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 119),
(10, 'Project10', 'project10', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:20:25', 1, '2015-07-28 11:02:00', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 97),
(11, 'Project11', 'project11', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:21:25', 1, '2015-07-28 14:25:52', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 123),
(12, 'Project12', 'project12', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:22:25', 1, '2015-07-28 11:04:58', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 117),
(13, 'Project13', 'project13', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:23:25', 1, '2015-07-28 11:05:33', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 117),
(14, 'Project14', 'project14', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:24:25', 1, '2015-07-28 11:06:03', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 115),
(15, 'Project15', 'project15', 'Amazing work for Project', 'Amazing Client', 'Amazing Client', 'http://www.haze.gr', 'http://www.haze.gr', 'Develop Project', 'haze web studio', '2013-06-13', '2015-07-27 14:54:25', 1, '2015-07-28 11:06:44', 1, 1, 0, 2, 'project,web design, web dev', 'The Project we developed', 'Project', 'project,web design, web dev', 105);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `portfolio_category_title` varchar(255) NOT NULL,
  `portfolio_category_slug` varchar(255) NOT NULL,
  `portfolio_category_description` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `seo_page_title` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `portfolio_category_title`, `portfolio_category_slug`, `portfolio_category_description`, `created`, `created_by`, `modified`, `modified_by`, `is_published`, `deleted`, `meta_keywords`, `meta_description`, `seo_page_title`, `tags`) VALUES
(1, 'Uncategorized', 'uncategorized', 'Default Category', '2015-07-24 13:27:24', 0, NULL, NULL, 1, 0, '', '', '', ''),
(2, 'Web Services', 'web_services', 'Services our company offers for web services', '2015-07-25 14:55:15', 1, NULL, NULL, 1, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_media`
--

CREATE TABLE `portfolio_media` (
  `id` int(100) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_caption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portfolio_media`
--

INSERT INTO `portfolio_media` (`id`, `project_id`, `image_path`, `image_caption`) VALUES
(8, 1, 'filemanager/userfiles/portfolio/portfolio_10.jpg', 'Project1'),
(9, 2, 'filemanager/userfiles/portfolio/portfolio_02.jpg', 'Project2'),
(10, 3, 'filemanager/userfiles/portfolio/portfolio_01.jpg', 'Project3'),
(11, 4, 'filemanager/userfiles/portfolio/portfolio_03.jpg', 'Project4'),
(13, 6, 'filemanager/userfiles/portfolio/portfolio_05.jpg', 'Project6'),
(14, 7, 'filemanager/userfiles/portfolio/portfolio_06.jpg', 'Project7'),
(15, 8, 'filemanager/userfiles/portfolio/portfolio_07.jpg', 'Project8'),
(16, 9, 'filemanager/userfiles/portfolio/portfolio_08.jpg', 'Project9'),
(17, 10, 'filemanager/userfiles/portfolio/portfolio_09.jpg', 'Project10'),
(19, 12, 'filemanager/userfiles/portfolio/portfolio_10.jpg', 'Project12'),
(20, 13, 'filemanager/userfiles/portfolio/portfolio_03.jpg', 'Project13'),
(21, 14, 'filemanager/userfiles/portfolio/portfolio_02.jpg', 'Project14'),
(22, 15, 'filemanager/userfiles/portfolio/portfolio_07.jpg', 'Project15'),
(23, 11, 'filemanager/userfiles/blog_posts/post02.jpg', 'Project11'),
(24, 5, 'filemanager/userfiles/portfolio/portfolio_04.jpg', 'Project5'),
(25, 5, 'filemanager/userfiles/portfolio/portfolio_02.jpg', 'Put something here');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `webpage_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `seo_page_title` varchar(255) NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `min_password_length` int(11) NOT NULL DEFAULT '8',
  `google_analytics_tracking_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `webpage_title`, `meta_keywords`, `meta_description`, `seo_page_title`, `logo_image`, `created`, `created_by`, `modified`, `modified_by`, `min_password_length`, `google_analytics_tracking_id`) VALUES
(0, 'Blogit CMS', 'new webpage, blogit cms,', 'Helo World.This is our very new webpage, created with BlogIt.', 'Welcome', '', '2015-05-07 19:30:39', 0, '2015-08-04 17:46:29', 1, 8, 'UA-65969807-1');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `title`, `created`, `created_by`, `modified`, `modified_by`, `is_published`, `deleted`, `default`) VALUES
(1, 'creolio', '2015-06-12 15:40:38', 1, NULL, NULL, 1, 0, 0),
(2, 'solid', '2015-07-23 12:43:50', 1, NULL, NULL, 1, 0, 1),
(3, 'momok', '2017-02-06 23:34:06', 1, NULL, NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `uacc_id` int(11) UNSIGNED NOT NULL,
  `uacc_group_fk` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `uacc_email` varchar(100) NOT NULL DEFAULT '',
  `uacc_username` varchar(15) NOT NULL DEFAULT '',
  `uacc_password` varchar(60) NOT NULL DEFAULT '',
  `uacc_ip_address` varchar(40) NOT NULL DEFAULT '',
  `uacc_salt` varchar(40) NOT NULL DEFAULT '',
  `uacc_activation_token` varchar(40) NOT NULL DEFAULT '',
  `uacc_forgotten_password_token` varchar(40) NOT NULL DEFAULT '',
  `uacc_forgotten_password_expire` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uacc_update_email_token` varchar(40) NOT NULL DEFAULT '',
  `uacc_update_email` varchar(100) NOT NULL DEFAULT '',
  `uacc_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `uacc_suspend` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `uacc_fail_login_attempts` smallint(5) NOT NULL DEFAULT '0',
  `uacc_fail_login_ip_address` varchar(40) NOT NULL DEFAULT '',
  `uacc_date_fail_login_ban` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Time user is banned until due to repeated failed logins',
  `uacc_date_last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uacc_date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`uacc_id`, `uacc_group_fk`, `uacc_email`, `uacc_username`, `uacc_password`, `uacc_ip_address`, `uacc_salt`, `uacc_activation_token`, `uacc_forgotten_password_token`, `uacc_forgotten_password_expire`, `uacc_update_email_token`, `uacc_update_email`, `uacc_active`, `uacc_suspend`, `uacc_fail_login_attempts`, `uacc_fail_login_ip_address`, `uacc_date_fail_login_ban`, `uacc_date_last_login`, `uacc_date_added`) VALUES
(1, 3, 'admin@gmail.com', 'admin', '$2a$08$//gooTq1.Rt1Lk.gUvVrz..UnEBF.oqdTG4kVVJik7ob7pu2qkK4W', '212.54.196.99', 'Cf6hCMXnWp', '', '', '0000-00-00 00:00:00', '', '', 1, 0, 0, '', '0000-00-00 00:00:00', '2017-11-24 22:22:39', '2014-12-08 23:00:57'),
(2, 2, 'non_admin@gmail.com', 'non_admin', '$2a$08$pEUp8Ir01NKES78ow/GKaueL8OkbipUNR76E5sr/qz1mPcjDmZuUO', '212.251.28.209', 'Cf6hCMXnWp', '', '', '0000-00-00 00:00:00', '', '', 1, 0, 0, '', '0000-00-00 00:00:00', '2017-11-24 19:37:23', '2015-08-25 16:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `uadd_id` int(11) NOT NULL,
  `uadd_uacc_fk` int(11) NOT NULL DEFAULT '0',
  `uadd_alias` varchar(50) NOT NULL DEFAULT '',
  `uadd_recipient` varchar(100) NOT NULL DEFAULT '',
  `uadd_phone` varchar(25) NOT NULL DEFAULT '',
  `uadd_company` varchar(75) NOT NULL DEFAULT '',
  `uadd_address_01` varchar(100) NOT NULL DEFAULT '',
  `uadd_address_02` varchar(100) NOT NULL DEFAULT '',
  `uadd_city` varchar(50) NOT NULL DEFAULT '',
  `uadd_county` varchar(50) NOT NULL DEFAULT '',
  `uadd_post_code` varchar(25) NOT NULL DEFAULT '',
  `uadd_country` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `ugrp_id` smallint(5) NOT NULL,
  `ugrp_name` varchar(20) NOT NULL DEFAULT '',
  `ugrp_desc` varchar(100) NOT NULL DEFAULT '',
  `ugrp_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`ugrp_id`, `ugrp_name`, `ugrp_desc`, `ugrp_admin`) VALUES
(1, 'Public', 'Public User : has no admin access rights.', 0),
(2, 'Moderator', 'Admin Moderator : has partial admin access rights.', 1),
(3, 'Master Admin', ' Master Admin : has full admin access rights.', 1),
(4, 'Editors', 'Only editors assigned users can access the pages, modules and generally data', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_login_sessions`
--

CREATE TABLE `user_login_sessions` (
  `usess_uacc_fk` int(11) NOT NULL DEFAULT '0',
  `usess_series` varchar(40) NOT NULL DEFAULT '',
  `usess_token` varchar(40) NOT NULL DEFAULT '',
  `usess_login_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login_sessions`
--

INSERT INTO `user_login_sessions` (`usess_uacc_fk`, `usess_series`, `usess_token`, `usess_login_date`) VALUES
(1, '', '467c50f4cc75d28cc1d8479350c2979651f4e6ea', '2017-11-24 22:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

CREATE TABLE `user_privileges` (
  `upriv_id` smallint(5) NOT NULL,
  `upriv_name` varchar(100) NOT NULL DEFAULT '',
  `upriv_desc` varchar(100) NOT NULL DEFAULT '',
  `upriv_is_frontend` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_privileges`
--

INSERT INTO `user_privileges` (`upriv_id`, `upriv_name`, `upriv_desc`, `upriv_is_frontend`) VALUES
(1, 'View Users', 'User can view user account details.', 0),
(2, 'View User Groups', 'User can view user groups.', 0),
(3, 'View Privileges', 'User can view privileges.', 0),
(4, 'Insert User Groups', 'User can insert new user groups.', 0),
(5, 'Insert Privileges', 'User can insert privileges.', 0),
(6, 'Update Users', 'User can update user account details.', 0),
(7, 'Update User Groups', 'User can update user groups.', 0),
(8, 'Update Privileges', 'User can update user privileges.', 0),
(9, 'Delete Users', 'User can delete user accounts.', 0),
(10, 'Delete User Groups', 'User can delete user groups.', 0),
(11, 'Delete Privileges', 'User can delete user privileges.', 0),
(12, 'Block Users', 'User can suspend other users accounts. That prevent user to login with account on next login.', 0),
(13, 'Unblock Users', 'User can unblock users so users can login using their accounts credentials', 0),
(14, 'Insert Users', 'User can create users accounts.', 0),
(15, 'View Blog Articles', ' User can view blog articles list', 0),
(16, 'Create Blog Articles', ' User can create blog articles', 0),
(17, 'Delete Blog Articles', ' User can delete blog articles ', 0),
(18, 'Update Blog Articles', 'User can update create blog articles ', 0),
(19, 'Publish/Unpublish Blog Articles', 'User can publish/unpublish blog articles. ', 0),
(20, 'View Blog Categories', 'User can view blog categories', 0),
(21, 'Create Blog Categories', ' User can create blog categories', 0),
(22, 'Update Blog Categories', ' User can update blog categories', 0),
(23, 'Delete Blog Categories', ' User can delete blog categories', 0),
(24, 'Publish/Unpublish Blog Categories', ' User can publish/unpublish blog categories', 0),
(25, 'View Pages', 'User can view pages module in the backend', 0),
(26, 'Update Pages', 'User can update pages module in the backend', 0),
(27, 'Create Pages', 'User can create pages module in the backend', 0),
(28, 'Delete Pages', ' User can delete pages module in the backend', 0),
(29, 'Publish/Unpublish Pages', ' User can publish / unpublish pages module in the backend', 0),
(30, 'View Menus', 'User can view menus', 0),
(31, 'Update Menus', 'User can update menus ', 0),
(32, 'Create Menus', 'User can create menus ', 0),
(33, 'Delete Menus', 'User can delete menus ', 0),
(34, 'Publish/Unpublish Menus', 'User can publish / unpublish menus ', 0),
(35, 'View Modules', 'User can create Modules', 0),
(36, 'Create Module', 'User can create new Modules', 0),
(37, 'Update Modules', 'User can edit Modules', 0),
(38, 'Delete Modules', 'User can delete Modules', 0),
(39, 'Publish/Unpublish Modules', 'User can publish and unpublish Modules', 0),
(40, 'View Template Positions', 'User can view template positions', 0),
(41, 'Publish/Unpublish Template Positions', 'User can Publish/Unpublish Template Positions', 0),
(42, 'Delete Template Positions', 'User can delete Template Positions', 0),
(43, 'Update Template Positions', 'User can update Template Positions', 0),
(44, 'Create Template Positions', 'User can create Template Positions', 0),
(45, 'View Menu Items', 'User can view Menu Items', 0),
(46, 'Update Menu Items', 'User can update Menu Items', 0),
(47, 'Delete Menu Items', 'User can delete Menu Items', 0),
(48, 'Publish/Unpublish Menu Items', 'User can Publish/Unpublish Menu Items', 0),
(49, 'Create Menu Items', 'Users can create Menu Items', 0),
(50, 'Set Home Page', 'User can set home page', 0),
(51, 'Modify Settings', 'Users can modify settings panel options', 0),
(52, 'View Templates', 'User can access Templates Administration', 0),
(53, 'Update Templates', 'User can update Templates Informations', 0),
(54, 'Delete Templates', 'User can delete Templates', 0),
(55, 'Publish/Unpublish Templates', 'User can Publish/Unpublish Templates', 0),
(56, 'Set Default Template', 'User can set a Default Template', 0),
(57, 'Create Templates', 'User can Create Templates', 0),
(58, 'View Media Files', 'User can view Media Files', 0),
(59, 'Delete Media Files', 'User can delete Media Files', 0),
(60, 'Upload Media Files', 'User can Upload Media Files', 0),
(61, 'Create Media Folders', 'User Can Create Media Folders', 0),
(62, 'View Portfolio Projects', 'User can view Portfolio Projects', 0),
(63, 'Create Portfolio Projects', 'User can create Portfolio Projects', 0),
(64, 'Delete Portfolio Projects', 'User can delete Portfolio Projects', 0),
(65, 'Update Portfolio Projects', 'User can update Portfolio Projects', 0),
(66, 'Publish/Unpublish Portfolio Projects', 'User can publish/unpublish Portfolio Projects', 0),
(67, 'View Portfolio Categories', 'User can view Portfolio Categories', 0),
(68, 'Create Portfolio Categories', 'User can create Portfolio Categories', 0),
(69, 'Update Portfolio Categories', 'User can update Portfolio Categories', 0),
(70, 'Delete Portfolio Categories', 'User can Delete Portfolio Categories', 0),
(71, 'Publish/Unpublish Portfolio Categories', 'User can Publish/Unpublish Portfolio Categories', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege_groups`
--

CREATE TABLE `user_privilege_groups` (
  `upriv_groups_id` smallint(5) UNSIGNED NOT NULL,
  `upriv_groups_ugrp_fk` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `upriv_groups_upriv_fk` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_privilege_groups`
--

INSERT INTO `user_privilege_groups` (`upriv_groups_id`, `upriv_groups_ugrp_fk`, `upriv_groups_upriv_fk`) VALUES
(3, 3, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 2, 2),
(13, 2, 4),
(14, 2, 5),
(15, 3, 2),
(16, 3, 14),
(17, 4, 2),
(18, 3, 15),
(19, 3, 16),
(20, 3, 17),
(21, 3, 18),
(22, 3, 19),
(23, 3, 20),
(24, 3, 21),
(25, 3, 22),
(26, 3, 23),
(27, 3, 24),
(28, 3, 25),
(29, 3, 26),
(30, 3, 27),
(31, 3, 28),
(32, 3, 29),
(33, 3, 30),
(34, 3, 31),
(35, 3, 32),
(36, 3, 33),
(37, 3, 34),
(38, 3, 35),
(39, 3, 36),
(40, 3, 37),
(41, 3, 38),
(42, 3, 39),
(43, 3, 40),
(44, 3, 41),
(45, 3, 42),
(46, 3, 43),
(47, 3, 44),
(48, 3, 45),
(49, 3, 46),
(50, 3, 47),
(51, 3, 48),
(53, 2, 49),
(54, 3, 49),
(55, 3, 50),
(56, 3, 51),
(57, 3, 52),
(58, 3, 53),
(59, 3, 54),
(60, 3, 55),
(61, 3, 56),
(62, 3, 57),
(63, 3, 1),
(64, 3, 58),
(65, 3, 59),
(66, 3, 60),
(67, 3, 61),
(68, 3, 62),
(69, 3, 63),
(70, 3, 64),
(71, 3, 65),
(72, 3, 66),
(73, 3, 67),
(74, 3, 68),
(75, 3, 69),
(76, 3, 70),
(77, 3, 71),
(78, 2, 1),
(79, 2, 3),
(80, 2, 6),
(81, 2, 7),
(82, 2, 8),
(83, 2, 9),
(84, 2, 10),
(85, 2, 11),
(86, 2, 14),
(87, 2, 15),
(88, 2, 16),
(89, 2, 17),
(90, 2, 18),
(91, 2, 19),
(92, 2, 20),
(93, 2, 21),
(94, 2, 22),
(95, 2, 23),
(96, 2, 24),
(97, 2, 25),
(98, 2, 26),
(99, 2, 27),
(100, 2, 28),
(101, 2, 29),
(102, 2, 30),
(103, 2, 31),
(104, 2, 32),
(105, 2, 33),
(106, 2, 34),
(107, 2, 35),
(108, 2, 36),
(109, 2, 37),
(110, 2, 38),
(111, 2, 39),
(112, 2, 40),
(113, 2, 41),
(114, 2, 42),
(115, 2, 43),
(116, 2, 44),
(117, 2, 45),
(118, 2, 46),
(119, 2, 47),
(120, 2, 48),
(121, 2, 50),
(122, 2, 51),
(123, 2, 52),
(124, 2, 53),
(125, 2, 54),
(126, 2, 55),
(127, 2, 56),
(128, 2, 57),
(129, 2, 58),
(130, 2, 59),
(131, 2, 60),
(133, 2, 62),
(134, 2, 63),
(135, 2, 64),
(136, 2, 65),
(137, 2, 66),
(138, 2, 67),
(139, 2, 68),
(140, 2, 69),
(141, 2, 70),
(142, 2, 71),
(143, 3, 12),
(144, 2, 12),
(145, 3, 13),
(146, 2, 13),
(147, 2, 61);

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege_users`
--

CREATE TABLE `user_privilege_users` (
  `upriv_users_id` smallint(5) NOT NULL,
  `upriv_users_uacc_fk` int(11) NOT NULL DEFAULT '0',
  `upriv_users_upriv_fk` smallint(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `upro_id` int(11) NOT NULL,
  `upro_uacc_fk` int(11) NOT NULL DEFAULT '0',
  `upro_company` varchar(50) NOT NULL DEFAULT '',
  `upro_first_name` varchar(50) NOT NULL DEFAULT '',
  `upro_last_name` varchar(50) NOT NULL DEFAULT '',
  `upro_phone` varchar(25) NOT NULL DEFAULT '',
  `upro_newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `upro_avatar` varchar(555) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`upro_id`, `upro_uacc_fk`, `upro_company`, `upro_first_name`, `upro_last_name`, `upro_phone`, `upro_newsletter`, `upro_avatar`) VALUES
(1, 1, '', 'B', 'Real', '11888', 0, 'filemanager/userfiles/zorzis.png'),
(2, 2, '', 'Non Admin', 'User', '3232323', 0, 'filemanager/userfiles/zorzis.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles_media`
--
ALTER TABLE `articles_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity` (`last_activity`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_blog_content`
--
ALTER TABLE `module_blog_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_custom_content`
--
ALTER TABLE `module_custom_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_image_slider`
--
ALTER TABLE `module_image_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_menu_content`
--
ALTER TABLE `module_menu_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_portfolio_content`
--
ALTER TABLE `module_portfolio_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_blog_content`
--
ALTER TABLE `page_blog_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_custom_content`
--
ALTER TABLE `page_custom_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_external_url_content`
--
ALTER TABLE `page_external_url_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_portfolio_content`
--
ALTER TABLE `page_portfolio_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_media`
--
ALTER TABLE `portfolio_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`uacc_id`),
  ADD UNIQUE KEY `uacc_id` (`uacc_id`),
  ADD KEY `uacc_group_fk` (`uacc_group_fk`),
  ADD KEY `uacc_email` (`uacc_email`),
  ADD KEY `uacc_username` (`uacc_username`),
  ADD KEY `uacc_fail_login_ip_address` (`uacc_fail_login_ip_address`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`uadd_id`),
  ADD UNIQUE KEY `uadd_id` (`uadd_id`),
  ADD KEY `uadd_uacc_fk` (`uadd_uacc_fk`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`ugrp_id`),
  ADD UNIQUE KEY `ugrp_id` (`ugrp_id`) USING BTREE;

--
-- Indexes for table `user_login_sessions`
--
ALTER TABLE `user_login_sessions`
  ADD PRIMARY KEY (`usess_token`),
  ADD UNIQUE KEY `usess_token` (`usess_token`);

--
-- Indexes for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`upriv_id`),
  ADD UNIQUE KEY `upriv_id` (`upriv_id`) USING BTREE;

--
-- Indexes for table `user_privilege_groups`
--
ALTER TABLE `user_privilege_groups`
  ADD PRIMARY KEY (`upriv_groups_id`),
  ADD UNIQUE KEY `upriv_groups_id` (`upriv_groups_id`) USING BTREE,
  ADD KEY `upriv_groups_ugrp_fk` (`upriv_groups_ugrp_fk`),
  ADD KEY `upriv_groups_upriv_fk` (`upriv_groups_upriv_fk`);

--
-- Indexes for table `user_privilege_users`
--
ALTER TABLE `user_privilege_users`
  ADD PRIMARY KEY (`upriv_users_id`),
  ADD UNIQUE KEY `upriv_users_id` (`upriv_users_id`) USING BTREE,
  ADD KEY `upriv_users_uacc_fk` (`upriv_users_uacc_fk`),
  ADD KEY `upriv_users_upriv_fk` (`upriv_users_upriv_fk`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`upro_id`),
  ADD UNIQUE KEY `upro_id` (`upro_id`),
  ADD KEY `upro_uacc_fk` (`upro_uacc_fk`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `articles_media`
--
ALTER TABLE `articles_media`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `module_blog_content`
--
ALTER TABLE `module_blog_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `module_custom_content`
--
ALTER TABLE `module_custom_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `module_image_slider`
--
ALTER TABLE `module_image_slider`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `module_menu_content`
--
ALTER TABLE `module_menu_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module_portfolio_content`
--
ALTER TABLE `module_portfolio_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page_blog_content`
--
ALTER TABLE `page_blog_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_custom_content`
--
ALTER TABLE `page_custom_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `page_external_url_content`
--
ALTER TABLE `page_external_url_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_portfolio_content`
--
ALTER TABLE `page_portfolio_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `portfolio_media`
--
ALTER TABLE `portfolio_media`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `uacc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `uadd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `ugrp_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_privileges`
--
ALTER TABLE `user_privileges`
  MODIFY `upriv_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user_privilege_groups`
--
ALTER TABLE `user_privilege_groups`
  MODIFY `upriv_groups_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `user_privilege_users`
--
ALTER TABLE `user_privilege_users`
  MODIFY `upriv_users_id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `upro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
