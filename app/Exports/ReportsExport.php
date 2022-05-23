<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


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
        //
    }

    public function headings() {
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
