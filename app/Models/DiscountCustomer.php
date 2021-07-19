<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCustomer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','discount_id', 'user_id', 'deleted_at'];
}
