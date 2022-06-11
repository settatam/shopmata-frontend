<?php

namespace App\Widget;
use App\Widget\Filter\DeclinedTransactionsActions;

class OffersDeclined extends Form
{
    public function shouldConfirm()
    {
        return true;
    }

    public function name() {
        return 'transaction-actions';
    }

    public function formGroups($filter)
    {
        return [
            [
                'field' => (new DeclinedTransactionsActions())->render($filter)
            ]
        ];
    }
}
