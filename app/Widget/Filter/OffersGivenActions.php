<?php

namespace App\Widget\Filter;

class OffersGivenActions extends Select
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
                'text' => 'Offer Accepted',
                'value' => 'Offer Accepted'
            ],
            [
                'text' => 'Offer Declined',
                'value' => 'Offer Declined'
            ],
            [
                'text' => 'Declined- Send Back',
                'value' => 'Declined- Send Back'
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
