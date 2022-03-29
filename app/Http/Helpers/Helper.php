<?php

namespace App\Http\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;



class Helper
{

    public static function formatDate($date)
    {
        if ($date) {
            return Carbon::createFromDate($date);
        }
        return null;
    }


    public static function generateSlug($str){
        return str_replace(" ","-", $str);
    }


    public  static function getApiData($url)
    {
        $response = Http::get($url);
        $data = $response->body();
        if($data = json_decode($data, true)) { 
            return $data;
        }
        return null;
    }
    
}



