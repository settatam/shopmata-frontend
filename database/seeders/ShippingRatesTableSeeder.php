<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingRatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('shipping_rates')->delete();

        \DB::table('shipping_rates')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Standard Shipping',
                'description' => 'Standard',
                'price' => '200.00',
                'user_id' => 66,
                'is_domestic' => 1,
                'is_international' => 0,
                'is_flat' => 0,
                'match_all_condition' => 0,
                'created_at' => '2021-02-02 06:00:01',
                'updated_at' => '2021-02-02 06:00:01',
                'deleted_at' => NULL,
                'store_id' => 2,
            ),
        ));


    }
}
