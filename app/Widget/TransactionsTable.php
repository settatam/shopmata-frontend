<?php

namespace App\Widget;

use Illuminate\Support\Str;
use App\Models\Transaction;


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
                'label' => 'Date Requested',
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
                'key' => 'Categories',
                'label' => 'Misses',
                'sortable' => true,
                'html' => true
              ],
            [
                'key' => 'Whatever',
                'label' => 'whatever',
                'sortable' => true,
                'html' => true
              ],
              [
                'key' => 'Customer Info',
                'label' => 'customer_info',
                'sortable' => true,
                'html' => true
              ]
        ];
    }

    public function data() {

        $this->data = Transaction::search([])
            ->paginate(20);

        return [
            'count' => data_get($this->data, 'perPage'),
            'total' => data_get($this->data, 'total'),
            'numberOfRows' => data_get($this->data, 'numberOfRows'),
            'items' => $this->data->map(function(Transaction $transaction) {
                return [
                    'id' => $transaction->id,
                    'created_at' => $transaction->created_at,
                    'status' => 'Pending Kits',
                    'description' => 'This is my test description',
                    'categories' => 'Category 1, Category 2',
                    'whatever' => 'This is whatever',
                    'Customer Info' => 'This is the customer info you need to know'
                ];

            })
        ];
    }

    public function items() {
        return data_get($this->data(), 'items');
    }

    public function totalRows() {
        return $this->data->lastPage();
    }

    public function actions() {
        return  [
            'Create Shipping Label',
            'Create Barcodes',
            'Delete',
            'Rejected By Admin'
        ];
    }
}
