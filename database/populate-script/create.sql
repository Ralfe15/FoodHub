PRAGMA foreign_keys = on;
.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Dish_order;
DROP TABLE IF EXISTS User_order;
DROP TABLE IF EXISTS Restaurant_owner;


CREATE TABLE User(
    idUser integer PRIMARY KEY AUTOINCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone varchar(30) NOT NULL,
    address varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    avatar integer
);

CREATE TABLE Restaurant(
    idRestaurant integer PRIMARY KEY AUTOINCREMENT,
    name varchar(255) NOT NULL,
    category varchar(100) NOT NULL,
    address varchar(255) NOT NULL,
    logo int
);

CREATE TABLE Review(
    idReview integer PRIMARY KEY AUTOINCREMENT,
    review varchar(255),
    rating number,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    idUser number NOT NULL REFERENCES User(idUser),
    idOrder varchar(50) REFERENCES User_order(idOrder) ON DELETE CASCADE
);

CREATE TABLE Dish(
    idDish integer PRIMARY KEY AUTOINCREMENT,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    name varchar(255) NOT NULL,
    price varchar(255) NOT NULL,
    category varchar(100) NOT NULL,
    photo integer
);

CREATE TABLE Dish_order(
    idOrder varchar(50) REFERENCES User_order(idOrder) ON DELETE CASCADE,
    idDish number NOT NULL REFERENCES Dish(idDish),
    ammount number NOT NULL
);

CREATE TABLE User_order(
    idUser number NOT NULL REFERENCES User(idUser),
    idOrder varchar(50) PRIMARY KEY NOT NULL,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    date varchar(50) NOT NULL,
    total number NOT NULL,
    status varchar(50) NOT NULL
);

CREATE TABLE Restaurant_owner(
    idRestaurant_owner integer PRIMARY KEY AUTOINCREMENT,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    idUser number NOT NULL REFERENCES User(idUser)
);


