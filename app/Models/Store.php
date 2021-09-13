<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Scopes\StoreScope;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 
    						'name', 
    						'slug', 
    						'name', 
    						'account_email',
    						'customer_email',
    						'business_email',
    						'address',
    						'address2',
    						'city',
    						'state',
    						'country_id',
    						'timezone',
    						'unit_id',
    						'default_weight_unit_id',
    						'currency_id',
    						'theme_id',
    						'is_active',
    						'meta_description',
    						'meta_title',
    						'phone',
    						'zip',
    						'store_domain',
    						'industry_id',
    						'order_id_suffix',
    						'order_id_prefix'
    					];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new StoreScope);
    // }

    public static function store()
    {
        $userId = Auth::user()->id;
        return static::where(['user_id' => $userId])
            ->get();
    }

    public function domains() {
    	return $this->hasMany(StoreDomain::class, 'store_id', 'id')->where('is_active', 1);
    }

    public function payment_gateways() {
        return $this->hasMany(StorePaymentGateway::class, 'store_id', 'id')->where('is_active', 1);
    }

    public function theme() {
        return $this->belongsTo(Theme::class, 'theme_id', 'id');
    }

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function weight() {
        return $this->belongsTo(Unit::class, 'default_weight_unit_id', 'id');
    }
}
