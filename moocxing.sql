-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 �?06 �?04 �?18:28
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

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
-- 表的结构 `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `bid` int(20) NOT NULL AUTO_INCREMENT,
  `schname` varchar(20) NOT NULL,
  `type` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `description` tinytext NOT NULL,
  `quantity` int(8) NOT NULL,
  `price` int(6) NOT NULL,
  `escort` varchar(4) NOT NULL,
  `sale` varchar(4) NOT NULL,
  `time` varchar(10) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='业务表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `business`
--

INSERT INTO `business` (`bid`, `schname`, `type`, `model`, `description`, `quantity`, `price`, `escort`, `sale`, `time`, `content`) VALUES
(1, '杨思镇小学', '电子积木套件', 'mx-lck-101', '套件购买', 5, 1060, '无', '胡婉蓉', '2016-04-20', '测试数据'),
(2, '杨思镇小学', '乐高积木耗材', 'mx-lego-101', '国产乐高兼容101套件', 2, 380, '无', '胡婉蓉', '2016-05-06', '测试数据');

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `cid` smallint(5) NOT NULL AUTO_INCREMENT,
  `cname` varchar(15) NOT NULL,
  `money` int(10) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cname` (`cname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`cid`, `cname`, `money`) VALUES
(1, '3D打印', 7800),
(2, '电子积木', 7800),
(3, '创客实战', 7000),
(8, '设计思维', 7800);

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
  `course` varchar(20) NOT NULL,
  PRIMARY KEY (`reid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='课程记录表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `crecord`
--

INSERT INTO `crecord` (`reid`, `stuname`, `tename`, `tecontent`, `tetime`, `teadress`, `hours`, `course`) VALUES
(1, '王小二', '张三', '无处不在的灯光', '2017-02-30', '少创派', 2, '电子积木'),
(2, '王小二', '张少英', '组装磐纹发F1', '2017-3-18', '少创派', 3, '3D打印');

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
  `dperiod` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `sacourse`
--

INSERT INTO `sacourse` (`cid`, `stuname`, `course`, `escort`, `sale`, `money`, `teacher`, `content`, `state`, `period`, `dperiod`) VALUES
(23, '王小二', '机器人课程', '黄少辉', '李四', 7800, '谢凯年', '测试数据', 0, 30, 0),
(22, '王小二', '设计思维', '胡婉蓉', '孙毅', 7800, '孟毅', '测试数据', 0, 30, 0),
(21, '王小月', '电子积木', '胡婉蓉', '文莉', 7800, '张少英', '电脑是windows系统', 0, 30, 0),
(18, '王小二', '3D打印', '黄少辉', '孙毅', 15644781, '阿斯蒂芬', '发生大幅', 0, 27, 3),
(19, '王小二', '电子积木', '黄少辉', '孙毅', 15644781, '阿斯蒂芬', '发生大幅', 0, 28, 2);

-- --------------------------------------------------------

--
-- 表的结构 `school`
--

CREATE TABLE IF NOT EXISTS `school` (
  `cid` int(20) NOT NULL AUTO_INCREMENT,
  `schname` varchar(20) NOT NULL,
  `kpeople` varchar(4) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `adreess` varchar(50) NOT NULL COMMENT '地址',
  `content` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `school`
--

INSERT INTO `school` (`cid`, `schname`, `kpeople`, `phone`, `adreess`, `content`) VALUES
(1, '上海市敬业中学', '周志敏', '13938651265', '上海市黄浦区蓬莱路345号', '百年老校，历史悠久'),
(2, '杨思镇小学', '曹老师', '15978612561', '浦东新区杨南路321号', '百年老校杨小，杨帆思进');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='学生表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (` pid`, `name`, `sex`, `birthday`, `parentname`, `phone`, `adreess`, `remarks`) VALUES
(1, '王小二', '男', '1998-06-16', 'jcakson', 2147483647, '上海市杨浦区国定路328号', '阿道夫'),
(2, '王小月', '女', '2006-06-13', 'marry', 2147483647, '上海市浦东新区世纪大道300号', '电脑为windo10系统'),
(3, '朱之文', '男', '2016-06-08', '朱小云', 2147483647, '上海市杨浦区邯郸路300号36栋503', '性格比较内向，单亲家庭'),
(4, '魏小田', '女', '2016-05-09', '魏芳芳', 2147483647, '上海市黄浦区斜土路323号', '性格活泼开朗'),
(5, '王老五', '男', '2001-01-08', '王晓光', 2147483647, '上海市杨浦区邯郸路200号', '学习成绩好'),
(6, '王小路', '男', '2001-01-08', '王大陆', 2147483647, '上海市杨浦区邯郸路200号', '阿的风格和复旦光华');

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
