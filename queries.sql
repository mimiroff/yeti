INSERT INTO categories (category) VALUES
  ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное');

INSERT INTO users (email, password, register_date, name, contacts) VALUES
  ('ignat.v@gmail.com', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', '2017-11-25 12:00:00', 'Игнат', 'ignat.v@gmail.com'),
  ('kitty_93@li.ru', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', '2017-11-25 12:00:00', 'Леночка', 'kitty_93@li.ru'),
  ('warrior07@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', '2017-11-25 12:00:00', 'Руслан', 'warrior07@mail.ru');

INSERT INTO lots (date, name, description, picture, price, expire_date, author_id, category_id) VALUES
  ('2017-11-25 12:00:00', '2014 Rossignol District Snowboard', name, 'img/lot-1.jpg', 10999, '2017-12-05 00:00:00', 1, 1),
  ('2017-11-25 12:30:00', 'DC Ply Mens 2016/2017 Snowboard', name, 'img/lot-2.jpg', 159999, '2017-12-05 00:30:00', 3, 1),
  ('2017-11-25 12:40:00', 'Крепления Union Contact Pro 2015 года размер L/XL', name, 'img/lot-3.jpg', 8000, '2017-12-05 00:40:00', 2, 2),
  ('2017-11-25 12:45:00', 'Ботинки для сноуборда DC Mutiny Charocal', name, 'img/lot-4.jpg', 10999, '2017-12-05 00:45:00', 3, 3),
  ('2017-11-25 13:00:00', 'Куртка для сноуборда DC Mutiny Charocal', name, 'img/lot-5.jpg', 7500, '2017-12-05 13:00:00', 1, 4),
  ('2017-11-25 13:20:00', 'Маска Oakley Canopy', name, 'img/lot-6.jpg', 5400, '2017-12-05 13:20:00', 2, 6);

INSERT INTO bets (date, cost, user_id, lot_id) VALUES
  ('2017-11-25 12:10:00', 11500, 3, 1),
  ('2017-11-25 12:40:00', 12000, 2, 1),
  ('2017-11-25 15:30:00', 170000, 1, 2),
  ('2017-11-25 17:50:00', 173000, 2, 2),
  ('2017-11-25 17:55:00', 181000, 1, 2),
  ('2017-11-25 13:10:00', 8500, 1, 3),
  ('2017-11-25 18:40:00', 9000, 3, 3),
  ('2017-11-25 16:55:00', 12000, 2, 4),
  ('2017-11-25 19:27:00', 13500, 1, 4),
  ('2017-11-25 14:13:00', 8000, 2, 5),
  ('2017-11-25 15:35:00', 9000, 3, 5),
  ('2017-11-25 18:19:00', 5900, 3, 6),
  ('2017-11-25 21:36:00', 6400, 1, 6);

# получить список из всех категорий
SELECT * FROM categories;

# получить самые новые, открытые лоты. Каждый лот должен включать название,
# стартовую цену, ссылку на изображение, цену, количество ставок, название категории
SELECT l.id, l.name, l.price, l.picture, MAX(b.cost), COUNT(b.id), category FROM lots l
  LEFT JOIN bets b ON l.id = b.lot_id JOIN categories c ON l.category_id = c.id WHERE l.winner_id IS NULL GROUP BY l.id;

# найти лот по его названию или описанию
SELECT * FROM lots WHERE name LIKE '%маска%' OR description LIKE '%маска%';

# обновить название лота по его идентификатору
UPDATE lots SET name = 'Крепления Union Contact' WHERE id = 3;

# получить список самых свежих ставок для лота по его идентификатору
SELECT * FROM bets WHERE lot_id = 3 ORDER BY date DESC;
