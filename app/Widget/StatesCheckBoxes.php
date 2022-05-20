<?php

namespace App\Widget;

use App\Models\Transaction;

class StatesCheckBoxes extends CheckBox
{
    public function options($filter) {
        $states   =  Transaction::searchForFilter([])->withGroupedStates()->get();
        return $states->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => $transaction->name . ' - '  . ($transaction->stateCount),
                'value' => $transaction->state_id
            ];
        });
    }
}
