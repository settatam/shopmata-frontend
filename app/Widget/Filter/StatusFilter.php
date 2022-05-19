<?php

namespace App\Widget\Filter;

use App\Models\Status;

class StatusFilter extends Select
{

    public function default() {
        return [
            'text' => 'Choose Status',
            'value' => ''
        ];
    }

    public function selected()
    {
        return '';
    }

    public function data() {
        $statuses = Status::all();
        return $statuses->map(function(Status $status) {
            return [
                'text' => $status->name,
                'value' => $status->id
            ];
        })->toArray();
    }

    public function options() {
        return array_merge(
            $this->default(),
            $this->data()
        );
    }

}
