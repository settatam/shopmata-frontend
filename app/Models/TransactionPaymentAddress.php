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
        'bank_name',
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
        'check_zip',
        'check_country',
        'customer_id'
    ];

    public function payment_type()
    {
        return $this->belongsTo(TransactionPaymentType::class,'payment_type_id','id');
    }


    public function state()
    {
        return $this->belongsTo(State::class,'check_state_id','id');
    }


    public static function UpdateCustomerPayment($input, $transaction_id) {
        $payment_type = TransactionPaymentType::where('name', $input['payment_method'])->first();
        $input['payment_type_id'] = null != $payment_type ? $payment_type->id : null;
        self::doUpdate($transaction_id,  $input);
    }


    public static function doUpdate($transaction_id,  $data) {
        $paymentInfo = self::firstOrNew(
            ['transaction_id' => $transaction_id],
            $data
        );

        $paymentInfo->save();
    }

}
