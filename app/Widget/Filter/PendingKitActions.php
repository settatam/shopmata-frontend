<?php

namespace App\Widget\Filter;

class PendingKitActions extends Select
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
                'text' => 'Create Shipping Label',
                'value' => 'Create Shipping Label'
            ],
            [
                'text' => 'Create Barcodes',
                'value' => 'Create Barcodes'
            ],
            [
                'text' => 'Rejected By Admin',
                'value' => 'Rejected By Adminn'
            ],
            [
                'text' => 'Delete',
                'value' => 'Delete'
            ],
            [
                'text' => 'Send Message',
                'value' => 'Send Message'
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
