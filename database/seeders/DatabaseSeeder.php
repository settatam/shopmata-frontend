<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	//\App\Models\Customer::truncate();
        // \App\Models\User::factory(10)->create();
        //\App\Models\Customer::factory(100)->create();
        //\App\Models\Order::factory(50)->create();
        // \App\Models\CartDetail::factory(300)->create();
        \App\Models\OrderShippingAddress::factory(45)->create();
    }
}
