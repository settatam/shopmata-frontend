<?php

namespace App\Widget;

use App\Models\Transaction;

class DaysCheckBoxes extends CheckBox
{
    public function options($filter) {
       // $days =  [];
       // return $days->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => null,
                'value' => null
            ];
       // });
    }
}
