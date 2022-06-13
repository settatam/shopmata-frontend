<?php

namespace App\Widget\Filter;

class DeclinedTransactionsActions extends Select
{
    public function default($filters) {
        return [];
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
                'text' => 'Declined - Send Back',
                'value' => 12
            ],
            [
                'text' => 'Offer Accepted',
                'value' => 5
            ],
            [
                'text' => 'Create Return Label',
                'value' => 'Create Return Label'
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
