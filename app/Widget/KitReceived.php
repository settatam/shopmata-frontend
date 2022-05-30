<?php

namespace App\Widget;
use App\Widget\Filter\KitReceivedActions;

class KitReceived extends Form
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
                'field' => (new KitReceivedActions())->render($filter)
            ]
        ];
    }
}
