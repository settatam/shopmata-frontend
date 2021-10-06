<?php

namespace App\Models;

use App\Scopes\StoreScope;
use App\Models\ShippingProfilePrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingProfile extends Model
{
    use HasFactory;

    protected $fillable = [ 'store_id', 'profile','max_amount', 'name' ];

    protected static function booted() {
        static::addGlobalScope(new StoreScope);
    }

    public function prices()
    {
        return $this->hasMany(ShippingProfilePrice::class);
    }
}
