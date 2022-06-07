<?php

namespace App\Widget;

use App\Models\Transaction;

class TagsCheckBoxes extends CheckBox
{
    public function options($filter) {
       // $tags  = [];
       // return $tags->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => null,
                'value' => null
            ];
        //});
    }
}
