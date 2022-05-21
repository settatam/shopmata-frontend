<?php

namespace App\Widget;

use App\Widget\StatusCheckBoxes;
use App\Widget\RepeatCustomerCheckBoxes;
use App\Widget\LeadTypeCheckBoxes;
use App\Widget\PaymentTypeCheckBoxes;
//use App\Widget\BehaviourCheckBoxes;
//use App\Widget\TagsCheckBoxes;
//use App\Widget\SourceCheckBoxes;
use App\Widget\AgeCheckBoxes;
use App\Widget\DaysCheckBoxes;
use App\Widget\StatesCheckBoxes;




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
            ],
            [
                'label' => 'Gender',
                'fields' => (new GenderCheckBoxes())->render($filter)
            ],
            [
                'label' => 'Lead Type',
                'fields' => (new LeadTypeCheckBoxes())->render($filter)
            ],
            [
                'label' => 'Payment Type',
                'fields' => (new PaymentTypeCheckBoxes())->render($filter)
            ],
            [
                 'label' => 'Behaviour',
                 'fields' => (new BehaviourCheckBoxes())->render($filter)
            ],
            // [
            //     'label' => 'Tags',
            //     'fields' => (new TagsCheckBoxes())->render($filter)
            // ],
            // [
            //     'label' => 'Source',
            //     'fields' => (new SourceCheckBoxes())->render($filter)
            // ],
            // [
            //     'label' => 'Age',
            //     'fields' => (new AgeCheckBoxes())->render($filter)
            // ],
            [
                'label' => 'Days',
                'fields' => (new DaysCheckBoxes())->render($filter)
            ],
            [
                'label' => 'States',
                'fields' => (new StatesCheckBoxes())->render($filter)
            ]
        ];
    }
}
