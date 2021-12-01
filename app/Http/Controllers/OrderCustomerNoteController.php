<?php

namespace App\Http\Controllers;

use App\Models\OrderCustomerNote;
use Illuminate\Http\Request;
use Log;

class OrderCustomerNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'note'=>['required'],
            'order_id'=>['required']
        ]);

        if($note = OrderCustomerNote::create($request->input())) {
            Log::info('New Customer note created for order ' . $request->order_id . ' by ' . Auth::id(), $request->input());
        }else{
            Log::error('New Customer note councreated for order ' . $request->order_id, $request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderCustomerNote  $orderCustomerNote
     * @return \Illuminate\Http\Response
     */
    public function show(OrderCustomerNote $orderCustomerNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderCustomerNote  $orderCustomerNote
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderCustomerNote $orderCustomerNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderCustomerNote  $orderCustomerNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderCustomerNote $orderCustomerNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderCustomerNote  $orderCustomerNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderCustomerNote $orderCustomerNote)
    {
        //
    }
}
