<?php

namespace App\Widget;

use App\Models\Transaction;

class PaymentTypeCheckBoxes extends CheckBox
{
    public function options($filter) {
        $payment_types  = Transaction::withGroupedPaymentTypes()->get();
        return $payment_types->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => $transaction->name . ' - '  . ($transaction->paymentCount),
                'value' => $transaction->payment_type_id
            ];
        });
    }
}
