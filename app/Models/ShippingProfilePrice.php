<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class ShippingProfilePrice extends Model
{
    use HasFactory;

    protected $fillable = [ 'shipping_profile_id', 'min_weight', 'max_weight', 'min_amount',	'max_amount', 'description', 'price' ];

    protected static function booted() {
        static::addGlobalScope(new StoreScope);
    }
}
