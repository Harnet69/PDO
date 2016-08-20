<?php
const SQL_CREATE_PERSON_TABLE = '
	CREATE TABLE IF NOT EXISTS au_person(
		id INT UNSIGNED AUTO_INCREMENT NOT NULL,
		firstname VARCHAR(50) NOT NULL,
		lastname VARCHAR(50) NOT NULL,
		patro VARCHAR(50) NOT NULL,
		PRIMARY KEY (id)
	)
';

const SQL_CREATE_ACCOUNT_TABLE = '
	CREATE TABLE IF NOT EXISTS au_account(
		id INT UNSIGNED AUTO_INCREMENT NOT NULL,
		person_id INT(50) UNSIGNED NOT NULL,
		username VARCHAR(50) NOT NULL,
		password VARCHAR(100) NOT NULL,
		PRIMARY KEY (id),
		KEY person_id_idx1 (person_id),
		CONSTRAINT fk_account_ref_person_1
			FOREIGN KEY (person_id) REFERENCES au_person (id)
				ON DELETE RESTRICT
				ON UPDATE RESTRICT
	)
';
const MY_SQL_INSERT_PERSON = '
    INSERT INTO au_person(firstname, lastname, patro) VALUES (:firstname, :lastname, :patro)
';

const SQL_INSERT_ACCOUNT = '
    INSERT INTO au_account(person_id, username, password) VALUES (:person_id, :username, :password)
';
?>