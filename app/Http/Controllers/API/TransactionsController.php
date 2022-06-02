<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\TransactionPaymentAddress;



class TransactionsController extends Controller
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

    public function verifyAddress(Request $request) {
      
        $request->validate([
            'email' => ['required','email','max:75','unique:customers'],
        ]);

        $customer = new Customer;
        $store_id = $request->session()->get('store_id');
        try {
            $customer = Customer::createOrUpdateCustomer($store_id, $request);
            $transaction = Transaction::createTransaction($store_id, $request, $customer->id);
            $transaction_payment_address = new TransactionPaymentAddress;
            $transaction_payment_address = TransactionPaymentAddress::firstOrNew(
                ['customer_id' => $customer->id ]
            );
            $transaction_payment_address->transaction_id         =  $transaction->id;
            $transaction_payment_address->customer_id            =  $customer->id;
            $transaction_payment_address->payment_type_id        =  $request->payment;
            $transaction_payment_address->save();

            return response()->json(null, 200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to save  transaction  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response()->json(['message'=> "Failed to save  transaction"], 422);
        }
       

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
