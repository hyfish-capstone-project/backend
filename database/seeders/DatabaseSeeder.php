<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['username' => 'admin', 'email' => 'admin@example.com', 'password' => Hash::make('password'), 'role' => 'admin'],
        ]);

        DB::table('fishes')->insert([
            [
                'name' => 'Black Sea Sprat',
                'description' => 'The Black Sea sprat or Pontic sprat, Clupeonella cultriventris, is a small fish of the herring family, Clupeidae. It is found in the Black Sea and Sea of Azov and rivers of its basins: Danube, Dnister, Dnipro, Southern Bug, Don, Kuban. It has white-grey flesh and silver-grey scales. A typical size is 10 cm.',
                'nutrition_image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/nutritions/black-sea-sprat.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Gilt-Head Bream',
                'description' => 'The gilt-head bream, also known as the gilthead, gilt-head seabream or silver seabream, is a species of marine ray-finned fish belonging to the family Sparidae, the seabreams or porgies. This fish is found in the Eastern Atlantic and the Mediterranean.',
                'nutrition_image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/nutritions/gilt-head-bream.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Horse Mackerel',
                'description' => 'Horse Mackerel (Jack Mackerel)  are not real mackerel at all, belonging to a family of fish called carangidae made up of jacks and trevallies. They form large shoals over sandy bottomed ground, often schooling with herring or (actual) mackerel.',
                'nutrition_image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/nutritions/horse-mackerel.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Red Mullet',
                'description' => 'The red mullets or surmullets are two species of goatfish, Mullus barbatus and Mullus surmuletus, found in the Mediterranean Sea, east North Atlantic Ocean, and the Black Sea.',
                'nutrition_image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/nutritions/red-mullet.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Red Sea Bream',
                'description' => 'Pagrus major, the red seabream, red pargo, red porgy or silver seabream, is a species of marine ray-finned fish in the family Sparidae, which includes the seabreams and porgies. This species is found in the Western Pacific Ocean. The fish has high culinary and cultural importance in Japan, and is also frequently eaten in Korea and Taiwan.',
                'nutrition_image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/nutritions/red-sea-bream.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sea Bass',
                'description' => 'Sea bass, (family Serranidae), any of the numerous fishes of the family Serranidae (order Perciformes), most of which are marine, found in the shallower regions of warm and tropical seas. The family includes about 475 species, many of them well-known food and sport fishes.',
                'nutrition_image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/nutritions/sea-bass.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Shrimp',
                'description' => 'A shrimp is a crustacean with an elongated body and a primarily swimming mode of locomotion – typically belonging to the Caridea or Dendrobranchiata of the order Decapoda, although some crustaceans outside of this order are also referred to as "shrimp".',
                'nutrition_image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/nutritions/shrimp.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Striped Red Mullet',
                'description' => 'The striped red mullet or surmullet is a species of goatfish found in the Mediterranean Sea, eastern North Atlantic Ocean, and the Black Sea. They can be found in water as shallow as 5 metres or as deep as 409 metres depending upon the portion of their range that they are in.',
                'nutrition_image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/nutritions/striped-red-mullet.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Trout',
                'description' => 'Trout is a generic common name for numerous species of carnivorous freshwater ray-finned fishes belonging to the genera Oncorhynchus, Salmo and Salvelinus, all of which are members of the subfamily Salmoninae in the family Salmonidae.',
                'nutrition_image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/nutritions/trout.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('fish_images')->insert([
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/black-sea-sprat-1.jpg', 'fish_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/black-sea-sprat-2.jpg', 'fish_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/black-sea-sprat-3.jpg', 'fish_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/gilt-head-bream-1.jpg', 'fish_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/gilt-head-bream-2.jpg', 'fish_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/gilt-head-bream-3.jpg', 'fish_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/horse-mackerel-1.jpg', 'fish_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/horse-mackerel-2.jpg', 'fish_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/horse-mackerel-3.jpg', 'fish_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/red-mullet-1.jpg', 'fish_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/red-mullet-2.jpg', 'fish_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/red-mullet-3.jpg', 'fish_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/red-sea-bream-1.jpg', 'fish_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/red-sea-bream-2.jpg', 'fish_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/red-sea-bream-3.jpg', 'fish_id' => 5, 'created_at' => now(), 'updated_at' => now()],

            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/sea-bass-1.jpg', 'fish_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/sea-bass-2.jpg', 'fish_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/sea-bass-3.jpg', 'fish_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/shrimp-1.jpg', 'fish_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/shrimp-2.jpg', 'fish_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/shrimp-3.jpg', 'fish_id' => 7, 'created_at' => now(), 'updated_at' => now()],

            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/striped-red-mullet-1.jpg', 'fish_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/striped-red-mullet-2.jpg', 'fish_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/striped-red-mullet-3.jpg', 'fish_id' => 8, 'created_at' => now(), 'updated_at' => now()],

            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/trout-1.jpg', 'fish_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/trout-2.jpg', 'fish_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['image_url' => 'https://storage.googleapis.com/hyfish-storage/fishes/images/trout-3.jpg', 'fish_id' => 9, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('recipes')->insert([
            ['name' => 'Smoked Sprats Sandwich Spread', 'fish_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Egg and Sprats Canapes', 'fish_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Roasted Gilt Head Bream', 'fish_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Baked Gilt Head Bream', 'fish_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Horse Mackerel Meuniere with Japanese-style Sauce', 'fish_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Deep-fried Horse Mackerel', 'fish_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // ['name' => 'Pan-Fried Red Mullet', 'fish_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Tagliarini with red mullet, tomatoes, olives and pangrattato', 'fish_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // ['name' => 'Pan Fried Bream with Lemon Caper Butter Sauce', 'fish_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Red Sea Bream Carpaccio', 'fish_id' => 5, 'created_at' => now(), 'updated_at' => now()],

            // ['name' => 'Pan-Seared Chilean Sea Bass', 'fish_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Sea Bass with Sizzled Ginger, Chilli & Spring Onions', 'fish_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            // ['name' => 'Fried Shrimp', 'fish_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Garlic Shrimp', 'fish_id' => 7, 'created_at' => now(), 'updated_at' => now()],

            // ['name' => , 'fish_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => , 'fish_id' => 8, 'created_at' => now(), 'updated_at' => now()],

            // ['name' => 'Trout with Garlic Lemon Butter Herb Sauce', 'fish_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'Baked Fresh Rainbow Trout', 'fish_id' => 9, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('ingredients')->insert([
            ['name' => 'Tomato', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Olive Oil', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Herbs', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Smoked Sprat', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Salt', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Black Pepper', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pickled Onion', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Baguette', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bread', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Egg', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Sprat', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mayonnaise', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dill', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chive', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lemon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Caper', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Red Onion', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gilt Head Bream', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Potato', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Small Onion', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Lemon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bay Leaf', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'White Pepper', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Parsley Leaf', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Garlic', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Water', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vinegar', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'White Wine', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lemon Juice', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bouillon Cube', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Dried Herbs', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Horse Mackerel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bell Pepper', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Maitake Mushroom', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Flour', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cooking Sake', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kikkoman Soy Sauce', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mirin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Panko Breadcrumbs', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Oil', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('recipe_ingredient')->insert([
            // Smoked Sprats Sandwich Spread
            ['recipe_id' => 1, 'ingredient_id' => 1, 'amount' => 250, 'measurement' => 'gram', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 1, 'ingredient_id' => 2, 'amount' => 1, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 1, 'ingredient_id' => 3, 'amount' => 1, 'measurement' => 'teaspoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 1, 'ingredient_id' => 4, 'amount' => 100, 'measurement' => 'gram', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 1, 'ingredient_id' => 5, 'amount' => 1, 'measurement' => 'pinch', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 1, 'ingredient_id' => 6, 'amount' => 1, 'measurement' => 'pinch', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 1, 'ingredient_id' => 7, 'amount' => 2, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 1, 'ingredient_id' => 8, 'amount' => 1, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],

            // Egg and Sprats Canapes
            ['recipe_id' => 2, 'ingredient_id' => 9, 'amount' => 6, 'measurement' => 'slice', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 10, 'amount' => 3, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 11, 'amount' => 200, 'measurement' => 'gram', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 12, 'amount' => 1, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 13, 'amount' => 1, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 6, 'amount' => 1, 'measurement' => 'pinch', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 7, 'amount' => 1, 'measurement' => 'pinch', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 14, 'amount' => 2, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 15, 'amount' => 1, 'measurement' => 'cut', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 16, 'amount' => 1, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 2, 'ingredient_id' => 17, 'amount' => 1, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],

            // Roasted Gilt Head Bream
            ['recipe_id' => 3, 'ingredient_id' => 18, 'amount' => 1000, 'measurement' => 'gram', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 19, 'amount' => 500, 'measurement' => 'gram', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 20, 'amount' => 120, 'measurement' => 'gram', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 21, 'amount' => 1, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 22, 'amount' => 2, 'measurement' => 'leaf', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 5, 'amount' => 1, 'measurement' => 'pinch', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 23, 'amount' => 1, 'measurement' => 'pinch', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 24, 'amount' => 5, 'measurement' => 'leaf', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 2, 'amount' => 120, 'measurement' => 'ml', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 25, 'amount' => 4, 'measurement' => 'clove', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 26, 'amount' => 50, 'measurement' => 'ml', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 3, 'ingredient_id' => 27, 'amount' => 50, 'measurement' => 'ml', 'created_at' => now(), 'updated_at' => now()],

            // Baked Gilt Head Bream
            ['recipe_id' => 4, 'ingredient_id' => 28, 'amount' => 60, 'measurement' => 'ml', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 4, 'ingredient_id' => 2, 'amount' => 2, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 4, 'ingredient_id' => 29, 'amount' => 2, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 4, 'ingredient_id' => 5, 'amount' => 1, 'measurement' => 'teaspoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 4, 'ingredient_id' => 6, 'amount' => 1, 'measurement' => 'teaspoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 4, 'ingredient_id' => 30, 'amount' => 1, 'measurement' => 'cube', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 4, 'ingredient_id' => 31, 'amount' => 1, 'measurement' => 'teaspoon', 'created_at' => now(), 'updated_at' => now()],

            // Horse Mackerel Meuniere with Japanese-style Sauce
            ['recipe_id' => 5, 'ingredient_id' => 32, 'amount' => 2, 'measurement' => 'fillet', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 5, 'amount' => 1, 'measurement' => 'dash', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 6, 'amount' => 2, 'measurement' => 'dash', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 25, 'amount' => 1, 'measurement' => 'clove', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 33, 'amount' => 2, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 34, 'amount' => 1, 'measurement' => 'pack', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 2, 'amount' => 2, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 35, 'amount' => 100, 'measurement' => 'gram', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 36, 'amount' => 1, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 37, 'amount' => 1, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 38, 'amount' => 1, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 5, 'ingredient_id' => 26, 'amount' => 1, 'measurement' => 'splash', 'created_at' => now(), 'updated_at' => now()],

            // Deep-fried Horse Mackerel
            ['recipe_id' => 6, 'ingredient_id' => 32, 'amount' => 4, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 6, 'ingredient_id' => 5, 'amount' => 0.25, 'measurement' => 'teaspoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 6, 'ingredient_id' => 6, 'amount' => 0.25, 'measurement' => 'teaspoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 6, 'ingredient_id' => 35, 'amount' => 1.5, 'measurement' => 'tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 6, 'ingredient_id' => 10, 'amount' => 1, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 6, 'ingredient_id' => 39, 'amount' => 1.5, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],
            ['recipe_id' => 6, 'ingredient_id' => 40, 'amount' => 1000, 'measurement' => 'whole', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('steps')->insert([
            // Smoked Sprats Sandwich Spread
            ['description' => 'Cut the tomatoes into small cubes, put them in a pot along with the olive oil and herbs. Simmer over a medium heat for 20-25 minutes, or until the tomato juice has almost completely evaporated, then cool it down.', 'order' => 1, 'recipe_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Put smoked sprats, fried tomatoes, a pinch of salt and pepper into a tall mug. Blend to a creamy, uniform consistency.', 'order' => 2, 'recipe_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Cut the baguette into thin slices, spread each with sprat paste. Arrange the sprouts, pickled onion and smoked sprats on the paste.', 'order' => 3, 'recipe_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Egg and Sprats Canapes
            ['description' => 'Hard boil the eggs, cool, peel, and chop finely.', 'order' => 1, 'recipe_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Toast the bread slices lightly in butter until golden brown.', 'order' => 2, 'recipe_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Spread a thin layer of mayonnaise on the toasted bread, top with chopped eggs, then place a sprat on top of each. Garnish with dill, chives, and any other optional toppings like capers or red onion.', 'order' => 3, 'recipe_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Add salt and pepper to taste.', 'order' => 4, 'recipe_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Arrange on a platter and serve with lemon wedges if desired.', 'order' => 5, 'recipe_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Roasted Gilt Head Bream
            ['description' => 'Pour a cup of oil into a frying pan and place over medium heat. When hot, add the peeled and sliced potatoes. Fry them for a couple of minutes on each side.', 'order' => 1, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Remove them on kitchen paper to absorb the extra oil and keep them for later use.', 'order' => 2, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Add the julienned onion and fry in the same oil for 4-5 minutes. Remove from the pan and place on kitchen paper for later use.', 'order' => 3, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'For this recipe, I asked my fishmonger to prepare the gilthead bream for roasting whole, so He only cut off the fins, removed the gills, guts and scales, and finally washed it well with water.', 'order' => 4, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Take the gilthead bream and salt and pepper it on both sides. Then make two transversal cuts on the side that you will put upwards in the roast and introduce the half slices of lemon.', 'order' => 5, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Line a baking tray with baking paper. Place the potatoes on the base of the tray and then the onion, which will be the bed for the gilthead bream. Put salt and pepper on the potatoes and place the fish on the bed.', 'order' => 6, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Add the bay leaves, a little olive oil and a couple of slices of lemon.', 'order' => 7, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Put the gilthead bream in a preheated oven at 180 degrees for 25 minutes.', 'order' => 8, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'In the meantime, we are going to make the "Majado". You can do it with a pestle and mortar or a food processor, but in this case, I prefer to chop it with a knife.', 'order' => 9, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Mix the garlic and finely chopped parsley in a bowl, together with the vinegar and water. Add a little salt and mix well. This mixture will make a delicious sauce.', 'order' => 10, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Once the 25 minutes have elapsed, take the gilthead bream out of the oven. It is time to add the "Majado" to the fish and potatoes. You can save a little to put at the end if you are a fan of garlic like me.', 'order' => 11, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Put the gilthead bream back in the oven and cook for 5 more minutes at 190 degrees. Finally, take the fish out of the oven, and it is ready to eat.', 'order' => 12, 'recipe_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Baked Gilt Head Bream
            ['description' => 'Make the marinade by mixing the wine, olive oil, lemon juice, salt, pepper, bouillon cube, and dried herbs in a small bowl.', 'order' => 1, 'recipe_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Make three diagonal cuts on each fish, then place the fish on a baking tray and pour the marinade on top.', 'order' => 2, 'recipe_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Place a thin lemon slice in each diagonal cut on the fish.', 'order' => 2, 'recipe_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Bake the fish at 285°F (140°C) for 40-45 minutes, or until the fish is fully cooked. Add a little water to the pan if the fish drys out.', 'order' => 3, 'recipe_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Make the picadillo salad. Deseed the tomatoes and pepper, then dice the tomato, pepper, and onion. Toss with salt, pepper, vinegar, and olive oil to taste.', 'order' => 4, 'recipe_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Serve the baked bream with the picadillo salad and enjoy!', 'order' => 5, 'recipe_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // Horse Mackerel Meuniere with Japanese-style Sauce
            ['description' => 'Rinse off and dry the horse mackerel. Pre-season with salt and pepper. Thinly slice up the garlic. Cut up the bell peppers into thin slices. Break apart the maitake mushrooms.', 'order' => 1, 'recipe_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Place 1 Tbsp of olive oil into a fry pan and cook the garlic slices over low heat. Once brown and crunchy, remove the garlic chips.', 'order' => 2, 'recipe_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Without washing the fry pan from (2), lightly and evenly cover the horse mackerel from (1) with flour and cook in the fry pan until golden brown on both sides. Quickly wipe away any excess oil in the fry pan, pour in the cooking sake, and braise until cooked through.', 'order' => 3, 'recipe_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'In a separate fry pan heat 1 & 1/2 Tbsp of olive oil, saute the bell peppers and maitake mushrooms, season with salt and pepper and serve together with the horse mackerel from (3).', 'order' => 4, 'recipe_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Place additional together into a small pot and bring to a boil to prepare the sauce. Pour onto (4) and sprinkle on the garlic chips from (2).', 'order' => 5, 'recipe_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            
            // Deep-fried Horse Mackerel
            ['description' => 'Sprinkle salt and pepper over both sides of butterflied fish fillets.', 'order' => 1, 'recipe_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Working one fillet at a time, coat a fillet with flour, then pat to shake off excess flour. Place it in the egg and coat all over. Allow excess egg to drip, then transfer to the breadcrumbs.', 'order' => 1, 'recipe_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Cover the entire fish with breadcrumbs, and gently press down so that a good layer of breadcrumbs is stuck on both sides. Repeat for the rest of the fillets.', 'order' => 1, 'recipe_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Heat oil in a frying pan to 170°C / 338°F. The oil should be about 3cm / 1¼” deep.', 'order' => 1, 'recipe_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Gently place the crumbed fish skin side up. Do not crowd the oil with too many fish pieces (note 5). Cook for about 1-1½ minutes, then turn the fish over. Cook for further 1 minutes or so, until golden brown (note 6).', 'order' => 1, 'recipe_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Transfer the fried fish to a tray lined with kitchen paper to drain excess oil.', 'order' => 1, 'recipe_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Place two Aji Fry pieces with shredded lettuce on each serving plate. Serve immediately with the sauce of your choice.', 'order' => 1, 'recipe_id' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
