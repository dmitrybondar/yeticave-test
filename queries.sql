INSERT INTO `categories` (`title`) VALUES
('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное');

INSERT INTO `users` (`email`, `password`, `name`, `registration_date`, `avatar`, `contacts`) VALUES
('ignat.v@gmail.com', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'Игнат', '2017-12-03 12:10:45', 'img/user.jpg', 'skype: ignat123, vk: id12345'),
('kitty_93@li.ru', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'Леночка', '2017-12-01 09:42:10', 'img/user.jpg', 'vk: id13565'),
('warrior07@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'Руслан', '2017-11-28 16:22:37', 'img/user.jpg', 'мой скайп: warrior07');

INSERT INTO `lots` (`title`, `description`, `start_date`, `end_date`, `img`, `price`, `min_bet`, `user_id`, `winner_id`, `category_id`) VALUES
('2014 Rossignol District Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', '2017-11-26 11:10:22', '2017-12-10 11:10:22', 'img/lot-1.jpg', 10999, 12000, 1, NULL, 1),
('DC Ply Mens 2016/2017 Snowboard', 'Легкий маневренный сноуборд', '2017-11-22 12:10:22', '2017-12-05 12:10:22', 'img/lot-2.jpg', 17200, 15999, 2, NULL, 1),
('Крепления Union Contact Pro 2015 года размер L/XL', 'Очень крутые крепления', '2017-11-13 16:05:45', '2017-12-07 16:05:45', 'img/lot-3.jpg', 9000, 8000, 3, NULL, 2),
('Ботинки для сноуборда DC Mutiny Charocal', 'Лучшие ботинки', '2017-11-24 11:15:45', '2017-12-24 11:15:45', 'img/lot-4.jpg', 11999, 10999, 1, NULL, 3),
('Куртка для сноуборда DC Mutiny Charocal', 'Удобная куртка', '2017-12-01 05:11:12', '2017-12-02 17:52:49', 'img/lot-5.jpg', 8000, 7500, 2, 3, 4),
('Маска Oakley Canopy', NULL, '2017-11-21 11:13:41', '2017-12-14 11:13:41', 'img/lot-6.jpg', 9000, 8000, 3, 1, 6);

INSERT INTO `bets` (`date`, `cost`, `user_id`, `lot_id`) VALUES
('2017-11-29 18:45:25', 16500, 1, 2),
('2017-11-30 17:55:18', 16700, 2, 2);

-- получить список из всех категорий
SELECT * FROM categories;

-- получить самые новые, открытые лоты. Каждый лот должен включать
-- название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории
-- (не понятно что значит самые новые лоты. По этому на свое усмотрение вывел лоты за последние 14 дней)
SELECT
 l.`id`,
 l.`title`,
 l.`price`,
 l.`img`,
 l.`min_bet`,
 c.`title` AS category_title,
 COUNT(b.`id`) AS count_bets
FROM lots AS l
LEFT JOIN categories AS c ON l.`category_id` = c.`id`
LEFT JOIN bets AS b ON l.`id` = b.`lot_id`
WHERE l.`end_date` > NOW()
AND l.`winner_id` IS NULL
AND l.`start_date` > NOW() - INTERVAL 14 DAY
GROUP BY l.`id`;

-- найти лот по его названию или описанию
SELECT * FROM lots WHERE (`title` LIKE '%ботинки%' OR `description` LIKE '%ботинки%');

-- обновить название лота по его идентификатору
UPDATE lots SET `title` = '2015 Rossignol District Snowboard' WHERE `id` = 1;

-- получить список самых свежих ставок для лота по его идентификатору
SELECT * FROM bets WHERE `lot_id` = 2 ORDER BY `date` DESC;
