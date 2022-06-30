CREATE DATABASE users;


CREATE TABLE users(
    firstname varchar(25),
    lastname varchar(25),
    age int,
    gender varchar(25),
    email varchar(25) primary key not null,
    password varchar(255)
);

CREATE TABLE profile(
    photo MEDIUMBLOB
);

CREATE TABLE posts(
    title varchar(50),
    email varchar(25),
    caption varchar(255),
    post_src varchar(255),
    date datetime
);