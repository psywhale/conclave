-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2016 at 03:31 PM
-- Server version: 5.5.49
-- PHP Version: 5.3.10-1ubuntu3.22

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `conclave`
--

DELIMITER $$
--
-- Functions
--
CREATE FUNCTION `regex_replace`(pattern VARCHAR(1000),replacement VARCHAR(1000),original VARCHAR(1000)) RETURNS varchar(1000) CHARSET latin1
    DETERMINISTIC
BEGIN 
 DECLARE temp VARCHAR(1000); 
 DECLARE ch VARCHAR(1); 
 DECLARE i INT;
 SET i = 1;
 SET temp = '';
 IF original REGEXP pattern THEN 
  loop_label: LOOP 
   IF i>CHAR_LENGTH(original) THEN
    LEAVE loop_label;  
   END IF;
   SET ch = SUBSTRING(original,i,1);
   IF NOT ch REGEXP pattern THEN
    SET temp = CONCAT(temp,ch);
   ELSE
    SET temp = CONCAT(temp,replacement);
   END IF;
   SET i=i+1;
  END LOOP;
 ELSE
  SET temp = original;
 END IF;
 RETURN temp;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `ndx` int(5) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) NOT NULL COMMENT 'links to reg ndx',
  `event_code` int(3) NOT NULL COMMENT 'links to event code',
  `paid` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ndx`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conferences`
--

CREATE TABLE IF NOT EXISTS `conferences` (
  `event_code` int(3) NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `presenter` varchar(50) NOT NULL,
  `price` varchar(10) DEFAULT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `Age` varchar(12) NOT NULL DEFAULT '5 -12',
  `billing_code` varchar(15) NOT NULL,
  `Location` varchar(30) NOT NULL,
  PRIMARY KEY (`event_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `descriptions`
--

CREATE TABLE IF NOT EXISTS `descriptions` (
  `ndx` int(3) NOT NULL AUTO_INCREMENT,
  `event_code` int(3) NOT NULL COMMENT 'ties to conferences',
  `description` text NOT NULL,
  PRIMARY KEY (`ndx`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE IF NOT EXISTS `limits` (
  `event_code` int(3) NOT NULL DEFAULT '0',
  `capacity` int(3) DEFAULT '20',
  PRIMARY KEY (`event_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Log`
--

CREATE TABLE IF NOT EXISTS `Log` (
  `ndx` int(5) NOT NULL AUTO_INCREMENT,
  `clock` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(16) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`ndx`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='log of activity' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE IF NOT EXISTS `proposals` (
  `title` varchar(100) DEFAULT NULL,
  `format` enum('Breakout','Workshop','Forum_panel') NOT NULL DEFAULT 'Breakout',
  `strands` set('Instructional','Technical','Smorgashboard') NOT NULL DEFAULT '',
  `description` blob,
  `outline` blob,
  `methods` blob,
  `presenter_name` varchar(50) DEFAULT NULL,
  `presenter_title` varchar(50) DEFAULT NULL,
  `presenter_org` varchar(50) DEFAULT NULL,
  `presenter_addr` varchar(50) DEFAULT NULL,
  `presenter_city` varchar(50) DEFAULT NULL,
  `presenter_state` char(2) DEFAULT NULL,
  `presenter_zip` varchar(5) DEFAULT NULL,
  `presenter_phone` varchar(20) DEFAULT NULL,
  `presenter_email` varchar(50) NOT NULL DEFAULT '',
  `other_presenters` blob,
  `sales_job` enum('N','Y') NOT NULL DEFAULT 'N',
  `priority` char(1) DEFAULT NULL,
  `securekey` varchar(50) DEFAULT NULL,
  `confirmed` enum('N','Y') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `ndx` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `age` varchar(30) DEFAULT NULL,
  `gender` varchar(40) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `workphone` varchar(10) DEFAULT NULL,
  `911phone` varchar(10) DEFAULT NULL,
  `special_needs` tinytext,
  `security` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ndx`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SpecialCodes`
--

CREATE TABLE IF NOT EXISTS `SpecialCodes` (
  `codeid` int(5) NOT NULL AUTO_INCREMENT,
  `Code` varchar(10) NOT NULL,
  `CodeDescription` text NOT NULL COMMENT 'What does Code do?',
  PRIMARY KEY (`codeid`),
  UNIQUE KEY `Code` (`Code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SpecialCodes_discount`
--

CREATE TABLE IF NOT EXISTS `SpecialCodes_discount` (
  `codeid` int(5) NOT NULL COMMENT 'links to SpecialCodes',
  `discount` int(2) NOT NULL COMMENT 'percent off',
  `event_code` int(3) NOT NULL COMMENT 'link to conference event_code',
  PRIMARY KEY (`codeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SpecialCodes_limit`
--

CREATE TABLE IF NOT EXISTS `SpecialCodes_limit` (
  `codeid` int(5) NOT NULL COMMENT 'links to SpecialCodes',
  `limit` int(2) NOT NULL COMMENT 'number of times can be used',
  PRIMARY KEY (`codeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SpecialCodes_used`
--

CREATE TABLE IF NOT EXISTS `SpecialCodes_used` (
  `codeid` int(5) NOT NULL COMMENT 'links to SpecialCodes',
  `user_code` varchar(50) NOT NULL COMMENT 'attendance',
  PRIMARY KEY (`codeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_q`
--

CREATE TABLE IF NOT EXISTS `survey_q` (
  `question_id` int(9) NOT NULL AUTO_INCREMENT,
  `question` varchar(50) NOT NULL,
  `type` varchar(3) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

