<?php

namespace App\Widget;

use App\Models\Activity;

class TransactionActionsTable extends Table
{
    protected $hasCheckBox = true;

    protected $title = '';

    public function __construct($filter = null, $data = [])
    {
        parent::__construct($filter, $data);
    }

    public function fields() {
        return [
              [
                'key' => 'id',
                'label' => 'ID',
                'html' => true,
                'sortable' => true,
              ],
              [
                'key' => 'created_at',
                'label' => 'Date',
                'sortable' => true,
                'html' => true
              ],
              [
                'key' => 'agent',
                'label' => 'Agent',
                'sortable' => true,
                'html' => true
              ],
              [
                'key' => 'communication',
                'label' => 'Communication',
                'sortable' => true,
                'html' => true
              ],
            [
                'key' => 'offer',
                'label' => 'Offer',
                'sortable' => true,
                'html' => true
              ],
              [
                'key' => 'Status',
                'label' => 'status',
                'sortable' => false,
                'html' => true
              ],
        ];
    }

    public function hasCheckBox()
    {
        return false;
    }

    public function data($filter=[]) {

        $this->data = Activity::where('activityable_id', $filter['transaction_id'])
                ->orderBy('id', 'desc')
                ->paginate(100);

        return [
            'count' => data_get($this->data, 'perPage'),
            'total' => data_get($this->data, 'total'),
            'numberOfRows' => data_get($this->data, 'numberOfRows'),
            'items' => $this->data->map(function(Activity $activity) {
                return [
                    'id' => [
                        'data' => $activity->name,
                        ],
                    'created_at' => [
                            'data' => $activity->created_at
                        ],
                    'agent' => [
                        'data' => $activity->agent,
                        ],
                    'communication' => [
                            'data' => $activity->notes,
                        ],
                    'offer' => [
                        'data' => '',
                        ],
                    'status' => [
                        'data' => $activity->status,
                    ],

                ];
            })
        ];
    }

    public function items($filter) {
        return data_get($this->data($filter), 'items');
    }

    public function totalRows() {
        return $this->data->lastPage();
    }

    public function isSearchable()
    {
        return false;
    }

}
