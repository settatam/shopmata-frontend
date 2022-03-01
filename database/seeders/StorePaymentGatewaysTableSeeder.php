<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StorePaymentGatewaysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_payment_gateways')->delete();
        
        \DB::table('store_payment_gateways')->insert(array (
            0 => 
            array (
                'id' => 1,
                'store_id' => 22,
                'payment_gateway_id' => 1,
                'key' => 'adkasdknanldkasnlks',
                'secret' => 'dlkasndlnaknlanldnks',
                'is_active' => 1,
                'sort_order' => NULL,
                'description' => NULL,
                'created_by' => 83,
                'created_at' => '2021-06-18 16:14:06',
                'updated_at' => '2021-06-18 16:14:06',
                'deleted_at' => NULL,
                'is_test' => 0,
                'default_gateway' => '0',
            ),
            1 => 
            array (
                'id' => 2,
                'store_id' => 2,
                'payment_gateway_id' => 2,
                'key' => 'Test Stripe',
                'secret' => 'Test Password',
                'is_active' => 1,
                'sort_order' => NULL,
                'description' => NULL,
                'created_by' => 66,
                'created_at' => '2021-06-26 16:34:00',
                'updated_at' => '2021-06-26 16:34:00',
                'deleted_at' => NULL,
                'is_test' => 0,
                'default_gateway' => '0',
            ),
            2 => 
            array (
                'id' => 4,
                'store_id' => 2,
                'payment_gateway_id' => 4,
                'key' => 'dafsdfsa',
                'secret' => 'asdfasdfasdf',
                'is_active' => 1,
                'sort_order' => NULL,
                'description' => NULL,
                'created_by' => 66,
                'created_at' => '2021-06-26 17:21:03',
                'updated_at' => '2021-06-26 17:21:03',
                'deleted_at' => NULL,
                'is_test' => 0,
                'default_gateway' => '0',
            ),
        ));
        
        
    }
}