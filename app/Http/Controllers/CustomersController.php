<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Store;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Address;
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

        $customer = new Customer;

        try {
            $this->createUpdate($request, $customer);
            \Log::info("New customer added");
            return response()->json(['message'=> "Customer added  successfully"], 200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to save  customers  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response()->json(['message'=> "Failed to save  customer"], 422);
        }

    }



    public function createUpdate($request, $customer)
    {
        $user  = $request->user();
        $customer->store_id     = $user->store_id;
        $customer->first_name   = $request->first_name;
        $customer->last_name    = $request->last_name;
        $customer->email        = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->is_active    = 1;
        $customer->accepts_marketing = 1;
        $customer->save();

            Address::updateOrCreate(
                ['user_id' => $customer->id],
                [
                    'first_name' => $request->first_name,
                    'last_name'  => $request->last_name,
                    'user_id'    => $customer->id,
                    'country_id' => $request->country_id,
                    'state_id'   => $request->state_id,
                    'city'       => $request->city,
                    'is_default' => 1,
                    'address'    => $request->address,
                    'address2'   => $request->address2,
                    'zip'        => $request->postal_code,
                ]
            );
        


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
            case 'payments':

                 
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
                $this->addTag($request, $id);
                break;
//            case:

        }

        return response()->json(null, 200);
    }



     public function addTag(Request $request, $id)
    {
        try {
            Customer::addTag($request->tag_id, $id);
            return response(null, 200);
        } catch (\Throwable $th) {
            //throw $th;
            \Log::Error("Failed to add or delete  tag  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
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

        // $month = time();
        // $months[date("F", $month)] = 0;
        // for ($i = 1; $i <= 11; $i++) {
        //   $month = strtotime('last month', $month);
        //   $months[date("F", $month)] = 0;
        // }

        $tags  = Tag::whereIn('name', Customer::TAGS)->get();

        $leads = Lead::all();

        $countries = Country::where('name','United States')->with('states')->first();

        $customer  = Customer::with(['transactions','addresses','transaction_payment_address'])->find($id);

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
        try {
            $this->createUpdate($request, $customer);
            \Log::info("Customer Updated");
            return response()->json(['message'=> "Customer details updated successfully" ], 200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to update  customers  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response()->json(['message'=> "Failed to update settings"], 422);
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
}
