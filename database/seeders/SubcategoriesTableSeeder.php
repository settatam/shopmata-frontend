<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subcategories')->delete();
        
        \DB::table('subcategories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Clutch',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'clutch',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Wristlet',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'wristlet',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Waist Bag',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'waist-bag',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Tote',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'tote',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Shoulder Bag',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'shoulder-bag',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Satchel',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'satchel',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Pochette',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'pochette',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Hobo',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'hobo',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Evening',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'evening',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Crossbody Bag',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'crossbody-bag',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Cosmetic Bag',
                'category_id' => 1,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'cosmetic-bag',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Boots',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'boots',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Comfort',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'comfort',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Heels & Pumps',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'heels-pump',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Mules & Slides',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'mules-slides',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Sandals',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'sandals',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Slippers',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'slippers',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Sneakers',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'sneakers',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Slippers',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'slippers',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Sneakers',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'sneakers',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Wedges',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'wedges',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Kitten',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'kitten',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Heels',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'heels',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Flip-Flops',
                'category_id' => 2,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'flip-flops',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Bandana',
                'category_id' => 3,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'bandana',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Handkerchief',
                'category_id' => 3,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'handkerchiefs',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Scarves',
                'category_id' => 3,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'scarves',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Ties',
                'category_id' => 3,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'ties',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Travel and Luggage',
                'category_id' => 3,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'travel-luggage',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Belts',
                'category_id' => 3,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'belts',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Wallets',
                'category_id' => 3,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'wallets',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Sunglasses',
                'category_id' => 3,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'sunglasses',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Hats',
                'category_id' => 3,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'hats',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Necklaces',
                'category_id' => 4,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'necklaces',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Watches',
                'category_id' => 4,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'watches',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Rings',
                'category_id' => 4,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'rings',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Pins & Brooches',
                'category_id' => 4,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'pins-brooches',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Earrings',
                'category_id' => 4,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'earrings',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Bracelets',
                'category_id' => 4,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'bracelets',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Pants',
                'category_id' => 5,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'pants',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Swimwear',
                'category_id' => 5,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'swimwear',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Suits',
                'category_id' => 5,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'suits',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Dresses',
                'category_id' => 5,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'dresses',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Tops',
                'category_id' => 5,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'tops',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Sweaters',
                'category_id' => 5,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'sweater',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Outerwear',
                'category_id' => 5,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => 'outerwear',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Skirts',
                'category_id' => 5,
                'generic' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'slug' => NULL,
            ),
        ));
        
        
    }
}