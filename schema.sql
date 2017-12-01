CREATE DATABASE yeticave;

USE yeticave;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title CHAR(64)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  registration_date DATETIME,
  email CHAR(64),
  name CHAR(64),
  password CHAR(32),
  avatar CHAR(64),
  contacts CHAR(128)
);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title CHAR(64),
  description TEXT,
  start_date DATETIME,
  end_date DATETIME,
  img CHAR(64),
  price INT,
  min_bet INT,
  user_id INT,
	winner_id	INT,
	category_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (winner_id) REFERENCES users(id),
	FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE bets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  cost INT,
  user_id INT,
  lot_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (lot_id) REFERENCES lots(id)
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX category ON categories(title);

