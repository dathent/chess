-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 24 2014 г., 15:47
-- Версия сервера: 5.5.36
-- Версия PHP: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `chess`
--

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_user_id` varchar(400) NOT NULL,
  `partner_user_id` varchar(400) DEFAULT NULL,
  `created` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` longtext,
  `status` varchar(400) NOT NULL,
  `result` varchar(400) DEFAULT NULL,
  `next_go` varchar(400) DEFAULT NULL,
  `author_color` varchar(400) NOT NULL,
  `table_state` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ignore`
--

CREATE TABLE IF NOT EXISTS `ignore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `me` int(11) NOT NULL,
  `ignore_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `invite`
--

CREATE TABLE IF NOT EXISTS `invite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(400) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `from_user_id` int(100) NOT NULL,
  `to_user_id` int(100) NOT NULL,
  `result` enum('progress','accept','reject','ignore') DEFAULT 'progress',
  `game_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `main_menu`
--

CREATE TABLE IF NOT EXISTS `main_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(400) NOT NULL,
  `label` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `main_menu`
--

INSERT INTO `main_menu` (`id`, `url`, `label`) VALUES
(1, ' ', 'Home'),
(4, 'game/', 'Game'),
(6, '?contacts', 'Contacts');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(400) NOT NULL,
  `status` varchar(400) NOT NULL,
  `login` varchar(400) NOT NULL,
  `password` varchar(400) NOT NULL,
  `real_name` varchar(400) NOT NULL,
  `points` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(400) NOT NULL,
  `activate` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `status`, `login`, `password`, `real_name`, `points`, `created`, `edited`, `role`, `activate`) VALUES
(1, '', 'activate', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin', 100, '0000-00-00 00:00:00', '2014-06-24 13:46:43', 'admin', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
