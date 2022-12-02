<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreTag;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\TransactionPaymentAddress;
use App\Models\Transaction;
use Auth;
use App\Http\Helpers\Helper;
use App\Models\Address;
use App\Services\Logistics\Fedex;


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

      $store = Store::find(43);

    $request->validate([
      //'email' => ['required','email','max:75'],
    ]);

    $input = $request->input();

    $customerAddress = [
      'first_name' => data_get($input, 'first_name'),
      'last_name' => data_get($input, 'last_name'),
      'address' => data_get($input, 'address'),
      'address2' => data_get($input, 'address2'),
      'state' => data_get($input, 'state'),
      'city' => data_get($input, 'city'),
      'country_id' => 1,
      'zip' => data_get($input, 'zip'),
      'phone' => data_get($input, 'phone'),
      'state_id' => Helper::getStateId(data_get($input, 'state'))
    ];

    $address = new Address();
    $address->fill($customerAddress);

    try {
      $fedex = new Fedex();
      $addressVerification = $fedex->verifyAddress($address);
      //$request->session()->put('verifiedAddress', $addressVerification);
    } catch (\Exception $e) {
      $addressVerification['valid'] = false;
    }

    if(!data_get($addressVerification, 'valid')) {
      return response()->json($addressVerification);
    }

    $customer = new Customer();
    //try {

    $input['first_name'] = $request->first_name ?? $request->firstname;
    $input['last_name'] = $request->last_name ?? $request->lastname;

    $customer = Customer::where('email', $input['email'])->first();

//    $customer['first_name'] = data_get($input, 'first_name');
//    $customer['last_name'] = data_get($input, 'last_name');

    $customerAddress['address'] = $addressVerification['parsedAddress']['street'];
    $customerAddress['address2'] = $addressVerification['parsedAddress']['street2'];
    $customerAddress['state'] = Helper::getStateId($addressVerification['parsedAddress']['state']);
    $customerAddress['city'] = $addressVerification['parsedAddress']['city'];
    $customerAddress['zip'] = $addressVerification['parsedAddress']['zip'];

    if(null === $customer) {
      $customer = Customer::addNewFromApi($store, $input);
    } else {
      $customer->addresses()->delete();
    }

    $cAddress = $customer->address()->firstOrNew($customerAddress);
    $cAddress->save();

    if(!Auth::check()) {
      Auth::loginUsingId($customer->id);
    }



    $transaction = Transaction::createNew($store, $request, $customer);
    $transaction->address()->create($customerAddress);
    $addressVerification['transaction_id'] = $transaction->id;
    $addressVerification['customer_id'] = $customer->id;

    $transaction_payment_address = new TransactionPaymentAddress();
    $transaction_payment_address = TransactionPaymentAddress::firstOrNew(
      [ 'transaction_id' => $transaction->id ]
    );

    $transaction_payment_address->transaction_id = $transaction->id;
    $transaction_payment_address->customer_id = $customer->id;
    $transaction_payment_address->payment_type_id = $request->pay;

    $transaction_payment_address->save();

    return response()->json($addressVerification);

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

    public function moreInfo(Request $request) {
      $input = $request->input();
      $transaction = Transaction::find($request->id);

      $transaction->update($input);
      $transaction->save();

      return response()->json('Request Successful');
    }

    public function upload(Request $request) {
      $image = $request->file;
      $transaction = Transaction::find($request->id);
      $response = $transaction->addImage($image);
      return response()->json($response);
    }
}
