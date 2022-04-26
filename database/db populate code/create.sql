PRAGMA foreign_keys = on;
.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Dish_order;

CREATE TABLE User(
    idUser number UNIQUE NOT NULL,
    name varchar(255) NOT NULL,
    phone varchar(30) NOT NULL,
    address varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    PRIMARY KEY(idUser)
);

CREATE TABLE Restaurant(
    idRestaurant number UNIQUE NOT NULL,
    name varchar(255) NOT NULL,
    category varchar(100) NOT NULL,
    address varchar(255) NOT NULL,
    logo varchar(255) NOT NULL,
    PRIMARY KEY(idRestaurant)
);

CREATE TABLE Review(
    idReview number UNIQUE NOT NULL,
    review varchar(255),
    rating number,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    idUser number NOT NULL REFERENCES User(idUser),
    PRIMARY KEY(idReview)
);

CREATE TABLE Dish(
    idDish number UNIQUE NOT NULL,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    name varchar(255) NOT NULL,
    price varchar(255) NOT NULL,
    photo varchar(255) NOT NULL,
    category varchar(100) NOT NULL,
    PRIMARY KEY(idDish)
);

CREATE TABLE Dish_order(
    idDish_order number UNIQUE NOT NULL,
    idDish number NOT NULL REFERENCES Dish(idDish),
    idUser number NOT NULL REFERENCES User(idUser),
    state varchar(50) NOT NULL,
    PRIMARY KEY(idDish_order)
);

CREATE TABLE Restaurant_owner(
    idRestaurant_owner number UNIQUE NOT NULL,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    idUser number NOT NULL REFERENCES User(idUser),
    PRIMARY KEY(idRestaurant_owner)
);

