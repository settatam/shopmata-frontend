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
use App\Models\Status;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionTracking;
use Intervention\Image\Image;

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
      //dd($pageToFind);
      $pageType = 'page';

      $data = [];
      $data['store'] = $store;
      $data['customer'] = Auth::check() ? Auth::user() : null;

      if ($pageToFind === 'home') {
        //$pageType = 'template';
      } else if ($pageToFind == 'transactions') {
        if (!Auth::check()) {
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
          ->where('store_id', $store->id)
          ->orderBy($sortBy, $orderBy)
          ->get();
      } else if ($pageToFind == 'contact-us') {
        return redirect('https://sellmyjewelry.com/contact-us');
      } else if ($pageToFind == 'thank-you.detail') {
        if( $request->has('id') && $request->id ) {
          $id = $request->input('id');
          $transaction = Transaction::find($id);
          if (null !== $transaction->tracking) {
            $transaction->tracking()->delete();
          }
          $clientId = $request->session()->get('google-seo-client-id');
          $sessionId = $request->session()->get('google-seo-session-id');
          $transaction->sendTransactionToGoogle($clientId, $sessionId);
        }

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
              'status_id' => 19
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

  public function settings(Request $request)
  {
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

    $customer = Customer::where('email', trim($input['email']))->where('store_id', $store->id)->first();

    $customerAddress['address'] = $addressVerification['parsedAddress']['street'];
    $customerAddress['address2'] = $addressVerification['parsedAddress']['street2'];
    $customerAddress['state'] = Helper::getStateId($addressVerification['parsedAddress']['state']);
    $customerAddress['city'] = $addressVerification['parsedAddress']['city'];
    $customerAddress['zip'] = $addressVerification['parsedAddress']['zip'];

    if(null === $customer) {
      $customer = Customer::addNew($store, $input);
      $customer->fill($customerAddress);
    } else {
      $customer->addresses()->delete();
    }

    if(!Auth::check()) {
      Auth::loginUsingId($customer->id);
    }

    $cAddress = $customer->address()->firstOrNew($customerAddress);
    $cAddress->save();

    if ($request->session()->has('google-seo-client-id')) {
      $customer->addOrUpdateMeta('google-seo-client-id', $request->session()->get('google-seo-client-id'));
    }

    if ($request->session()->has('google-seo-session-id')) {
      $customer->addOrUpdateMeta('google-seo-session-id', $request->session()->get('google-seo-session-id'));
    }

    $transaction = Transaction::createNew($store, $request, $customer);
    //session()->put('transactionID', $transaction->id);
    $transaction->address()->create($customerAddress);
    $addressVerification['transaction_id'] = $transaction->id;

    $transaction_payment_address = new TransactionPaymentAddress();
    $transaction_payment_address = TransactionPaymentAddress::firstOrNew(
      [ 'transaction_id' => $transaction->id ]
    );

    $transaction_payment_address->transaction_id = $transaction->id;
    $transaction_payment_address->customer_id = $customer->id;
    $transaction_payment_address->payment_type_id = $request->payment;
    $transaction_payment_address->amount = 0;
    $transaction_payment_address->percentage = 100;

    $transaction_payment_address->save();

    //$transaction->sendTransactionToGoogle();
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
    $transaction = Transaction::with('customer')->find($request->transaction_id);
    //update verified address
    if (null !== $transaction) {
      $transaction->address()->update([
        'is_verified' => true
      ]);

      $note = sprintf(
            '%s %s created new transaction',
            $transaction->customer->first_name,
            $transaction->customer->last_name
        );

        $transaction->addActivity($transaction, ['status_id' => Status::PENDING_KIT_REQUEST]);

      new EventNotification(
        'Pending-Kit Request',
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
    $request->session()->put($request->field, $request->value);

    if(Auth::check()) {
      $customer = Auth::user();
      $customer->addOrUpdateMeta($request->field, $request->value);
    }

    return response()->json([
      $request->field => $request->value
    ]);
  }

  public function trkProgress($id)
  {
    $transaction = TransactionTracking::find($id);
    //$transaction->content = unserialize($transaction->content);
    return response()->json($transaction);
  }

  public function postTrkProgress(Request $request)
  {
    $input = $request->input();
    $data['content'] = serialize($input);
    $data['step'] = data_get($input, 'step');
    //$data['step'] = 'profile';

    if ($tracking_id = data_get($input, 'tracking_id')) {
      $tracking = TransactionTracking::find($tracking_id);
      //if ($data['step'] === 'uploads') {
        $generated_images = [];
        if ($images = data_get($input, 'photos')) {
          for ($i=0; $i < count($images); $i++) {
            $pathInfo = pathinfo($images[0], PATHINFO_EXTENSION);
            $imageName = sprintf('%s-%s.$s', $tracking->transaction_id, $i, $pathInfo);
            $img = Image::make($images[0]);
            $pathToSave = sprintf('%s/%s', public_path(), $imageName);
            $img->save($pathToSave);
            $generated_images[] = $pathToSave;
          }
          data_set($input, 'generated_images', $generated_images);
        }

      //}
      $input['content'] = serialize($input);
      $tracking->fill($input);
      $tracking->save();
      return response()->json([
        'valid' => true,
        'tracking_id' => $tracking_id,
        'transaction_id' => $tracking->transaction_id,
        'generated_images' => $generated_images
      ]);
    }

    if ($trk = TransactionTracking::firstOrNew($data)) {
      //Create Transaction ..
      $customer = Customer::firstOrNew([
        'email' => data_get($input, 'profile_email'),
        'store_id' => $request->session()->get('store_id')
      ]);

      $customer->fill([
        'first_name' => data_get($input, 'profile_firstname'),
        'last_name' => data_get($input, 'profile_lastname'),
        'phone_number' => data_get($input, 'profile_mobile')
      ]);

      $customer->save();

      $transaction = Transaction::create([
        'customer_id' => $customer->id,
        'status_id' => 64,
        'store_id' => $request->session()->get('store_id')
      ]);

      $trk->transaction_id = $transaction->id;
      $trk->save();

      Auth::loginUsingId($customer->id);
      $transaction->addActivity($transaction, ['status_id' => 64]);

      return response()->json([
        'valid' => true,
        'tracking_id' => $trk->id,
        'transaction_id' => $transaction->id
      ]);
    } else {
      return response()->json([
        'valid' => false,
        'message' => 'There was an unknown error'
      ], 422);
    }
  }
}
