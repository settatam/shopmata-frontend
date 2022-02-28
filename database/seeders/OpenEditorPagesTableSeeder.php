<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OpenEditorPagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('open_editor_pages')->delete();
        
        \DB::table('open_editor_pages')->insert(array (
            0 => 
            array (
                'id' => 23,
                'theme_file_id' => 2,
                'user_id' => 66,
                'store_id' => 2,
                'created_at' => '2021-07-31 19:40:24',
                'updated_at' => '2021-09-24 03:07:29',
                'deleted_at' => NULL,
                'is_open' => 0,
            ),
            1 => 
            array (
                'id' => 29,
                'theme_file_id' => 16,
                'user_id' => 66,
                'store_id' => 2,
                'created_at' => '2021-07-31 20:20:28',
                'updated_at' => '2021-09-24 03:07:29',
                'deleted_at' => NULL,
                'is_open' => 0,
            ),
            2 => 
            array (
                'id' => 35,
                'theme_file_id' => 2,
                'user_id' => 66,
                'store_id' => 2,
                'created_at' => '2021-08-03 00:19:48',
                'updated_at' => '2021-09-24 03:07:29',
                'deleted_at' => NULL,
                'is_open' => 0,
            ),
            3 => 
            array (
                'id' => 36,
                'theme_file_id' => 3,
                'user_id' => 66,
                'store_id' => 2,
                'created_at' => '2021-09-24 02:55:26',
                'updated_at' => '2021-09-24 03:07:29',
                'deleted_at' => NULL,
                'is_open' => 0,
            ),
            4 => 
            array (
                'id' => 42,
                'theme_file_id' => 2,
                'user_id' => 66,
                'store_id' => 2,
                'created_at' => '2021-09-24 02:56:02',
                'updated_at' => '2021-09-24 03:07:29',
                'deleted_at' => NULL,
                'is_open' => 0,
            ),
            5 => 
            array (
                'id' => 43,
                'theme_file_id' => 3,
                'user_id' => 66,
                'store_id' => 2,
                'created_at' => '2021-09-24 03:00:44',
                'updated_at' => '2021-09-24 03:07:29',
                'deleted_at' => NULL,
                'is_open' => 0,
            ),
            6 => 
            array (
                'id' => 45,
                'theme_file_id' => 2,
                'user_id' => 66,
                'store_id' => 2,
                'created_at' => '2021-09-24 03:07:29',
                'updated_at' => '2021-09-24 03:07:29',
                'deleted_at' => NULL,
                'is_open' => 1,
            ),
        ));
        
        
    }
}