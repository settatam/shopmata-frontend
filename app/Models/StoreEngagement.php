<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Browser;
use Auth;
use Customer;

class StoreEngagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_agent',
        'is_mobile',
        'is_tablet',
        'is_desktop',
        'browser_name',
        'browser_version',
        'platform',
        'platform_version',
        'device_family',
        'device_version',
        'user_id', // Check if logged in as user
        'customer_id', // Check if logged in as user
        'ip_address', // $request->ip()
        'store_id',
        'engageable_type',
        'engageable_id'
    ];


    public static function createOrUpdate($data, $id = null) {
       return self::updateOrCreate(
            ['id' => $id],
            $data
        );
    }


    public static function fields ($ip, $store_id) {
       return $data =  [
            'user_agent' => Browser::userAgent(),
            'is_mobile'  => Browser::isMobile(),
            'is_tablet'        => Browser::isTablet(),
            'is_desktop'       => Browser::isDesktop(),
            'browser_name'     => Browser::browserName(),
            'browser_version'  => Browser::browserVersion(),
            'platform'         => Browser::platformName(),
            'platform_version' => Browser::platformVersion(),
            'device_family'    => Browser::deviceFamily(),
            'engageable_type' => Customer::class,
            'engageable_id' => Auth::check() ? Auth::id() : null,
            'ip_address' => $ip,
            'store_id' => $store_id,
        ];
    }

}
