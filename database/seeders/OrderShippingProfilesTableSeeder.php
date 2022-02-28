<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderShippingProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_shipping_profiles')->delete();
        
        \DB::table('order_shipping_profiles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Up to 5 - 7 Business Days',
                'profile' => 'Standard Shipping',
                'store_id' => 2,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '2 - 3 Business Days',
                'profile' => 'Expedited Shipping',
                'store_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '1 Business Day',
                'profile' => 'Express Shipping',
                'store_id' => 2,
            ),
        ));
        
        
    }
}