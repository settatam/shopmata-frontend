<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'store_id',
        'country',
        'state',
        'phone',
        'city',
        'first_name',
        'last_name',
        'phone',
        'address',
        'address2',
        'accepts_marketing',
        'is_active',
        'zip'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function store_users()
    {
        return $this->hasMany(StoreUser::class);
    }

    public function shipping_addresses()
    {
        return $this->hasMany(ShippingAddress::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }
}
