<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreActualNotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_actual_notifications')->delete();
        
        \DB::table('store_actual_notifications')->insert(array (
            0 => 
            array (
                'id' => 3,
                'store_notification_id' => 23,
                'store_id' => 2,
                'subject' => 'Order confirmation',
                'message' => 'Hello {{ Customer name }}
Thank you for the purchase of {{ Order number }}. This is to let you know that your order is confirmed and
will go into processing.',
                'user_id' => 66,
                'created_at' => '2022-01-06 22:00:33',
                'updated_at' => '2022-01-14 21:21:39',
            ),
            1 => 
            array (
                'id' => 4,
                'store_notification_id' => 45,
                'store_id' => 2,
                'subject' => 'Customer account invite',
                'message' => 'This is the default message and should be edited forCustomer account invite',
                'user_id' => 66,
                'created_at' => '2022-01-07 23:46:24',
                'updated_at' => '2022-01-07 23:46:24',
            ),
            2 => 
            array (
                'id' => 5,
                'store_notification_id' => 46,
                'store_id' => 2,
                'subject' => 'Customer account welcome',
                'message' => 'This is the default message and should be edited forCustomer account welcomennn',
                'user_id' => 66,
                'created_at' => '2022-01-07 23:46:41',
                'updated_at' => '2022-01-17 19:17:32',
            ),
            3 => 
            array (
                'id' => 6,
                'store_notification_id' => 24,
                'store_id' => 2,
                'subject' => 'Order edited',
                'message' => 'This is the default message and should be edited forOrder editedwdwd',
                'user_id' => 66,
                'created_at' => '2022-01-17 19:17:50',
                'updated_at' => '2022-01-17 19:17:50',
            ),
        ));
        
        
    }
}