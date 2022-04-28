//
// Created by igcbs on 25/04/2022.
//

#include "Database.h"
#include <iostream>
#include <fstream>
#include <cstdlib>
#include <ctime>


using namespace std;

void Database::readFile(string filename, vector<string>& vec){
    ifstream file;
    file.open (filename + ".txt");
    string temp;
    while(getline(file, temp)){
        vec.push_back(temp);
    }
    file.close();
}


int Database::generateUsers(int n){
    readFile("names", names);
    readFile("emails", emails);
    readFile("surnames", surnames);
    readFile("passwords", passwords);
    if(cities.empty()) {
        readFile("cities", cities);
    }
    if(streets.empty()){
        readFile("streets", streets);
    }
    srand(time(0));

    /*
CREATE TABLE User(
    idUser number UNIQUE NOT NULL,
    name varchar(255) NOT NULL,
    phone varchar(30) NOT NULL,
    address varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    PRIMARY KEY(idUser)
);*/

    for(int i=0; i<n; i++){
        string tempStr = "insert into User values(" + to_string(i) + ", '";

        string tempName = names[rand()%names.size()] + " " + surnames[rand()%surnames.size()];
        string tempAddress = to_string(rand()%1000) + ", " + streets[rand()%streets.size()] + " - " + cities[rand()%cities.size()];
        string tempPhone = to_string(100 + rand()%900) + to_string(100 + rand()%900) + to_string(100 + rand()%900);
        string tempPassword = passwords[rand()%passwords.size()];
        string tempEmail = emails[rand()%emails.size()];


        tempStr += (tempName + "', " + "\'"+tempEmail+"\'" + ", " + tempPhone + ", '" + tempAddress + "', '" + tempPassword+"');");
        users.push_back(tempStr);
    }
    return 0;
}

int Database::generateRestaurants(int n) {
    readFile("restaurants", restaurantNames);
    readFile("categories", categories);
    readFile("passwords", logos); //TODO passwords is only placeholder - shall later be changed to actual image names;
    if(cities.empty()){
        readFile("cities", cities);
    }
    if(streets.empty()){
        readFile("streets", streets);
    }

    /*
CREATE TABLE Restaurant(
    idRestaurant number UNIQUE NOT NULL,
    name varchar(255) NOT NULL,
    category varchar(100) NOT NULL,
    address varchar(255) NOT NULL,
    logo varchar(255) NOT NULL,
    PRIMARY KEY(idRestaurant)
);*/

    for(int i=0; i<n; i++){
        string tempStr = "insert into Restaurant values(" + to_string(i) + ", '";

        string tempName = restaurantNames[rand()%restaurantNames.size()];
        string tempCat = categories[rand()%categories.size()];
        string tempAddress = to_string(rand()%1000) + ", " + streets[rand()%streets.size()] + " - " + cities[rand()%cities.size()];
        string tempLogo = logos[rand()%logos.size()];

        tempStr += (tempName + "', '" + tempCat + "', '" + tempAddress + "', '" + tempLogo +"');");
        restaurants.push_back(tempStr);
    }
    return 0;
}

int Database::generateDishes(int n) {
    if(restaurants.empty())
        return 1;
    readFile("dishNames", dishNames);
    readFile("passwords", photos); //TODO passwords is only placeholder - shall later be changed to actual photo names
/*
CREATE TABLE Dish(
    idDish number UNIQUE NOT NULL,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    name varchar(255) NOT NULL,
    price varchar(255) NOT NULL,
    photo varchar(255) NOT NULL,
    category varchar(100) NOT NULL,
    PRIMARY KEY(idDish)
);
 */
    for(int i=0; i<n; i++){
        string tempStr = "insert into Dish values(" + to_string(i) + ", ";
        string tempRestaurantId = to_string(rand()%restaurants.size());
        string tempDishName = dishNames[rand()%dishNames.size()];
        string tempPrice = to_string(1+ rand()%40);
        string tempPhoto = photos[rand()%photos.size()];
        string tempCat = categories[rand()%categories.size()];
        //TODO DishCategories != RestaurantCategories. Decide on what the dish categories are and create new dishCategories file

        tempStr += (tempRestaurantId + ", '" + tempDishName + "', " + tempPrice + ", '" + tempPhoto + "', '" + tempCat + "');");
        dishes.push_back(tempStr);
    }
    return 0;
}

int Database::generateRestaurantOwners(int n){
    if(restaurants.empty() || users.empty())
        return 1;

    /*
CREATE TABLE Restaurant_owner(
    idRestaurant_owner number UNIQUE NOT NULL,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    idUser number NOT NULL REFERENCES User(idUser),
    PRIMARY KEY(idRestaurant_owner)
);*/

    for(int i=0; i<n; i++){
        string tempStr = "insert into Restaurant_owner values(" + to_string(i) + ", ";
        string tempRestaurantId = to_string(rand()%restaurants.size());
        string tempUserId = to_string(rand()%users.size());

        tempStr += (tempRestaurantId + ", " + tempUserId + ");");
        restaurantOwners.push_back(tempStr);
    }
    return 0;
}

int Database::generateDishOrder(int n) {
    if(dishes.empty() || users.empty())
        return 1;
    readFile("states", states);

    /*
CREATE TABLE Dish_order(
    idDish_order number UNIQUE NOT NULL,
    idDish number NOT NULL REFERENCES Dish(idDish),
    idUser number NOT NULL REFERENCES User(idUser),
    state varchar(50) NOT NULL,
    PRIMARY KEY(idDish_order)
);*/

    for(int i=0; i<n; i++){
        string tempStr = "insert into Dish_order values(" + to_string(i) + ", ";
        string tempDishId = to_string(rand()%dishes.size());
        string tempUserId = to_string(rand()%users.size());
        string tempState = states[rand()%states.size()];

        tempStr += (tempDishId + ", " + tempUserId + ", '" + tempState +"');");
        dishOrders.push_back(tempStr);
    }
    return 0;
}

int Database::generateReviews(int n){
    if(restaurants.empty() || users.empty())
        return 1;
    readFile("reviewTexts", reviewTexts);
    /*
CREATE TABLE Review(
    idReview number UNIQUE NOT NULL,
    review varchar(255),
    rating number,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    idUser number NOT NULL REFERENCES User(idUser),
    PRIMARY KEY(idReview)
);*/

    for(int i=0; i<n; i++){
        string tempStr = "insert into Review values(" + to_string(i) + ", '";
        string tempReviewText = reviewTexts[rand()%reviewTexts.size()];
        string tempRating = to_string(1 + rand()%10);
        string tempRestaurantId = to_string(rand()%restaurants.size());
        string tempUserId = to_string(rand()%users.size());

        tempStr += (tempReviewText + "', " + tempRating + ", " + tempRestaurantId + ", " + tempUserId + ");");
        reviews.push_back(tempStr);
    }
    return 0;
}

void Database::pushToFile(string filename){
    ofstream file;
    file.open (filename + ".sql");
    file << "PRAGMA foreign_keys=ON;\nBEGIN TRANSACTION;\n\n";

    for(string user : users){
        file << user << endl;
    }
    file<<endl;
    for(string restaurant : restaurants){
        file << restaurant << endl;
    }
    file<<endl;
    for(string review : reviews){
        file << review << endl;
    }
    file<<endl;
    for(string dish : dishes){
        file << dish << endl;
    }
    file<<endl;
    for(string dishOrder : dishOrders){
        file << dishOrder << endl;
    }
    file<<endl;
    for(string restaurantOwner : restaurantOwners){
        file << restaurantOwner << endl;
    }
    file<<endl;
    file<<"COMMIT;";
}


