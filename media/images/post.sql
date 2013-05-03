-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2013 at 06:55 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `link` text NOT NULL,
  `type` int(11) NOT NULL,
  `linkimage` text,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `content`, `link`, `type`, `linkimage`) VALUES
(113, 92, '', 'images_(11).jpg', 1, NULL),
(115, 92, 'http://i0.kym-cdn.com/entries/icons/original/000/010/277/genius-meme.png', 'http://i0.kym-cdn.com/entries/icons/original/000/010/277/genius-meme.png', 2, 'http://i0.kym-cdn.com/entries/icons/original/000/010/277/genius-meme.png'),
(116, 92, '', 'images_(8).jpg', 1, NULL),
(117, 90, '', 'images_(3).jpg', 1, NULL),
(118, 90, 'http://zamzar.com', 'http://zamzar.com', 2, 'http://zamzar.com/images/zamzar-logo-v2.jpg'),
(119, 92, 'http://cleaningupmylife.blogspot.com', 'http://cleaningupmylife.blogspot.com', 2, 'http://img1.blogblog.com/img/icon18_wrench_allbkg.png'),
(120, 92, 'http://www.tumblr.com/tagged/something%20funny', 'http://www.tumblr.com/tagged/something%20funny', 2, 'http://assets.tumblr.com/images/content_top.png?alpha'),
(121, 92, 'http://www.tumblr.com/tagged/something%20funny', 'http://www.tumblr.com/tagged/something%20funny', 2, 'http://assets.tumblr.com/images/content_top.png?alpha'),
(122, 92, 'http://www.tumblr.com/tagged/something%20funny', 'http://www.tumblr.com/tagged/something%20funny', 2, 'http://assets.tumblr.com/images/content_top.png?alpha'),
(128, 92, 'http://www.randomwebsite.com/images/head.jpg', 'http://www.randomwebsite.com/images/head.jpg', 2, 'http://www.randomwebsite.com/images/head.jpg'),
(129, 92, '', 'Scottish-landscape._.jpg', 1, NULL),
(130, 92, 'http://www.aaalandscape.com/images/bg/home.jpg', 'http://www.aaalandscape.com/images/bg/home.jpg', 2, 'http://www.aaalandscape.com/images/bg/home.jpg'),
(131, 92, 'http://www.youtube.com/watch?v=RQTgoQbkV-8', 'http://www.youtube.com/watch?v=RQTgoQbkV-8', 2, 'http://img.youtube.com/vi/RQTgoQbkV-8/default.jpg'),
(132, 92, 'This is a caption', '001-laptops.jpg', 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
