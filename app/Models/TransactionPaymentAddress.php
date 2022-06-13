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


    public static function UpdateCustomerPayment($input, $customer_id) {
        $payment_type = TransactionPaymentType::where('name', $input['payment_method'])->first();
        $pA = TransactionPaymentAddress::where('customer_id', $customer_id)->first();
        self::updateOrCreate(
            ['customer_id' => $customer_id],  
            [ 
              'payment_type_id'       =>  null != $payment_type ? $payment_type->id : null,
              'paypal_address'        =>   $input['paypal_address'] ?? optional($pA)->paypal_address,
              'bank_name'             =>   $input['bank_name'] ?? optional($pA)->bank_name,
              'bank_address'          =>   $input['bank_address'] ?? optional($pA)->bank_address,            
              'bank_address_2'        =>   $input['bank_address_2'] ?? optional($pA)->bank_address_2,
              'bank_address_city'     =>   $input['bank_address_city'] ?? optional($pA)->bank_address_city,
              'bank_address_state_id' =>   $input['bank_address_state_id'] ?? optional($pA)->bank_address_state_id,
              'bank_address_zip'      =>   $input['bank_address_zip'] ?? optional($pA)->bank_address_zip,
              'routing_number'        =>   $input['routing_number'] ?? optional($pA)->routing_number,
              'account_number'        =>   $input['account_number'] ?? optional($pA)->account_number,
              'account_name'          =>   $input['account_name'] ?? optional($pA)->account_name,
              'account_type'          =>   $input['account_type'] ?? optional($pA)->account_type,
              'venmo_address'         =>   $input['venmo_address'] ?? optional($pA)->venmo_address,
              'check_name'            =>   $input['check_name'] ?? optional($pA)->check_name,
              'check_address'         =>   $input['check_address'] ?? optional($pA)->check_address,
              'check_city'            =>   $input['check_city'] ?? optional($pA)->check_city,
              'check_zip'             =>   $input['check_zip'] ?? optional($pA)->check_zip,
              'check_state_id'        =>   $input['check_state_id'] ?? optional($pA)->check_state_id,
            ]
        );

    }

}
