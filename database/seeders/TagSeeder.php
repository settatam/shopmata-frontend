<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Helper;



class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            1  => [                   
                'Tyvek',
                'Fedex',
                'Customer',
                'Other',
                '10%',
                'Fedex Gr',
                'Fedex Ex',
                'Box',
            ],
            2 => [
                'SP',
                'Message Received',
                'MET',
                'MET2',
                'MET3',
                'Payment Rejected or Returned'
            ]

        ];

        foreach ($tags as $key => $tag) {
            foreach ($tag as $t) {
                DB::table('tags')->insert([
                    'group_id' => $key,
                    'name' => $t,
                    'tagable_type' => 'App\Models\Transaction',
                    'store_id' => Helper::getStoreByName('BuyMyGold')
                ]); 
            }
        }
    }
}
