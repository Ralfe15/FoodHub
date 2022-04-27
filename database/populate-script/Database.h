//
// Created by igcbs on 25/04/2022.
//

#ifndef UNTITLED_DATABASE_H
#define UNTITLED_DATABASE_H

#include <string>
#include <vector>

using namespace std;


class Database {
    vector<string> cities;
    vector<string> streets;
    vector<string> names;
    vector<string> surnames;
    vector<string> passwords;
        vector<string> users;
    vector<string> restaurantNames;
    vector<string> categories;
    vector<string> logos;
        vector<string> restaurants;
    vector<string> dishNames;
    vector<string> photos;
        vector<string> dishes;
        vector<string> restaurantOwners;
    vector<string> states;
        vector<string> dishOrders;
    vector<string> reviewTexts;
        vector<string> reviews;
public:
    void readFile(string filename, vector<string>& vec);

    int generateUsers(int n);
    int generateRestaurants(int n);
    int generateDishes(int n);
    int generateRestaurantOwners(int n);
    int generateDishOrder(int n);
    int generateReviews(int n);

    void pushToFile(string filename);
};


#endif


/*"Apollo Street", "Lotus Avenue", "Crimson Avenue", "Luna Lane", "Haven Row", "Sunny Street",
    "Long Lane", "Summer Street", "Arch Avenue", "Barley Row", "Vermilion Lane", "Main Row", "Saffron Lane", "Bridgewater Way",
    "Merchant Lane", "Globe Row", "Orchard Route", "Anchor Avenue", "Summer Lane", "Market Street", "Art Way",
    "Campus Street", "Clearance Lane", "Canal Passage", "Heirloom Lane", "Congress Passage", "Bright Street", "Valley Boulevard",
    "Beech Lane", "Terrace Lane", "Vista Street", "Ash Lane", "Flax Lane", "Hazelnut Passage", "Station Way", "Prospect Lane",
    "Shadow Row", "Blessing Way", "Serenity Boulevard", "Revolution Row"*/
/*"Gotham City", "Hill Valley", "Springfield", "Castle Rock", "Metropolis", "Riverdale",
                             "South Park", "Mos Eisley", "Bedrock", "Quahog", "Gravity Falls", "Hogsmeade", "Vice City",
                             "Lavender Town", "Los Santos", "San Andreas", "Silent Hill", "New New York City", "Kings Landing",
                             "Atlantis", "Whoville", "Arkham", "Emerald City", "Bikini Bottom", "Halloween Town", "Little Whinging",
                             "Twin Peaks", "Cloud City"*/