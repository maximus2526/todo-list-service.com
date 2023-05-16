-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 16 2023 г., 10:06
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
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `todo_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `todo_item` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `to-does`
--

INSERT INTO `to-does` (`todo_id`, `user_name`, `todo_status`, `todo_item`) VALUES
(106, 'admin', 'complete', '4321423212434231');

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
(46, 'admin', '$2y$10$fOXesHPO6y5v7092PRSSOuAOIkes/VGpW4J/FoCPZ7EaQrKlmh6eS'),
(47, 'admin3', '$2y$10$idN4WFP7Q6a048FrslPOtODZ3xnZtEJelxO.cOtRNWEGhEZWA0Af6');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `to-does`
--
ALTER TABLE `to-does`
  ADD PRIMARY KEY (`todo_id`),
  ADD KEY `user_name` (`user_name`);

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
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `to-does`
--
ALTER TABLE `to-does`
  ADD CONSTRAINT `to-does_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
