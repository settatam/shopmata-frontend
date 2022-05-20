<?php

namespace App\Widget;

use App\Models\Transaction;

class StatusCheckBoxes extends CheckBox
{
    public function options($filter) {
        $statuses = Transaction::searchForFilter($filter)->with('trStatus')->whereNotNUll('status_id')->withGroupedStatus()->get();
        return $statuses->map(function (Transaction $transaction) use ($filter) {
            return [
                'label' => $transaction->trStatus->name . ' - '  . ($transaction->statusCount),
                'value' => $transaction->transStatus->id
            ];
        });
    }
}
