<?php

namespace App\Widget;

use App\Widget\StatusCheckBoxes;
use App\Widget\RepeatCustomerCheckBoxes;

class ReportFormGroup extends Form
{
    public function formGroups($filter)
    {
        return [
            [
                'label' => 'Status',
                'fields' => (new StatusCheckBoxes())->render($filter)
            ],
            [
                'label' => 'Repeat Customer',
                'fields' => (new RepeatCustomerCheckBoxes())->render($filter)
            ]
        ];
    }
}
