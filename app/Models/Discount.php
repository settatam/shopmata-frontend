<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class Discount extends Model
{
    use HasFactory;

    public static $fixed = 'fixed';
    public static $percentage = 'percentage';
    public static $free_shipping = 'free shipping';

    protected $table = 'discounts';
    protected $fillable = ['store_id', 'status', 'type', 'active', 'discount', 'start_date', 'end_date', 'code', 'for_entire_order'];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    public function countries() {
    	return $this->hasMany(DiscountCountry::class);
    }

    public function products() {
    	return $this->hasMany(DiscountProduct::class);
    }

    public function categories() {
    	return $this->hasMany(DiscountCategory::class);
    }

    public function customers() {
    	return $this->hasMany(DiscountCustomer::class);
    }
}
