<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPaymentType extends Model
{
    use HasFactory;


    protected $fillable = [
        'name'
    ];

    const CHECK_ID = 1;

    public static $paymentTypes = [
        '1' => 'Check',
        '2' => 'PayPal',
        '3' => 'ACH',
        '4' => 'Venmo',
        '5' => 'Wire Transfer',
        '6' => 'Bank Transfer (Nigeria)',
        '7' => 'CashApp'
    ];






}



