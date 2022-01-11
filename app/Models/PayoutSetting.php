<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PayoutSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =  [
        'store_id',        
        'account_number',
        'routing_number',
        'account_name',
        'bank_name',
        'payout_schedule',
    ];
}
