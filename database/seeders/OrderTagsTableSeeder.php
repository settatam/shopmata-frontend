<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_tags')->delete();
        
        \DB::table('order_tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_id' => 7,
                'title' => 'Nice',
                'user_id' => 66,
                'created_at' => '2020-02-02 06:00:01',
                'updated_at' => '2020-02-02 06:00:01',
            ),
            1 => 
            array (
                'id' => 2,
                'order_id' => 7,
                'title' => 'new One',
                'user_id' => 66,
                'created_at' => '2020-02-02 06:00:01',
                'updated_at' => '2020-02-02 06:00:01',
            ),
            2 => 
            array (
                'id' => 3,
                'order_id' => 8,
                'title' => 'Test Tag',
                'user_id' => 66,
                'created_at' => '2020-02-02 06:00:01',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}