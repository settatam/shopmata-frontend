<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    const SHIPPING_ADDRESS_TYPE = 'shipping';
    const BILLING_ADDRESS_TYPE  = 'billing';
    const LOCATION_ADDRESS_TYPE = 'location';

    protected $fillable = [
        'user_id',
        'country',
        'state',
        'city',
        'is_default',
        'address',
        'address2',
        'zip',
        'country',
        'first_name',
        'last_name',
        'addressable_type',
        'addressable_id',
        'nickname',
        'extension',
        'store_id',
        'dob',
        'state_id',
        'phone'
    ];

    protected $appends = [
        'apt_suite'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function state() {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function getAptSuiteAttribute() {
        return $this->address2;
    }

    public function checkAddressIsValid() {
        if(
            $this->address &&
            $this->city &&
            $this->state_id &&
            $this->city &&
            $this->zip
        ) return true;

        return false;

    }

}
