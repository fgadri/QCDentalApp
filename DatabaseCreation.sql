DROP DATABASE IF EXISTS QCDentalApp;
CREATE DATABASE IF NOT EXISTS QCDentalApp;
UPDATE mysql.db SET Host='%' WHERE Db='QCDentalApp'; 

GRANT ALL PRIVILEGES ON QCDentalApp.* TO 'qcadmin'@'%' IDENTIFIED BY 'J2PKY!HrkYt*AB8dhz@rYw$X';
UPDATE mysql.user SET Host='%' WHERE user='qcadmin';

USE QCDentalApp;

DROP TABLE IF EXISTS ratings, rating_meta, teeth, departments, cases, user_lab_map, user_role_map, user_roles, users, labs, licenses, companies;

CREATE TABLE IF NOT EXISTS companies (
	id INT(20) NOT NULL AUTO_INCREMENT,
	name VARCHAR(256) NOT NULL,
	email VARCHAR(256) NOT NULL,
	geo_location_1 VARCHAR(256) NOT NULL,
	geo_location_2 VARCHAR(256) NULL,
	city VARCHAR(64) NOT NULL,
	state_province VARCHAR(64) NOT NULL,
	postal_code VARCHAR(16) NOT NULL,
	country VARCHAR(64) NOT NULL,
	phone VARCHAR(16) NOT NULL,
	contact VARCHAR(64) NOT NULL,
	PRIMARY KEY (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT 10001;

CREATE TABLE IF NOT EXISTS licenses (
	id INT(20) NOT NULL AUTO_INCREMENT,
	license VARCHAR(32) NOT NULL,
	seats_available INT(10) NOT NULL,
	purchase_date DATETIME NOT NULL,
	duration INT(10) NOT NULL,
	company_id INT(20) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY company_id (company_id) REFERENCES companies (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
	
CREATE TABLE IF NOT EXISTS labs (
	id INT(20) NOT NULL AUTO_INCREMENT,
	name VARCHAR(256) NOT NULL,
	email VARCHAR(256) NOT NULL,
	geo_location_1 VARCHAR(256) NOT NULL,
	geo_location_2 VARCHAR(256) NULL,
	city VARCHAR(64) NOT NULL,
	state_province VARCHAR(64) NOT NULL,
	postal_code VARCHAR(16) NOT NULL,
	country VARCHAR(64) NOT NULL,
	phone VARCHAR(16) NOT NULL,
	contact VARCHAR(64) NOT NULL,
	company_id INT(20) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY company_id (company_id) REFERENCES companies (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT 10001;

CREATE TABLE IF NOT EXISTS users (
	id INT(20) NOT NULL AUTO_INCREMENT,
	username VARCHAR(64) NOT NULL,
	password VARCHAR(256) NOT NULL,
	title VARCHAR(16) NULL,
	first_name VARCHAR(64) NOT NULL,
	last_name VARCHAR(64) NOT NULL,
	email VARCHAR(256) NOT NULL,
	phone VARCHAR(16) NOT NULL,
	image VARCHAR(256) NOT NULL,
	company_id INT(20) NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT user_company UNIQUE (username, company_id),
	FOREIGN KEY company_id (company_id) REFERENCES companies (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT 10001;

CREATE TABLE IF NOT EXISTS user_roles (
	id INT(20) NOT NULL AUTO_INCREMENT,
	name VARCHAR(64) NOT NULL,
	PRIMARY KEY (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS user_role_map (
	user_id INT(20) NOT NULL,
	role_id INT(20) NOT NULL,
	PRIMARY KEY (user_id, role_id),
	CONSTRAINT user_role UNIQUE (user_id, role_id),
	FOREIGN KEY user_id (user_id) REFERENCES users (id),
	FOREIGN KEY role_id (role_id) REFERENCES user_roles (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS user_lab_map (
	user_id INT(20) NOT NULL,
	lab_id INT(20) NOT NULL,
	PRIMARY KEY (user_id, lab_id),
	CONSTRAINT user_lab UNIQUE (user_id, lab_id),
	FOREIGN KEY user_id (user_id) REFERENCES users (id),
	FOREIGN KEY lab_id (lab_id) REFERENCES labs (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS cases (
	id INT(20) NOT NULL AUTO_INCREMENT,
	case_number VARCHAR(32) NOT NULL,
	comments VARCHAR(1024) NULL,
	lab_id INT(20) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY lab_id (lab_id) REFERENCES labs (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS departments (
	id INT(20) NOT NULL AUTO_INCREMENT,
	name VARCHAR(32) NOT NULL,
	color VARCHAR(16) NOT NULL,
	comments VARCHAR(1024) NULL,
	lab_id INT(20) NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT name_lab UNIQUE (name, lab_id),
	FOREIGN KEY lab_id (lab_id) REFERENCES labs (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS teeth (
	id INT(20) NOT NULL AUTO_INCREMENT,
	tooth_number INT(3) NOT NULL,
	comments VARCHAR(1024) NULL,
	case_id INT(20) NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT tooth_case UNIQUE (tooth_number, case_id),
	FOREIGN KEY case_id (case_id) REFERENCES cases (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS rating_meta (
	id INT(20) NOT NULL AUTO_INCREMENT,
	name VARCHAR(32) NOT NULL,
	parent INT(20) NOT NULL,
	department_id INT(20) NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT name_department UNIQUE (name, department_id),
	FOREIGN KEY department_id (department_id) REFERENCES departments (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS ratings (
	id INT(20) NOT NULL AUTO_INCREMENT,
	rating INT(1) NOT NULL,
	timestamp DATETIME NOT NULL,
	comments VARCHAR(1024) NULL,
	tooth_id INT(20) NOT NULL,
	rating_meta_id INT(20) NOT NULL,
	technician_id INT(20) NOT NULL,
	quality_control_id INT(20) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY tooth_id (tooth_id) REFERENCES teeth (id),
	FOREIGN KEY rating_meta_id (rating_meta_id) REFERENCES rating_meta (id),
	FOREIGN KEY department_id (department_id) REFERENCES departments (id),
	FOREIGN KEY technician_id (technician_id) REFERENCES users (id),
	FOREIGN KEY quality_control_id (quality_control_id) REFERENCES users (id)
) ENGINE InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;