#include <iostream>
#include "Database.h"



int main() {
    Database d;
    d.generateUsers(30);
    d.generateRestaurants(30);
    d.generateDishes(60);
    d.generateRestaurantOwners(30);
    d.generateDishOrder(30);
    d.generateReviews(30);
    d.pushToFile("populate");
    return 0;
}
