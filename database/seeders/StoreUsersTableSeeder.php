<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_users')->delete();
        
        \DB::table('store_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 66,
                'store_id' => 2,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2020-10-31 05:00:01',
                'updated_at' => '2020-10-31 05:00:01',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 74,
                'store_id' => 2,
                'store_group_id' => 4,
                'status' => 'invite sent',
                'created_at' => '2020-11-28 13:32:36',
                'updated_at' => '2020-11-28 13:32:36',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 75,
                'store_id' => 2,
                'store_group_id' => 4,
                'status' => 'invite sent',
                'created_at' => '2020-11-28 13:35:03',
                'updated_at' => '2020-11-28 13:35:03',
            ),
            3 => 
            array (
                'id' => 5,
                'user_id' => 83,
                'store_id' => 22,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-05-27 12:39:54',
                'updated_at' => '2021-05-27 12:39:54',
            ),
            4 => 
            array (
                'id' => 6,
                'user_id' => 84,
                'store_id' => 23,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-05-28 11:50:36',
                'updated_at' => '2021-05-28 11:50:36',
            ),
            5 => 
            array (
                'id' => 7,
                'user_id' => 85,
                'store_id' => 24,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-06-11 19:35:27',
                'updated_at' => '2021-06-11 19:35:27',
            ),
            6 => 
            array (
                'id' => 8,
                'user_id' => 70,
                'store_id' => 2,
                'store_group_id' => 2,
                'status' => 'invite sent',
                'created_at' => '2021-06-26 17:43:40',
                'updated_at' => '2021-06-26 17:43:40',
            ),
            7 => 
            array (
                'id' => 9,
                'user_id' => 87,
                'store_id' => 25,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-09-22 02:49:15',
                'updated_at' => '2021-09-22 02:49:15',
            ),
            8 => 
            array (
                'id' => 10,
                'user_id' => 88,
                'store_id' => 26,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-09-22 02:50:47',
                'updated_at' => '2021-09-22 02:50:47',
            ),
            9 => 
            array (
                'id' => 11,
                'user_id' => 89,
                'store_id' => 27,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-09-22 05:03:42',
                'updated_at' => '2021-09-22 05:03:42',
            ),
            10 => 
            array (
                'id' => 12,
                'user_id' => 90,
                'store_id' => 28,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-09-22 05:03:59',
                'updated_at' => '2021-09-22 05:03:59',
            ),
            11 => 
            array (
                'id' => 13,
                'user_id' => 91,
                'store_id' => 29,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-09-22 05:04:49',
                'updated_at' => '2021-09-22 05:04:49',
            ),
            12 => 
            array (
                'id' => 14,
                'user_id' => 92,
                'store_id' => 30,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-09-22 22:41:33',
                'updated_at' => '2021-09-22 22:41:33',
            ),
            13 => 
            array (
                'id' => 15,
                'user_id' => 93,
                'store_id' => 31,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-09-23 22:37:46',
                'updated_at' => '2021-09-23 22:37:46',
            ),
            14 => 
            array (
                'id' => 16,
                'user_id' => 94,
                'store_id' => 32,
                'store_group_id' => 1,
                'status' => 'invite sent',
                'created_at' => '2021-09-24 05:07:20',
                'updated_at' => '2021-09-24 05:07:20',
            ),
        ));
        
        
    }
}