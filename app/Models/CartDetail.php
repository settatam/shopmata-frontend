<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $fillable = [ "sku", "cart_id", "price", "deleted_at", "quantity", "tracking_number", "shipping_status", "delivery_date", "shipping_carrier", "status"];

    public function variant() {
    	return $this->hasOne(ProductVariant::class, 'sku', 'sku');
    }
}
