-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 10 2019 г., 13:52
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `pr20`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id_msg` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id_msg`),
  KEY `id_users` (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=70 ;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id_msg`, `message`, `answer`, `date`, `id_users`) VALUES
(60, 'ewyy', 'Dimchigg214', '03.12.2019, 21:19', 9),
(62, 'It is my answer.', 'Moder09', '04.12.2019, 17:25', 12),
(63, '(*-*)', 'No_answer', '04.12.2019, 17:28', 12),
(64, '01001', 'No_answer', '04.12.2019, 17:29', 8),
(65, 'Hello. How are you?', 'Moder09', '04.12.2019, 17:29', 8),
(68, 'Hola <(* )', 'No_answer', '10.12.2019, 11:07', 5),
(69, 'HDFJFG', 'NowOrNever', '10.12.2019, 11:11', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_users`, `login`, `password`, `status`, `date`) VALUES
(5, 'NowOrNever', '56cf1a29a1b91aab71ed4ad120a62bd5', 'user', '10.12.2019, 13:14'),
(8, 'AdMiN123', '560f04f5963c0b8fb9bb7a094b9c9d0d', 'admin', '10.12.2019, 13:40'),
(9, 'Moder09', 'c78269e7adcb4567cf848d9ce13e55e4', 'moder', '05.12.2019, 00:56'),
(12, 'Dimchigg214', '14c6f7eff796a19d01c00c9dd52dcd6a', 'user', '10.12.2019, 13:14');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
