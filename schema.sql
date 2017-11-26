CREATE TABLE categories (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(128) NOT NULL
);

CREATE TABLE users (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL,
  password CHAR(60) NOT NULL,
  register_data DATETIME NOT NULL,
  name VARCHAR(128) NOT NULL,
  picture VARCHAR(255),
  contacts TEXT NOT NULL,
  is_deleted TINYINT(1) UNSIGNED
);

CREATE TABLE bets (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  date DATETIME NOT NULL,
  cost INT UNSIGNED NOT NULL,
  user_id INT UNSIGNED NOT NULL,
  lot_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (lot_id) REFERENCES lots(id)
);

CREATE TABLE lots (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  date DATETIME NOT NULL,
  name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  picture VARCHAR(255) NOT NULL,
  price INT UNSIGNED NOT NULL,
  expire_date DATETIME NOT NULL,
  step INT UNSIGNED DEFAULT 500,
  author_id INT UNSIGNED,
  winner_id INT UNSIGNED,
  category_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (author_id, winner_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX cat ON categories(category);
CREATE INDEX b_cost ON bets(cost);
CREATE INDEX b_date ON bets(date);
CREATE INDEX l_date ON lots(date);
CREATE INDEX l_exp ON lots(expire_date);
CREATE INDEX l_price ON lots(price);
CREATE INDEX l_name ON lots(name);
CREATE INDEX l_desc ON lots(description);
