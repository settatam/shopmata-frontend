<?php

namespace App\Widget;

use App\Helpers\Filter;
use Illuminate\Support\Str;
use App\Models\Transaction;

class SearchTable extends Table
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
                'key' => 'Categories',
                'label' => 'Categories',
                'sortable' => false,
                'html' => true
              ],
            [
                'key' => 'Whatever',
                'label' => 'whatever',
                'sortable' => true,
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
        $term = data_get($filter, 'term');
        if(!$term) {
            return response()->json([
                'error'=> ' You need a search term to continue'
            ], 422);
        }
        $term = '%'.$term.'%';

        $this->data = Transaction::where('id', 'LIKE', $term)
            ->orWhereHas('customer', function($q) use ($term){
                $q->where('first_name', 'LIKE', $term)
                    ->orWhere('last_name', 'LIKE', $term);
            })->with('transStatus')
            ->with('images')
            ->orderBy(Filter::sortBy($filter), Filter::sort($filter))
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
                    'categories' => [
                        'data' => $transaction->customer_categories,
                    ],
                    'whatever' => [
                        'data' => 'This is whatever',
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
        return  [
            'Create Shipping Label',
            'Create Barcodes',
            'Delete',
            'Rejected By Admin'
        ];
    }

    public function exportable($filter, $filteredData) {
        return true;
    }
}
