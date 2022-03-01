<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentGatewaysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payment_gateways')->delete();
        
        \DB::table('payment_gateways')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'paypal',
                'is_active' => 1,
                'logo' => 'https://fashionerize.nyc3.digitaloceanspaces.com/paypal-2.svg',
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'group_id' => 2,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'stripe',
                'is_active' => 1,
                'logo' => 'https://fashionerize.nyc3.digitaloceanspaces.com/stripe.svg',
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'group_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'authorize.net',
                'is_active' => 0,
                'logo' => NULL,
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'group_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'square',
                'is_active' => 0,
                'logo' => NULL,
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'group_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'paystack',
                'is_active' => 1,
                'logo' => 'https://fashionerize.nyc3.digitaloceanspaces.com/paystack-2.svg',
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'group_id' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'flutterwave',
                'is_active' => 0,
                'logo' => NULL,
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'group_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Cash on Delivery',
                'is_active' => 1,
                'logo' => NULL,
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'group_id' => 3,
            ),
        ));
        
        
    }
}