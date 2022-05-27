<?php

namespace App\Widget;
use App\Widget\Filter\ReadyForMeltActions;

class ReadyForMelt extends Form
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
                'label' => '',
                'field' => (new ReadyForMeltActions())->render($filter)
            ]
        ];
    }
}
