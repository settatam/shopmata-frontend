<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'tracking_number',
        'raw_data',
        'shippable_id',
        'shippable_type',
        'shipping_company_id',
        'is_return',
        'status',
        'to_customer',
        'tracking_info'
    ];

    public function shippable()
    {
        return $this->morphTo();
    }


}
