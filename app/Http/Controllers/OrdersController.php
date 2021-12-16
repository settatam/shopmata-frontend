<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ShippingAddress;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $statuses = Order::statuses();
        $filters = $request->all('search', 'from', 'to', 'user');
        // $orders = Order::whereHas('user')->with('user')->with('items')->orderBy('id', 'asc')->paginate(50);

       $orders = Order::whereHas('user', function($query){
            // $query->addSelect(['total_orders'=>Order::selectRaw('sum(total) as total_sum')
            //                 ->whereColumn('store_id', 'orders.store_id'),
            // ]);
       })->with('user')
            ->with('items')
            ->with('tags')
            ->orderBy('id', 'asc')->paginate(50);

        $shipping_addresses = ShippingAddress::where('user_id', Auth::id())->orderBy('is_default')->get();

        // dd($orders);
        return Inertia::render('Orders/Index', compact('orders', 'filters', 'shipping_addresses', 'statuses'));
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
        $o = Order::find($id);
        $statuses = Order::statuses();
        $order = Order::with(['activities','billing_address','customer','items','tags','shipping_addresses'])->withTotalOrders($o->customer_id)->withAverageOrders($o->customer_id)->where('id', $id)->first();

        if(count($order->items)) {
            for($i=0; $i<count($order->items); $i++) {  
                if(null !== $order->items[$i]->variant->product) {
                    $order->items[$i]->title = $order->items[$i]->variant->product->title;
                }else{
                   $order->items[$i]->title = 'This is a test title';
                }
            }
        }

        return Inertia::render('Orders/Show', compact('notification', 'order', 'statuses'));
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
        git push -u origin jacob_dev
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
