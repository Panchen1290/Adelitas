create database adelitas;

use adelitas;

create table users (
	id_user int auto_increment,
	name varchar(50),
	lastname varchar(50),
	user varchar(50),
	password text(50),
	captureDate date,
	primary key(id_user)
);

create table images (
	id_image int auto_increment,
	name varchar(500),
	filePath varchar(500),
	uploadDate date,
	primary key(id_image)
);

create table categories (
	id_category int auto_increment,
	id_user int not null,
	name varchar(150),
	captureDate date,
	primary key(id_category)
);

create table products (
	id_product int auto_increment,
	id_image int not null,
	id_user int not null,
	id_category varchar(50),
	barcode varchar(200),
	name varchar(50),
	description varchar(500),
	amount int,
	price float,
	captureDate date,
	primary key(id_product)
);

create table clients (
	id_client int auto_increment,
	id_user int not null,
	name varchar(200),
	lastname varchar(200),
	code varchar(200),
	tin varchar(200),
	primary key(id_client)
);

create table sales (
	id_sale int not null,
	id_client int,
	id_product int,
	id_user int,
	price float,
	saleDate date,
	primary key(id_sale)
);