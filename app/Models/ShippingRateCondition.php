<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRateCondition extends Model
{
    use HasFactory;

    public static $condition_options = [
    	['title'=>'is equal to', 'type'=>'string'],
    	['title'=>'is not equal to', 'type'=>'string'],
    	['title'=>'is greater than', 'type'=>'int'],
    	['title'=>'is less than', 'type'=>'int']
    ];

    public static $rate_options = [
    	['title'=>'State', 'type'=>'string'],
    	['title'=>'Price', 'type'=>'string'],
    	['title'=>'Weight', 'type'=>'int'],
        ['title'=>'Number of Items', 'type'=>'int'],
    ];
}
