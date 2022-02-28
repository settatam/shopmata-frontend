<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipping_addresses')->delete();
        
        \DB::table('shipping_addresses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nickname' => NULL,
                'address' => '14112  Castle Blvd',
                'address2' => NULL,
                'city' => 'Silver Spring',
                'state' => NULL,
                'country' => NULL,
            'phone' => '(267) 980-9781',
                'created_at' => '2020-10-25 08:52:03',
                'updated_at' => '2020-10-25 08:52:03',
                'deleted_at' => NULL,
                'zip' => '20904',
                'user_id' => 42,
                'first_name' => 'Seth',
                'last_name' => 'Atam',
                'is_default' => 0,
                'country_id' => 1,
                'state_id' => 22,
                'county_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nickname' => NULL,
                'address' => '14160  Baltimore Ave',
                'address2' => NULL,
                'city' => 'Laurel',
                'state' => NULL,
                'country' => NULL,
            'phone' => '(267) 980-9681',
                'created_at' => '2020-10-27 15:36:13',
                'updated_at' => '2020-10-27 15:36:13',
                'deleted_at' => NULL,
                'zip' => '20707',
                'user_id' => 43,
                'first_name' => 'Seth',
                'last_name' => 'Atam',
                'is_default' => 0,
                'country_id' => 1,
                'state_id' => 22,
                'county_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nickname' => NULL,
                'address' => '14160  Baltimore Ave',
                'address2' => NULL,
                'city' => 'Laurel',
                'state' => NULL,
                'country' => NULL,
            'phone' => '(267) 980-9681',
                'created_at' => '2020-10-29 23:54:20',
                'updated_at' => '2020-10-29 23:54:20',
                'deleted_at' => NULL,
                'zip' => '20707',
                'user_id' => 44,
                'first_name' => 'Seth',
                'last_name' => 'Atam',
                'is_default' => 0,
                'country_id' => 1,
                'state_id' => 22,
                'county_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nickname' => NULL,
                'address' => '14147  Castle Blvd',
                'address2' => NULL,
                'city' => 'Silver Spring',
                'state' => NULL,
                'country' => NULL,
            'phone' => '(267) 980-9681',
                'created_at' => '2020-10-30 08:34:29',
                'updated_at' => '2020-10-30 08:34:29',
                'deleted_at' => NULL,
                'zip' => '20904',
                'user_id' => 45,
                'first_name' => 'Seth',
                'last_name' => 'Atam',
                'is_default' => 0,
                'country_id' => 1,
                'state_id' => 22,
                'county_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nickname' => NULL,
                'address' => '14160  Baltimore Ave',
                'address2' => NULL,
                'city' => 'Laurel',
                'state' => NULL,
                'country' => NULL,
            'phone' => '(267) 980-9681',
                'created_at' => '2020-10-30 17:53:00',
                'updated_at' => '2020-10-30 17:53:00',
                'deleted_at' => NULL,
                'zip' => '20707',
                'user_id' => 39,
                'first_name' => 'Seth',
                'last_name' => 'Atam',
                'is_default' => 0,
                'country_id' => 1,
                'state_id' => 22,
                'county_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nickname' => NULL,
                'address' => '1415  N Taft St',
                'address2' => NULL,
                'city' => 'Arlington',
                'state' => NULL,
                'country' => NULL,
            'phone' => '(267) 980-9681',
                'created_at' => '2020-10-31 22:00:07',
                'updated_at' => '2020-10-31 22:00:07',
                'deleted_at' => NULL,
                'zip' => '22201',
                'user_id' => 66,
                'first_name' => 'Seth',
                'last_name' => 'Atam',
                'is_default' => 0,
                'country_id' => 1,
                'state_id' => 49,
                'county_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nickname' => NULL,
                'address' => '1410  N Scott St',
                'address2' => NULL,
                'city' => 'Arlington',
                'state' => NULL,
                'country' => NULL,
            'phone' => '(267) 980-9681',
                'created_at' => '2020-10-31 22:32:24',
                'updated_at' => '2020-10-31 22:32:24',
                'deleted_at' => NULL,
                'zip' => '22209',
                'user_id' => 38,
                'first_name' => 'Seth',
                'last_name' => 'Atam',
                'is_default' => 0,
                'country_id' => 1,
                'state_id' => 49,
                'county_id' => NULL,
            ),
        ));
        
        
    }
}