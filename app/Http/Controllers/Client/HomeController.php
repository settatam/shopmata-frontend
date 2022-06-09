<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StorePage;
use Illuminate\Http\Request;
use Auth;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\TransactionPaymentAddress;
use Illuminate\Routing\Route;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($account)
    {
        //
        if(session()->has('store_id')) {
            //This is probably a store page
            $store_id = session()->get('store_id');
            $store = Store::find($store_id);
            $path = request()->path();
            $orderBy = $request->order_by ?? 'desc';
            $sortBy = $request->sort_by ?? 'created_at';

            $pageToFind = StorePage::nameFromPath($path);

            $data = [];

            if($pageToFind == 'transactions') {

                if(!Auth::guard('customer')->check()) {
                    return redirect('customer/login');
                }

                $data['customer'] = Auth::guard('customer')->user();
                $data['transactions'] = Transaction::with('images')
                    ->with('customer')
                    ->withPaymentDateTime()
                    ->where('customer_id', $data['customer']->id)
                    ->orderBy($sortBy, $orderBy)
                    ->get();
            }else if($pageToFind == 'transactions.detail') {

                $data['customer'] = Auth::guard('customer')->user();
                $data['transactions'] = Transaction::with('images')
                    ->with('customer')
                    ->withFinalOffer()
                    ->withPaymentDateTime()
                    ->where('customer_id', $data['customer']->id)
                    ->orderBy($sortBy, $orderBy)
                    ->get();
            }


            if(null !== $store) {
                $page = $store->pageContent($pageToFind, $data);
                $customer = null;
                if(Auth::check()) {
                    $customer = Auth::user();
                }
            }
        }

        return view('pages.index', compact('page'));
    }

    public function logout() {
        Auth::guard('customer')->logout();
        return redirect('customer/login');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($account, $id)
    {
        //
        if(session()->has('store_id')) {
            //This is probably a store page
            $store_id = session()->get('store_id');
            $store = Store::find($store_id);
            $path = request()->path();
            $pageToFind = StorePage::nameFromPath($path);

            dd($pageToFind);

            $transaction = Transaction::with('trStatus')->with('images')->with('offers')->find($id);

            if(null !== $store) {
                $page = $store->pageContent($pageToFind);
                $customer = null;
                if(Auth::check()) {
                    $customer = Auth::user();
                }
            }
        }

        return view('pages.index', compact('page', 'transaction'));
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

    public function verifyAddress(Request $request) {

        $request->validate([
            //'email' => ['required','email','max:75'],
        ]);

        $store_id = $request->store_id ?? 43;

        $store = Store::find($store_id);
        $customer = new Customer;
        //try {
            $input = $request->input();
            $input['first_name'] = $request->first_name ?? $request->firstname;
            $input['last_name'] = $request->last_name ?? $request->lastname;

            $customer = Customer::where('email', $input['email'])->first();

            if(null === $customer) {
                $customer = Customer::addNew($store, $input);
            }

            if(!Auth::guard('customer')->check()) {
                Auth::guard('customer')->loginUsingId($customer->id);
            }

            $transaction = Transaction::createNew($store, $request, $customer);
            $transaction_payment_address = new TransactionPaymentAddress;
            $transaction_payment_address = TransactionPaymentAddress::firstOrNew(
                ['customer_id' => $customer->id ]
            );
            $transaction_payment_address->transaction_id         =  $transaction->id;
            $transaction_payment_address->customer_id            =  $customer->id;
            $transaction_payment_address->payment_type_id        =  $request->payment;
            $transaction_payment_address->save();

            return response()->json($transaction, 200);
//        } catch (\Throwable $th) {
//            \Log::Error("Failed to save  transaction  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
//            return response()->json(['message'=> "Failed to save  transaction"], 422);
//        }


    }
}
