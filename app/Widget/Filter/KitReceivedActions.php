<?php

namespace App\Widget\Filter;

class KitReceivedActions extends Select
{

    public function default($filters) {
        return [
//            '' => 'Choose Action'
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
                'value' => 3
            ],
            [
                'text' => 'Returned by Admin',
                'value' => 24
            ],
            [
                'text' => 'Send Offer',
                'value' => 'Send Offer'
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
