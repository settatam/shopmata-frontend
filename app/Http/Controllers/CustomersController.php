<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Store;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pageSize = $request->has('pageSize') ? $request->pageSize : 50;
        $data = [];
        // $customers = Customer::all()->with('orders')->with('shipping_addresses')->paginate(50);

        $filters = $request->all('search', 'orderBy', 'sortOrder');

        $customers = Customer::whereHas('orders')->where(function (Builder $query) use ($request) {
            if ($request->search)
                $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            // $query;
        })->orderBy($request->input('orderBy', 'id'), $request->input('sortOrder', 'asc'))->with('orders')->with('shipping_addresses')->paginate($pageSize);

        // if ($request->name) dd($customers);

        foreach ($customers as $customer) {
            $categories = [];
            $customer_user = User::with('orders')->with('shipping_addresses')->find($customer->user_id);
            // $customer->total_order = $customer_user->orders->sum();
        }

        return Inertia::render('Customers/Index', compact('customers', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $countries = Country::all();
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
        $store = Store::store();
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make(Str::random(10))
        ]);
        $userId = $user->id;
        $store_id = $user->store_id;
        $customer = Customer::create([
            'store_id' => session('store_id'),
            'user_id' => $userId,
            'country' => $request->country,
            'state' => $request->state,
            'phone' => $request->phone_number,
            'city' => $request->city,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'is_active' => 1,
            'country' => $request->country,
            'address' => $request->address,
            'address2' => $request->address,
            'accepts_marketing' => 1,
            'zip' => $request->postal_code
        ]);
        if ($customer && $user) {
            Log::info('New Customer Created!');
        } else {
            Log::error('An Error occured while creating the customer!');
        }

        return Redirect::route('customers')->with('success', 'Customer created.');
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
        // dd(Order::getByRange($id));
        $month = time();
        $months[date("F", $month)] = 0;
        for ($i = 1; $i <= 11; $i++) {
          $month = strtotime('last month', $month);
          $months[date("F", $month)] = 0;
        }

        $stats = Order::getByRange($id);
        foreach($stats as $stat) {
            $months[$stat->month] = $stat->total_sale;
        }

        // foreach($stats as )

        $customer = Customer::with('orders.items')->with('shipping_addresses')->withTotalOrders($id)->find($id);

        $user = User::find($customer->user_id);

        if (null === $customer) {
            throw new HttpException(404);
        }

        $customer->number_of_orders = count($customer->orders);
        $customer->customer_since = \Carbon\Carbon::parse($customer->created_at)->diffForHumans();

        // $customer->total_order = 0;

        // foreach ($customer->orders as $order) {
        //     $customer->total_order += $order->total;
        // }

        // if ($customer->number_of_orders) {
        //     $customer->last_order_placed = $customer->orders[$customer->number_of_orders - 1]->created_at;
        //     $customer->average_order = round($customer->total_order / $customer->number_of_orders, 2);
        // }

        return Inertia::render('Customers/Show', compact('customer', 'user', 'months'));
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
        $customer = User::with('orders')->find($id);

        //Average order
        //Last order placed
        //

        if (null === $customer) {
            throw new HttpException(404);
        }
        return Inertia::render('Customers/Update', compact('customer'));
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
        $customer = Customer::find($id);

        if($customer->update($request->input())) {
            return response()->json($customer);
        }else{ 
            return response()->json('could not update', 400);
        }

        // $categories = [];
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
        // }
        // catch($e) {
        //     Log("Error occured deleting");
        // }
        // $data = [];
        // $customer = Customer::find($id);
        // $user_deleted = User::find($customer->user_id)->delete();
        // $customer_deleted = $customer->delete();
        // if ($user_deleted && $customer_deleted) {
        //     $data['status'] = 'success';
        //     $data['message'] = "Customer deleted successfully!";
        //     $customers = Customer::with('orders')->with('shipping_addresses')->paginate(50);
        //     Log::info("Customer deleted!");
        // } else {
        //     $data['status'] = 'failed';
        //     $data['message'] = "An error occured!";
        //     Log::error("Customer wasn't successfully deleted.");
        // }

        return Inertia::render('Customers/Index', compact('customers', 'data'));
    }
}
