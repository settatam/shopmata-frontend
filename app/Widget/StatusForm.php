<?php

namespace App\Widget;
use App\Widget\Filter\StatusFilter;

class StatusForm extends Form
{
    public function formGroups($filter)
    {
        return [
            [
                'label' => '',
                'field' => (new StatusFilter($filter))->render($filter)
            ]
        ];
    }

    public function buttons()
    {
        return [
            [
                'type' => 'button',
                'label' => 'Update Status',
                'classes' => '',
                'id' => ''
            ]
        ];
    }
}
