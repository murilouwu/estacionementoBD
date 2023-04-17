CREATE DATABASE db_estacionamento;
USE db_estacionamento;

CREATE TABLE user(
	cd_user INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nm_nome VARCHAR(1000),
	nm_name VARCHAR(1000), /*nome de usuario*/
	mail_user VARCHAR(1000),
	img LONGTEXT,
	dt_nasc DATE,
	des_endereco LONGTEXT,
	sl_senha CHAR(100),
	nr_tel CHAR(100),
	sl_adm BOOLEAN
);

CREATE TABLE esta(
	cd_esta INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nm_name VARCHAR(1000),
	des_endereco LONGTEXT,
	img LONGTEXT
);

CREATE TABLE esta_Vag(
	cd_vag INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	ps_X INT,
	ps_Y INT,
	tipo INT,
	ocup BOOLEAN,
	vl_preco DECIMAL(65, 2),
	id_esta INT,
	FOREIGN KEY (id_esta) REFERENCES esta(cd_esta) ON DELETE CASCADE
);

CREATE TABLE data(
	cd_data INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	dt_disp DATE,
	vl_dia DECIMAL(65, 2),
	vl_con DECIMAL(65, 2),
	vl_men DECIMAL(65, 2),
	id_esta INT,
	FOREIGN KEY (id_esta) REFERENCES esta(cd_esta) ON DELETE CASCADE
);

CREATE TABLE marcaDay(
	cd INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_user INT,
	FOREIGN KEY (id_user) REFERENCES user(cd_user) ON DELETE CASCADE,
	id_data INT,
	FOREIGN KEY (id_data) REFERENCES data(cd_data) ON DELETE CASCADE
);

CREATE TABLE User_vag(
	cd_vgUs INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	tipo INT,
	vl_precoFinal DECIMAL(65, 2),
	id_user INT,
	FOREIGN KEY (id_user) REFERENCES user(cd_user) ON DELETE CASCADE,
	id_esta INT,
	FOREIGN KEY (id_esta) REFERENCES esta(cd_esta) ON DELETE CASCADE,
	id_vag INT,
	FOREIGN KEY (id_vag) REFERENCES esta_Vag(cd_vag) ON DELETE CASCADE
);