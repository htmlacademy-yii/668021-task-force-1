CREATE DATABASE taskforce
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE users (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name,
email,
address,
avatar,
date_birthday,
about_info,
password,
contact_phone,
contact_skype,
contact_oder

);

CREATE TABLE categories_users (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
user_id,
category_id
)

CREATE TABLE tasks (

);

CREATE TABLE role_users (

);

CREATE TABLE cities (

);

CREATE TABLE categories (

);

CREATE TABLE responses_task (

);

CREATE TABLE add_info_for_task (

);

CREATE TABLE status_user (

);



