<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Models\Address;
use App\Models\Store;
use App\Models\StorePage;
use App\Services\Logistics\Fedex;
use Illuminate\Http\Request;
use Auth;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\TransactionPaymentAddress;
use Illuminate\Routing\Route;
use App\Models\State;
use App\Services\EventNotification;

class HomeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, $id=null)
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
      $pageType = 'page';

      $data = [];
      $data['store'] = $store;
      $data['customer'] = Auth::check() ? Auth::user() : null;

      if ($pageToFind === 'home') {
        //$pageType = 'template';
      } else if ($pageToFind == 'transactions') {
        if(!Auth::check()) {
          return redirect('customer/login?q=couldnot');
        }

        $data['customer'] = Auth::user();
        $data['customer']->load('address');
        $data['transactions'] = Transaction::with('images')
          ->with('status')
          ->withStatusDateTime()
          ->with('customer')
          ->withPaymentDateTime()
          ->where('customer_id', $data['customer']->id)
          ->orderBy($sortBy, $orderBy)
          ->get();

      } else if($pageToFind == 'thank-you.detail') {
        $id = $request->input('id');

        if(!Auth::check()) {
          if($request->has('customer_id') && $request->customer_id) {
            Auth::loginUsingId($request->customer_id);
          }
        }

        if(!Auth::check()) {
          return redirect('customer/login');
        }

        $data['store']->load('address');
        $pageType = 'template';
        $data['customer'] = Auth::user();
        $data['transaction'] = Transaction::with('images')
          ->with('customer')
          ->with('status')
          ->withPaymentType()
          //->where('customer_id', $data['customer']->id)
          ->orderBy($sortBy, $orderBy)
          ->find($id);
      } else if($pageToFind == 'transactions.detail') {
        if(!Auth::check()) {
          return redirect('customer/login');
        }

        $pageType = 'template';
        $data['customer'] = Auth::user();
        $transaction = Transaction::with('images')
          ->with('customer')
          ->with('status')
          ->withFinalOffer()
          ->withPaymentDateTime()
          ->withKitSentDateTime()
          ->withOfferGivenDateTime()
          ->withReturnedDateTime()
          ->withReceivedDateTime()
          ->withPaymentType()
          ->where('customer_id', $data['customer']->id)
          ->orderBy($sortBy, $orderBy)
          ->find($id);

        if($request->has('accept') && $request->accept == 1) {
          if($transaction->status_id == 4) {
            $transaction->doUpdate([
              'status_id' => 5
            ]);
          }

        }else if($request->has('decline') && $request->decline == 1) {
          if($transaction->status_id == 4) {
            $transaction->doUpdate([
              'status_id' => 6
            ]);
          }
        }

        $data['transaction'] = $transaction;

      }else if($pageToFind == 'my-settings' || $pageToFind == 'my-settings.details') {

        if(!Auth::check()) {
          return redirect('customer/login');
        }

        $data['states'] = State::where('country_id', 1)->get();
        $data['customer'] = Auth::user();

        $transactionObj = Transaction::with('images')
          ->with('customer')
          ->with('status')
          ->with('payment_address')
          ->with('address')
          ->withFinalOffer()
          ->withPaymentDateTime()
          ->withKitSentDateTime()
          ->withOfferGivenDateTime()
          ->withReturnedDateTime()
          ->withReceivedDateTime()
          ->withPaymentType()
          ->where('customer_id', $data['customer']->id);

        if(!$id) {
          $data['transaction'] = $transactionObj->orderBy('id', 'desc')->first();
        }else{
          $data['transaction'] = $transactionObj->find($id);
        }

        $pageType = 'template';
        $customer = Auth::user();
        $customer->load('address', 'transactions.payment_address');

      }

      if(null !== $store) {
        $page = $store->pageContent($pageToFind, $data, $pageType);
      }
    }

    return view('pages.index', compact('page'));
  }

  public function logout() {
    Auth::logout();
    return redirect('customer/login');
  }

  public function settings(Request $request){
    $customer =  Auth::user();
    $input    = $request->all();
    $input['phone_number'] = $request->phone;
    $store = Store::find($customer->store_id);

    if($request->pass_new && $request->pass_confirm) {
      $customer->password = bcrypt($request->get('pass_new'));
      $customer->save();
    }

//        try {
    $customerAddress = [
      'first_name' => data_get($input, 'first_name'),
      'last_name' => data_get($input, 'last_name'),
      'address' => data_get($input, 'address'),
      'address2' => data_get($input, 'address2'),
      'city' => data_get($input, 'city'),
      'country_id' => 1,
      'zip' => data_get($input, 'zip'),
      'phone' => data_get($input, 'phone'),
      'state_id' => data_get($input, 'state_id')
    ];
    $customer = (new Customer())->createOrUpdateCustomer($store, $input, $customer);
    $customer->address->fill($customerAddress);
    $customer->address->save();
    $transactions = $customer->transactions()->take(1)->orderBy('id', 'desc')->get();
    //$transactions = Transaction::where('customer_id', )
    if ( count($transactions )) {
      foreach($transactions as $transaction) {
        TransactionPaymentAddress::doUpdate($transaction->id,  $input);
        if($request->payment_type_id == 1) {
          if(null !== $transaction->address) {
            $transaction->address->fill($customerAddress);
            $transaction->address->save();
          }else{
            $transaction->address()->create(
              $customerAddress
            );
          }
        }
      }
    }
    return response()->json($customer, 200);
//        } catch (\Throwable $th) {
//            return response()->json(['message'=> "Failed"], 422);
//            //throw $th;
//        }
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
  public function show($id)
  {
    //
    if(session()->has('store_id')) {
      //This is probably a store page
      $store_id = session()->get('store_id');
      $store = Store::find($store_id);
      $path = request()->path();
      $pageToFind = StorePage::nameFromPath($path);
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
    $transaction = Transaction::find($id);
    if( $transaction->status_id == 4) {
      return $transaction->doUpdate($request->input());
    }
    return $transaction;
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

    $input = $request->input();

    $customerAddress = [
      'first_name' => data_get($input, 'firstname'),
      'last_name' => data_get($input, 'lastname'),
      'address' => data_get($input, 'address'),
      'address2' => data_get($input, 'apt'),
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
      $request->session()->put('verifiedAddress', $addressVerification);
    } catch (\Exception $e) {
      $addressVerification['valid'] = false;
    }

    if(!data_get($addressVerification, 'valid')) {
      return response()->json($addressVerification);
    }

    $store_id = session()->get('store_id');

    $store = Store::find($store_id);
    $customer = new Customer();
    //try {

    $input['first_name'] = $request->first_name ?? $request->firstname;
    $input['last_name'] = $request->last_name ?? $request->lastname;

    $customer = Customer::where('email', $input['email'])->first();

    $customerAddress['address'] = $addressVerification['parsedAddress']['street'];
    $customerAddress['address2'] = $addressVerification['parsedAddress']['street2'];
    $customerAddress['state'] = Helper::getStateId($addressVerification['parsedAddress']['state']);
    $customerAddress['city'] = $addressVerification['parsedAddress']['city'];
    $customerAddress['zip'] = $addressVerification['parsedAddress']['zip'];

    if(null === $customer) {
      $customer = Customer::addNew($store, $input);
    } else {
      $customer->addresses()->delete();
    }

    $cAddress = $customer->address()->firstOrNew($customerAddress);
    $cAddress->save();

    if(!Auth::check()) {
      Auth::loginUsingId($customer->id);
    }

    $transaction = Transaction::createNew($store, $request, $customer);
    session()->put('transactionID', $transaction->id);
    $transaction->address()->create($customerAddress);
    $addressVerification['transaction_id'] = $transaction->id;

    $transaction_payment_address = new TransactionPaymentAddress();
    $transaction_payment_address = TransactionPaymentAddress::firstOrNew(
      [ 'transaction_id' => $transaction->id ]
    );

    $transaction_payment_address->transaction_id = $transaction->id;
    $transaction_payment_address->customer_id = $customer->id;
    $transaction_payment_address->payment_type_id = $request->payment;

    $transaction_payment_address->save();

    $transaction->doWarehouser();

    return response()->json($addressVerification);

  }

  public function reVerifyAddress(Request $request)
  {
    $transaction = Transaction::find($request->transactionID);
    if(null === $transaction) {
      return response()->json('There was an unspecified error. Please try again later', 400);
    }
    $input = $request->input();

    $customerAddress = [
      'first_name' => data_get($input, 'first_name'),
      'last_name' => data_get($input, 'last_name'),
      'address' => data_get($input, 'address'),
      'address2' => data_get($input, 'apt'),
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
      if($addressVerification['valid']) {
        $addressVerification['transaction_id'] = $transaction->id;
        return response()->json($addressVerification);
      }
    } catch (\Exception $e) {
      $addressVerification['valid'] = false;
    }

    return response()->json($addressVerification);
  }

  public function fix(Request $request, $id=null) {
    dd($id);
  }

  public function updateAddressVerification(Request $request)
  {
    $transaction = Transaction::find($request->transactionID);
    //update verified address
    if (null !== $transaction) {
      $transaction->address()->update([
        'is_verified' => true
      ]);

      new EventNotification(
        'New Transaction',
        [
          'customer' => $transaction->customer,
          'store' => $transaction->store,
          'transaction' => $transaction
        ]
      );
      $link = 'thank-you.html?id='.$transaction->id;

      return redirect($link);
    } else {
      dd($request->input());
    }
  }

  public function meta(Request $request)
  {
    //We don't know who the customer is ... we save the seo id in a session ....
    if(Auth::check()) {
      $customer = Auth::user();
      $customer->addOrUpdateMeta($request->field, $request->value);
      return $customer;
    }

  }
}
