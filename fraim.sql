-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 05 2022 г., 16:33
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fraim`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'brand_no_image.jpg',
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `title`, `alias`, `img`, `description`) VALUES
(1, 'Shenzhen Nongke', 'shenzhen nongke', '1.jpg', 'Самый эксклюзивный и дорогой цветок в мире'),
(2, 'Gold Of Kinabalu', 'gold of kinabalu', '2.jpg', 'Самый эксклюзивный и дорогой цветок в мире'),
(3, 'Rainbow Roses', 'rainbow roses', '3.jpg', 'Радужные розы получены не путем селекции ,а это инженерное искусство, заключающееся в мастерстве смешивания красок'),
(4, 'Gloriosa', 'gloriosa', '4.jpg', 'Цветки этого растения напоминают языки пламени, а в переводе с латыни название цветка звучит как «прославленный»'),
(5, 'Тюльпан-Король ночи', 'тюльпан-король ночи', '5.jpg', 'Его лепестки в зависимости от освещения то бархатно черного, то глубокого фиолетового оттенка'),
(6, 'Strongylodon macrobotrys', 'strongylodon macrobotrys', '6.jpg', 'Эту небесно голубую лиану в природе можно найти только в тропическом лесу Филиппин'),
(7, 'Мединилла', 'мединилла', '7.jpg', 'Это растение считается одним из самых красивых в мире, садоводы и ботаники даже дали ей соответствующее прозвище \"прекрасная\"'),
(8, 'Fredclarkeara', 'fredclarkeara', '8.jpg', 'Была получена путем скрещивания трех видов орхидей. Создал этот удивительный сорт американский селекционер Фред Кларк.'),
(9, 'Плетистая роза «Пьер де Ронсар»', 'pierre de ronsard', '9.jpg', 'Волшебной красоты плетистая роза,второе название у нее Райская роза');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `title`, `alias`, `parent_id`, `keywords`, `description`) VALUES
(1, 'ЛУКОВИЧНЫЕ', 'lukvechnye', 0, '', ''),
(2, 'МНОГОЛЕТНИКИ', 'perennials', 0, '', ''),
(3, 'КУСТАРНИКИ', 'ornamental-shrubs', 0, '', ''),
(4, 'ХВОЙНЫЕ', 'coniferous', 0, '', ''),
(5, 'РОЗЫ', 'roses', 0, '', ''),
(6, 'ПЛОДОВЫЕ', 'fruit-trees', 0, '', ''),
(7, 'ТОВАРЫ', 'related-products', 0, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `coming`
--

CREATE TABLE `coming` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user` varchar(120) DEFAULT NULL,
  `count` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `coming`
--

