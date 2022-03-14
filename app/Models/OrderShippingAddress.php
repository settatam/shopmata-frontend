<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShippingAddress extends Model
{
    use HasFactory;

    protected $fillable [
    	'first_name',
    	'last_name',
    	'address',
    	'address2',
    	'city',
    	'state_id',
    	'zip',
    ];
}
