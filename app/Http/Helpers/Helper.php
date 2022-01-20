<?php

namespace App\Http\Helpers;
use Carbon\Carbon;


class Helper
{

    public static function formatDate($date)
    {
        if ($date) {
            return Carbon::createFromDate($date);
        }
        return null;
    }
    
}



