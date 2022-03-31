<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [                   
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
            'Incomin ',
        ];
    }
}

    
   