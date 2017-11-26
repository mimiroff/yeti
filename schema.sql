CREATE TABLE categories (
  id INT(3) AUTO_INCREMENT PRIMARY KEY,
  category CHAR(128)
);

CREATE TABLE users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255),
  password CHAR(32),
  register_data DATETIME,
  name CHAR(64),
  picture CHAR(255),
  contacts TEXT,
  is_deleted TINYINT(1)
);

CREATE TABLE bets (
  id INT(50) AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  cost INT,
  user_id INT,
  lot_id INT
);

CREATE TABLE lots (
  id INT(50) AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  name CHAR(255),
  description TEXT,
  picture CHAR(255),
  price INT,
  expire_date DATETIME,
  step INT,
  author_id INT,
  winner_id INT,
  category_id INT
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX cat ON categories(category);
CREATE INDEX b_cost ON bets(cost);
CREATE INDEX b_date ON bets(date);
CREATE INDEX l_date ON lots(date);
CREATE INDEX l_exp ON lots(expire_date);
CREATE INDEX l_price ON lots(price);
