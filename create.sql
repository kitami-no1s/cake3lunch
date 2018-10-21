DROP DATABASE IF EXISTS cake3lunch;
CREATE DATABASE cake3lunch DEFAULT CHARACTER SET utf8;

SET NAMES utf8;

USE cake3lunch;

DROP TABLE IF EXISTS users;
CREATE TABLE users(
	id int(11) not null auto_increment,
	name varchar(255) not null,
	password varchar(255) not null,
	role varchar(8) default 'user',
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS stores;
CREATE TABLE stores(
	id int(11) not null auto_increment,
	name varchar(255) not null,
	address varchar(255) default null,
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS comments;
CREATE TABLE comments(
	id int(11) not null auto_increment,
	store_id int(11) not null,
	comment text default null,
	created datetime default current_timestamp,
        user_id int(11) not null,
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS stations;
CREATE TABLE stations(
	id int(11) not null auto_increment,
	name varchar(255) not null,
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS images;
CREATE TABLE images(
	id int(11) not null auto_increment,
	comment_id int(11) not null,
	image_url varchar(255) not null,
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS stations_stores;
CREATE TABLE stations_stores(
	station_id int(11) not null,
	stores_id int(11) not null
);
