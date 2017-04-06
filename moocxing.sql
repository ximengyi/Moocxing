-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 04 月 06 日 11:52
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `moocxing`
--

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `cid` smallint(5) NOT NULL AUTO_INCREMENT,
  `cname` varchar(15) NOT NULL,
  `money` int(10) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`cid`, `cname`, `money`) VALUES
(1, '3D打印', 7800),
(2, '电子积木', 7800),
(3, '创客实战', 7000),
(4, '机器人战车', 7000);

-- --------------------------------------------------------

--
-- 表的结构 `crecord`
--

CREATE TABLE IF NOT EXISTS `crecord` (
  `reid` bigint(100) NOT NULL AUTO_INCREMENT,
  `stuname` varchar(5) NOT NULL,
  `tename` varchar(5) NOT NULL,
  `tecontent` text NOT NULL,
  `tetime` varchar(15) NOT NULL,
  `teadress` varchar(100) NOT NULL,
  `hours` tinyint(10) NOT NULL DEFAULT '2',
  PRIMARY KEY (`reid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='课程记录表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sacourse`
--

CREATE TABLE IF NOT EXISTS `sacourse` (
  `cid` int(20) NOT NULL AUTO_INCREMENT,
  `stuname` varchar(4) NOT NULL,
  `course` varchar(15) NOT NULL,
  `escort` varchar(4) NOT NULL,
  `sale` varchar(4) NOT NULL,
  `money` int(20) NOT NULL,
  `teacher` varchar(4) NOT NULL,
  `content` text NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `period` int(10) NOT NULL DEFAULT '30' COMMENT '学时',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `sacourse`
--

INSERT INTO `sacourse` (`cid`, `stuname`, `course`, `escort`, `sale`, `money`, `teacher`, `content`, `state`, `period`) VALUES
(1, '王测试', '3', '0', '孙毅', 24000, '0', '阿斯达', 0, 30),
(2, '王小二', '3', '0', '孙毅', 14000, '0', '阿斯蒂芬阿斯蒂芬', 0, 30),
(3, '张三', '3', '0', '孙毅', 125890, '0', '阿斯蒂芬啊啊史蒂夫', 0, 30),
(4, '张三', '0', '0', '孙毅', 125890, '0', '阿斯蒂芬啊啊史蒂夫', 0, 30),
(5, '张三', '0', '0', '孙毅', 125890, '0', '阿斯蒂芬啊啊史蒂夫', 0, 30),
(18, '王小二', '3D打印', '黄少辉', '孙毅', 15644781, '阿斯蒂芬', '发生大幅', 0, 30),
(19, '王小二', '电子积木', '黄少辉', '孙毅', 15644781, '阿斯蒂芬', '发生大幅', 0, 30),
(20, '王小二', '设计思维', '黄少辉', '孙毅', 15644781, '阿斯蒂芬', '发生大幅', 0, 30);

-- --------------------------------------------------------

--
-- 表的结构 `school`
--

CREATE TABLE IF NOT EXISTS `school` (
  `cid` int(20) NOT NULL AUTO_INCREMENT,
  `schname` varchar(20) NOT NULL,
  `kpeople` varchar(4) NOT NULL,
  `phone` varchar(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  ` pid` int(15) NOT NULL AUTO_INCREMENT COMMENT '列表',
  `name` varchar(5) NOT NULL COMMENT '学生姓名',
  `sex` varchar(1) NOT NULL COMMENT '性别',
  `birthday` varchar(10) NOT NULL COMMENT '出生年月',
  `parentname` varchar(10) NOT NULL,
  `phone` int(11) NOT NULL COMMENT '电话',
  `adreess` varchar(30) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (` pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='学生表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (` pid`, `name`, `sex`, `birthday`, `parentname`, `phone`, `adreess`, `remarks`) VALUES
(1, '王小二', '男', '1998-06-16', 'jcakson', 2147483647, '上海市杨浦区国定路328号', '阿道夫'),
(2, '王小月', '女', '2006-06-13', 'marry', 2147483647, '上海市浦东新区世纪大道300号', '电脑为windo10系统'),
(3, '朱之文', '男', '2016-06-08', '朱小云', 2147483647, '上海市杨浦区邯郸路300号36栋503', '性格比较内向，单亲家庭'),
(4, '魏小田', '女', '2016-05-09', '魏芳芳', 2147483647, '上海市黄浦区斜土路323号', '性格活泼开朗');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `pid` int(5) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(5) NOT NULL COMMENT '用户名',
  `userpw` varchar(20) NOT NULL COMMENT '密码',
  `moocid` int(20) NOT NULL COMMENT '慕客ID',
  `moocpm` tinyint(2) NOT NULL DEFAULT '0' COMMENT '慕客权限',
  PRIMARY KEY (`pid`),
  UNIQUE KEY `moocid` (`moocid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`pid`, `username`, `userpw`, `moocid`, `moocpm`) VALUES
(1, 'test', 'test', 2016, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
