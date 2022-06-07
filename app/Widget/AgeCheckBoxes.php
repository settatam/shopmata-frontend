<?php

namespace App\Widget;

use App\Models\Transaction;

class AgeCheckBoxes extends CheckBox
{
    public function options($filter) {
       // $ages  = [];
       // return $ages->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => null,
                'value' => null
            ];
       // });
    }
}
