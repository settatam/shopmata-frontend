<?php

namespace App\Widget;

use App\Models\Transaction;

class RepeatCustomerCheckBoxes extends CheckBox
{
    public function options($filter) {
        $repeatCustomerCount   = Transaction::searchForFilter($filter)->withGroupedRepeatCustomer(true)->count();
        $noRepeatCustomerCount = Transaction::searchForFilter($filter)->withGroupedRepeatCustomer(false)->count();

        return collect(
            [
                [
                'label' => 'Yes - ' . $repeatCustomerCount,
                'value' => 'Yes'
                ],
                [
                    'label' => 'No - ' . $noRepeatCustomerCount,
                    'value' => 'No'
                ],
            ]
        );
    }
}
