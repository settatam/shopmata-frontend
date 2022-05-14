<?php

namespace App\Http\Controllers\Widgets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionsList extends Controller
{
    //
    public function index(Request $request) {
        $filter = $request->input();
        $data = Transaction::search($filter)->paginate(20);
        return response()->json(Transaction::tableData($filter, $data));
    }
}
