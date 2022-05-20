<?php

namespace App\Widget\Filter;

class PendingKitActions extends Select
{
    public function default() {
        return [
            '' => 'Choose Action'
        ];
    }

    public function selected()
    {
        return '';
    }

    public function attributes() {
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
        ];
    }

    public function options() {
        return array_merge(
            $this->default(),
            $this->data()
        );
    }
}
