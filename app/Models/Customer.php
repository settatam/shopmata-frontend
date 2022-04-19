<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $appends = ['activation_status'];

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
        'zip',
        'password'
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function public_note()
    {
        return $this->hasOne(TransactionNote::class)->where('type','public');
    }


    public function private_note()
    {
        return $this->hasOne(TransactionNote::class)->where('type','private');
    }


    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getActivationStatusAttribute()
    {
        return 'Email Sent';
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function store_users()
    {
        return $this->hasMany(StoreUser::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class,'user_id','id');
    }


    public function state()
    {
        return $this->belongsTo(State::class);
    }


    public function shipping_addresses()
    {
        return $this->hasMany(ShippingAddress::class, 'user_id', 'id');
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeWithTotalOrders($query, $customer_id){
        return $query->addSelect(['total_orders'=>Order::selectRaw('sum(total) as total_orders')
            ->where('customer_id', $customer_id)
        ]);
    }


    
}
