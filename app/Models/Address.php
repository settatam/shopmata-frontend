<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    const SHIPPING_ADDRESS_TYPE = 'shipping';
    const BILLING_ADDRESS_TYPE = 'billing';
    const LOCATION_ADDRESS_TYPE = 'location';

    public function addressable()
    {
        return $this->morphTo();
    }

}
