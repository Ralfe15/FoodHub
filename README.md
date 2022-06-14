# LTW-t09-g05

Welcome to the documentation page of our LTW (Web Languages and Technologies) project!

The object of the project is to fully simulate a food ordering/delivery website using HTML/CSS/PHP and other web technologies!


## Contents:

* Webpages
  * [Menu](https://github.com/FEUP-LTW-2022/ltw-t09-g05/tree/main/webpages/menu)
  * [Search Results]
  * [Restaurant Profile](https://github.com/FEUP-LTW-2022/ltw-t09-g05/tree/main/webpages/restaurant%20profile)
* [Database](https://github.com/FEUP-LTW-2022/ltw-t09-g05/tree/main/database)
  * [create](https://github.com/FEUP-LTW-2022/ltw-t09-g05/blob/main/database/create.sql)
  * [populate](https://github.com/FEUP-LTW-2022/ltw-t09-g05/tree/main/database/db%20populate%20code)
  * [UML](https://github.com/FEUP-LTW-2022/ltw-t09-g05/blob/main/database/database%20uml.png)

## Project setup

To initialize the project's DB, after cloning the project run the following commands:
```
cd ltw-t09-g05/database/populate-script
sqlite3 db.db
```
In sql shell:
```
.read create.sql
.read populate.sql
```

## Features

- [x] Register
- [x] Login/Logout
- [x] Edit Profile
- [x] Add Restaurant
- [x] Edit Restaurant
- [x] Add Dishes
- [x] Add Dish Photo
- [x] List Reviews
- [x] Restaurant Owner Can Answer to Review
- [x] List Customer Orders
- [x] Change Order State
- [x] Search Restaurants
- [x] Order Dishes
- [x] List My Orders
- [x] Mark Restaurant as Favourite
- [x] Mark Dish as Favourite
- [x] Customer Can Leave a Review

## Extra Features
- [x] REST API
- [x] Track price history (used in REST API)

## Credentials

ltw@ltw.com / password123  
guest@guest.com / ianigorrafa

## REST API specifications

URL: http://localhost:9000/api/api_restaurants.php/?search="SEARCH-VALUE"&type="SEARCH-TYPE"  
Possible values for "SEARCH-TYPE":
  - name, look for restaurants with names that look like "SEARCH-TYPE"
  - address, look for restaurants with addresses that look like "SEARCH-TYPE"
  - history, price history for dish with id="SEARCH-TYPE"
  - dishes, get all possible dishes
  - price, get all dishes cheaper than "SEARCH-TYPE"
  - rating, get all restaurants with average rating greater or equals "SEARCH-TYPE"

## Members:

- Ian Ítalo Martins Gomes (ianitalo) - up202000707
- Igor Liberato de Castro (LiberCas) - up202000161 - igcbsb@gmail
- Rafael Schmidt (Ralfe15) - up202000166
