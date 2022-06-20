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

        'country',
        'state',
        'city',
        'is_default',
        'address',
        'address2',
        'zip',
        'country_id',
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
        'apt_suite',
        'street_address'
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

    public function getStreetAddressAttribute() {
        return $this->address;
    }

    public function checkAddressIsValid() {
        if(
            $this->address &&
            $this->state_id &&
            $this->city &&
            $this->zip
        ) return true;

        return false;

    }


    public function addFields($input) {
        return $address = [
            'first_name' => $input['first_name'],
            'last_name'  => $input['last_name'],
            'phone'      => $input['phone'],
            'state'      => isset($input['state']) ? $input['state'] : null,
            'state_id'   => isset($input['state_id']) ? $input['state_id'] : null,
            'country_id'   => isset($input['country_id']) ? $input['country_id'] : null,
            'city'       => $input['city'],
            'is_default' => 1,
            'address'    => $input['address'],
            'address2'   => $input['address2'],
            'zip'        => $input['zip'],
        ];
    }

}
