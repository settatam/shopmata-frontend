<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreDomainsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_domains')->delete();
        
        \DB::table('store_domains')->insert(array (
            0 => 
            array (
                'id' => 1,
                'store_id' => 2,
                'is_shopmata' => 1,
                'user_id' => NULL,
                'name' => 'https://teheelar.shopmata.com',
                'domain_registrar' => 'shopmata',
                'region' => 'none',
                'languages' => 'en',
                'created_at' => '2021-06-01 05:00:01',
                'updated_at' => '2021-06-01 05:00:01',
                'is_secure' => 0,
                'record_is_updated' => 0,
                'is_active' => '1',
            ),
            1 => 
            array (
                'id' => 2,
                'store_id' => 3,
                'is_shopmata' => 1,
                'user_id' => NULL,
                'name' => 'test@shopmata.com',
                'domain_registrar' => 'shopmata',
                'region' => 'none',
                'languages' => 'en',
                'created_at' => '2021-06-01 05:00:01',
                'updated_at' => '2021-06-01 05:00:01',
                'is_secure' => 0,
                'record_is_updated' => 0,
                'is_active' => '0',
            ),
            2 => 
            array (
                'id' => 3,
                'store_id' => 2,
                'is_shopmata' => 0,
                'user_id' => NULL,
                'name' => 'teheelar.com',
                'domain_registrar' => 'godaddy',
                'region' => 'none',
                'languages' => 'en',
                'created_at' => '2021-06-01 05:00:01',
                'updated_at' => '2021-06-01 05:00:01',
                'is_secure' => 0,
                'record_is_updated' => 0,
                'is_active' => '1',
            ),
            3 => 
            array (
                'id' => 9,
                'store_id' => 2,
                'is_shopmata' => 0,
                'user_id' => NULL,
                'name' => 'fashionerize.com',
                'domain_registrar' => 'GoDaddy.com, LLC',
                'region' => 'none',
                'languages' => 'en',
                'created_at' => '2021-06-13 19:22:22',
                'updated_at' => '2021-06-13 19:22:22',
                'is_secure' => 0,
                'record_is_updated' => 0,
                'is_active' => '0',
            ),
            4 => 
            array (
                'id' => 10,
                'store_id' => 2,
                'is_shopmata' => 0,
                'user_id' => NULL,
                'name' => 'reportpolice.ng',
                'domain_registrar' => 'Web4Africa',
                'region' => 'none',
                'languages' => 'en',
                'created_at' => '2021-06-14 13:45:41',
                'updated_at' => '2021-06-14 13:45:41',
                'is_secure' => 0,
                'record_is_updated' => 0,
                'is_active' => '0',
            ),
            5 => 
            array (
                'id' => 11,
                'store_id' => 2,
                'is_shopmata' => 0,
                'user_id' => NULL,
                'name' => 'reportpolice.ng',
                'domain_registrar' => 'Web4Africa',
                'region' => 'none',
                'languages' => 'en',
                'created_at' => '2021-06-14 13:45:41',
                'updated_at' => '2021-06-14 13:45:41',
                'is_secure' => 0,
                'record_is_updated' => 0,
                'is_active' => '0',
            ),
            6 => 
            array (
                'id' => 12,
                'store_id' => 2,
                'is_shopmata' => 0,
                'user_id' => NULL,
                'name' => 'mata-studio.com',
                'domain_registrar' => 'GoDaddy.com, LLC',
                'region' => 'none',
                'languages' => 'en',
                'created_at' => '2021-06-14 14:13:43',
                'updated_at' => '2021-06-14 14:13:43',
                'is_secure' => 0,
                'record_is_updated' => 0,
                'is_active' => '0',
            ),
            7 => 
            array (
                'id' => 13,
                'store_id' => 2,
                'is_shopmata' => 0,
                'user_id' => NULL,
                'name' => 'mata-studio.com',
                'domain_registrar' => 'GoDaddy.com, LLC',
                'region' => 'none',
                'languages' => 'en',
                'created_at' => '2021-06-14 14:13:43',
                'updated_at' => '2021-06-14 14:13:43',
                'is_secure' => 0,
                'record_is_updated' => 0,
                'is_active' => '0',
            ),
        ));
        
        
    }
}