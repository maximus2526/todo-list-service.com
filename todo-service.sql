-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 19 2023 г., 10:17
-- Версия сервера: 5.7.33
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todo-service`
--

-- --------------------------------------------------------

--
-- Структура таблицы `to-does`
--

CREATE TABLE `to-does` (
  `todo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `todo_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `todo_item` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `todo_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `to-does`
--

INSERT INTO `to-does` (`todo_id`, `user_id`, `todo_status`, `todo_item`, `todo_category`) VALUES
(2, 1, 'incomplete', '2313212133', 'Work'),
(4, 1, 'incomplete', '4322334', 'No category'),
(5, 1, 'complete', '312413423423', 'Study'),
(6, 1, 'complete', '3212321', 'Hobby'),
(7, 1, 'complete', '23121331', 'Work'),
(8, 1, 'complete', '321231213', 'Work');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`) VALUES
(1, 'admin', '$2y$10$nhgnaYUYz3nabCeuYDYgSe8gxJ8lhRGm2IUpAPycwf6K7LN61wi3u');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `to-does`
--
ALTER TABLE `to-does`
  ADD PRIMARY KEY (`todo_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `to-does`
--
ALTER TABLE `to-does`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `to-does`
--
ALTER TABLE `to-does`
  ADD CONSTRAINT `to-does_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
