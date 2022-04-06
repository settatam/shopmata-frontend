<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class StatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {   
        $status =  [                   
            'Kit Received'                     ,
            'Pending Kit request',
            'Kit Sent',
            'Kit Received - Rejected By Admin',
            'Offer Given',
            'Offer Accepted',
            'Customer Declined Offer',
            'Payment Processed',
            'Offer Declined',
            'Offer #2 Given',
            'Offer #2 Decline',
            'Offer Given (Cnotes &amp; Picture',
            'Pending Phone Kit Requests',
            'Kit Request - Email',
            'Kit Request - Download Printed',
            '14 Day',
            'Refused and return kits',
            'Kits not received',
            'Import',
            'Return Kit Shipped',
            'Return kit being processed',
            'Returned kit',
            'Kit Request Declined',
            'Kit Sent - Awaiting Shipment',
            'Ready for Melt',
            'Imported List - Kit mailed',
            'Imported List - Received',
            'Incomin',
        ];

        foreach ($status as $key => $statu) {
            DB::table('statuses')->insert([
                'name' => $statu,
            ]); 
        }
       
    }
}

