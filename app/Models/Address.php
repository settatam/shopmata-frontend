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

    protected $fillable = [
        'user_id',
        'country_id',
        'state_id',
        'city',
        'is_default',
        'address',
        'address2',
        'zip',
        'country',
        'state',
        'first_name',
        'last_name',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
