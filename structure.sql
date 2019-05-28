DROP TABLE IF EXISTS users;

CREATE TABLE users (
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	first_name varchar(50) NOT NULL,
	last_name varchar(50) NOT NULL,
	username varchar(50) NOT NULL,
	email varchar(50) NOT NULL UNIQUE,
	status boolean(),
	password varchar(50) NOT NULL,
	date_of_birth date,
	created_at datetime DEFAULT now(),
	updated_at datetime DEFAULT now()
);

