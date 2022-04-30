<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use App\Models\Customer;

class Filter
{

    const DATE_7_DAYS = '7 Days';
    const DATE_30_DAYS = '1 month';
    const DATE_6_MONTHS = '6 months';
    const DATE_1_YEAR = '1 year';
    const DEFAULT_TIMEZONE = 'America/New_York';
    const DEFAULT_PER_PAGE = 25;

    static function dates($params, $range=self::DATE_7_DAYS, $timezone=self::DEFAULT_TIMEZONE)
    {
        $dates['to'] = data_get($params, 'date_to');
        $dates['from'] = data_get($params, 'date_from');

        if($dates['to'] && $dates['from']) return $dates;

        switch ($range) {
            case self::DATE_7_DAYS:
                return self::getDefault7Days($timezone);
                break;
            case self::DATE_30_DAYS:
                return self::getDefault30Days($timezone);
                break;
            case self::DATE_6_MONTHS:
                return self::getDefault6Months($timezone);
                break;
            case self::DATE_1_YEAR:
                return self::getDefault1Year($timezone);
                break;
        }

    }

    static function getDefault7Days($timezone) {
        return [
          'from' => now()->setTimezone($timezone)->startOfDay()->addDays(-7)->utc()->format('c'),
          'to' => now()->setTimezone($timezone)->endOfDay()->utc()->format('c'),
        ];
    }

    static function getDefault30Days($timezone) {
        return [
          'from' => now()->setTimezone($timezone)->startOfDay()->addDays(-30)->utc()->format('c'),
          'to' => now()->setTimezone($timezone)->endOfDay()->utc()->format('c'),
        ];
    }

    static function getDefault6Months($timezone) {
        return [
          'from' => now()->setTimezone($timezone)->startOfDay()->addDays(-180)->utc()->format('c'),
          'to' => now()->setTimezone($timezone)->endOfDay()->utc()->format('c'),
        ];
    }

    static function getDefault1Year($timezone) {
        return [
          'from' => now()->setTimezone($timezone)->startOfDay()->addDays(-365)->utc()->format('c'),
          'to' => now()->setTimezone($timezone)->endOfDay()->utc()->format('c'),
        ];
    }

    static function isValidToFromDate($dates) {

    }

    static function perPage($filter){
        return data_get($filter, 'per_page') ?? self::DEFAULT_PER_PAGE;
    }

}
