<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthAccessTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_access_tokens')->delete();
        
        \DB::table('oauth_access_tokens')->insert(array (
            0 => 
            array (
                'id' => '483e21718abf87b9ddaaf1a0ec7544ad10d582a0126ab70f49e27401bf077633a2d8f4acee7e75a9',
                'user_id' => 2,
                'client_id' => 12,
                'name' => 'Shopmata',
                'scopes' => '[]',
                'revoked' => 0,
                'created_at' => '2019-05-23 05:18:40',
                'updated_at' => '2019-05-23 05:18:40',
                'expires_at' => '2020-05-23 00:18:40',
            ),
            1 => 
            array (
                'id' => '4b3c23d932e46167cbd621032ce418004574a5d3c8d7f80376f02193ec2edfed9400ea924af90c46',
                'user_id' => 2,
                'client_id' => 8,
                'name' => 'Fahionerize Password Grant Client',
                'scopes' => '[]',
                'revoked' => 0,
                'created_at' => '2019-05-12 10:26:29',
                'updated_at' => '2019-05-12 10:26:29',
                'expires_at' => '2020-05-12 05:26:29',
            ),
            2 => 
            array (
                'id' => '661d1c4403225fa553ce27d1ea80813f39a97c7d251b8c5c645d11bc4f04f801ffd5a79052e34e1c',
                'user_id' => 1,
                'client_id' => 8,
                'name' => 'Fahionerize Password Grant Client',
                'scopes' => '[]',
                'revoked' => 0,
                'created_at' => '2019-05-12 10:25:49',
                'updated_at' => '2019-05-12 10:25:49',
                'expires_at' => '2020-05-12 05:25:49',
            ),
            3 => 
            array (
                'id' => 'a8d78c62a2c526e46a0de029d5d2c7afdf01931ab2af8581c344ad07e2f863f325fc470728776c8a',
                'user_id' => 1,
                'client_id' => 8,
                'name' => 'Fahionerize Password Grant Client',
                'scopes' => '[]',
                'revoked' => 0,
                'created_at' => '2019-05-12 10:26:41',
                'updated_at' => '2019-05-12 10:26:41',
                'expires_at' => '2020-05-12 05:26:41',
            ),
            4 => 
            array (
                'id' => 'eaee5df0a0f032afcb99feeff0dc705a04e312be834312acbe3ed2c183a8cea158b7e1f8508e14eb',
                'user_id' => 2,
                'client_id' => 8,
                'name' => 'Fahionerize Password Grant Client',
                'scopes' => '[]',
                'revoked' => 0,
                'created_at' => '2019-05-12 10:26:57',
                'updated_at' => '2019-05-12 10:26:57',
                'expires_at' => '2020-05-12 05:26:57',
            ),
        ));
        
        
    }
}