<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Helpers\Filter;
use App\Models\Transaction;
use App\Models\Customer;
use App\Widget\ReportsTable;
use App\Widget\ReportFormGroup;


class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->input();
        $reportForm = (new ReportFormGroup())->render($filters);
        $statuses = Transaction::searchForFilter($filters)->with('trStatus')->withGroupedStatus()->get();

        $lead_type             = Customer::has('transactions')->select(\DB::raw('customers.lead_id, COUNT(customers.lead_id) AS `leadIdCount`'))->with('lead')->groupBy('lead_id')->get();
        $genders               = Transaction::searchForFilter($filters)->withGroupedGender()->get();
        $payment_types         = Transaction::withGroupedPaymentTypes()->get();
        $repeatCustomerCount   = Transaction::searchForFilter($filters)->withGroupedRepeatCustomer(true)->count();
        $noRepeatCustomerCount = Transaction::searchForFilter($filters)->withGroupedRepeatCustomer(false)->count();
        $days =  Transaction::searchForFilter($filters)->withGroupedDates()->get();
        //$behaviour           =
       // $tags =
        $states   =  Transaction::searchForFilter($filters)->withGroupedStates()->get();
        $repeatCustomers = collect([
            'Yes' => $repeatCustomerCount,
            'No' => $noRepeatCustomerCount
        ]);

        //†$filters['dates'] = Filter::dates($filters);
        $filters['type'] = 'ReportsTable';
        return Inertia::render('Reports/Index',
            compact('filters', 'statuses','states', 'genders', 'repeatCustomers','lead_type','days','payment_types','states', 'reportForm')
        );
    }
}

//$age = Carbon::parse($request->date_of_birth)->diff(Carbon::now())->y;

