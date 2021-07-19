<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShippingProfilePrice extends Model
{
    use HasFactory;

    public function profile() {
    	return $this->belongsTo('App\OrderShippingProfile', 'order_shipping_profile_id', 'id');
    }
}
