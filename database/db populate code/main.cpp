#include <iostream>
#include "Database.h"



int main() {
    Database d;
    d.generateUsers(30);
    d.generateRestaurants(30);
    d.generateDishes(30);
    d.generateRestaurantOwners(30);
    d.generateDishOrder(30);
    d.generateReviews(30);
    d.pushToFile("database1");
    return 0;
}
