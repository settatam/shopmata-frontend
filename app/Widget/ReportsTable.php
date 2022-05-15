<?php

namespace App\Widget;

class ReportsTable extends Table
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
                'label' => 'Txn ID',
                'sortable' => true,
            ],
            [
                'key' => 'final_offer',
                'label' => 'Bought',
                'sortable' => true,
            ],
            [
                'key' => 'est_val',
                'label' => 'Estimated Value',
                'sortable' => true,
            ],
            [
                'key' => 'customer_name',
                'label' => 'Customer',
                'sortable' => true,
            ],
            [
                'key' => 'phone',
                'label' => 'Phone',
                'sortable' => true,
            ],
            [
                'key' => 'numberOfTransactions',
                'label' => '# of Trans',
                'sortable' => true,
            ],
            [
                'key' => 'Status',
                'label' => 'status',
                'sortable' => false,
            ],
            [
                'key' => 'customer_since',
                'label' => 'Customer Since',
                'sortable' => true,
            ],
            [
                'key' => 'keyword',
                'label' => 'Keyword',
                'sortable' => true,
            ],
            [
                'key' => 'lead',
                'label' => 'Lead',
                'sortable' => true,
            ],
            [
                'key' => 'website',
                'label' => 'Website',
                'sortable' => true,
            ],
            [
                'key' => 'tags',
                'label' => 'Tags',
                'sortable' => true,
            ],
            [
                'key' => 'incoming_fedex',
                'label' => 'Incoming Fedex',
                'sortable' => true,
            ],
            [
                'key' => 'outgoing_fedex',
                'label' => 'Outgoing Fedex',
                'sortable' => true,
            ],
        ];
    }

    public function data($filter=[]) {

        $this->data = Transaction::search($filter)
            ->with('transStatus')
            ->with('images')
            ->paginate(Filter::perPage($filter));

        return [
            'count' => data_get($this->data, 'perPage'),
            'total' => data_get($this->data, 'total'),
            'numberOfRows' => data_get($this->data, 'numberOfRows'),
            'items' => $this->data->map(function(Transaction $transaction) {
                return [
                    'id' => $transaction->id,
                    'created_at' => $transaction->created_at,
                    'status' => optional($transaction->transStatus)->name,
                    'description' => 'This is my test description',
                    'pictures' => $transaction->images,
                    'categories' => 'Category 1, Category 2',
                    'whatever' => 'This is whatever',
                    'customer_info' => $transaction->customer
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

    public function getCustomerHTMLInfo($customer) {
        return sprintf('<span class="pb-4 pt-6 px-6 flex flex-col">
                                    <span class="text-indigo-700 cursor-pointer font-bold">%s %s</span>
                                    <div>%s, %s</div>
                               </div>',
            $customer->first_name,
            $customer->last_name,
            $customer->address,
            $customer->state->code
        );
    }

    public function getPicturesHTML($images) {
        if(count($images)) {
            return sprintf('<div class="h-10 w-10 flex-shrink-0"><img class="h-10 w-10 rounded-full src="%s" /></div>',
            $images[0]->url);
        }
        return '';
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
