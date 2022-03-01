<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NavigationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('navigations')->delete();
        
        \DB::table('navigations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'store_id' => 2,
                'name' => 'Test',
                'handle' => 'test',
                'created_at' => '2021-09-25 05:49:24',
                'updated_at' => '2021-09-25 05:49:24',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'store_id' => 2,
                'name' => 'Test',
                'handle' => 'test',
                'created_at' => '2021-09-25 05:50:41',
                'updated_at' => '2021-09-25 05:50:41',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'store_id' => 2,
                'name' => 'Test',
                'handle' => 'test',
                'created_at' => '2021-09-25 05:51:03',
                'updated_at' => '2021-09-25 05:51:03',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'store_id' => 2,
                'name' => 'Nixx Header',
                'handle' => 'nixx-header',
                'created_at' => '2021-09-30 00:15:05',
                'updated_at' => '2021-09-30 00:15:05',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'store_id' => 2,
                'name' => 'Footer LIst 1',
                'handle' => 'footer-list-1',
                'created_at' => '2021-09-30 00:17:07',
                'updated_at' => '2021-09-30 00:17:07',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'store_id' => 2,
                'name' => 'My new navaigaition menu',
                'handle' => 'asfasdf-sdfsdf',
                'created_at' => '2021-10-10 04:12:21',
                'updated_at' => '2021-10-10 04:12:21',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'store_id' => 2,
                'name' => 'My new test menu',
                'handle' => 'asdfasdfasfasdfas',
                'created_at' => '2021-10-10 04:32:51',
                'updated_at' => '2021-10-10 04:32:51',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'store_id' => 2,
                'name' => 'My new test menuddd',
                'handle' => 'asdfasdfasfasdfas',
                'created_at' => '2021-10-10 04:35:15',
                'updated_at' => '2021-10-10 04:35:15',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'store_id' => 2,
                'name' => 'asdfasdfa',
                'handle' => 'asdfasdfa',
                'created_at' => '2021-10-10 04:35:54',
                'updated_at' => '2021-10-10 04:35:54',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'store_id' => 2,
                'name' => 'gfhgfhgfgh',
                'handle' => 'lkjhkhkjhkjh',
                'created_at' => '2021-10-15 20:15:54',
                'updated_at' => '2021-10-15 20:15:54',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}