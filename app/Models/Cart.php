<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [ "user_id", "status", "expiry", "deleted_at", "discount_id", "shipping_profile_price_id", "shipping_address_id", "is_completed"];

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }
}
