<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreActivitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_activities')->delete();
        
        \DB::table('store_activities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 66,
                'customer_id' => NULL,
                'activity' => 'created a new collection',
                'model' => NULL,
                'activity_id' => NULL,
                'created_at' => '2021-10-13 11:56:20',
                'updated_at' => '2021-10-13 11:56:20',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 66,
                'customer_id' => NULL,
                'activity' => 'created a new collection',
                'model' => NULL,
                'activity_id' => NULL,
                'created_at' => '2021-10-13 11:56:50',
                'updated_at' => '2021-10-13 11:56:50',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 66,
                'customer_id' => NULL,
                'activity' => 'created a new collection',
                'model' => NULL,
                'activity_id' => NULL,
                'created_at' => '2021-10-13 11:58:12',
                'updated_at' => '2021-10-13 11:58:12',
            ),
        ));
        
        
    }
}