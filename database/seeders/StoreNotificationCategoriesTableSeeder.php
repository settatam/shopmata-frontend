<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreNotificationCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_notification_categories')->delete();
        
        \DB::table('store_notification_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Orders',
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Shipping',
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Local Delivery',
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Local Pickup',
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Customer',
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Email Marketing',
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Returns',
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            ),
        ));
        
        
    }
}