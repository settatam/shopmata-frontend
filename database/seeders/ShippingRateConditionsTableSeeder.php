<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingRateConditionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipping_rate_conditions')->delete();
        
        \DB::table('shipping_rate_conditions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tag' => 'Weight',
                'condition' => 'is greater than',
                'description' => NULL,
                'value' => '20',
                'user_id' => 66,
                'shipping_rate_id' => 1,
                'created_at' => '2021-02-02 06:00:01',
                'updated_at' => '2021-02-02 06:00:01',
            ),
        ));
        
        
    }
}