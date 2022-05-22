<?php

namespace App\Widget;

use App\Helpers\Filter;
use Illuminate\Support\Str;
use App\Models\Transaction;
use App\Widget\Filter\StatusFilter;
use App\Widget\Filter\PendingKitActions;
use App\Widget\PendingKit;
use App\Widget\StatusForm;


class TransactionsTable extends Table
{
    protected $hasCheckBox = true;

    protected $title = 'Transactions';

    public function __construct($filter = null, $data = [])
    {
        parent::__construct($filter, $data);
    }

    public function fields($filter=null) {
        $items = [
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
                'key' => 'status',
                'label' => 'Status',
                'sortable' => true,
                'html' => true
              ],
              [
                'key' => 'description',
                'label' => 'Description',
                'sortable' => true,
                'html' => true
              ],
        ];

        $extras = [];
        if($status = data_get($filter, 'status')) {
            switch($status) {
                case 60:
                case 3:
                case 1:
                    $extras = [
                         [
                            'key' => 'pictures',
                            'label' => 'Pictures',
                            'sortable' => true,
                            'html' => true
                        ],

                        [
                            'key' => 'message',
                            'label' => 'Message',
                            'sortable' => true,
                            'html' => true
                        ],

                        [
                            'key' => 'Categories',
                            'label' => 'Categories',
                            'sortable' => false,
                            'html' => true
                        ],
                        [
                            'key' => 'customer_info',
                            'label' => 'Customer Info',
                            'sortable' => true,
                            'html' => true
                        ]
                    ];
                    break;
                case 2:
                    $extras = [
                         [
                            'key' => 'pictures',
                            'label' => 'Pictures',
                            'sortable' => true,
                            'html' => true
                        ],

                        [
                            'key' => 'message',
                            'label' => 'Message',
                            'sortable' => true,
                            'html' => true
                        ],

                        [
                            'key' => 'Categories',
                            'label' => 'Categories',
                            'sortable' => false,
                            'html' => true
                        ],
                        [
                            'key' => 'customer_info',
                            'label' => 'Customer Info',
                            'sortable' => true,
                            'html' => true
                        ],
                        [
                            'key' => 'outbound_tracking',
                            'label' => 'Outbound Tracking',
                            'sortable' => true,
                            'html' => true
                        ],
                        [
                            'key' => 'inbound_tracking',
                            'label' => 'Inbound Tracking',
                            'sortable' => true,
                            'html' => true
                        ],
                        [
                            'key' => 'bin_location',
                            'label' => 'Bin Location',
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
                            'key' => 'estimated_value',
                            'label' => 'Estimated Value',
                            'sortable' => true,
                            'html' => true
                        ],
                    ];

                    break;
            }
        }

        return array_merge($items, $extras);

    }

    public function data($filter=[]) {

        $this->data = Transaction::with('transStatus')
            ->with('images')
            ->with('trStatus')
            ->orderBy('id', 'desc')
            ->paginate(Filter::perPage($filter))
            ->withQueryString();

        return [
            'count' => data_get($this->data, 'perPage'),
            'total' => data_get($this->data, 'total'),
            'numberOfRows' => data_get($this->data, 'numberOfRows'),
            'items' => $this->data->map(function(Transaction $transaction) use ($filter) {
                $extras = [];
                $mains = [
                    'id' => [
                        'data' => $transaction->id,
                        'type' => 'link',
                        'href' => '/admin/transactions/'.$transaction->id,
                        'classes' => 'font-bold text-indigo-800'
                    ],
                    'created_at' => [
                            'data' => $transaction->created_date,
                            'class' => 'w-24'
                        ],
                    'status' => [
                        'data' => optional($transaction->trStatus)->name,
                        'class' => 'w-24'
                        ],
                    'description' => [
                            'type' => 'description',
                            'data' => $transaction->comments,
                        ],
                    'pictures' => [
                        'data' => $transaction->images,
                        'type' => 'slideshow'
                    ],
                ];

                if($status = data_get($filter, 'status')) {
                    switch ($status) {
                        case 60:
                        case 3:
                        case 1:
                            $extras = [
                                'message' => [
                                        'data' => 'This is a messager',
                                ],
                                'categories' => [
                                    'data' => $transaction->customer_categories,
                                ],
                                'customer_info' => [
                                    'data' => $transaction->customer,
                                    'type' => 'customer_info',
                                    'href' => '/admin/customers/'.$transaction->customer->id
                                ]
                            ];
                            break;
                        case 2:
                            $extras =[
                                'message' => [
                                        'data' => 'This is a messager',
                                ],
                                'categories' => [
                                    'data' => $transaction->customer_categories,
                                ],
                                'customer_info' => [
                                    'data' => $transaction->customer,
                                    'type' => 'customer_info',
                                    'href' => '/admin/customers/'.$transaction->customer->id
                                ],
                                'outbound_tracking' => [
                                    'data' => $transaction->outgoing_tracking
                                ],
                                'inbound_tracking' => [
                                    'data' => $transaction->incoming_tracking
                                ],
                                'bin_location' => [
                                    'data' => 'Bin Location'
                                ],
                                'offer' => [
                                    'data' => $transaction->offer
                                ],
                                'estimated_value' => [
                                    'data' => $transaction->est_val
                                ],
                            ];
                        }
                    }
                return array_merge($mains, $extras);

            })
        ];
    }

    public function items($filter) {
        return data_get($this->data($filter), 'items');
    }

    public function totalRows() {
        return $this->data->lastPage();
    }

    public function actions($filter) {
        //should have data, action, type, and so on
        return  [
            (new PendingKit())->render($filter),
            (new StatusForm())->render($filter)
        ];
    }

    public function exportable($filter, $filteredData) {
        return true;
    }

    public function isSearchable()
    {
        return true;
    }

    public function shouldChangeStatus()
    {
        return false;
    }
}
