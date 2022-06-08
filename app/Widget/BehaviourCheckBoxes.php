<?php

namespace App\Widget;

use App\Models\Transaction;

class BehaviourCheckBoxes extends CheckBox
{
    public function options($filter) {
        $behavious  = [];
       // return $behavious->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => 0,
                'value' => 0
            ];
        //});
    }
}
