<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPaymentType extends Model
{
    use HasFactory;

    public static $paymentTypes = [
        '1' => 'Check',
        '2' => 'Paypal',
        '3' => 'ACH',
        '4' => 'Venmo',
        '5' => 'Wire Transfer',
        '6' => 'Bank Transfer (Nigeria)',
        '7' => 'CashApp'
    ];
}
