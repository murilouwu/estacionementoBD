CREATE DATABASE db_estacionamento;
USE db_estacionamento;

CREATE TABLE user(
	cd_user INT PRIMARY KEY NOT NULL,
	nm_nome VARCHAR(1000),
	nm_name VARCHAR(1000), /*nome de usuario*/
	mail_user VARCHAR(1000),
	img LONGTEXT,
	dt_nasc DATE,
	des_endereco LONGTEXT,
	nr_cartão INT,
	sl_senha CHAR(100),
	nr_tel CHAR(100),
	sl_adm BOOLEAN
);

CREATE TABLE estas(
	cd_estas INT PRIMARY KEY NOT NULL,
	qt_horizontal INT,
	qt_vertical INT,
	nm_nome VARCHAR(1000),
	ps_quadrantX INT,
	ps_quadrantY INT,
	des_endereco LONGTEXT
);
CREATE TABLE tipos(
	cd_tipo INT	PRIMARY KEY NOT NULL,
	nm_para VARCHAR(1000)
);

CREATE TABLE estas_vag(
	cd_vag INT PRIMARY KEY NOT NULL,
	ps_X INT,
	ps_Y INT,
	vl_preco DECIMAL(65, 2),
	id_tipo INT,
	FOREIGN KEY (id_tipo) REFERENCES tipos(cd_tipo),
	id_esta INT,
	FOREIGN KEY (id_esta) REFERENCES estas(cd_estas)
);

CREATE TABLE user_vag(
	cd_vgUser INT PRIMARY KEY NOT NULL,
	id_vaga INT,
	FOREIGN KEY (id_vaga) REFERENCES estas_vag(cd_vag),
	id_user INT,
	FOREIGN KEY (id_user) REFERENCES user(cd_user)
);