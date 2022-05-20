<?php

namespace App\Widget;

use App\Models\Transaction;

class StatusCheckBoxes extends CheckBox
{
    public function options($filter) {
        $statuses = Transaction::searchForFilter($filter)->with('trStatus')->whereNotNull('status_id')->withGroupedStatus()->get();
        return $statuses->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => optional($transaction->trStatus)->name . ' - '  . ($transaction->statusCount),
                'value' => optional($transaction->transStatus)->id
            ];
        });
    }

}
