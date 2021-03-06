<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Handbags',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'handbags',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Shoes',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'shoes',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Accessories',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'accessories',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Jewelry',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'jewelry',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Apparel',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'apparel',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Boots',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'boots',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '2',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 64,
                'merchant_id' => 64,
                'level' => 0,
                'store_id' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Flats',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'flats',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '2',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 64,
                'merchant_id' => 64,
                'level' => 0,
                'store_id' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Slippers',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => NULL,
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '7',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 64,
                'merchant_id' => 64,
                'level' => 0,
                'store_id' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'One Lined',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => NULL,
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '8',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 64,
                'merchant_id' => 64,
                'level' => 0,
                'store_id' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Tote',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => NULL,
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '1',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 64,
                'merchant_id' => 64,
                'level' => 0,
                'store_id' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Living Room',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'living-room',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 2,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Bedroom',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'bedroom',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 2,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Kitchen',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'kitchen',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 2,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Dinning',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'dinning',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 2,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Nursery',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'nursery',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 2,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Bathroom',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'bathroom',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 2,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Wall Decor',
                'user_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'slug' => 'wall-decor',
                'language_id' => 1,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keyword' => NULL,
                'parent_id' => '0',
                'sort_order' => NULL,
                'column' => NULL,
                'mechant_id' => 0,
                'merchant_id' => 0,
                'level' => 0,
                'store_id' => 2,
            ),
        ));
        
        
    }
}