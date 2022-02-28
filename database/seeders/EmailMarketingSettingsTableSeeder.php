<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailMarketingSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('email_marketing_settings')->delete();
        
        \DB::table('email_marketing_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'double_opt_in' => 1,
                'open_tracking' => 'ask_for_consent',
                'store_id' => 2,
                'created_at' => '2022-01-14 00:31:01',
                'updated_at' => '2022-01-14 00:31:54',
            ),
        ));
        
        
    }
}