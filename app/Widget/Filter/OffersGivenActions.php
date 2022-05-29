<?php

namespace App\Widget\Filter;

class OffersGivenActions extends Select
{

    public function default($filters) {
        return [
            //'' => 'Choose Action'
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
                'value' => 5
            ],
            [
                'text' => 'Offer Declined',
                'value' =>  19
            ],
            [
                'text' => 'Declined - Send Back',
                'value' => 12
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
