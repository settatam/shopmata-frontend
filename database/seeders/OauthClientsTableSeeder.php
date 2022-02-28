<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_clients')->delete();
        
        \DB::table('oauth_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'KXEK8o52Efcw3tsGI1cy7qIQtt2wRnTPeMm8oeAH',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2018-05-28 19:45:45',
                'updated_at' => '2018-05-28 19:45:45',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'hHVUVTraExNDtYthPGi55igUvex2ySVE3yIGBh27',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2018-05-28 19:45:45',
                'updated_at' => '2018-05-28 19:45:45',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'name' => 'Seth Atam',
                'secret' => '5Ms1wtjF0AKkB6bkGVzra5GYXNjAvfxuuNIwSoCr',
                'redirect' => 'http://localhost/auth/callback',
                'personal_access_client' => 0,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2018-05-28 19:52:52',
                'updated_at' => '2018-05-28 19:52:52',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => NULL,
                'name' => 'Fashionerize',
                'secret' => 'ITcYkEydKGRpIKC14GrNQL7zaKU1oFWuJ0sF8FbV',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2018-06-02 23:08:36',
                'updated_at' => '2018-06-02 23:08:36',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => NULL,
                'name' => 'Fashionerize',
                'secret' => 'dDd7C8Q3pouCkrfPhG9c7Vf8qblXpLpcW1hOxCub',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2018-06-02 23:11:38',
                'updated_at' => '2018-06-02 23:11:38',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'uhLGCKJ90d3N8CuGFLNLrslC2YkTdHvOoE48Tpl5',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2019-03-24 17:37:56',
                'updated_at' => '2019-03-24 17:37:56',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'E8oqhKCD8rxLQ8bRsYpRVVuTGb1F4bwlWU40Rl1K',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2019-03-24 17:37:56',
                'updated_at' => '2019-03-24 17:37:56',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'W6x0L3nSkkZOnZeq2WpuLSC6nw5UO5gBWvfBzkXF',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2019-05-11 06:19:52',
                'updated_at' => '2019-05-11 06:19:52',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => '6s55jtrlkc7OJjX81LLkcbgcI8EWfZJ63YrGaT4H',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2019-05-11 06:19:52',
                'updated_at' => '2019-05-11 06:19:52',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'ZUlZvSt4DiftXiz8sQal5gJPWf81q2ihtNBNtnjt',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2019-05-13 02:54:50',
                'updated_at' => '2019-05-13 02:54:50',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'gNUyrgKIkocitKe7Bf34T2Bze10WTGHISHCDAHIe',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2019-05-13 02:54:50',
                'updated_at' => '2019-05-13 02:54:50',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'f479wp8Nf6z2v785Hk9EdemeY29Spk8PKzYcQFeJ',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2019-05-13 02:54:59',
                'updated_at' => '2019-05-13 02:54:59',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'YhXnO9RrPRHZSTiQ3RrMa6uHr6GRmx5mSEFiEhZI',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2019-05-13 02:54:59',
                'updated_at' => '2019-05-13 02:54:59',
            ),
        ));
        
        
    }
}