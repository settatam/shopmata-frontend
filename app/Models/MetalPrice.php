<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetalPrice extends Model
{
    use HasFactory;

    protected $dwts = [
        '10K'=>['GOLD', 0.0195],
        '14K'=>['GOLD',0.0278],
        '16K'=>['GOLD',0.0303],
        '18K'=>['GOLD', 0.0355],
        '20K'=>['GOLD', 0.0415],
        '22K'=>['GOLD', 0.043],
        '24K'=>['GOLD', 0.045],
        'Sterling'=>['SILVER', 0.04],
        'Platinum'=>['PLATINUM', 0.04],
    ];

    static function calcSpotPrice($metal, $dwt, $qty=1) {
        if(!$qty) return false;
        $currentObj = new static();
        if(array_key_exists($metal, $currentObj->dwts)) {
            $metalCat = $currentObj->dwts[$metal];
            $priceObj = self::where('name', $metalCat[0])->first();
            if(null !== $priceObj) {
                return  round(($priceObj->price*$metalCat[1]*$dwt*$qty), 2);
            }
        }
        return false;
    }

}
