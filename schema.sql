CREATE TABLE categories (
  id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  category CHAR(128)
);

CREATE TABLE users (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255),
  password CHAR(32),
  register_data DATETIME,
  name CHAR(64),
  picture CHAR(255),
  contacts TEXT,
  is_deleted TINYINT(1) UNSIGNED
);

CREATE TABLE bets (
  id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  cost INT UNSIGNED,
  user_id INT UNSIGNED,
  lot_id INT UNSIGNED,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (lot_id) REFERENCES lots(id)
);

CREATE TABLE lots (
  id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  name CHAR(255),
  description TEXT,
  picture CHAR(255),
  price INT UNSIGNED,
  expire_date DATETIME,
  step INT UNSIGNED,
  author_id INT UNSIGNED,
  winner_id INT UNSIGNED,
  category_id INT UNSIGNED,
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
