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
        'country',
        'state',
        'city',
        'is_default',
        'address',
        'address2',
        'postal_code',
        'country',
        'state',
        'first_name',
        'last_name',
        'addressable_type',
        'addressable_id',
        'nickname',
        'extension',
        'store_id',
        'dob',
        'state_id'
    ];


    public function addressable()
    {
        return $this->morphTo();
    }
}
