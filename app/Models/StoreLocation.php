<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class StoreLocation extends Model
{
    use HasFactory;

    protected $fillable = [
    	'address',
    	'address2',
    	'postal_code',
    	'city',
    	'state_id',
    	'country_id',
    	'store_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }
}
