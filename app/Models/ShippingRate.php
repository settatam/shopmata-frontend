<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'user_id', 'name', 'description', 'is_domestic', 'price', 'match_all_conditions'];

    public function profiles() {
    	return $this->hasMany(ShippingRateProfile::class);
    }

    public function conditions() {
    	return $this->hasMany(ShippingRateCondition::class);
    }
}
