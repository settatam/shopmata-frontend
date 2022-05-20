<?php

namespace App\Widget;
use App\Models\Transaction;

class GenderCheckBoxes extends CheckBox
{
    public function options($filter) {
        $statuses = Transaction::searchForFilter($filter)->with('customer')->withGroupedGender()->get();
        return $statuses->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => optional($transaction->customer)->gender . ' - '  . ($transaction->genderCount),
                'value' => optional($transaction->customer)->gender
            ];
        });
    }
}
