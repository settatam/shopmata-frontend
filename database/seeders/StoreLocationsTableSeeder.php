<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreLocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_locations')->delete();
        
        \DB::table('store_locations')->insert(array (
            0 => 
            array (
                'id' => 4,
                'store_id' => 2,
                'address' => '1112 Palm Avenue',
                'address2' => NULL,
                'county_id' => NULL,
                'state_id' => 62,
                'country_id' => 158,
                'postal_code' => '112233',
                'created_at' => '2021-10-14 05:45:46',
                'updated_at' => '2021-10-14 05:45:46',
                'city' => 'Calabar',
                'state' => NULL,
                'user_id' => 0,
                'name' => NULL,
            ),
        ));
        
        
    }
}