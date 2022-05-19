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
    }

    public function data($filter=[]) {

        $this->data = Transaction::search($filter)
            ->with('transStatus')
            ->with('images')
            ->paginate(Filter::perPage($filter))->withQueryString();

        return [
            'count' => data_get($this->data, 'perPage'),
            'total' => data_get($this->data, 'total'),
            'numberOfRows' => data_get($this->data, 'numberOfRows'),
            'items' => $this->data->map(function(Transaction $transaction) {
                return [
                    'id' => [
                        'data' => $transaction->id,
                        'type' => 'link',
                        'href' => '/admin/transactions/'.$transaction->id

                        ],
                    'created_at' => [
                            'data' => $transaction->created_at
                        ],
                    'status' => [
                        'data' => optional($transaction->transStatus)->name,
                        ],
                    'description' => [
                            'data' => $transaction->comments,
                        ],
                    'pictures' => [
                        'data' => $transaction->images,
                        'type' => 'slideshow'
                        ],
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
