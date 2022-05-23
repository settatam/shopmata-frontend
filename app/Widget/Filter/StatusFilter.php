<?php

namespace App\Widget\Filter;

use App\Models\Status;

class StatusFilter extends Select
{

    public function default($filter) {
        return [
            [
                'text' => 'Choose Status',
                'value' => ''
            ]
        ];
    }

    public function selected()
    {
        return '';
    }

    public function attributes($filter)
    {
        return [
           'name' => 'status',
           'value' => data_get($filter, 'status')
        ];
    }

    public function data() {
        $statuses = Status::all();
        return $statuses->map(function(Status $status) {
            return [
                'text' => $status->name,
                'value' => $status->status_id
            ];
        })->toArray();
    }

    public function options($filter) {
        return array_merge(
            $this->default($filter),
            $this->data()
        );
    }

}
