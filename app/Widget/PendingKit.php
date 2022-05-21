<?php

namespace App\Widget;
use App\Widget\Filter\PendingKitActions;

class PendingKit extends Form
{
    public function shouldConfirm()
    {
        return true;
    }

    public function formGroups($filter)
    {
        return [
            [
                'label' => '',
                'field' => (new PendingKitActions())->render($filter)
            ]
        ];
    }
}
