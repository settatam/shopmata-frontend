<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CollectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('collections')->delete();
        
        \DB::table('collections')->insert(array (
            0 => 
            array (
                'id' => 1,
                'store_id' => 2,
                'user_id' => 66,
                'title' => 'adfasdf',
                'handle' => 'https://shopmata.com/asdfasdf',
                'page_title' => 'asdfasf',
                'description' => 'asdfas',
                'created_at' => '2021-10-13 11:48:31',
                'updated_at' => '2021-10-13 11:48:31',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'store_id' => 2,
                'user_id' => 66,
                'title' => 'adfasdf',
                'handle' => 'https://shopmata.com/asdfasdf',
                'page_title' => 'asdfasf',
                'description' => 'asdfas',
                'created_at' => '2021-10-13 11:49:29',
                'updated_at' => '2021-10-13 11:49:29',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'store_id' => 2,
                'user_id' => 66,
                'title' => 'adfasdf',
                'handle' => 'https://shopmata.com/asdfasdf',
                'page_title' => 'asdfasf',
                'description' => 'asdfas',
                'created_at' => '2021-10-13 11:56:20',
                'updated_at' => '2021-10-13 11:56:20',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'store_id' => 2,
                'user_id' => 66,
                'title' => 'adfasdf',
                'handle' => 'https://shopmata.com/asdfasdf',
                'page_title' => 'asdfasf',
                'description' => 'asdfas',
                'created_at' => '2021-10-13 11:56:50',
                'updated_at' => '2021-10-13 11:56:50',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'store_id' => 2,
                'user_id' => 66,
                'title' => 'adfasdf',
                'handle' => 'https://shopmata.com/asdfasdf',
                'page_title' => 'asdfasf',
                'description' => 'asdfas',
                'created_at' => '2021-10-13 11:58:12',
                'updated_at' => '2021-10-13 11:58:12',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}