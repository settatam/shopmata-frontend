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
    const DEFAULT_SORTBY = 'id';
    const DEFAULT_SORT = 'desc';

    static function dates($params, $setDate = false, $range=self::DATE_7_DAYS, $timezone=self::DEFAULT_TIMEZONE)
    {
        $dates['to'] = data_get($params, 'date_to');
        $dates['from'] = data_get($params, 'date_from');

        if($dates['to'] && $dates['from']) return $dates;

        if(!$setDate) {
            if(!$dates['to'] && !$dates['from']) {
                return [
                    'from' => '1970-01-01',
                    'to' =>  now()->setTimezone($timezone)->endOfDay()->utc()->format('Y-m-d H:i:s')
                ];
            }

            if($dates['to'] && !$dates['from']) {
                return [
                    'from' => '1970-01-01 00:00:01',
                    'to' =>  $dates['to']
                ];
            }

            if(!$dates['to'] && $dates['from']) {
                return [
                    'from' => $dates['from'],
                    'to' => now()->setTimezone($timezone)->endOfDay()->utc()->format('c')
                ];
            }
        }


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

    static function stores($filter, $implode=false) {
        if($stores = data_get($filter, 'stores')) {
            if(!is_array($stores)) $stores = [$stores];
            return ($implode) ? implode(',', $stores) : $stores;
        }
        return null;
    }

    static function perPage($filter){
        return data_get($filter, 'per_page') ?? self::DEFAULT_PER_PAGE;
    }

    static function sortBy($filter) {
        return data_get($filter, 'sort_by') ?? self::DEFAULT_SORTBY;
    }

    static function sort($filter) {
        return data_get($filter, 'sort') ?? self::DEFAULT_SORT;
    }

    static function page($filter, $default = 1) {
        return data_get($filter, 'page') ?? $default;
    }

}
