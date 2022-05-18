<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Helpers\Filter;
use App\Models\Transaction;
use App\Widget\ReportsTable;


class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->input();
        $statuses = Transaction::searchForFilter($filters)->with('trStatus')->withGroupedStatus()->get();
        $genders = Transaction::searchForFilter($filters)->withGroupedGender()->get();
        $repeatCustomerCount = Transaction::searchForFilter($filters)->withGroupedRepeatCustomer(true)->count();
        $noRepeatCustomerCount = Transaction::searchForFilter($filters)->withGroupedRepeatCustomer(false)->count();
        $repeatCustomers = collect([
            'Yes' => $repeatCustomerCount,
            'No' => $noRepeatCustomerCount
        ]);

        

        //†$filters['dates'] = Filter::dates($filters);
        $filters['type'] = 'ReportsTable';
        return Inertia::render('Reports/Index',
            compact('filters', 'statuses', 'genders', 'repeatCustomers')
        );
    }
}
