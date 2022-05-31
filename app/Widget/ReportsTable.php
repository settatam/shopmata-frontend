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

        $this->data = Transaction::search($filter)
            ->with('transStatus')
            ->with('address')
            ->with('images')
            ->with('trStatus')
            ->with('customer')
            ->with('store')
            ->withFinalOffer()
            ->withEstValue()
            ->withTotalDwt()
            ->withLabelsFrom()
            ->withLabelsTo()
            ->withPrivateNote()
            ->withPublicNote()
            ->withPaymentType()
            ->withStatusDateTime()
            ->withReceivedDateTime()
            ->withPaymentDateTime()
            ->with('payment')
            ->paginate(Filter::perPage($filter))
            ->withQueryString();

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
                    'final_offer' => [
                        'data' => Numeral::number($transaction->offer)->format('$0.0'),
                    ],
                    'est_val' => [
                        'data' => Numeral::number($transaction->est_value)->format('$0.0'),
                    ],
                    'numberOfTransactions' => [
                        'data' => $transaction->customer->transaction_count,
                    ],
                    'status' => [
                        'data' => optional($transaction->trStatus)->name,
                    ],
                    'customer_since' => [
                        'data' => $transaction->customer->created_at,
                        'class' => 'block w-24'
                    ],
                    'keyword' => [
                        'data' => $transaction->keyword,
                    ],
                    'lead' => [
                        'data' => $transaction->lead,
                    ],
                    'website' => [
                        'data' => optional($transaction->store)->name,
                    ],
                    'tags' => [
                        'data' => $transaction->tags,
                    ],
                    'incoming_fedex' => [
                        'data' => $transaction->incoming_tracking,
                    ],
                    'outgoing_fedex' => [
                        'data' => $transaction->outgoing_tracking,
                    ],
                    'customer_info' => [
                        'data' => optional($transaction->customer)->name,
                        'type' => 'link',
                        'href' => '/admin/customers/'.$transaction->customer->id,
                        'class' => 'block w-48'
                    ],
                    'phone' => [
                        'data' => optional($transaction->customer)->phone_number,
                    ],
                    'email' => [
                        'data' => optional($transaction->customer)->email,
                    ],
                    'address' => [
                        'data' => optional(optional($transaction->customer)->address)->address,
                    ],
                    'address2' => [
                        'data' => optional(optional($transaction->customer)->address)->address2,
                    ],
                    'city' => [
                        'data' => optional(optional($transaction->customer)->customer_address)->city,
                    ],
                    'state' => [
                        'data' => optional(optional($transaction->customer)->address)->state
                    ],
                    'zip' => [
                        'data' => optional(optional($transaction->customer)->customer_address)->postal_code,
                    ],
                    'gender' => [
                        'data' => $transaction->customer->gender,
                    ],
                    'behavior' => [
                        'data' => optional(optional(optional($transaction->customer)->behavior)->tag)->name,
                    ],
                    'dob' => [
                        'data' => optional($transaction->customer)->dob,
                    ],
                    'dis' => [
                        'data' => $transaction->days_in_stock,
                    ],
                    'profit_percent' => [
                        'data' => $transaction->percentage_profit,
                    ],
                    'estimated_profit' => [
                        'key' => $transaction->estimated_profit,
                    ],
                    'payment_type' => [
                        'data' => optional(optional($transaction->payment_address)->payment_type)->name,
                    ],
                    'total_dwt' => [
                        'data' => $transaction->total_dwt,
                    ],
                    'inotes' => [
                        'data' => $transaction->inotes,
                    ],
                    'cnotes' => [
                        'data' => optional($transaction->public_note)->notes,
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

    private function calcProfit($cost, $selling) {
        if(!$cost && !$selling) return '';
        $profit = $selling - $cost;
        $percent = (($selling - $cost) / $cost) * 100;
        return Numeral::number($percent)->format('0.0%');
    }
}
