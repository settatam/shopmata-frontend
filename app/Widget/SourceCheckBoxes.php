<?php

namespace App\Widget;

use App\Models\Transaction;

class SourceCheckBoxes extends CheckBox
{
    public function options($filter) {
        $sources  = [];
       // return $sources->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => 0,
                'value' => 0
            ];
       // });
    }
}
