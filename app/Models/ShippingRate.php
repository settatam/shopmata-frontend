<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'user_id', 'name', 'description'];

    public function conditions() {
    	return $this->hasMany(ShippingRateCondition::class);
    }
}
