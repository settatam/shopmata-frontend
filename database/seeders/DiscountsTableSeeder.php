<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('discounts')->delete();
        
        \DB::table('discounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'status' => 'all',
                'type' => 'fixed',
                'everyone' => NULL,
                'entire_order' => 1,
                'active' => 1,
                'discount' => '10.00',
                'start_date' => '2021-05-01 00:00:00',
                'end_date' => '2021-05-16 00:00:00',
                'created_at' => '2021-05-14 00:17:52',
                'updated_at' => '2021-05-14 00:17:52',
                'deleted_at' => NULL,
                'code' => 'win0012#',
                'store_id' => 2,
            ),
        ));
        
        
    }
}