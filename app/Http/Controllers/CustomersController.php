<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Store;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Address;
use App\Models\TransactionPaymentAddress;

use App\Models\Tag;
use App\Models\Lead;

use App\Http\Helpers\Helper;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Resources\CustomerCollection;
use Carbon\Carbon;


class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $pageSize  = $request->has('pageSize') ? $request->pageSize : 20;
        $countries = Country::all();

        $data      = [];
        $from_date = Helper::formatDate($request->from_date);
        $to_date   = Helper::formatDate($request->to_date);
        $filters   = $request->all('q', 'orderBy', 'sortOrder');
        $customers = Customer::where(function (Builder $query) use ($request, $from_date, $to_date) {
            if ($request->filter && $request->q) {
                $query->where('first_name', 'like', '%' . $request->q . '%')
                    ->orWhere('last_name', 'like', '%' . $request->q . '%')
                    ->orWhere('email', 'like', '%' . $request->q . '%')
                    ->orWhere('phone_number', 'like', '%' . $request->q . '%')
                    ->whereBetween('created_at', [$from_date, $to_date]);
            }

            if ($request->filter && !$request->q && $from_date && $to_date) {
                $query->whereBetween('created_at', [$from_date, $to_date]);
            }
        })->orderBy('created_at','desc')->paginate($pageSize);

        if ( $request->ajax() && $request->filter ) {
            return CustomerCollection::collection($customers);
        }

        return Inertia::render('Customers/Index', compact('customers', 'filters', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $countries->load('states');
        return Inertia::render('Customers/Create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name'   => ['required','string'],
            'last_name'    => ['required','string'],
            'email'        => ['required','email','max:75','unique:users'],
            'phone_number' => ['required']
        ]);

        $store_id = $request->store_id ?? 43;
        $store = Store::find($store_id);
        $input = $request->input();
        try {
            (new Customer())->createOrUpdateCustomer($store, $input);
            \Log::info("New customer added");
            return response()->json(['message'=> "Customer added  successfully"], 200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to save  customers  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response()->json(['message'=> "Failed to save  customer"], 422);
        }

    }





        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function extras(Request $request, $id, $action)
    {
        //
        $input = $request->input();
        $customer = Customer::find($id);

        //How do we perform validation here???

        switch ($action) {
            case 'images':
                try {
                    $image  = FileUploader::upload($request);
                    if ( isset($image[0]['thumb']) ){
                        $l_image = $image[0]['large'];
                        $tn_image = $image[0]['thumb'];
                        $imgs= new Image(['url' => $l_image, 'thumbnail' =>  $tn_image, 'rank' => 1]);
                        $customer->images()->save($imgs);
                    }

                    return response()->json($customer->images,  200);
                } catch (\Throwable $th) {
                    \Log::Error("Failed to Add image" . collect($request->all())  ."  Error: " .$th->getMessage() );
                    return response($th->getMessage() ,422);
                }

                return response("Something went wrong" ,422);
                break;
            case 'payment':
                   try {
                    TransactionPaymentAddress::UpdateCustomerPayment($input, $id);
                   } catch (\Throwable $th) {
                      return response($th->getMessage() ,422);

                   }
                break;

            case 'leads':

                try {
                    $lead = new Lead;
                    $lead->name = $request->name;
                    $lead->save();
                    $leads = Lead::all();
                    return response()->json($leads,  200);
                } catch (\Throwable $th) {
                    \Log::Error("Failed to Add lead" . collect($request->all())  ."  Error: " .$th->getMessage() );
                    return response($th->getMessage() ,422);
                }

                break;

            case 'tags':
                $this->addTag($request->tag_id, $id);
                break;
//            case:

        }

        return response()->json(null, 200);
    }



     public function addTag($tag_id, $id)
    {
        try {
            Customer::addBehaviorTag($tag_id, $id);
            return response(null, 200);
        } catch (\Throwable $th) {
            //throw $th;
            \Log::Error("Failed to add or delete  tag  with id" . $tag_id  ."  Error: " .$th->getMessage() );
            return response(null, 422);
        }
        return response(null,422);
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
        $store = Store::find(session('store_id'));

        $store->load('currency');
        $tags  = Tag::whereIn('name', Customer::TAGS)->get();
        $leads = Lead::all();
        $countries = Country::where('name','United States')->with('states')->first();
        $customer  = Customer::with(['transactions','customer_address','images','payment_address','payment_address.payment_type','payment_address.state','tags','behavior'])->find($id);

        if (null === $customer) {
            throw new HttpException(404);
        }

        $customer->customer_since = \Carbon\Carbon::parse($customer->created_at)->diffForHumans();
        return Inertia::render('Customers/Show', compact('leads','store','customer', 'tags','countries'));
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
        $customer = Customer::find($id);
        if (null === $customer) {
            throw new HttpException(404);
        }

        $countries = Country::all();
        $countries->load('states');
        return Inertia::render('Customers/Edit', compact('customer','countries'));
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

        $customer = Customer::find($id);
        // $request->validate([
        //     'first_name'   => ['required','string'],
        //     'last_name'    => ['required','string'],
        //     'email'        => ['required','email','max:75','unique:customers'],
        //     'phone_number' => ['required']
        // ]);
        $store_id = $request->store_id ?? 43;
        $store = Store::find($store_id);
        $input = $request->input();
        try {
            (new Customer())->createOrUpdateCustomer($store, $input, $customer);
            \Log::info("Customer Updated");
            return response()->json(['message'=> "Customer details updated successfully" ], 200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to update  customers  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response()->json(['message'=> $th->getMessage()], 422);
        }
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
        // try {
        $ids = explode(",", $id);
        $delete_customers = Customer::find($ids)->each(function ($customer_id, $key) {
            $customer = Customer::find($customer_id->id);
            User::find($customer->user_id)->delete();
            $customer->delete();
        });
        if ($delete_customers) {
            $data['status'] = 'success';
            $data['message'] = "Customer(s) deleted successfully!";
            $customers = Customer::with('orders')->with('shipping_addresses')->paginate(50);
            Log::info("Customer(s) deleted!");
        } else {
            $data['status'] = 'failed';
            $data['message'] = "An error occured!";
            Log::error("Customer wasn't successfully deleted.");
        }

        return Inertia::render('Customers/Index', compact('customers', 'data'));
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
            $customer = Customer::addNew($store, $input);
            Auth::guard('customer')->loginUsingId($customer->id);

            $transaction = Transaction::createNew($store, $request, $customer);
            $transaction_payment_address = new TransactionPaymentAddress;
            $transaction_payment_address = TransactionPaymentAddress::firstOrNew(
                ['customer_id' => $customer->id ]
            );
            $transaction_payment_address->transaction_id         =  $transaction->id;
            $transaction_payment_address->customer_id            =  $customer->id;
            $transaction_payment_address->payment_type_id        =  $request->payment;
            $transaction_payment_address->save();

            return response()->json(null, 200);
//        } catch (\Throwable $th) {
//            \Log::Error("Failed to save  transaction  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
//            return response()->json(['message'=> "Failed to save  transaction"], 422);
//        }


    }
}
