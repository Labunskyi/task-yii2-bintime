-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 17 2019 г., 03:05
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bintime`
--

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

CREATE TABLE `addresses` (
  `id` int(12) NOT NULL,
  `userid` int(12) NOT NULL,
  `post_index` varchar(12) NOT NULL,
  `country` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `street` varchar(200) DEFAULT NULL,
  `house` varchar(200) NOT NULL,
  `appartment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `userid`, `post_index`, `country`, `city`, `street`, `house`, `appartment`) VALUES
(5, 83, '09876', 'YU', 'qw', 'qwe', 'qe', ''),
(6, 83, '1111', 'WE', 'kiev', 'street', '43', '22'),
(7, 84, '09876', 'WS', 'qw', 'qwe', 'qe', '23'),
(14, 87, '1111', 'TR', '1111', '111', '222', '3553'),
(15, 86, '09876', 'YU', 'qw', 'qwe', 'qe', '1'),
(16, 85, '09876', 'WS', 'qw', 'qwe', 'qe', '1'),
(17, 88, '09876', 'T', 'qw', 'qw', 'wq', 'qw'),
(18, 88, '09983', 'ER', 'qw', 'qw', 'wqqw', 'qwqw'),
(19, 89, '09876', 'RR', 'qw', 'qwe', 'a', 'a');

-- --------------------------------------------------------

--
-- Структура таблицы `parcel`
--

CREATE TABLE `parcel` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `depth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parcel`
--

INSERT INTO `parcel` (`id`, `product_id`, `code`, `height`, `width`, `depth`) VALUES
(47, 45, '1', 1, 1, 1),
(48, 46, '1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`) VALUES
(45, 'er'),
(46, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `login` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `gender`, `create_time`, `email`) VALUES
(85, 'test3', '1232143214', 'Test3', 'Test3', 'Women', '2019-09-16 21:33:32', 'qweew@wer.com'),
(86, 'test2', '124424', 'Test2', 'Adad', 'Not information', '2019-09-16 22:09:54', 'lkj@re.conweew'),
(88, 'tyiutu7', 'qwqqwqwqw', 'Qwe', 'Qw', 'Women', '2019-09-16 23:44:47', 'lkj@re.con'),
(89, 'adasdasd', 'asdadsad', 'Asd', 'Adad', 'Men', '2019-09-16 23:47:06', 'qweew@wer.comewwesad');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Индексы таблицы `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`,`email`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `parcel`
--
ALTER TABLE `parcel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `parcel_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
