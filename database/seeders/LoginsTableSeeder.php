<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LoginsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('logins')->delete();
        
        \DB::table('logins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-01 16:56:49',
                'updated_at' => '2021-05-01 16:56:49',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-02 01:23:20',
                'updated_at' => '2021-05-02 01:23:20',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-03 14:56:36',
                'updated_at' => '2021-05-03 14:56:36',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 77,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-04 17:17:06',
                'updated_at' => '2021-05-04 17:17:06',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 77,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-07 20:52:52',
                'updated_at' => '2021-05-07 20:52:52',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-07 21:13:15',
                'updated_at' => '2021-05-07 21:13:15',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 77,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-10 13:31:45',
                'updated_at' => '2021-05-10 13:31:45',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-10 14:20:40',
                'updated_at' => '2021-05-10 14:20:40',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-10 18:55:49',
                'updated_at' => '2021-05-10 18:55:49',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 78,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-11 11:05:55',
                'updated_at' => '2021-05-11 11:05:55',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-11 14:30:51',
                'updated_at' => '2021-05-11 14:30:51',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-11 23:11:24',
                'updated_at' => '2021-05-11 23:11:24',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 77,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-12 12:02:03',
                'updated_at' => '2021-05-12 12:02:03',
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 78,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-12 16:47:41',
                'updated_at' => '2021-05-12 16:47:41',
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-12 18:39:29',
                'updated_at' => '2021-05-12 18:39:29',
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-13 16:07:27',
                'updated_at' => '2021-05-13 16:07:27',
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 77,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-14 00:16:44',
                'updated_at' => '2021-05-14 00:16:44',
            ),
            17 => 
            array (
                'id' => 18,
                'user_id' => 77,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-14 12:37:55',
                'updated_at' => '2021-05-14 12:37:55',
            ),
            18 => 
            array (
                'id' => 19,
                'user_id' => 77,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-14 15:36:56',
                'updated_at' => '2021-05-14 15:36:56',
            ),
            19 => 
            array (
                'id' => 20,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-15 17:39:14',
                'updated_at' => '2021-05-15 17:39:14',
            ),
            20 => 
            array (
                'id' => 21,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-15 18:55:02',
                'updated_at' => '2021-05-15 18:55:02',
            ),
            21 => 
            array (
                'id' => 22,
                'user_id' => 77,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-17 13:12:07',
                'updated_at' => '2021-05-17 13:12:07',
            ),
            22 => 
            array (
                'id' => 23,
                'user_id' => 77,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-17 13:12:07',
                'updated_at' => '2021-05-17 13:12:07',
            ),
            23 => 
            array (
                'id' => 24,
                'user_id' => 78,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-17 14:09:35',
                'updated_at' => '2021-05-17 14:09:35',
            ),
            24 => 
            array (
                'id' => 25,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-17 14:11:14',
                'updated_at' => '2021-05-17 14:11:14',
            ),
            25 => 
            array (
                'id' => 26,
                'user_id' => 81,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-17 14:17:50',
                'updated_at' => '2021-05-17 14:17:50',
            ),
            26 => 
            array (
                'id' => 27,
                'user_id' => 81,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-17 18:23:28',
                'updated_at' => '2021-05-17 18:23:28',
            ),
            27 => 
            array (
                'id' => 28,
                'user_id' => 81,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-18 04:32:59',
                'updated_at' => '2021-05-18 04:32:59',
            ),
            28 => 
            array (
                'id' => 29,
                'user_id' => 81,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-18 07:01:58',
                'updated_at' => '2021-05-18 07:01:58',
            ),
            29 => 
            array (
                'id' => 30,
                'user_id' => 78,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-18 10:41:15',
                'updated_at' => '2021-05-18 10:41:15',
            ),
            30 => 
            array (
                'id' => 31,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-18 21:18:22',
                'updated_at' => '2021-05-18 21:18:22',
            ),
            31 => 
            array (
                'id' => 32,
                'user_id' => 78,
                'store_id' => 18,
                'ip_address' => NULL,
                'created_at' => '2021-05-20 10:43:18',
                'updated_at' => '2021-05-20 10:43:18',
            ),
            32 => 
            array (
                'id' => 33,
                'user_id' => 81,
                'store_id' => 21,
                'ip_address' => NULL,
                'created_at' => '2021-05-20 13:23:45',
                'updated_at' => '2021-05-20 13:23:45',
            ),
            33 => 
            array (
                'id' => 34,
                'user_id' => 77,
                'store_id' => 17,
                'ip_address' => NULL,
                'created_at' => '2021-05-21 12:16:45',
                'updated_at' => '2021-05-21 12:16:45',
            ),
            34 => 
            array (
                'id' => 35,
                'user_id' => 81,
                'store_id' => 21,
                'ip_address' => NULL,
                'created_at' => '2021-05-21 17:07:43',
                'updated_at' => '2021-05-21 17:07:43',
            ),
            35 => 
            array (
                'id' => 36,
                'user_id' => 81,
                'store_id' => 21,
                'ip_address' => NULL,
                'created_at' => '2021-05-24 08:37:34',
                'updated_at' => '2021-05-24 08:37:34',
            ),
            36 => 
            array (
                'id' => 37,
                'user_id' => 77,
                'store_id' => 17,
                'ip_address' => NULL,
                'created_at' => '2021-05-24 12:06:00',
                'updated_at' => '2021-05-24 12:06:00',
            ),
            37 => 
            array (
                'id' => 38,
                'user_id' => 81,
                'store_id' => 21,
                'ip_address' => NULL,
                'created_at' => '2021-05-24 12:32:26',
                'updated_at' => '2021-05-24 12:32:26',
            ),
            38 => 
            array (
                'id' => 39,
                'user_id' => 77,
                'store_id' => 17,
                'ip_address' => NULL,
                'created_at' => '2021-05-24 14:55:18',
                'updated_at' => '2021-05-24 14:55:18',
            ),
            39 => 
            array (
                'id' => 40,
                'user_id' => 66,
                'store_id' => 1,
                'ip_address' => NULL,
                'created_at' => '2021-05-25 23:00:42',
                'updated_at' => '2021-05-25 23:00:42',
            ),
            40 => 
            array (
                'id' => 41,
                'user_id' => 66,
                'store_id' => 1,
                'ip_address' => NULL,
                'created_at' => '2021-05-25 23:09:54',
                'updated_at' => '2021-05-25 23:09:54',
            ),
            41 => 
            array (
                'id' => 42,
                'user_id' => 66,
                'store_id' => 1,
                'ip_address' => NULL,
                'created_at' => '2021-05-27 14:10:56',
                'updated_at' => '2021-05-27 14:10:56',
            ),
            42 => 
            array (
                'id' => 43,
                'user_id' => 83,
                'store_id' => 5,
                'ip_address' => NULL,
                'created_at' => '2021-05-28 11:40:48',
                'updated_at' => '2021-05-28 11:40:48',
            ),
            43 => 
            array (
                'id' => 44,
                'user_id' => 66,
                'store_id' => 1,
                'ip_address' => NULL,
                'created_at' => '2021-05-29 06:04:40',
                'updated_at' => '2021-05-29 06:04:40',
            ),
            44 => 
            array (
                'id' => 45,
                'user_id' => 66,
                'store_id' => 1,
                'ip_address' => NULL,
                'created_at' => '2021-05-31 13:30:07',
                'updated_at' => '2021-05-31 13:30:07',
            ),
            45 => 
            array (
                'id' => 46,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-31 14:14:37',
                'updated_at' => '2021-05-31 14:14:37',
            ),
            46 => 
            array (
                'id' => 47,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-05-31 14:41:57',
                'updated_at' => '2021-05-31 14:41:57',
            ),
            47 => 
            array (
                'id' => 48,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-05-31 15:01:42',
                'updated_at' => '2021-05-31 15:01:42',
            ),
            48 => 
            array (
                'id' => 49,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-06-07 12:59:21',
                'updated_at' => '2021-06-07 12:59:21',
            ),
            49 => 
            array (
                'id' => 50,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-11 19:35:27',
                'updated_at' => '2021-06-11 19:35:27',
            ),
            50 => 
            array (
                'id' => 51,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-11 19:38:19',
                'updated_at' => '2021-06-11 19:38:19',
            ),
            51 => 
            array (
                'id' => 52,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-11 19:39:11',
                'updated_at' => '2021-06-11 19:39:11',
            ),
            52 => 
            array (
                'id' => 53,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-12 03:56:49',
                'updated_at' => '2021-06-12 03:56:49',
            ),
            53 => 
            array (
                'id' => 54,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-12 14:23:32',
                'updated_at' => '2021-06-12 14:23:32',
            ),
            54 => 
            array (
                'id' => 55,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-12 20:37:41',
                'updated_at' => '2021-06-12 20:37:41',
            ),
            55 => 
            array (
                'id' => 56,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-12 23:19:02',
                'updated_at' => '2021-06-12 23:19:02',
            ),
            56 => 
            array (
                'id' => 57,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-13 15:50:25',
                'updated_at' => '2021-06-13 15:50:25',
            ),
            57 => 
            array (
                'id' => 58,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-13 18:20:07',
                'updated_at' => '2021-06-13 18:20:07',
            ),
            58 => 
            array (
                'id' => 59,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-13 18:20:46',
                'updated_at' => '2021-06-13 18:20:46',
            ),
            59 => 
            array (
                'id' => 60,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-06-14 00:56:41',
                'updated_at' => '2021-06-14 00:56:41',
            ),
            60 => 
            array (
                'id' => 61,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-14 13:01:33',
                'updated_at' => '2021-06-14 13:01:33',
            ),
            61 => 
            array (
                'id' => 62,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-14 13:44:46',
                'updated_at' => '2021-06-14 13:44:46',
            ),
            62 => 
            array (
                'id' => 63,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-14 13:45:17',
                'updated_at' => '2021-06-14 13:45:17',
            ),
            63 => 
            array (
                'id' => 64,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-14 14:11:28',
                'updated_at' => '2021-06-14 14:11:28',
            ),
            64 => 
            array (
                'id' => 65,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-15 16:41:40',
                'updated_at' => '2021-06-15 16:41:40',
            ),
            65 => 
            array (
                'id' => 66,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-15 17:08:21',
                'updated_at' => '2021-06-15 17:08:21',
            ),
            66 => 
            array (
                'id' => 67,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-16 00:16:11',
                'updated_at' => '2021-06-16 00:16:11',
            ),
            67 => 
            array (
                'id' => 68,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-16 13:56:16',
                'updated_at' => '2021-06-16 13:56:16',
            ),
            68 => 
            array (
                'id' => 69,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-16 15:29:46',
                'updated_at' => '2021-06-16 15:29:46',
            ),
            69 => 
            array (
                'id' => 70,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-16 16:11:32',
                'updated_at' => '2021-06-16 16:11:32',
            ),
            70 => 
            array (
                'id' => 71,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-16 17:25:26',
                'updated_at' => '2021-06-16 17:25:26',
            ),
            71 => 
            array (
                'id' => 72,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-17 00:29:55',
                'updated_at' => '2021-06-17 00:29:55',
            ),
            72 => 
            array (
                'id' => 73,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-17 09:15:54',
                'updated_at' => '2021-06-17 09:15:54',
            ),
            73 => 
            array (
                'id' => 74,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-06-17 14:34:34',
                'updated_at' => '2021-06-17 14:34:34',
            ),
            74 => 
            array (
                'id' => 75,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-06-18 16:13:39',
                'updated_at' => '2021-06-18 16:13:39',
            ),
            75 => 
            array (
                'id' => 76,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-20 03:03:36',
                'updated_at' => '2021-06-20 03:03:36',
            ),
            76 => 
            array (
                'id' => 77,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-20 14:45:02',
                'updated_at' => '2021-06-20 14:45:02',
            ),
            77 => 
            array (
                'id' => 78,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-06-20 14:49:01',
                'updated_at' => '2021-06-20 14:49:01',
            ),
            78 => 
            array (
                'id' => 79,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-20 19:20:00',
                'updated_at' => '2021-06-20 19:20:00',
            ),
            79 => 
            array (
                'id' => 80,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-06-20 19:41:47',
                'updated_at' => '2021-06-20 19:41:47',
            ),
            80 => 
            array (
                'id' => 81,
                'user_id' => 84,
                'store_id' => 23,
                'ip_address' => NULL,
                'created_at' => '2021-06-21 10:44:51',
                'updated_at' => '2021-06-21 10:44:51',
            ),
            81 => 
            array (
                'id' => 82,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-22 12:51:36',
                'updated_at' => '2021-06-22 12:51:36',
            ),
            82 => 
            array (
                'id' => 83,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-26 00:17:49',
                'updated_at' => '2021-06-26 00:17:49',
            ),
            83 => 
            array (
                'id' => 84,
                'user_id' => 85,
                'store_id' => 24,
                'ip_address' => NULL,
                'created_at' => '2021-06-26 00:18:27',
                'updated_at' => '2021-06-26 00:18:27',
            ),
            84 => 
            array (
                'id' => 85,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-26 15:46:53',
                'updated_at' => '2021-06-26 15:46:53',
            ),
            85 => 
            array (
                'id' => 86,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-06-26 16:00:33',
                'updated_at' => '2021-06-26 16:00:33',
            ),
            86 => 
            array (
                'id' => 87,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-26 16:04:30',
                'updated_at' => '2021-06-26 16:04:30',
            ),
            87 => 
            array (
                'id' => 88,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-06-26 18:41:17',
                'updated_at' => '2021-06-26 18:41:17',
            ),
            88 => 
            array (
                'id' => 89,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-26 20:39:33',
                'updated_at' => '2021-06-26 20:39:33',
            ),
            89 => 
            array (
                'id' => 90,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-27 00:31:02',
                'updated_at' => '2021-06-27 00:31:02',
            ),
            90 => 
            array (
                'id' => 91,
                'user_id' => 83,
                'store_id' => 22,
                'ip_address' => NULL,
                'created_at' => '2021-06-28 15:15:32',
                'updated_at' => '2021-06-28 15:15:32',
            ),
            91 => 
            array (
                'id' => 92,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-06-30 22:12:28',
                'updated_at' => '2021-06-30 22:12:28',
            ),
            92 => 
            array (
                'id' => 93,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-03 19:35:02',
                'updated_at' => '2021-07-03 19:35:02',
            ),
            93 => 
            array (
                'id' => 94,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-04 05:19:08',
                'updated_at' => '2021-07-04 05:19:08',
            ),
            94 => 
            array (
                'id' => 95,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-04 15:09:57',
                'updated_at' => '2021-07-04 15:09:57',
            ),
            95 => 
            array (
                'id' => 96,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-04 18:29:58',
                'updated_at' => '2021-07-04 18:29:58',
            ),
            96 => 
            array (
                'id' => 97,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-05 02:30:21',
                'updated_at' => '2021-07-05 02:30:21',
            ),
            97 => 
            array (
                'id' => 98,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-05 05:30:31',
                'updated_at' => '2021-07-05 05:30:31',
            ),
            98 => 
            array (
                'id' => 99,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-05 18:12:52',
                'updated_at' => '2021-07-05 18:12:52',
            ),
            99 => 
            array (
                'id' => 100,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-06 04:47:10',
                'updated_at' => '2021-07-06 04:47:10',
            ),
            100 => 
            array (
                'id' => 101,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-06 18:56:12',
                'updated_at' => '2021-07-06 18:56:12',
            ),
            101 => 
            array (
                'id' => 102,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-06 22:10:57',
                'updated_at' => '2021-07-06 22:10:57',
            ),
            102 => 
            array (
                'id' => 103,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-07 04:46:31',
                'updated_at' => '2021-07-07 04:46:31',
            ),
            103 => 
            array (
                'id' => 104,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-08 20:19:36',
                'updated_at' => '2021-07-08 20:19:36',
            ),
            104 => 
            array (
                'id' => 105,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-10 23:56:20',
                'updated_at' => '2021-07-10 23:56:20',
            ),
            105 => 
            array (
                'id' => 106,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-11 19:55:23',
                'updated_at' => '2021-07-11 19:55:23',
            ),
            106 => 
            array (
                'id' => 107,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-12 18:05:04',
                'updated_at' => '2021-07-12 18:05:04',
            ),
            107 => 
            array (
                'id' => 108,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-13 08:38:58',
                'updated_at' => '2021-07-13 08:38:58',
            ),
            108 => 
            array (
                'id' => 109,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-13 22:58:55',
                'updated_at' => '2021-07-13 22:58:55',
            ),
            109 => 
            array (
                'id' => 110,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-14 01:40:48',
                'updated_at' => '2021-07-14 01:40:48',
            ),
            110 => 
            array (
                'id' => 111,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-14 21:34:30',
                'updated_at' => '2021-07-14 21:34:30',
            ),
            111 => 
            array (
                'id' => 112,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-16 07:04:52',
                'updated_at' => '2021-07-16 07:04:52',
            ),
            112 => 
            array (
                'id' => 113,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-16 07:13:27',
                'updated_at' => '2021-07-16 07:13:27',
            ),
            113 => 
            array (
                'id' => 114,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-16 19:33:19',
                'updated_at' => '2021-07-16 19:33:19',
            ),
            114 => 
            array (
                'id' => 115,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-16 19:34:13',
                'updated_at' => '2021-07-16 19:34:13',
            ),
            115 => 
            array (
                'id' => 116,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-16 20:40:30',
                'updated_at' => '2021-07-16 20:40:30',
            ),
            116 => 
            array (
                'id' => 117,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-17 07:31:44',
                'updated_at' => '2021-07-17 07:31:44',
            ),
            117 => 
            array (
                'id' => 118,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-17 11:05:12',
                'updated_at' => '2021-07-17 11:05:12',
            ),
            118 => 
            array (
                'id' => 119,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-17 18:14:21',
                'updated_at' => '2021-07-17 18:14:21',
            ),
            119 => 
            array (
                'id' => 120,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-17 19:27:02',
                'updated_at' => '2021-07-17 19:27:02',
            ),
            120 => 
            array (
                'id' => 121,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-18 17:26:44',
                'updated_at' => '2021-07-18 17:26:44',
            ),
            121 => 
            array (
                'id' => 122,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-18 23:59:39',
                'updated_at' => '2021-07-18 23:59:39',
            ),
            122 => 
            array (
                'id' => 123,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-19 02:46:24',
                'updated_at' => '2021-07-19 02:46:24',
            ),
            123 => 
            array (
                'id' => 124,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-19 07:05:45',
                'updated_at' => '2021-07-19 07:05:45',
            ),
            124 => 
            array (
                'id' => 125,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-19 16:28:22',
                'updated_at' => '2021-07-19 16:28:22',
            ),
            125 => 
            array (
                'id' => 126,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-19 18:15:13',
                'updated_at' => '2021-07-19 18:15:13',
            ),
            126 => 
            array (
                'id' => 127,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-19 23:23:54',
                'updated_at' => '2021-07-19 23:23:54',
            ),
            127 => 
            array (
                'id' => 128,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-20 19:18:42',
                'updated_at' => '2021-07-20 19:18:42',
            ),
            128 => 
            array (
                'id' => 129,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-20 20:35:19',
                'updated_at' => '2021-07-20 20:35:19',
            ),
            129 => 
            array (
                'id' => 130,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-20 22:59:58',
                'updated_at' => '2021-07-20 22:59:58',
            ),
            130 => 
            array (
                'id' => 131,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-22 03:38:12',
                'updated_at' => '2021-07-22 03:38:12',
            ),
            131 => 
            array (
                'id' => 132,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-22 18:43:40',
                'updated_at' => '2021-07-22 18:43:40',
            ),
            132 => 
            array (
                'id' => 133,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-23 02:04:15',
                'updated_at' => '2021-07-23 02:04:15',
            ),
            133 => 
            array (
                'id' => 134,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-23 04:39:42',
                'updated_at' => '2021-07-23 04:39:42',
            ),
            134 => 
            array (
                'id' => 135,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-23 16:46:19',
                'updated_at' => '2021-07-23 16:46:19',
            ),
            135 => 
            array (
                'id' => 136,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-24 04:32:15',
                'updated_at' => '2021-07-24 04:32:15',
            ),
            136 => 
            array (
                'id' => 137,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-24 04:34:04',
                'updated_at' => '2021-07-24 04:34:04',
            ),
            137 => 
            array (
                'id' => 138,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-24 21:47:11',
                'updated_at' => '2021-07-24 21:47:11',
            ),
            138 => 
            array (
                'id' => 139,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-26 06:48:59',
                'updated_at' => '2021-07-26 06:48:59',
            ),
            139 => 
            array (
                'id' => 140,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-26 18:11:11',
                'updated_at' => '2021-07-26 18:11:11',
            ),
            140 => 
            array (
                'id' => 141,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-26 18:14:28',
                'updated_at' => '2021-07-26 18:14:28',
            ),
            141 => 
            array (
                'id' => 142,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-27 02:43:57',
                'updated_at' => '2021-07-27 02:43:57',
            ),
            142 => 
            array (
                'id' => 143,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-27 02:44:42',
                'updated_at' => '2021-07-27 02:44:42',
            ),
            143 => 
            array (
                'id' => 144,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-27 13:48:28',
                'updated_at' => '2021-07-27 13:48:28',
            ),
            144 => 
            array (
                'id' => 145,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-28 18:09:00',
                'updated_at' => '2021-07-28 18:09:00',
            ),
            145 => 
            array (
                'id' => 146,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-29 17:50:55',
                'updated_at' => '2021-07-29 17:50:55',
            ),
            146 => 
            array (
                'id' => 147,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-29 18:04:26',
                'updated_at' => '2021-07-29 18:04:26',
            ),
            147 => 
            array (
                'id' => 148,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-30 18:43:28',
                'updated_at' => '2021-07-30 18:43:28',
            ),
            148 => 
            array (
                'id' => 149,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-31 02:45:47',
                'updated_at' => '2021-07-31 02:45:47',
            ),
            149 => 
            array (
                'id' => 150,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-31 05:48:29',
                'updated_at' => '2021-07-31 05:48:29',
            ),
            150 => 
            array (
                'id' => 151,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-31 16:11:54',
                'updated_at' => '2021-07-31 16:11:54',
            ),
            151 => 
            array (
                'id' => 152,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-31 18:49:50',
                'updated_at' => '2021-07-31 18:49:50',
            ),
            152 => 
            array (
                'id' => 153,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-07-31 21:18:53',
                'updated_at' => '2021-07-31 21:18:53',
            ),
            153 => 
            array (
                'id' => 154,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-08-01 00:46:41',
                'updated_at' => '2021-08-01 00:46:41',
            ),
            154 => 
            array (
                'id' => 155,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-08-02 18:15:44',
                'updated_at' => '2021-08-02 18:15:44',
            ),
            155 => 
            array (
                'id' => 156,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-08-02 23:25:27',
                'updated_at' => '2021-08-02 23:25:27',
            ),
            156 => 
            array (
                'id' => 157,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-08-02 23:35:00',
                'updated_at' => '2021-08-02 23:35:00',
            ),
            157 => 
            array (
                'id' => 158,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-08-02 23:36:13',
                'updated_at' => '2021-08-02 23:36:13',
            ),
            158 => 
            array (
                'id' => 159,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-08-05 18:16:13',
                'updated_at' => '2021-08-05 18:16:13',
            ),
            159 => 
            array (
                'id' => 160,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-08-23 18:14:34',
                'updated_at' => '2021-08-23 18:14:34',
            ),
            160 => 
            array (
                'id' => 161,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-02 22:26:59',
                'updated_at' => '2021-09-02 22:26:59',
            ),
            161 => 
            array (
                'id' => 162,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-04 21:05:36',
                'updated_at' => '2021-09-04 21:05:36',
            ),
            162 => 
            array (
                'id' => 163,
                'user_id' => 70,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-06 18:03:38',
                'updated_at' => '2021-09-06 18:03:38',
            ),
            163 => 
            array (
                'id' => 164,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-11 02:52:36',
                'updated_at' => '2021-09-11 02:52:36',
            ),
            164 => 
            array (
                'id' => 165,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-11 16:34:34',
                'updated_at' => '2021-09-11 16:34:34',
            ),
            165 => 
            array (
                'id' => 166,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-11 21:22:23',
                'updated_at' => '2021-09-11 21:22:23',
            ),
            166 => 
            array (
                'id' => 167,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-11 21:30:33',
                'updated_at' => '2021-09-11 21:30:33',
            ),
            167 => 
            array (
                'id' => 168,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-12 04:34:13',
                'updated_at' => '2021-09-12 04:34:13',
            ),
            168 => 
            array (
                'id' => 169,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-12 06:48:51',
                'updated_at' => '2021-09-12 06:48:51',
            ),
            169 => 
            array (
                'id' => 170,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-12 16:38:12',
                'updated_at' => '2021-09-12 16:38:12',
            ),
            170 => 
            array (
                'id' => 171,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-13 14:16:58',
                'updated_at' => '2021-09-13 14:16:58',
            ),
            171 => 
            array (
                'id' => 172,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-15 19:30:30',
                'updated_at' => '2021-09-15 19:30:30',
            ),
            172 => 
            array (
                'id' => 173,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-19 01:34:50',
                'updated_at' => '2021-09-19 01:34:50',
            ),
            173 => 
            array (
                'id' => 174,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-19 19:33:33',
                'updated_at' => '2021-09-19 19:33:33',
            ),
            174 => 
            array (
                'id' => 175,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-20 04:58:07',
                'updated_at' => '2021-09-20 04:58:07',
            ),
            175 => 
            array (
                'id' => 176,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-20 15:30:13',
                'updated_at' => '2021-09-20 15:30:13',
            ),
            176 => 
            array (
                'id' => 177,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-20 18:14:26',
                'updated_at' => '2021-09-20 18:14:26',
            ),
            177 => 
            array (
                'id' => 178,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-20 18:20:50',
                'updated_at' => '2021-09-20 18:20:50',
            ),
            178 => 
            array (
                'id' => 179,
                'user_id' => 88,
                'store_id' => 26,
                'ip_address' => NULL,
                'created_at' => '2021-09-22 02:50:47',
                'updated_at' => '2021-09-22 02:50:47',
            ),
            179 => 
            array (
                'id' => 180,
                'user_id' => 89,
                'store_id' => 27,
                'ip_address' => NULL,
                'created_at' => '2021-09-22 05:03:42',
                'updated_at' => '2021-09-22 05:03:42',
            ),
            180 => 
            array (
                'id' => 181,
                'user_id' => 90,
                'store_id' => 28,
                'ip_address' => NULL,
                'created_at' => '2021-09-22 05:03:59',
                'updated_at' => '2021-09-22 05:03:59',
            ),
            181 => 
            array (
                'id' => 182,
                'user_id' => 91,
                'store_id' => 29,
                'ip_address' => NULL,
                'created_at' => '2021-09-22 05:04:49',
                'updated_at' => '2021-09-22 05:04:49',
            ),
            182 => 
            array (
                'id' => 183,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-22 21:10:14',
                'updated_at' => '2021-09-22 21:10:14',
            ),
            183 => 
            array (
                'id' => 184,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-22 21:11:13',
                'updated_at' => '2021-09-22 21:11:13',
            ),
            184 => 
            array (
                'id' => 185,
                'user_id' => 92,
                'store_id' => 30,
                'ip_address' => NULL,
                'created_at' => '2021-09-22 22:41:33',
                'updated_at' => '2021-09-22 22:41:33',
            ),
            185 => 
            array (
                'id' => 186,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-23 05:19:01',
                'updated_at' => '2021-09-23 05:19:01',
            ),
            186 => 
            array (
                'id' => 187,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-23 16:18:31',
                'updated_at' => '2021-09-23 16:18:31',
            ),
            187 => 
            array (
                'id' => 188,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-23 16:54:09',
                'updated_at' => '2021-09-23 16:54:09',
            ),
            188 => 
            array (
                'id' => 189,
                'user_id' => 93,
                'store_id' => 31,
                'ip_address' => NULL,
                'created_at' => '2021-09-23 22:37:46',
                'updated_at' => '2021-09-23 22:37:46',
            ),
            189 => 
            array (
                'id' => 190,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-24 02:54:38',
                'updated_at' => '2021-09-24 02:54:38',
            ),
            190 => 
            array (
                'id' => 191,
                'user_id' => 94,
                'store_id' => 32,
                'ip_address' => NULL,
                'created_at' => '2021-09-24 05:07:20',
                'updated_at' => '2021-09-24 05:07:20',
            ),
            191 => 
            array (
                'id' => 192,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-25 02:55:24',
                'updated_at' => '2021-09-25 02:55:24',
            ),
            192 => 
            array (
                'id' => 193,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-25 13:36:39',
                'updated_at' => '2021-09-25 13:36:39',
            ),
            193 => 
            array (
                'id' => 194,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-26 07:43:16',
                'updated_at' => '2021-09-26 07:43:16',
            ),
            194 => 
            array (
                'id' => 195,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-26 08:05:24',
                'updated_at' => '2021-09-26 08:05:24',
            ),
            195 => 
            array (
                'id' => 196,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-26 15:36:27',
                'updated_at' => '2021-09-26 15:36:27',
            ),
            196 => 
            array (
                'id' => 197,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-26 16:45:39',
                'updated_at' => '2021-09-26 16:45:39',
            ),
            197 => 
            array (
                'id' => 198,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-26 21:43:16',
                'updated_at' => '2021-09-26 21:43:16',
            ),
            198 => 
            array (
                'id' => 199,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-30 00:14:34',
                'updated_at' => '2021-09-30 00:14:34',
            ),
            199 => 
            array (
                'id' => 200,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-09-30 08:52:29',
                'updated_at' => '2021-09-30 08:52:29',
            ),
            200 => 
            array (
                'id' => 201,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-01 00:15:38',
                'updated_at' => '2021-10-01 00:15:38',
            ),
            201 => 
            array (
                'id' => 202,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-01 02:23:16',
                'updated_at' => '2021-10-01 02:23:16',
            ),
            202 => 
            array (
                'id' => 203,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-04 23:27:43',
                'updated_at' => '2021-10-04 23:27:43',
            ),
            203 => 
            array (
                'id' => 204,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-04 23:30:20',
                'updated_at' => '2021-10-04 23:30:20',
            ),
            204 => 
            array (
                'id' => 205,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-09 05:59:24',
                'updated_at' => '2021-10-09 05:59:24',
            ),
            205 => 
            array (
                'id' => 206,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-09 16:33:18',
                'updated_at' => '2021-10-09 16:33:18',
            ),
            206 => 
            array (
                'id' => 207,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-09 17:43:04',
                'updated_at' => '2021-10-09 17:43:04',
            ),
            207 => 
            array (
                'id' => 208,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-10 03:40:28',
                'updated_at' => '2021-10-10 03:40:28',
            ),
            208 => 
            array (
                'id' => 209,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-10 16:19:22',
                'updated_at' => '2021-10-10 16:19:22',
            ),
            209 => 
            array (
                'id' => 210,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-10 16:43:29',
                'updated_at' => '2021-10-10 16:43:29',
            ),
            210 => 
            array (
                'id' => 211,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-10 22:09:09',
                'updated_at' => '2021-10-10 22:09:09',
            ),
            211 => 
            array (
                'id' => 212,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-11 08:44:32',
                'updated_at' => '2021-10-11 08:44:32',
            ),
            212 => 
            array (
                'id' => 213,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-11 16:46:29',
                'updated_at' => '2021-10-11 16:46:29',
            ),
            213 => 
            array (
                'id' => 214,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-11 19:38:15',
                'updated_at' => '2021-10-11 19:38:15',
            ),
            214 => 
            array (
                'id' => 215,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-11 23:24:30',
                'updated_at' => '2021-10-11 23:24:30',
            ),
            215 => 
            array (
                'id' => 216,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-12 16:48:53',
                'updated_at' => '2021-10-12 16:48:53',
            ),
            216 => 
            array (
                'id' => 217,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-13 08:25:51',
                'updated_at' => '2021-10-13 08:25:51',
            ),
            217 => 
            array (
                'id' => 218,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-13 16:56:32',
                'updated_at' => '2021-10-13 16:56:32',
            ),
            218 => 
            array (
                'id' => 219,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-14 05:34:03',
                'updated_at' => '2021-10-14 05:34:03',
            ),
            219 => 
            array (
                'id' => 220,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-14 20:50:55',
                'updated_at' => '2021-10-14 20:50:55',
            ),
            220 => 
            array (
                'id' => 221,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-15 04:55:28',
                'updated_at' => '2021-10-15 04:55:28',
            ),
            221 => 
            array (
                'id' => 222,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-15 18:56:20',
                'updated_at' => '2021-10-15 18:56:20',
            ),
            222 => 
            array (
                'id' => 223,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-15 20:15:20',
                'updated_at' => '2021-10-15 20:15:20',
            ),
            223 => 
            array (
                'id' => 224,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-16 02:40:55',
                'updated_at' => '2021-10-16 02:40:55',
            ),
            224 => 
            array (
                'id' => 225,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-16 16:47:01',
                'updated_at' => '2021-10-16 16:47:01',
            ),
            225 => 
            array (
                'id' => 226,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-16 17:27:25',
                'updated_at' => '2021-10-16 17:27:25',
            ),
            226 => 
            array (
                'id' => 227,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-16 19:43:24',
                'updated_at' => '2021-10-16 19:43:24',
            ),
            227 => 
            array (
                'id' => 228,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-16 21:47:44',
                'updated_at' => '2021-10-16 21:47:44',
            ),
            228 => 
            array (
                'id' => 229,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-16 21:49:51',
                'updated_at' => '2021-10-16 21:49:51',
            ),
            229 => 
            array (
                'id' => 230,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-17 01:19:33',
                'updated_at' => '2021-10-17 01:19:33',
            ),
            230 => 
            array (
                'id' => 231,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-17 17:16:08',
                'updated_at' => '2021-10-17 17:16:08',
            ),
            231 => 
            array (
                'id' => 232,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-18 19:20:00',
                'updated_at' => '2021-10-18 19:20:00',
            ),
            232 => 
            array (
                'id' => 233,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-20 22:50:15',
                'updated_at' => '2021-10-20 22:50:15',
            ),
            233 => 
            array (
                'id' => 234,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-21 13:08:18',
                'updated_at' => '2021-10-21 13:08:18',
            ),
            234 => 
            array (
                'id' => 235,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-22 04:38:01',
                'updated_at' => '2021-10-22 04:38:01',
            ),
            235 => 
            array (
                'id' => 236,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-23 23:59:50',
                'updated_at' => '2021-10-23 23:59:50',
            ),
            236 => 
            array (
                'id' => 237,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-24 03:37:11',
                'updated_at' => '2021-10-24 03:37:11',
            ),
            237 => 
            array (
                'id' => 238,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-24 14:45:47',
                'updated_at' => '2021-10-24 14:45:47',
            ),
            238 => 
            array (
                'id' => 239,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-24 14:47:20',
                'updated_at' => '2021-10-24 14:47:20',
            ),
            239 => 
            array (
                'id' => 240,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-10-24 14:48:54',
                'updated_at' => '2021-10-24 14:48:54',
            ),
            240 => 
            array (
                'id' => 241,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-10-28 11:02:49',
                'updated_at' => '2021-10-28 11:02:49',
            ),
            241 => 
            array (
                'id' => 242,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-10-28 17:59:15',
                'updated_at' => '2021-10-28 17:59:15',
            ),
            242 => 
            array (
                'id' => 243,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-10-28 22:08:01',
                'updated_at' => '2021-10-28 22:08:01',
            ),
            243 => 
            array (
                'id' => 244,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-10-30 07:40:55',
                'updated_at' => '2021-10-30 07:40:55',
            ),
            244 => 
            array (
                'id' => 245,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-10-30 08:54:58',
                'updated_at' => '2021-10-30 08:54:58',
            ),
            245 => 
            array (
                'id' => 246,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-10-31 09:29:59',
                'updated_at' => '2021-10-31 09:29:59',
            ),
            246 => 
            array (
                'id' => 247,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-10-31 21:16:15',
                'updated_at' => '2021-10-31 21:16:15',
            ),
            247 => 
            array (
                'id' => 248,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-11-01 03:29:01',
                'updated_at' => '2021-11-01 03:29:01',
            ),
            248 => 
            array (
                'id' => 249,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-11-15 18:28:53',
                'updated_at' => '2021-11-15 18:28:53',
            ),
            249 => 
            array (
                'id' => 250,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-11-25 03:58:06',
                'updated_at' => '2021-11-25 03:58:06',
            ),
            250 => 
            array (
                'id' => 251,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-11-25 05:53:09',
                'updated_at' => '2021-11-25 05:53:09',
            ),
            251 => 
            array (
                'id' => 252,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => NULL,
                'created_at' => '2021-12-15 19:40:59',
                'updated_at' => '2021-12-15 19:40:59',
            ),
            252 => 
            array (
                'id' => 253,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-12-16 01:26:45',
                'updated_at' => '2021-12-16 01:26:45',
            ),
            253 => 
            array (
                'id' => 254,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-12-16 22:35:25',
                'updated_at' => '2021-12-16 22:35:25',
            ),
            254 => 
            array (
                'id' => 255,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-12-21 01:53:55',
                'updated_at' => '2021-12-21 01:53:55',
            ),
            255 => 
            array (
                'id' => 256,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2021-12-24 20:31:18',
                'updated_at' => '2021-12-24 20:31:18',
            ),
            256 => 
            array (
                'id' => 257,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-04 20:00:02',
                'updated_at' => '2022-01-04 20:00:02',
            ),
            257 => 
            array (
                'id' => 258,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-04 23:20:59',
                'updated_at' => '2022-01-04 23:20:59',
            ),
            258 => 
            array (
                'id' => 259,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-05 17:45:13',
                'updated_at' => '2022-01-05 17:45:13',
            ),
            259 => 
            array (
                'id' => 260,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-05 17:53:39',
                'updated_at' => '2022-01-05 17:53:39',
            ),
            260 => 
            array (
                'id' => 261,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-06 21:20:35',
                'updated_at' => '2022-01-06 21:20:35',
            ),
            261 => 
            array (
                'id' => 262,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-06 21:35:06',
                'updated_at' => '2022-01-06 21:35:06',
            ),
            262 => 
            array (
                'id' => 263,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-07 00:51:50',
                'updated_at' => '2022-01-07 00:51:50',
            ),
            263 => 
            array (
                'id' => 264,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-07 20:03:11',
                'updated_at' => '2022-01-07 20:03:11',
            ),
            264 => 
            array (
                'id' => 265,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-10 02:26:02',
                'updated_at' => '2022-01-10 02:26:02',
            ),
            265 => 
            array (
                'id' => 266,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-10 05:35:43',
                'updated_at' => '2022-01-10 05:35:43',
            ),
            266 => 
            array (
                'id' => 267,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-11 18:19:49',
                'updated_at' => '2022-01-11 18:19:49',
            ),
            267 => 
            array (
                'id' => 268,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-12 19:50:02',
                'updated_at' => '2022-01-12 19:50:02',
            ),
            268 => 
            array (
                'id' => 269,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-13 17:54:36',
                'updated_at' => '2022-01-13 17:54:36',
            ),
            269 => 
            array (
                'id' => 270,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-13 23:50:02',
                'updated_at' => '2022-01-13 23:50:02',
            ),
            270 => 
            array (
                'id' => 271,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-14 19:30:45',
                'updated_at' => '2022-01-14 19:30:45',
            ),
            271 => 
            array (
                'id' => 272,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-17 19:17:07',
                'updated_at' => '2022-01-17 19:17:07',
            ),
            272 => 
            array (
                'id' => 273,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-18 00:22:28',
                'updated_at' => '2022-01-18 00:22:28',
            ),
            273 => 
            array (
                'id' => 274,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-18 20:56:42',
                'updated_at' => '2022-01-18 20:56:42',
            ),
            274 => 
            array (
                'id' => 275,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-18 21:00:15',
                'updated_at' => '2022-01-18 21:00:15',
            ),
            275 => 
            array (
                'id' => 276,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-19 18:47:10',
                'updated_at' => '2022-01-19 18:47:10',
            ),
            276 => 
            array (
                'id' => 277,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-19 18:47:10',
                'updated_at' => '2022-01-19 18:47:10',
            ),
            277 => 
            array (
                'id' => 278,
                'user_id' => 66,
                'store_id' => 2,
                'ip_address' => '127.0.0.1',
                'created_at' => '2022-01-19 21:37:34',
                'updated_at' => '2022-01-19 21:37:34',
            ),
        ));
        
        
    }
}