<?php

namespace App\Widget;
use App\Widget\Filter\KitReceivedRefusedbyCustomerFedexActions;

class KitReceivedRefusedbyCustomerFedex extends Form
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
                'field' => (new KitReceivedRefusedbyCustomerFedexActions())->render($filter)
            ]
        ];
    }
}
