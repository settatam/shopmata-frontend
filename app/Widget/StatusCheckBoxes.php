<?php

namespace App\Widget;

use App\Models\Transaction;

class StatusCheckBoxes extends CheckBox
{
    public function options($filter) {
        $statuses = Transaction::searchForFilter($filter)->whereHas('trStatus')->with('trStatus')->whereNotNull('status_id')->withGroupedStatus()->get();
        return $statuses->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => optional($transaction->trStatus)->name . ' - '  . ($transaction->statusCount),
                'value' => optional($transaction->transStatus)->id
            ];
        });
    }

    public function name() {
        return 'status';
    }

}
