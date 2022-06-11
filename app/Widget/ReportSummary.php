<?php

namespace App\Widget;

use App\Models\Transaction;
use Numeral\Numeral;

class ReportSummary extends Table
{
    public function fields()
    {
        return [
              [
                'key' => 'website',
                'label' => 'Website',
                'html' => true,
                'sortable' => true,
              ],
              [
                'key' => 'bought',
                'label' => 'Bought',
                'sortable' => true,
                'html' => true
              ],
              [
                'key' => 'total_value',
                'label' => 'Total Value',
                'sortable' => true,
                'html' => true
              ],
              [
                'key' => 'avg_kit_value',
                'label' => 'Average Kit Value',
                'sortable' => true,
                'html' => true
              ],
            [
                'key' => 'avg_kit_profit_percent',
                'label' => 'Avg. Profit%',
                'sortable' => true,
                'html' => true
              ],
              [
                'key' => 'avg_kit_received_percent',
                'label' => 'AVG Kits Received %',
                'sortable' => false,
                'html' => true
              ],
              [
                'key' => 'avg_kits_declined_percent',
                'label' => 'Av Kit Declined %',
                'sortable' => true,
                'html' => true
              ],
            [
                'key' => 'avg_kits_rejected_percent',
                'label' => 'Av Kit Rejected %',
                'sortable' => true,
                'html' => true
            ],
            [
                'key' => 'avg_kits_not_received_percent',
                'label' => 'Av Kit Not Recieved%',
                'sortable' => true,
                'html' => true
            ]
        ];
    }

    public function items($filter) {
        return data_get($this->data($filter), 'items');
    }

    public function data($filter) {

        $this->data = Transaction::search($filter)
            ->leftJoin('transaction_offers', 'transaction_offers.transaction_id', '=', 'transactions.id')
            ->leftJoin('transaction_items', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->selectRaw('sum(offer) as offerTotal')
            ->selectRaw('AVG(offer) as avOffers')
            ->selectRaw('SUM(transaction_items.price) as totalValue')
            ->selectRaw('count(transactions.id) as transactionCount')
            ->with('store')
            ->groupBy('store_id')
            ->get();

        return [
            'count' => data_get($this->data, 'perPage'),
            'total' => data_get($this->data, 'total'),
            'numberOfRows' => data_get($this->data, 'numberOfRows'),
            'items' => $this->data->map(function(Transaction $transaction){
                return [
                    'bought' => Numeral::number($transaction->offerTotal)->format('$0,0.00'),
                    'store_name' => optional($transaction->store)->name,
                    'total_value' => Numeral::number($transaction->totalValue)->format('$0,0.00'),
                    'avg_kit_profit_percent' => '',
                    'transaction_count' => $transaction->transactionCount
                ];
            })
        ];
    }
}
