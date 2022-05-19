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
        //†$filters['dates'] = Filter::dates($filters);
        $filters['type'] = 'ReportsTable';
       // dd(Transaction::withGroupedGender()
                      //  ->get());
        return Inertia::render('Reports/Index', compact('filters'));
    }
}
