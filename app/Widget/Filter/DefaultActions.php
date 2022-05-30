<?php

namespace App\Widget\Filter;

class DefaultActions extends Select
{

    public function default($filters) {
        return [
            '' => 'Choose Action'
        ];
    }

    public function selected()
    {
        return '';
    }

    public function attributes($filter) {
        return [
            'name' => 'actions',
            'value' => ''
        ];
    }

    public function data() {
        return [
            [
                'text' => 'Choose Action',
                'value' => ''
            ],
            [
                'text' => 'Rejected By Admin',
                'value' => 'Rejected By Admin'
            ],
            [
                'text' => 'Returned by Admin',
                'value' => 'Returned by Admin'
            ],
            [
                'text' => 'Send Offer',
                'value' => 'Send Offer'
            ],
            [
                'text' => 'Delete',
                'value' => 'Delete'
            ],
            
           
        ];
    }

    public function options($filters) {
        return array_merge(
            $this->default($filters),
            $this->data()
        );
    }
}
