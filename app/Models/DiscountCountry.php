<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCountry extends Model
{
    use HasFactory;

    protected $fillable = ['country_id','discount_id', 'user_id', 'deleted_at'];
}
