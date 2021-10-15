<?php

namespace App\Models;

use App\Scopes\StoreScope;
use App\Models\ShippingProfilePrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingProfile extends Model
{
    use HasFactory;

    protected $fillable = [ 'store_id', 'name', 'price', 'description' ];

    protected static function booted() {
        static::addGlobalScope(new StoreScope);
    }

    public function prices()
    {
        return $this->hasMany(ShippingProfilePrice::class);
    }
}
