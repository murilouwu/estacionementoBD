CREATE DATABASE estacionamento;
USE estacionamento;

CREATE TABLE user(
	cd_user INT PRIMARY KEY NOT NULL,
	nm_nome VARCHAR(1000),
	dt_nasc DATE,
	des_endereco LONGTEXT,
	nr_cartão INT,
	sl_senha CHAR(100),
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
	vl_preco MONEY,
	id_tipo INT,
	FOREIGN KEY (id_tipo) REFERENCES tipos(cd_tipo)
);

CREATE TABLE uservag(

);