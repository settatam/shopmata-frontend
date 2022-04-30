<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Helpers\Filter;
use App\Models\Transaction;


class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input();
        $filter['dates'] = Filter::dates($filter);
        $transactions = Transaction::search($filter)
                        ->paginate(Filter::perPage($filter));
        return Inertia::render('Reports/Index', compact('transactions'));
    }
}
