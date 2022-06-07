<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Helpers\Filter;
use App\Models\Transaction;
use App\Models\Customer;
use App\Widget\ReportsTable;
use App\Widget\ReportFormGroup;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Store;


class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->input();
        $reportForm = (new ReportFormGroup())->render($filters);
        //†$filters['dates'] = Filter::dates($filters);
        $filters['type'] = 'ReportsTable';
        $dates = Filter::getDefaultMTD(Filter::DEFAULT_TIMEZONE);
        $store_id = Filter::getStoreId($filters);
        $to = data_get($dates, 'to');
        $from = data_get($dates, 'from');
        $stores = Store::get();
        return Inertia::render('Reports/Index',
            compact(
                'filters', 'reportForm', 'stores', 'to', 'from', 'store_id')
        );
    }

    public function export(Request $request) {
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', 300);
        $filters = $request->input();
        return Excel::download(new ReportsExport($filters), 'reports.xlsx');
    }

    public function formGroup(Request $request) {
        $formGroup =  (new ReportFormGroup())->render($request->input());
        return response()->json($formGroup);
    }

}

//$age = Carbon::parse($request->date_of_birth)->diff(Carbon::now())->y;

