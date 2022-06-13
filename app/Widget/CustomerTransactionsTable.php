<?php

namespace App\Widget;

use App\Helpers\Filter;
use Illuminate\Support\Str;
use App\Models\Transaction;

class CustomerTransactionsTable extends Table
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
                'key' => 'price',
                'label' => 'Price',
                'sortable' => true,
                'html' => true
              ],
              [
                'key' => 'items',
                'label' => 'Items',
                'sortable' => true,
                'html' => true
              ],
            [
                'key' => 'payment_type',
                'label' => 'Payment Type',
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

        $this->data = Transaction::search($filter)
            ->with('status')
            ->with('images')
            ->paginate(Filter::perPage($filter));

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
                    'final_offer' => [
                        'data' => $transaction->final_offer,
                        ],
                    'items' => [
                            'data' => $transaction->numberOfItems,
                        ],
                    'payment_type' => [
                        'data' => $transaction->payment_type,
                        ],
                    'status' => [
                        'data' => $transaction->status->name,
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

    public function showPagination()
    {
        return false;
    }

}
