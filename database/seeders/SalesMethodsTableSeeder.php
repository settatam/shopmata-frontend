<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalesMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sales_methods')->delete();
        
        \DB::table('sales_methods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'I am not selling yet',
                'created_at' => '2021-09-14 04:17:34',
                'updated_at' => '2021-09-14 04:17:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'I sell on another website',
                'created_at' => '2021-09-14 04:17:34',
                'updated_at' => '2021-09-14 04:17:34',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'I have an existing website',
                'created_at' => '2021-09-14 04:17:34',
                'updated_at' => '2021-09-14 04:17:34',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'I sell through social media',
                'created_at' => '2021-09-14 04:17:34',
                'updated_at' => '2021-09-14 04:17:34',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'I sell through online marketplaces',
                'created_at' => '2021-09-14 04:17:35',
                'updated_at' => '2021-09-14 04:17:35',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'I sell in person',
                'created_at' => '2021-09-14 04:17:35',
                'updated_at' => '2021-09-14 04:17:35',
            ),
        ));
        
        
    }
}