PRAGMA foreign_keys = on;
.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Dish_order;
DROP TABLE IF EXISTS Restaurant_owner;
DROP TABLE IF EXISTS Img;

CREATE TABLE User(
    idUser integer PRIMARY KEY AUTOINCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone varchar(30) NOT NULL,
    address varchar(255) NOT NULL,
    password varchar(255) NOT NULL
);

CREATE TABLE Restaurant(
    idRestaurant integer PRIMARY KEY AUTOINCREMENT,
    name varchar(255) NOT NULL,
    category varchar(100) NOT NULL,
    address varchar(255) NOT NULL,
    logo varchar(255) NOT NULL
);

CREATE TABLE Review(
    idReview integer PRIMARY KEY AUTOINCREMENT,
    review varchar(255),
    rating number,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    idUser number NOT NULL REFERENCES User(idUser)
);

CREATE TABLE Dish(
    idDish integer PRIMARY KEY,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    name varchar(255) NOT NULL,
    price varchar(255) NOT NULL,
    photo varchar(255) NOT NULL,
    category varchar(100) NOT NULL
);

CREATE TABLE Dish_order(
    idDish_order integer PRIMARY KEY,
    idDish number NOT NULL REFERENCES Dish(idDish),
    idUser number NOT NULL REFERENCES User(idUser),
    state varchar(50) NOT NULL
);

CREATE TABLE Restaurant_owner(
    idRestaurant_owner integer PRIMARY KEY,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    idUser number NOT NULL REFERENCES User(idUser)
);

CREATE TABLE Img(
  idImage integer PRIMARY KEY,
  title varchar(255) NOT NULL,
  type integer NOT NULL,
  idUser integer REFERENCES User(idUser),
  idRestaurant integer REFERENCES Restaurant(idRestaurant),
  idDish integer REFERENCES Dish(idDish)
);


