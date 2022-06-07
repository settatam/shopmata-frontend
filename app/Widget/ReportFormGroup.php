<?php

namespace App\Widget;

use App\Widget\StatusCheckBoxes;
use App\Widget\RepeatCustomerCheckBoxes;
use App\Widget\LeadTypeCheckBoxes;
use App\Widget\PaymentTypeCheckBoxes;
use App\Widget\BehaviourCheckBoxes;
use App\Widget\TagsCheckBoxes;
use App\Widget\SourceCheckBoxes;
use App\Widget\AgeCheckBoxes;
use App\Widget\DaysCheckBoxes;
use App\Widget\StatesCheckBoxes;
use App\Widget\GenderCheckBoxes;
use App\Widget\TimesCheckBoxes;




class ReportFormGroup extends Form
{
    public function formGroups($filter)
    {
        return [
            [
                'name' => 'status',
                'label' => 'Status',
                'fields' => (new StatusCheckBoxes())->render($filter)
            ],
            [
                'name' => 'repeat_customer',
                'label' => 'Repeat Customer',
                'fields' => (new RepeatCustomerCheckBoxes())->render($filter)
            ],
            [
                'name' => 'gender',
                'label' => 'Gender',
                'fields' => (new GenderCheckBoxes())->render($filter)
            ],
            [
                'name' => 'lead',
                'label' => 'Lead Type',
                'fields' => (new LeadTypeCheckBoxes())->render($filter)
            ],
            [
                
                'name' => 'payment_type',
                'label' => 'Payment Type',
                'fields' => (new PaymentTypeCheckBoxes())->render($filter)
            ],
            [
                 'name' => 'behaviour',
                 'label'  => 'Behaviour',
                 'fields' => (new BehaviourCheckBoxes())->render($filter)
            ],
            [   
                'name' => 'tags',
                'label' => 'Tags',
                'fields' => (new TagsCheckBoxes())->render($filter)
            ],
            [   
                'name' => 'source',
                'label' => 'Source',
                'fields' => (new SourceCheckBoxes())->render($filter)
            ],
            [   
                'name' => 'age',
                'label' => 'Age',
                'fields' => (new AgeCheckBoxes())->render($filter)
            ],
            [
                'name'   => 'days',
                'label'  => 'Days',
                'fields' => (new DaysCheckBoxes())->render($filter)
            ],
            [
                'name'   => 'times',
                'label'  => 'Times',
                'fields' => (new TimesCheckBoxes())->render($filter)
            ],
            [
                'name' => 'states',
                'label' => 'States',
                'fields' => (new StatesCheckBoxes())->render($filter)
            ]
        ];
    }
}
