<?php

namespace App\Http\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\Store;
use App\Models\State;

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

    public static function getApiData($url)
    {
        $response = Http::get($url);
        $data = $response->body();
        if($data = json_decode($data, true)) {
            return $data;
        }
        return null;
    }

    public static function getStoreByName($value)
    {

        $store = Store::where('name',$value)->first();

        if ($store) {
            return $store->id;
        }

        return null;
    }


    static function getStateId($state_abreviation)
    {
        $state = State::where('code', $state_abreviation)->first();
        return null !== $state ? $state->id : null;
    }

}



