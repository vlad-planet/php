-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 15 2019 г., 19:52
-- Версия сервера: 5.7.25
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `admin`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(14) NOT NULL,
  `marka` varchar(60) NOT NULL,
  `stock` varchar(14) NOT NULL,
  `installation` varchar(14) NOT NULL,
  `modification` varchar(60) NOT NULL,
  `code` varchar(14) NOT NULL,
  `type` varchar(14) NOT NULL,
  `model` varchar(60) NOT NULL,
  `volume` varchar(14) NOT NULL,
  `power` varchar(14) NOT NULL,
  `drive` varchar(14) NOT NULL,
  `year` varchar(14) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `email` varchar(60) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `marka`, `stock`, `installation`, `modification`, `code`, `type`, `model`, `volume`, `power`, `drive`, `year`, `name`, `phone`, `email`, `status`, `date`) VALUES
(6, 'Acura', 'engine', '0', '2.2', '', '', 'F22B2', '', '147', '', '1996 - 1997', '546', '564', '', 0, '2019-11-06 23:57:44'),
(8, 'Acura', 'engine', '0', '1.8 GS-R', '00000000', '', 'F18C2', '', '200', '', '1993 - 2001', 'авварпр', 'варпврвар', '', 0, '2019-11-06 23:58:32'),
(9, 'Acura', 'engine', '0', '2.2', '', '', 'F22B2', '', '147', '', '1996 - 1997', 'авпвапвап', 'вапвап', '', 0, '2019-11-07 13:30:35'),
(10, 'Acura', 'Двигатель', 'нет', '2.2', '', '', 'F22B2', '', '147', '', '1996 - 1997', '000000', '0000000000', '', 0, '2019-11-07 22:49:47'),
(11, 'Acura', 'Двигатель', 'нет', '2.3 Vtec', '', '', 'F23A7', '', '152', '', '1998 - 2000', '000000', '0000000000', '', 0, '2019-11-07 22:50:01'),
(12, 'Acura', 'Двигатель', 'нет', '2.7', '', 'Бензин', 'C27A1', 'Купе', '177', 'Передний', '1987 - 1991', '777777', '77777777', '', 0, '2019-11-07 22:50:34'),
(13, 'Acura', 'Двигатель', 'нет', '1.8 LS', '', 'Бензин', 'F18C1', 'Хэтчбек', '170', 'Передний', '1993 - 2001', '454', '4545', '', 0, '2019-11-07 22:51:02'),
(14, 'Acura', 'Двигатель', 'нет', '2.7', '', 'Бензин', 'C27A1', 'Купе', '177', 'Передний', '1987 - 1991', '555', '555', '', 1, '2019-11-07 22:53:22'),
(15, 'Acura', 'Двигатель', 'да', '1.8', '', 'Бензин', 'F18A2', 'Хэтчбек', '105', 'Передний', '1990 - 1993', '555', '555', '', 0, '2019-11-07 22:55:39'),
(16, 'Acura', 'Коробка', 'да', '1.8 LS', '', 'Бензин', 'F18C1', 'Хэтчбек', '170', 'Передний', '1993 - 2001', '0000', '0000', '', 0, '2019-11-07 23:01:29'),
(21, 'Ford', 'Коробка', 'нет', '1.4', '', 'Автомат', 'F6F; F6G', '', '71', '', '1990 - 1992', '345345', '453345345', '', 0, '2019-11-09 03:55:18'),
(22, 'Toyota', 'Двигатель', 'нет', '4.5 D-40 V8', '', 'Дизель', '1VD-FTV', '', '265', '', '2008 - текущий', 'Виктория Новикова', '89859279281', 'Vika230810@yandex.ru', 0, '2019-11-09 11:32:22');

-- --------------------------------------------------------

--
-- Структура таблицы `statistic`
--

CREATE TABLE `statistic` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `click` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statistic`
--

INSERT INTO `statistic` (`id`, `user_id`, `order_id`, `click`) VALUES
(11, 10, 10, 4),
(12, 10, 12, 2),
(14, 11, 8, 5),
(15, 11, 10, 6),
(16, 11, 11, 7),
(17, 11, 12, 3),
(18, 11, 6, 14),
(19, 11, 13, 3),
(20, 11, 9, 3),
(21, 11, 21, 1),
(22, 11, 1, 2),
(23, 11, 22, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `company` varchar(64) NOT NULL,
  `fio` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statistic`
--
ALTER TABLE `statistic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `statistic`
--
ALTER TABLE `statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
