<?php

namespace App\Widget\Filter;

class ReturnedbyAdminActions extends Select
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
                'text' => 'Returned By Admin',
                'value' => 'Returned By Admin'
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
