<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // \Log::info("Get order request Received".print_r($request->all(), true));
        //
        $filters = $request->all('search', 'from', 'to', 'user');
        // $orders = Order::whereHas('user')->with('user')->with('items')->orderBy('id', 'asc')->paginate(50);

       $orders = Order::whereHas('user', function($query){
            // $query->addSelect(['total_orders'=>Order::selectRaw('sum(total) as total_sum')
            //                 ->whereColumn('store_id', 'orders.store_id'),
            // ]);
       })->with('user')->withTotalOrders()->withAverageOrders()
            ->with('items')
            ->with('tags')
            ->orderBy('id', 'asc')->paginate(50);

        // dd($orders);
        return Inertia::render('Orders/Index', compact('orders', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return Inertia::render('Orders/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $userId = Auth::id();
            //create cart 
            $cart = Cart::create([
                'user_id' => $userId,
                'status' => $request->paid === true ? 'paid' : "pending",
                'discount_id' => $request->discount ?? null,
                'is_completed' => false
            ]);

            //create order
            $newOrder = Order::create([
                'user_id' => $userId,
                'status' => $request->paid === true ? 'paid' : "pending",
                'total' => $request->total,
                'store_id' => $request->store ?? 2,
                'payment_gateway_id' => $request->gateway ?? null,
                'sales_tax' => $request->tax ?? 0,
                'discount_cost' => $request->discountCost ?? 0,
                'cart_id' => $cart->id,
                'sub_total' =>  $request->subTotal,
                'shipping_weight' => $request->shippingWeight ?? null,
                'shipping' => $request->shipping ?? null
            ]);


            //create cart Details
            foreach ($request->orders as $order) {
                // \Log::info("Order".print_r($order, true));
                CartDetail::create([
                    "sku" => $order['sku'], 
                    "cart_id" => $cart->id, 
                    "price"=> $order['compare_at_price'], 
                    "quantity" => (int) $order['quantityOrdered'], 
                    "tracking_number" => $order['trackingNumber'] ?? null, 
                    "shipping_status" => $order['shippingStatus'] ?? null, 
                    "delivery_date" => $order['deliveryDate'] ?? null, 
                    "shipping_carrier" => $order['shippingCarrier'] ?? null, 
                    "status" => $order['status']
                ]);
            }

            $notification = [
                "title" => "Order #$newOrder->id created",
                "type" => "success",
                "message" => "Create another Order"
            ];

            return $this->show($newOrder->id, $notification);

        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename( $e->getFile() ),
                'line' => $e->getLine(),
                'type' => class_basename( $e ),
            ];

            \Log::info("create order exception".print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message']
            ];

            // return back()->with("notification", $notification);
            return Inertia::render('Orders/Create', compact('notification'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $notification = null )
    {
        $order = Order::with('items')->with('tags')->with('user')->with('activities')->where('id', $id)->first();
    
        return Inertia::render('Orders/Show', compact('notification', 'order'));
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
