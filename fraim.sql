-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 26 2022 г., 19:31
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
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(129) NOT NULL COMMENT 'наименование',
  `short_description` varchar(255) DEFAULT NULL COMMENT 'краткое описание',
  `description` text NOT NULL COMMENT 'описание',
  `date_create` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'дата создание',
  `user_id` int(11) NOT NULL COMMENT 'идентификатор пользователя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `short_description`, `description`, `date_create`, `user_id`) VALUES
(2, 'Кум', 'Про кума', 'poiuytre', '2022-01-13 19:38:31', 5),
(5, 'Пушкин', 'Сказка', 'Сказка о рыбаке и рыбке', '2022-02-15 10:29:25', 5);

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
(6, 'Петр', 'Petr', '$2y$10$TLCEJA0odTYuGAnn4EwiwOh2f0k3EUhfFbzKV1fcNbKPhn4F.xf7O', 0),
(7, 'Anna', 'Anna', '$2y$10$QPXeIW2NDCny0KVCyoiEsOG5JWnjdbZvmZirD4/Ws2hsCSRKWu/wS', 0),
(8, 'Luba', 'Luba', '$2y$10$Y2W.o.E.RoHvNsopd6I8eOCyBYd386TNs/eKTfrxnYPlc.0kY3ZZy', 0),
(9, 'Pavel', 'Pavel', '$2y$10$jZnxVtAoZCtZbwTOCe2KM.Flk5RvZV1Ib0z7haKPPrFUiWzs7pUxi', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
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
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
