<?php

namespace App\Widget;

use App\Models\Transaction;

class DaysCheckBoxes extends CheckBox
{
    public function options($filter) {
        $days =  Transaction::searchForFilter([])->withGroupedDates()->get();
        return $days->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => $transaction->day . ' - '  . ($transaction->dayCount),
                'value' => null
            ];
        });
    }
}
