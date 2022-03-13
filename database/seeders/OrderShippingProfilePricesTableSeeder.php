<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderShippingProfilePricesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_shipping_profile_prices')->delete();
        
        \DB::table('order_shipping_profile_prices')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_shipping_profile_id' => 1,
                'min_weight' => 0.0,
                'max_weight' => 99999.0,
                'min_amount' => '0.00',
                'max_amount' => '99.00',
                'description' => NULL,
                'price' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'order_shipping_profile_id' => 1,
                'min_weight' => 0.0,
                'max_weight' => 99999.0,
                'min_amount' => '100.00',
                'max_amount' => '1000000.00',
                'description' => NULL,
                'price' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'order_shipping_profile_id' => 2,
                'min_weight' => 0.0,
                'max_weight' => 99999.0,
                'min_amount' => '0.00',
                'max_amount' => '1000000.00',
                'description' => NULL,
                'price' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'order_shipping_profile_id' => 3,
                'min_weight' => 0.0,
                'max_weight' => 99999.0,
                'min_amount' => '0.00',
                'max_amount' => '1000000.00',
                'description' => NULL,
                'price' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}