<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefaultPagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('default_pages')->delete();
        
        \DB::table('default_pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'home',
                'content' => '<p> This is the default home page </p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'article',
                'content' => '<p> This is the default article page </p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'blog',
                'content' => '<p> This is the default blog page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'cart',
                'content' => '<p> This is the default cart page </p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'collection',
                'content' => '<p> This is the default collection page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'customers.account',
                'content' => '<p> This is the default collection page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'customers.activate_account',
                'content' => '<p> This is the default collection page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'customer.addresses',
                'content' => '<p> This is the default collection page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'customer.login',
                'content' => '<p> This is the default collection page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'customer.register',
                'content' => '<p> This is the default collection page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'customer.reset_password',
                'content' => '<p> This is the default collection page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'gift_card',
                'content' => '<p> This is the default gittcard page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'page',
                'content' => '<p> This is the default pages page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'password',
                'content' => '<p> This is the default password page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'product',
                'content' => '<p>This is the default product page </p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'search',
                'content' => '<p> This is the default search page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => '2021-01-10 06:00:01',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => '404',
                'content' => '<p> This is the default 404 page</p>',
                'created_at' => '2021-01-10 06:00:01',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}