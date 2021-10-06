<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class StorePaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
    	'key',
    	'secret',
    	'is_active',
    	'payment_gateway_id',
    	'store_id',
        'default_gateway',
        'is_test',
        'created_by'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }
}
