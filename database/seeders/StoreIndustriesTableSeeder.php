<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreIndustriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_industries')->delete();
        
        \DB::table('store_industries')->insert(array (
            0 => 
            array (
                'id' => 161,
                'name' => 'Beauty',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            1 => 
            array (
                'id' => 162,
                'name' => 'Clothing',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            2 => 
            array (
                'id' => 163,
                'name' => 'Electronics',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            3 => 
            array (
                'id' => 164,
                'name' => 'Furniture',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            4 => 
            array (
                'id' => 165,
                'name' => 'Handcrafts',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            5 => 
            array (
                'id' => 166,
                'name' => 'Jewelry',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            6 => 
            array (
                'id' => 167,
                'name' => 'Painting',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            7 => 
            array (
                'id' => 168,
                'name' => 'Photography',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            8 => 
            array (
                'id' => 169,
                'name' => 'Groceries',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            9 => 
            array (
                'id' => 170,
                'name' => 'Sports',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            10 => 
            array (
                'id' => 171,
                'name' => 'Toys',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            11 => 
            array (
                'id' => 172,
                'name' => 'Services',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            12 => 
            array (
                'id' => 173,
                'name' => 'Other',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}