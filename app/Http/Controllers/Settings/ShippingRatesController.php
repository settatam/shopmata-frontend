<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingRate;
use App\Models\ShippingRateCondition;
use App\Http\Resources\ShippingRate as ShippingRateResource;
use App\Http\Resources\ShippingRateCollection;
use App\Http\Resources\ShippingRate as ShipRate;
use Inertia\Inertia;

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
        $user = request()->user();
        return new ShippingRateCollection(ShippingRate::with('conditions')->where('store_id', $user->store_id)->orderBy('id', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $condition_options = ShippingRateCondition::$condition_options;
        $rate_options = ShippingRateCondition::$rate_options;
        $rates = ShippingRate::with('conditions')->orderBy('id', 'desc')->get();
        return Inertia::render('Settings/Shipping/Components/ShippingProfile', compact('rates', 'condition_options', 'rate_options'));
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
            'name'=>['required'],
            'price'=>['required'],
            'is_domestic'=>['required']
        ]);

        try {
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
        } catch (\Throwable $th) {
            \Log::error("Failed to save shipping rate" . collect($request->all())  ."Error: " .$th->getMessage() );
            return response()->json(['message'=>"Failed to save shipping rate"], 422);

        }

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

        $condition_options = ShippingRateCondition::$condition_options;
        $rate_options = ShippingRateCondition::$rate_options;
        $rate = ShippingRate::find($id);
        $rate->load('conditions');
        return Inertia::render('Settings/Shipping/Components/EditShippingProfile', compact('rate', 'condition_options', 'rate_options'));
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

        try {
            $rate = ShippingRate::find($id);
            $rate->name = $request->name;
            $rate->price = $request->price;
            $rate->description = $request->description;
            $rate->is_domestic = $request->is_domestic;
            $rate->match_all_condition = $request->match_all_condition;
            $rate->is_international = $request->is_international;
            $data = $request->input();
            $data['store_id'] = $request->session()->get('store_id');
            $data['user_id'] = Auth::id();
            if( $rate->save() ) {
                ShippingRateCondition::destroy($rate->conditions->pluck('id')->toArray());
                Log::info(Auth::id() . ' Updated new shipping rate ' , $data);
                if(isset($data['conditions'])) {
                    foreach($data['conditions'] as $condition) {
                        $condition['user_id'] = Auth::id();
                        $condition['shipping_rate_id'] = $rate->id;
                        $shipping_condition = ShippingRateCondition::create($condition);
                        Log::info(Auth::id() . ' Updated a new shipping rate condition ' , $condition);
                    }
                }
            } else {
                return response()->json(['message'=>"Failed to update shipping rate"], 422);
                \Log::error("Failed to update shipping rate" . collect($request->all())  ."Error: " .$th->getMessage() );
            }
            return \Redirect::route('settings.shipping')->withSuccess('Your shipping rate was created successfully');
        } catch (\Throwable $th) {
            return response()->json(['message'=>"Failed to save shipping rate"], 422);
            \Log::error("Failed to save shipping rate" . collect($request->all())  ."Error: " .$th->getMessage() );
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

                return ShipRate::collection(ShippingRate::with('conditions')->orderBy('id', 'desc')->get());

            }else{
                return response()->json('Resource could not be deleted', 422);
            }
            
        }else{
            return \Redirect::route('settings.shipping')->withErrors('You do not have permissions to delete this record');
        }
    }
}
