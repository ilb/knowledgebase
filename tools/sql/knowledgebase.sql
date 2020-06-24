-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 24 2020 г., 07:54
-- Версия сервера: 5.6.43
-- Версия PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `knowledgebase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `keyword`
--

CREATE TABLE `keyword` (
  `id_keyword` int(7) NOT NULL,
  `name_keyword` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `id_material` int(7) NOT NULL,
  `name_material` varchar(100) NOT NULL,
  `source` text NOT NULL,
  `type` enum('document','resource') NOT NULL DEFAULT 'resource'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id_material`, `name_material`, `source`, `type`) VALUES
(1, 'Test', 'link_to_material', 'document'),
(2, 'Test1', 'link_to_material', 'resource'),
(3, 'Test2', 'link_to_material', 'document'),
(4, 'examples/', 'https://ilb.github.io/devmethodology/examples/', 'document'),
(5, 'external/', 'https://ilb.github.io/devmethodology/external/', 'document'),
(6, 'interview/', 'https://ilb.github.io/devmethodology/interview/', 'document'),
(7, 'presentation/', 'https://ilb.github.io/devmethodology/presentation/', 'document'),
(8, 'architecture.xhtml', 'https://ilb.github.io/devmethodology/architecture.xhtml', 'document'),
(9, 'architecture.xhtml#arhitektura_prilozenij', 'https://ilb.github.io/devmethodology/architecture.xhtml/arhitektura_prilozenij', 'resource');

-- --------------------------------------------------------

--
-- Структура таблицы `material_from_keyword`
--

CREATE TABLE `material_from_keyword` (
  `material_id` int(7) NOT NULL,
  `keyword_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `offers`
--

CREATE TABLE `offers` (
  `id_offer` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `diff` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `offers`
--

INSERT INTO `offers` (`id_offer`, `material_id`, `user_id`, `diff`) VALUES
(1, 3, 1, 'Test Info');

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id_subscription` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `material_id` int(7) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`id_subscription`, `user_id`, `material_id`, `is_read`) VALUES
(1, 1, 2, 0),
(2, 2, 3, 1),
(3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(7) NOT NULL,
  `login` varchar(30) NOT NULL,
  `status` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `login`, `status`) VALUES
(1, 'USer1', 'user'),
(2, 'User2', 'mentor');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`id_keyword`);

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`);

--
-- Индексы таблицы `material_from_keyword`
--
ALTER TABLE `material_from_keyword`
  ADD KEY `keyword_id` (`keyword_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Индексы таблицы `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id_offer`),
  ADD KEY `offers_ibfk_1` (`material_id`),
  ADD KEY `offers_ibfk_2` (`user_id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id_subscription`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `keyword`
--
ALTER TABLE `keyword`
  MODIFY `id_keyword` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `offers`
--
ALTER TABLE `offers`
  MODIFY `id_offer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id_subscription` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `material_from_keyword`
--
ALTER TABLE `material_from_keyword`
  ADD CONSTRAINT `material_from_keyword_ibfk_1` FOREIGN KEY (`keyword_id`) REFERENCES `keyword` (`id_keyword`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material_from_keyword_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
