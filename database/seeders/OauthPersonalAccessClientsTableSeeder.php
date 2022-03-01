<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthPersonalAccessClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_personal_access_clients')->delete();
        
        \DB::table('oauth_personal_access_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'client_id' => 1,
                'created_at' => '2018-05-28 19:45:45',
                'updated_at' => '2018-05-28 19:45:45',
            ),
            1 => 
            array (
                'id' => 2,
                'client_id' => 4,
                'created_at' => '2018-06-02 23:08:36',
                'updated_at' => '2018-06-02 23:08:36',
            ),
            2 => 
            array (
                'id' => 3,
                'client_id' => 6,
                'created_at' => '2019-03-24 17:37:56',
                'updated_at' => '2019-03-24 17:37:56',
            ),
            3 => 
            array (
                'id' => 4,
                'client_id' => 8,
                'created_at' => '2019-05-11 06:19:52',
                'updated_at' => '2019-05-11 06:19:52',
            ),
            4 => 
            array (
                'id' => 5,
                'client_id' => 10,
                'created_at' => '2019-05-13 02:54:50',
                'updated_at' => '2019-05-13 02:54:50',
            ),
            5 => 
            array (
                'id' => 6,
                'client_id' => 12,
                'created_at' => '2019-05-13 02:54:59',
                'updated_at' => '2019-05-13 02:54:59',
            ),
        ));
        
        
    }
}