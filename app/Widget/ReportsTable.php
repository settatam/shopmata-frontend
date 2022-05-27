<?php

namespace App\Widget;

use App\Models\Transaction;
use App\Helpers\Filter;
use Numeral\Numeral;

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
                'key' => 'numberOfTransactions',
                'label' => '# of Trans',
                'sortable' => true,
            ],
            [
                'key' => 'status',
                'label' => 'Status',
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
                'key' => 'email',
                'label' => 'Email',
                'sortable' => true,
            ],
            [
                'key' => 'address',
                'label' => 'Street Address',
                'sortable' => true,
            ],
            [
                'key' => 'address2',
                'label' => 'Suite / Apt',
                'sortable' => true,
            ],
            [
                'key' => 'city',
                'label' => 'City',
                'sortable' => true,
            ],
            [
                'key' => 'state',
                'label' => 'State',
                'sortable' => true,
            ],
            [
                'key' => 'zip',
                'label' => 'Zip',
                'sortable' => true,
            ],
            [
                'key' => 'gender',
                'label' => 'Gender',
                'sortable' => true,
            ],
            [
                'key' => 'behavior',
                'label' => 'Behavior',
                'sortable' => true,
            ],
            [
                'key' => 'DOB',
                'label' => 'dob',
                'sortable' => true,
            ],
            [
                'key' => 'DIS',
                'label' => 'days_in_stock',
                'sortable' => true,
            ],
            [
                'key' => 'profit_percent',
                'label' => 'Profit Percent',
                'sortable' => true,
            ],
            [
                'key' => 'estimated_profit',
                'label' => 'Estimated Profit',
                'sortable' => true,
            ],
            [
                'key' => 'payment_type',
                'label' => 'Payment Type',
                'sortable' => true,
            ],
            [
                'key' => 'total_dwt',
                'label' => 'Total DWT',
                'sortable' => true,
            ],
            [
                'key' => 'inotes',
                'label' => 'INotes',
                'sortable' => true,
            ],
            [
                'key' => 'cnotes',
                'label' => 'Customer Notes',
                'sortable' => true,
            ],
        ];
    }

    public function data($filter=[]) {



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

    public function actions($filter) {
        return  [
            'Create Shipping Label',
            'Create Barcodes',
            'Delete',
            'Rejected By Admin'
        ];
    }

    public function isSearchable()
    {
         return true;
    }
}
