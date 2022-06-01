#include <iostream>
#include "Database.h"



int main() {
    Database d;
    d.generateUsers(60);
    d.generateRestaurants(200);
    d.generateDishes(500);
    d.generateRestaurantOwners(60);
    // d.generateDishOrder(100);
    // d.generateReviews(30);
    d.pushToFile("populate");
    return 0;
}
