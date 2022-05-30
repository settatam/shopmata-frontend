<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Helpers\Helper;



class StoreNotificationMessageSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
    
        foreach ($channels = ['sms','email'] as $key => $channel) {
            \DB::table('store_notification_messages')->insert(
            [
                'message' => "This is a" .$key . 'mesage',
                'store_notification_id' => null,
                'store_id' => Helper::getStoreByName('BuyMyGold'),
                'user_id' => null,  
                'channel' => $key,
                'email_subject' =>  "This is a" .$key . 'mesage',
                'is_custom' => 1
            ]
        
           ); 
       }
        
        
    }
}


