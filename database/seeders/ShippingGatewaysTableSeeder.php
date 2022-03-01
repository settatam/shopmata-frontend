<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingGatewaysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipping_gateways')->delete();
        
        \DB::table('shipping_gateways')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'SendBox',
                'description' => 'None',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'USPS',
                'description' => 'USPA',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'DHL',
                'description' => 'DHL',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Fedex',
                'description' => 'Fedex',
                'created_at' => '2020-01-01 06:00:01',
                'updated_at' => '2020-01-01 06:00:01',
            ),
        ));
        
        
    }
}