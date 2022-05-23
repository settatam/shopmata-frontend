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
        //†$filters['dates'] = Filter::dates($filters);
        $filters['type'] = 'ReportsTable';
        return Inertia::render('Reports/Index',
            compact('filters', 'reportForm')
        );
    }
}

//$age = Carbon::parse($request->date_of_birth)->diff(Carbon::now())->y;

