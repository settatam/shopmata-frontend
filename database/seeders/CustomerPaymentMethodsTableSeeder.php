<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerPaymentMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customer_payment_methods')->delete();
        
        \DB::table('customer_payment_methods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 43,
                'order_id' => 1,
                'payment_method_id' => 2,
                'created_at' => '2020-10-29 08:22:27',
                'updated_at' => '2020-10-29 08:22:27',
                'is_default' => NULL,
                'status' => NULL,
                'is_deactivated' => NULL,
                'paypal_email' => NULL,
                'credit_card_last_4' => '4242',
                'stripe_payment_method' => NULL,
                'credit_card_expiry' => '4/2024',
                'card_type' => 'visa',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 43,
                'order_id' => 2,
                'payment_method_id' => 2,
                'created_at' => '2020-10-29 17:52:25',
                'updated_at' => '2020-10-29 17:52:25',
                'is_default' => NULL,
                'status' => NULL,
                'is_deactivated' => NULL,
                'paypal_email' => NULL,
                'credit_card_last_4' => '4242',
                'stripe_payment_method' => NULL,
                'credit_card_expiry' => '4/2024',
                'card_type' => 'visa',
            ),
            2 => 
            array (
                'id' => 5,
                'user_id' => 44,
                'order_id' => 5,
                'payment_method_id' => 2,
                'created_at' => '2020-10-30 00:24:52',
                'updated_at' => '2020-10-30 00:24:52',
                'is_default' => NULL,
                'status' => NULL,
                'is_deactivated' => NULL,
                'paypal_email' => NULL,
                'credit_card_last_4' => '4242',
                'stripe_payment_method' => NULL,
                'credit_card_expiry' => '4/2024',
                'card_type' => 'visa',
            ),
            3 => 
            array (
                'id' => 6,
                'user_id' => 39,
                'order_id' => 6,
                'payment_method_id' => 2,
                'created_at' => '2020-10-30 17:53:21',
                'updated_at' => '2020-10-30 17:53:21',
                'is_default' => NULL,
                'status' => NULL,
                'is_deactivated' => NULL,
                'paypal_email' => NULL,
                'credit_card_last_4' => '4242',
                'stripe_payment_method' => NULL,
                'credit_card_expiry' => '4/2024',
                'card_type' => 'visa',
            ),
            4 => 
            array (
                'id' => 7,
                'user_id' => 66,
                'order_id' => 7,
                'payment_method_id' => 2,
                'created_at' => '2020-10-31 22:00:35',
                'updated_at' => '2020-10-31 22:00:35',
                'is_default' => NULL,
                'status' => NULL,
                'is_deactivated' => NULL,
                'paypal_email' => NULL,
                'credit_card_last_4' => '4242',
                'stripe_payment_method' => NULL,
                'credit_card_expiry' => '4/2024',
                'card_type' => 'visa',
            ),
            5 => 
            array (
                'id' => 8,
                'user_id' => 39,
                'order_id' => 8,
                'payment_method_id' => 2,
                'created_at' => '2020-11-03 01:58:21',
                'updated_at' => '2020-11-03 01:58:21',
                'is_default' => NULL,
                'status' => NULL,
                'is_deactivated' => NULL,
                'paypal_email' => NULL,
                'credit_card_last_4' => '4242',
                'stripe_payment_method' => NULL,
                'credit_card_expiry' => '4/2024',
                'card_type' => 'visa',
            ),
            6 => 
            array (
                'id' => 9,
                'user_id' => 66,
                'order_id' => 9,
                'payment_method_id' => 1,
                'created_at' => '2020-11-29 00:47:07',
                'updated_at' => '2020-11-29 00:47:07',
                'is_default' => NULL,
                'status' => NULL,
                'is_deactivated' => NULL,
                'paypal_email' => 'info@mata-studio.com',
                'credit_card_last_4' => NULL,
                'stripe_payment_method' => NULL,
                'credit_card_expiry' => NULL,
                'card_type' => NULL,
            ),
            7 => 
            array (
                'id' => 10,
                'user_id' => 66,
                'order_id' => 10,
                'payment_method_id' => 1,
                'created_at' => '2020-11-29 10:23:08',
                'updated_at' => '2020-11-29 10:23:08',
                'is_default' => NULL,
                'status' => NULL,
                'is_deactivated' => NULL,
                'paypal_email' => 'info@mata-studio.com',
                'credit_card_last_4' => NULL,
                'stripe_payment_method' => NULL,
                'credit_card_expiry' => NULL,
                'card_type' => NULL,
            ),
            8 => 
            array (
                'id' => 11,
                'user_id' => 66,
                'order_id' => 11,
                'payment_method_id' => 1,
                'created_at' => '2020-11-30 20:00:22',
                'updated_at' => '2020-11-30 20:00:22',
                'is_default' => NULL,
                'status' => NULL,
                'is_deactivated' => NULL,
                'paypal_email' => 'info@mata-studio.com',
                'credit_card_last_4' => NULL,
                'stripe_payment_method' => NULL,
                'credit_card_expiry' => NULL,
                'card_type' => NULL,
            ),
        ));
        
        
    }
}