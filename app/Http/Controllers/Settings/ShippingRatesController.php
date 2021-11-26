<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingRate;
use App\Models\ShippingRateCondition;
use App\Http\Resources\ShippingRate as ShippingRateResource;
use App\Http\Resources\ShippingRateCollection;
use Log;
use Auth;

class ShippingRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new ShippingRateCollection(ShippingRate::with('conditions')->orderBy('id', 'desc')->get());

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
        // dd($request->input());
        
        $request->validate([
            'name'=>['required'],
            'price'=>['required'],
            'is_domestic'=>['required']
        ]);

        $data = $request->input();
        $data['store_id'] = $request->session()->get('store_id');
        $data['user_id'] = Auth::id();

        if($shipping_rate = ShippingRate::create($data)) {
            Log::info(Auth::id() . ' created a new shipping rate ' , $data);

            if(isset($data['conditions'])) {
                foreach($data['conditions'] as $condition) {
                    $condition['user_id'] = Auth::id();
                    $condition['shipping_rate_id'] = $shipping_rate->id;
                    $shipping_condition = ShippingRateCondition::create($condition);
                    Log::info(Auth::id() . ' created a new shipping rate condition ' , $condition);
                }
            }
        }

        return \Redirect::route('settings.shipping')->withSuccess('Your shipping rate was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ShippingRateResource(ShippingRate::with('conditions')->find($id));
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
        $request->validate([
            'name'=>['required'],
            'price'=>['required'],
            'is_domestic'=>['required']
        ]);

        $rate = ShippingRate::find($id);
        if(null !== $rate) {
            $rate->name = $request->name;
            $rate->price = $request->price;
            $rate->description = $request->description;
            if($rate->save()) {
                // Log::info();
                //Add to Store Activity
            }
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
        if(Auth::user()->canDo('delete-shipping-rate')) {
            $rate = ShippingRate::find($id);
            if(null !== $rate) {
                if(count($rate->conditions)) {
                    ShippingRateCondition::where('shipping_rate_id', $id)->delete();
                }
                
                if($rate->delete()) {
                    Log::info(Auth::id() . ' deleted a shipping rate ' . $id);
                }
                return response()->json('Resource Deleted');
            }else{
                return response()->json('Resource could not be deleted', 400);
            }
            
        }else{

        return \Redirect::route('settings.shipping')->withErrors('You do not have permissions to delete this record');
        }
    }
}
