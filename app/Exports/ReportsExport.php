<?php
namespace App\Exports;

ini_set('memory_limit', -1);
ini_set('max_execution_time', 300);

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Transaction;
use Numeral\Numeral;


class ReportsExport implements FromCollection, WithHeadings
{
    protected $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transactions = Transaction::search($this->filter)
            ->with('transStatus')
            ->with('address')
            ->with('images')
            ->with('trStatus')
            ->with('customer')
            ->with('customer.address')
            ->with('customer.address.state')
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
            ->get();

        return $transactions->map(function(Transaction $transaction) {
            return [
                $transaction->id,
                Numeral::number($transaction->offer)->format('$0.0'),
                Numeral::number($transaction->est_value)->format('$0.0'),
                $transaction->customer->transaction_count,
                optional($transaction->trStatus)->name,
                $transaction->customer->created_at,
                $transaction->keyword,
                $transaction->lead,
                $transaction->store->name,
                $transaction->tags,
                $transaction->incoming_tracking,
                $transaction->outgoing_tracking,
                optional($transaction->customer)->name,
                $transaction->customer->gender,
                optional($transaction->customer)->email,
                $transaction->customer->address->address,
                $transaction->customer->address->address2,
                $transaction->customer->address->city,
                optional($transaction->customer->address->state)->code,
                $transaction->address->postal_code,
                $transaction->customer->gender,
                $transaction->customer->behavior,
                optional($transaction->customer)->dob,
                $transaction->days_in_stock,
                $transaction->profit_percent,
                $transaction->estimated_profit,
                $transaction->payment_type,
                $transaction->total_dwt,
                $transaction->inotes,
                $transaction->cnotes,
            ];
        });
    }

    public function headings() : array {
        return [
            'Txn ID',
            'Bought',
            'Estimated Value',
            '# of Trans',
            'Status',
            'Customer Since',
            'Keywords',
            'Lead',
            'Website',
            'Tags',
            'Incoming Fedex',
            'Outgoing Fedex',
            'Customer Name',
            'Phone',
            'Email',
            'Street Address',
            'Suite / Apt',
            'City',
            'State',
            'Zip',
            'Gender',
            'Behavior',
            'DOB',
            'Days in Stock',
            'Profit Percent',
            'Estimated Profit',
            'Payment Type',
            'Total DWT',
            'INotes',
            'CNotes'
        ];
    }
}
