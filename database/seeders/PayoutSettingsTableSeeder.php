<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PayoutSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payout_settings')->delete();
        
        \DB::table('payout_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'store_id' => 2,
                'account_number' => '8888888',
                'routing_number' => '888888',
                'account_name' => '7777777',
                'bank_name' => 'yyyyyy',
                'payout_schedule' => '0',
                'created_at' => '2022-01-11 19:48:52',
                'updated_at' => '2022-01-17 19:18:31',
                'deleted_at' => '2022-01-17 19:18:31',
            ),
            1 => 
            array (
                'id' => 2,
                'store_id' => 2,
                'account_number' => '3333',
                'routing_number' => '3333',
                'account_name' => 'eee',
                'bank_name' => 'Ioi',
                'payout_schedule' => '0',
                'created_at' => '2022-01-18 00:22:45',
                'updated_at' => '2022-01-18 00:23:11',
                'deleted_at' => '2022-01-18 00:23:11',
            ),
        ));
        
        
    }
}