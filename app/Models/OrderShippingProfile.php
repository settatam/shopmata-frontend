<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class OrderShippingProfile extends Model
{
    use HasFactory;

    protected static function booted() {
        static::addGlobalScope(new StoreScope);
    }

    public function price_profiles() {
    	return $this->hasMany(OrderShippingProfilePrice::class);
    }
}
