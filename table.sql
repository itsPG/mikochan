-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2012 年 02 月 11 日 13:44
-- 伺服器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 資料庫: `sharu`
--

-- --------------------------------------------------------

--
-- 表的結構 `mikochan_group`
--

CREATE TABLE IF NOT EXISTS `mikochan_group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- 表的結構 `mikochan_post`
--

CREATE TABLE IF NOT EXISTS `mikochan_post` (
  `id` int(11) NOT NULL auto_increment,
  `gid` int(11) NOT NULL,
  `head` tinyint(1) NOT NULL,
  `name` varchar(30) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `IP` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `msg` text NOT NULL,
  `pic` varchar(100) NOT NULL,
  `flag1` tinyint(1) NOT NULL,
  `flag2` tinyint(1) NOT NULL,
  `flag3` tinyint(1) NOT NULL,
  `flag4` tinyint(1) NOT NULL,
  `flag5` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `head` (`head`),
  KEY `gid` (`gid`),
  KEY `flag1` (`flag1`),
  KEY `flag2` (`flag2`),
  KEY `flag3` (`flag3`),
  KEY `flag4` (`flag4`),
  KEY `flag5` (`flag5`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

-- --------------------------------------------------------

--
-- 表的結構 `mikochan_push`
--

CREATE TABLE IF NOT EXISTS `mikochan_push` (
  `id` int(11) NOT NULL auto_increment,
  `gid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `msg` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;
