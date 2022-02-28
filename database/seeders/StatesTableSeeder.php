<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('states')->delete();
        
        \DB::table('states')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'AL',
                'name' => 'Alabama',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'AK',
                'name' => 'Alaska',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'AL',
                'name' => 'Alabama',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'AZ',
                'name' => 'Arizona',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'AR',
                'name' => 'Arkansas',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'CA',
                'name' => 'California',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'CO',
                'name' => 'Colorado',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'CT',
                'name' => 'Connecticut',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'DE',
                'name' => 'Delaware',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'DC',
                'name' => 'District of Columbia',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'FL',
                'name' => 'Florida',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'GA',
                'name' => 'Georgia',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'HI',
                'name' => 'Hawaii',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'ID',
                'name' => 'Idaho',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 'IL',
                'name' => 'Illinois',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 'IN',
                'name' => 'Indiana',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 'IA',
                'name' => 'Iowa',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'code' => 'KS',
                'name' => 'Kansas',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'code' => 'KY',
                'name' => 'Kentucky',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'code' => 'LA',
                'name' => 'Louisiana',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'code' => 'ME',
                'name' => 'Maine',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'code' => 'MD',
                'name' => 'Maryland',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'code' => 'MA',
                'name' => 'Massachusetts',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'code' => 'MI',
                'name' => 'Michigan',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'code' => 'MN',
                'name' => 'Minnesota',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'code' => 'MS',
                'name' => 'Mississippi',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'code' => 'MO',
                'name' => 'Missouri',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'code' => 'MT',
                'name' => 'Montana',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'code' => 'NE',
                'name' => 'Nebraska',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'code' => 'NV',
                'name' => 'Nevada',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'code' => 'NH',
                'name' => 'New Hampshire',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'code' => 'NJ',
                'name' => 'New Jersey',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'code' => 'NM',
                'name' => 'New Mexico',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'code' => 'NY',
                'name' => 'New York',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'code' => 'NC',
                'name' => 'North Carolina',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'code' => 'ND',
                'name' => 'North Dakota',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'code' => 'OH',
                'name' => 'Ohio',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'code' => 'OK',
                'name' => 'Oklahoma',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'code' => 'OR',
                'name' => 'Oregon',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'code' => 'PA',
                'name' => 'Pennsylvania',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'code' => 'PR',
                'name' => 'Puerto Rico',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'code' => 'RI',
                'name' => 'Rhode Island',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'code' => 'SC',
                'name' => 'South Carolina',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'code' => 'SD',
                'name' => 'South Dakota',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'code' => 'TN',
                'name' => 'Tennessee',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'code' => 'TX',
                'name' => 'Texas',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'code' => 'UT',
                'name' => 'Utah',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'code' => 'VT',
                'name' => 'Vermont',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'code' => 'VA',
                'name' => 'Virginia',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'code' => 'WA',
                'name' => 'Washington',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'code' => 'WV',
                'name' => 'West Virginia',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'code' => 'WI',
                'name' => 'Wisconsin',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'code' => 'WY',
                'name' => 'Wyoming',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'code' => 'AB',
                'name' => 'Abia',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'code' => 'AD',
                'name' => 'Adamawa',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'code' => 'AK',
                'name' => 'Akwa Ibom',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'code' => 'AN',
                'name' => 'Anambra',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'code' => 'BA',
                'name' => 'Bauchi',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'code' => 'BAY',
                'name' => 'Bayelsa',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'code' => 'BEN',
                'name' => 'Benue',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'code' => 'BOR',
                'name' => 'Borno',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'code' => 'CRS',
                'name' => 'Cross River',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'code' => 'DEL',
                'name' => 'Delta',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'code' => 'EBY',
                'name' => 'Ebonyi',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'code' => 'EDO',
                'name' => 'Edo',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'code' => 'EKT',
                'name' => 'Ekiti',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'code' => 'ENG',
                'name' => 'Enugu',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'code' => 'GMB',
                'name' => 'Gombe',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'code' => 'IMO',
                'name' => 'Imo',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'code' => 'JGW',
                'name' => 'Jigawa',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'code' => 'KAD',
                'name' => 'Kaduna',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'code' => 'KAN',
                'name' => 'Kano',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'code' => 'KAT',
                'name' => 'Katsina',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'code' => 'KEB',
                'name' => 'Kebbi',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'code' => 'KOG',
                'name' => 'Kogi',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'code' => 'KWR',
                'name' => 'Kwara',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'code' => 'LAG',
                'name' => 'Lagos',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'code' => 'NSR',
                'name' => 'Nasarawa',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'code' => 'NGR',
                'name' => 'Niger',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'code' => 'OGN',
                'name' => 'Ogun',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'code' => 'OND',
                'name' => 'Ondo',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'code' => 'OSN',
                'name' => 'Osun',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'code' => 'OYO',
                'name' => 'Oyo',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'code' => 'PLT',
                'name' => 'Plateau',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'code' => 'RVR',
                'name' => 'Rivers',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'code' => 'SKT',
                'name' => 'Sokoto',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'code' => 'TRB',
                'name' => 'Taraba',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'code' => 'YOB',
                'name' => 'Yobe',
                'country_id' => 158,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'code' => 'ZAM',
                'name' => 'Zamfara',
                'country_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'timezone_id' => NULL,
            ),
        ));
        
        
    }
}