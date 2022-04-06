<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Status;



class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $transactions = Transaction::with('items','customer','images')
                                ->where('store_id',session('store_id'))
                                ->latest()
                                ->paginate(10);
        $transactions->load('customer.state');
        return Inertia::render('Transactions/Index',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storag:wq
     * e.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $transaction  = Transaction::find($id);
        $statuses     = Status::all();
        $store_id     = session('store_id');
        $categories   = Category::where('store_id',$store_id)->get();
        $transactions = Transaction::where(['user_id' => optional($transaction->customer)->id,'store_id' => $store_id])->get();
        $tag1s        = Tag::where(['store_id' => $store_id, 'group_id' => 1,'tagable_type' => 'App\Models\Transaction'])->get();
        $tag2s        = Tag::where(['store_id' => $store_id, 'group_id' => 2,'tagable_type' => 'App\Models\Transaction'])->get();
        $transaction->load('customer','customer.state','items','items.images','histories','offers','notes','sms','images', 'activities','items','transaction_payment_address','transaction_payment_address.transaction_payment_type');
        return Inertia::render('Transactions/Show', compact('transaction','categories','statuses','transactions','tag1s','tag2s'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
