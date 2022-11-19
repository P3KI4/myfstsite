-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 19 2022 г., 05:10
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
-- База данных: `site1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admmenu`
--

CREATE TABLE `admmenu` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `vidimost` int(11) NOT NULL,
  `content_page` varchar(50) NOT NULL,
  `adm_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mainmenu`
--

CREATE TABLE `mainmenu` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `pn` int(2) DEFAULT NULL,
  `vidimost` int(11) NOT NULL,
  `menu_content` text,
  `user_status_id` int(11) NOT NULL,
  `content_page` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mainmenu`
--

INSERT INTO `mainmenu` (`id`, `item_name`, `pn`, `vidimost`, `menu_content`, `user_status_id`, `content_page`) VALUES
(1, 'Главная', 1, 1, 'Главная страница \"Администратор\"', 1, ''),
(2, 'Статьи', 2, 1, 'Страница \"Статьи\" администратор', 1, ''),
(3, 'Пользователи', 3, 1, 'Страница \"Пользователи\" администратор', 1, ''),
(4, 'Гланая', 1, 1, 'Главная страница \'Студент\'', 2, ''),
(6, 'Материал', 2, 1, 'Страница \'Материалы\' студент', 2, ''),
(7, 'Главная', 1, 1, 'Главная \'Гость\'', 3, ''),
(8, 'Статьи', 2, 1, 'Статьи раздела \'Гость\'', 3, ''),
(9, 'Справочник', 3, 1, 'Справочник раздела \'Гость\'', 3, ''),
(16, 'Главная', 1, 1, 'Главная \'Модератор\'', 4, ''),
(21, 'Справочник', 4, 1, '', 2, ''),
(24, 'Настя', NULL, 1, '', 2, '');

-- --------------------------------------------------------

--
-- Структура таблицы `newspapers`
--

CREATE TABLE `newspapers` (
  `id` int(2) NOT NULL,
  `nsp_title` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nsp_text` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `podmenu_id` int(2) DEFAULT '1',
  `vidimost` int(2) DEFAULT '1',
  `status_id` int(2) DEFAULT '1',
  `content_page` varchar(500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `newspapers`
--

INSERT INTO `newspapers` (`id`, `nsp_title`, `nsp_text`, `podmenu_id`, `vidimost`, `status_id`, `content_page`) VALUES
(1, 'Статья 1', 'Содержание новое', 14, 1, 3, NULL),
(2, 'Статья 2', 'Содержание новое', 14, 1, 3, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `podmenu`
--

CREATE TABLE `podmenu` (
  `id` int(11) UNSIGNED NOT NULL,
  `podmenu_item` varchar(25) NOT NULL,
  `pn` int(2) DEFAULT NULL,
  `menu_id` int(11) NOT NULL,
  `content` text,
  `is_article` int(1) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL,
  `content_page` int(30) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `podmenu`
--

INSERT INTO `podmenu` (`id`, `podmenu_item`, `pn`, `menu_id`, `content`, `is_article`, `status_id`, `content_page`) VALUES
(1, 'Вступление', 1, 1, 'Вступительная часть и приветствие для пользователей сайта', 0, 1, 0),
(2, 'О системе', 2, 1, 'Информация о назначении сайта и работе в системе', 0, 1, 0),
(3, 'Консалтинг', 3, 2, 'Статьи по теме \"Консалтинг\"', 0, 1, 0),
(4, 'Образование', -4, 2, 'Статьи об образовании', 0, 1, 0),
(5, 'Зарегистрированные', 6, 3, 'Зарегистрированные пользователи сайта', 0, 1, 0),
(6, 'Гости', -11, 3, 'Гости сайта за определенный период времени', 0, 2, 0),
(9, 'О системе', 19, 5, 'Информация о системе для студентов', 0, 2, 0),
(10, 'Экзамены', 4, 5, 'Список экзаменов для студентов определенного курса', 0, 2, 0),
(11, 'Математика', 6, 6, 'Материалы по математике', 0, 2, 0),
(12, 'Информатика', 5, 6, 'Материалы по информатике', 0, 2, 0),
(13, 'О системе', 2, 7, 'Информация о системе для гостей', 0, 3, 0),
(14, 'Статьи', 1, 7, 'Статьи для гостей', 1, 3, 0),
(15, 'Математика', 5, 8, 'Справочные материалы по математике для гостей', 0, 3, 0),
(16, 'Информатика', 55, 8, 'Справочные материалы по информатике для гостей', 0, 3, 0),
(19, 'Математика', 4, 8, 'Справочные материалы по математике для гостей', 0, 3, 0),
(20, 'Информатика', 3, 8, 'Справочные материалы по информатике для гостей', 0, 3, 0),
(29, 'Костя', NULL, 4, NULL, 0, 2, NULL),
(30, 'О статьях', 1, 9, 'О статьях', 0, 3, 0),
(32, 'Информация', 2, 9, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 0, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(11) UNSIGNED NOT NULL,
  `status_title` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `status_title`) VALUES
(1, 'администратор'),
(2, 'студент'),
(3, 'гость'),
(4, 'модератор'),
(16, 'nastya');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_fname` varchar(30) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_oname` varchar(30) NOT NULL,
  `user_login` varchar(15) NOT NULL,
  `user_pass` varchar(12) NOT NULL,
  `status_id` int(11) NOT NULL,
  `activation` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_fname`, `user_name`, `user_oname`, `user_login`, `user_pass`, `status_id`, `activation`) VALUES
(1, '', '', '', 'admin', 'admin', 1, 1),
(2, 'Ильич', 'Петр', 'Федоров', 'petr2001', 'pter21', 3, 1),
(3, 'Сташенко', 'Николай', 'Викторович', 'koshmar932', 'Koshmar542', 4, 1),
(4, 'Super', 'Brawler', '', 'Brawlik41', 'Brawl2004', 2, 1),
(5, 'Полина', 'Анастасия', 'Николаевна', '06anstasia04', 'tyty2004', 2, 1),
(6, 'Клопов', 'Никита', 'Иванович', 'shpekgucci932', 'shpekg231', 4, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admmenu`
--
ALTER TABLE `admmenu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mainmenu`
--
ALTER TABLE `mainmenu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `newspapers`
--
ALTER TABLE `newspapers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `podmenu`
--
ALTER TABLE `podmenu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
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
-- AUTO_INCREMENT для таблицы `admmenu`
--
ALTER TABLE `admmenu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mainmenu`
--
ALTER TABLE `mainmenu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `newspapers`
--
ALTER TABLE `newspapers`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `podmenu`
--
ALTER TABLE `podmenu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
