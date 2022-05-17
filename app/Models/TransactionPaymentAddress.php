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


    public static function UpdateCustomerPayment($request, $customer_id) {
        $payment_type = TransactionPaymentType::where('name', $request->payment_method)->first();
        self::updateOrCreate(
            ['customer_id' => $customer_id],  
            [ 
              'payment_type_id'       =>  null != $payment_type ? $payment_type->id : null,
              'paypal_address'        =>  $request->paypal_address,
              'bank_name'             =>  $request->bank_name,
              'bank_address'          =>  $request->bank_address,
              'bank_address_2'        =>  $request->bank_address_2,
              'bank_address_city'     =>  $request->bank_address_city,
              'bank_address_state_id' =>  $request->bank_address_state_id,
              'bank_address_zip'      =>  $request->bank_address_zip,
              'routing_number'        =>  $request->routing_number,
              'account_number'        =>  $request->account_number,
              'account_name'          =>  $request->account_name,
              'account_type'          =>  $request->account_type,
              'venmo_address'         =>  $request->venmo_address,
              'check_name'            =>  $request->check_name,
              'check_address'         =>  $request->check_address,
              'check_city'            =>  $request->check_city,
              'check_zip'             =>  $request->check_zip,
              'check_state_id'        =>  $request->check_state_id,
            ]
        );

    }

}
