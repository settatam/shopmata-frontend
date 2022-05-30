<?php

namespace App\Widget;
use App\Models\Transaction;

class GenderCheckBoxes extends CheckBox
{
    public function options($filter) {
        $statuses = Transaction::searchForFilter($filter)->with('customer')->withGroupedGender()->get();
        return $statuses->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => $transaction->gender . ' - '  . ($transaction->genderCount),
                'value' => $transaction->gender
            ];
        });
    }
}
