<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPaymentAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'payment_type_id',
        'paypal_address',
        'bank_address',
        'bank_address_2',
        'bank_address_city',
        'bank_address_state_id',
        'bank_address_zip',
        'routing_number',
        'account_number',
        'account_name',
        'account_type',
        'venmo_address',
        'check_name',
        'check_address',
        'check_address_2',
        'check_city',
        'check_state_id',
        'check_country'
    ];

    public function transaction_payment_type() 
    {
        return $this->belongsTo(TransactionPaymentType::class);
    }

}