INSERT INTO `coming` (`id`, `title`, `date`, `user`, `count`) VALUES
(1, 'БРУСНИКА RED PEARL', '2022-04-05 13:54:51', 'admin', 100),
(2, 'КАЛЛА NASHVILLE', '2022-04-05 14:13:27', 'admin', 100),
(3, 'ФЛОКС ZENOBIA', '2022-04-05 14:14:34', 'admin', 100),
(4, 'ЛАНДЫШ BORDEAUX', '2022-04-05 14:15:38', 'admin', 200),
(5, 'ФЛОКС FRECKLE RED SHADES', '2022-04-05 14:17:50', 'admin', 450),
(6, 'ФЛОКС JADE', '2022-04-05 14:19:12', 'admin', 100),
(7, 'ФЛОКС TEQUILA SUNRISE', '2022-04-05 14:21:18', 'admin', 200),
(8, 'ПЛАТИКОДОН ALBUM WHITE', '2022-04-05 14:22:07', 'admin', 200),
(9, 'Royal London 20034-02', '2022-04-05 14:22:55', 'admin', 200),
(10, 'Royal London 41156-02', '2022-04-05 14:23:26', 'admin', 100);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `brand_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `price` float NOT NULL DEFAULT 0,
  `old_price` float NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'no_image.jpg',
  `hit` enum('0','1') NOT NULL DEFAULT '0',
  `depart` varchar(255) DEFAULT NULL,
  `article` varchar(255) DEFAULT NULL,
  `grade` varchar(255) CHARACTER SET utf32 DEFAULT NULL,
  `height` varchar(100) CHARACTER SET utf32 DEFAULT NULL,
  `flower_size` varchar(255) CHARACTER SET utf32 DEFAULT NULL,
  `flowering_period` varchar(100) CHARACTER SET utf32 DEFAULT NULL,
  `landing_place` varchar(100) CHARACTER SET utf32 DEFAULT NULL,
  `frost_resistance` varchar(100) CHARACTER SET utf32 DEFAULT NULL,
  `quantity_per_pack` tinyint(4) DEFAULT NULL,
  `seedlings` varchar(100) CHARACTER SET utf32 DEFAULT NULL,
  ` bulbs` varchar(100) CHARACTER SET utf32 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `brand_id`, `title`, `alias`, `content`, `price`, `old_price`, `status`, `keywords`, `description`, `img`, `hit`, `depart`, `article`, `grade`, `height`, `flower_size`, `flowering_period`, `landing_place`, `frost_resistance`, `quantity_per_pack`, `seedlings`, ` bulbs`) VALUES
(1, 6, 0, 'БРУСНИКА RED PEARL', 'red-pearl ', NULL, 432, 0, '1', NULL, NULL, '20.jpg', '1', 'В контейнере P9', 'a_32041295', '', 'до 30 см', '', 'май-июнь', 'солнце', 'Зона 2', 1, '15-20 см', ''),
(2, 1, 0, 'КАЛЛА NASHVILLE', 'nashville', '', 158, 80, '1', NULL, NULL, '22.jpg', '1', 'упаковкой', 'a_32041150', '', 'до 35 см', '', 'июнь-август', 'солнце/полутень', 'Зона 9', 1, '', '12/+'),
(3, 2, 0, ' ФЛОКС ZENOBIA', 'zenobia ', NULL, 158, 0, '1', NULL, NULL, '23.jpg', '1', 'упаковкой', 'a_32041219', 'Метельчатые', '70 см', 'до 4 см', 'июль-август', 'солнце/полутень', 'Зона 4', 1, '', ''),
(4, 2, 0, 'ЛАНДЫШ BORDEAUX', 'bordeaux ', NULL, 70, 0, '1', NULL, NULL, '24.jpg', '1', 'упаковкой', 'a_32041157', '', '', '', '', '', '', 1, '', ''),
(5, 2, 0, 'ФЛОКС FRECKLE RED SHADES', 'freckle-red-shades ', NULL, 264, 0, '1', NULL, NULL, '25.jpg', '1', 'упаковкой', 'a_32041216', 'Метельчатые', 'до 50 см', 'до 4 см', 'июль-август', 'солнце/полутень', 'Зона 3', 1, '', ''),
(6, 2, 0, 'ФЛОКС JADE', 'jade', NULL, 248, 355, '1', NULL, NULL, '27.jpg', '1', 'упаковкой', 'a_32041217', 'Метельчатые', 'до 50 см', 'до 4 см', 'июль-август', 'солнце/полутень', 'Зона 3', 1, '', ''),
(7, 2, 0, 'ФЛОКС TEQUILA SUNRISE', 'tequila-sunrise', NULL, 191, 0, '1', NULL, NULL, '26.jpg', '1', 'упаковкой', 'a_32041218', 'Метельчатые', 'до 60 см', 'до 3 см', 'июль-август', 'солнце/полутень', 'Зона 3', 1, '', ''),
(8, 2, 0, 'ПЛАТИКОДОН ALBUM WHITE', 'album-white', NULL, 85, 0, '1', NULL, NULL, '21.jpg', '1', 'упаковкой', 'a_32041155', '', 'до 60 см', 'до 8 см', 'июль-август', 'солнце/полутень', 'Зона 4', 1, '', ''),
(9, 6, 4, 'Royal London 20034-02', 'royal-london-20034-02', NULL, 110, 0, '1', NULL, NULL, 'Jenny.jpg', '0', 'упаковкой', 'a_32567890', '', 'до 40 см', 'до 6 см', 'июль-август', 'солнце', 'Зона 3', 0, '', ''),
(10, 6, 4, 'Royal London 41156-02', 'royal-london-41156-02', NULL, 100, 0, '1', NULL, NULL, 'Weiki.jpg', '1', 'упаковкой', '6754', '', 'до 7 см', 'до 6 см', 'июль-август', 'солнце/полутень', 'Зона 8', 0, '', ''),
(49, 1, NULL, 'ГЕОРГИНА ADVANCE', 'advance', NULL, 170, 0, '1', NULL, NULL, 'Advance.png', '0', 'упаковкой', 'a_32041160', '', 'до 24 см', 'до 110 см', 'июнь-сентябрь', 'солнце', 'Зона 10', NULL, NULL, NULL),
(50, 1, NULL, 'ЛИЛИЯ AFRICAN LADY', 'african-lady', NULL, 345, 0, '1', NULL, NULL, 'AfricanLady.jpg', '0', 'упаковкой', '2038', NULL, 'до 25 см', 'до 110 см', 'июль-август', 'солнце/полутень', 'Зона 5', NULL, NULL, NULL),
(54, 1, NULL, 'ФРИТИЛЛЯРИЯ AURORE', 'aurora', NULL, 346, 0, '1', NULL, NULL, 'Aurora.jpg', '0', 'упаковкой', '501', NULL, 'до 60 см', 'до 6 см', 'апрель-май', 'солнце', 'Зона 5', NULL, NULL, NULL),
(55, 6, NULL, 'Голубика Bluecrop', ' bluecrop', NULL, 70, 0, '1', NULL, NULL, 'Bluecrop.jpg', '0', 'упаковкой', 'a_3256786', '', 'до 120 см', 'до 5 см', 'апрель-май', 'солнце/полутень', 'Зона 4', NULL, NULL, NULL),
(56, 1, NULL, 'qwerty', 'alias', NULL, 675, 0, '1', NULL, NULL, '24.jpg', '0', 'контейнером', '678598', 'klass', '56', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 3, NULL, 'Азалия Amoena', 'amoena', NULL, 354, 0, '1', NULL, NULL, 'amoena.jpg', '0', 'упаковкой', 'a_8654365', NULL, 'до 80 см', '15-20 см', 'май-июнь', 'полутень', 'Зона 5', NULL, NULL, NULL),
(58, 3, NULL, 'Азалия Arabesk', 'arabesk', NULL, 420, 0, '1', NULL, NULL, 'arabesk.jpg', '0', 'контейнером', 'a_3245678', NULL, 'до 40 см', 'до 57 см', 'май', 'полутень', 'Зона 4', NULL, NULL, NULL),
(59, 4, NULL, 'Ель канадская (сизая) Сандерс Блю', 'сандерс ', NULL, 231, 0, '1', NULL, NULL, 'сандерс.jpg', '0', 'контейнером', 'a_32754346', NULL, 'до 54 см', 'до 15-20 см', 'июль-август', 'полутень', 'Зона 5', NULL, NULL, NULL),
(60, 5, NULL, 'Роза Абракадабра', 'abracadabra', NULL, 299, 0, '1', NULL, NULL, 'abracadabra.jpg', '0', 'упаковкой', 'a_3265478', 'флорибунда', 'до 43 см', 'до 12 см', 'июнь-ноябрь', 'полутень', 'Зона 6', NULL, NULL, NULL),
(61, 7, NULL, 'BF - сад с/у радуга для гортензий 100 г', 'rainbow', NULL, 345, 0, '1', NULL, NULL, 'rainbow.jpg', '0', NULL, 'a_32567898', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 3, NULL, 'Азалия Fridoline', 'fridoline', NULL, 214, 0, '1', NULL, NULL, 'fridoline.jpg', '0', 'упаковкой', 'a_32765678', NULL, 'до 100 см', 'до 5 см', 'май-июнь', 'полутень', 'Зона 4', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `products_in_cart` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `user_name`, `user_phone`, `user_email`, `user_id`, `date`, `products_in_cart`) VALUES
(32, 'Anna', '34567890', 'ann@email.ru', 7, '2022-04-09 19:24:22', '{\"4\":1,\"3\":1}'),
(33, 'Luba', '12345678', 'tfgy@bk.ru', 19, '2022-04-09 19:30:08', '{\"5\":1,\"6\":1,\"7\":1}'),
(34, 'gena', '89274847665', 'tfgy@bk.ru', NULL, '2022-04-13 10:31:07', '{\"1\":1}'),
(35, 'pavel', '+79297404947', 'seroglazkinpavel@yandex.ru', 18, '2022-04-13 12:44:22', '{\"1\":1,\"7\":1,\"5\":1,\"4\":2}'),
(37, 'Anna', '1234567890', 'ann@email.ru', NULL, '2022-04-28 19:13:55', '{\"1\":3}');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(120) DEFAULT NULL,
  `login` varchar(24) NOT NULL COMMENT 'Логин',
  `password` varchar(60) NOT NULL COMMENT 'Пароль',
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `login`, `password`, `is_admin`) VALUES
(5, 'Pavel', 'Admin', '$2y$10$dH6LBYFk1y6HUAV3u7oilOICWlLNSRr2N599u.93eAv/NR7sdRTce', 1),
(7, 'Anna', 'Anna', '$2y$10$QPXeIW2NDCny0KVCyoiEsOG5JWnjdbZvmZirD4/Ws2hsCSRKWu/wS', 0),
(19, 'Luba', 'Luba', '$2y$10$lbJ6B.2FRUwJe8h4ZwWeqO9eM0TGchhTg3IYmxFy5U8maRqXKSwQW', 0),
(22, 'Юля', 'Julia', '$2y$10$Cpo717zm1sjkiXubJYeZ4ulA8fOnafWhi1vrb93vq6d1QqJtXpKDy', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Индексы таблицы `coming`
--
ALTER TABLE `coming`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `hit` (`hit`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `coming`
--
ALTER TABLE `coming`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
