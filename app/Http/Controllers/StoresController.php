<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreIndustry;
use App\Models\SalesMethod;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Unit;
use App\Models\Timezone;

use App\Http\Helpers\Helper;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;




class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stores = Store::where('user_id', Auth::id())->get();
        return Inertia::render('Stores/Index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industries = StoreIndustry::orderBy('name', 'asc')->get();
        $methods    = SalesMethod::orderBy('name', 'asc')->get();
        $countries  = Country::with('states')->where('status', 1)->first();
        $currencies = Currency::all(); //should by cached
        $units      = Unit::all(); //should be cached
        $timezones  = Timezone::all(); //should be cached
        //$user       = $request->user();
        //$store      = null !== $user ? Store::find($user->store_id) : null;
        return Inertia::render('Stores/Create', compact('industries', 'methods', 'countries','currencies','units','timezones'));
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
            $input = $request->all();
            $input['slug'] = Helper::generateSlug($input['name']);
            $input['user_id'] = Auth::id();
            $store = (new Store)->addStore($input);
            \Log::info("Store Added" . collect($request->all()));
            return response()->json(['message'=> "Store added" ], 200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to add  store" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response()->json(['message'=> $th->getMessage()], 422);
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
        try {
            $input = $request->all();
            $input['slug'] = Helper::generateSlug($input['name']);
            $input['user_id'] = Auth::id();
            $store = Store::find($id);
            $store->updateStore($store, $input);
            \Log::info("Store Added" . collect($request->all()));
            return response()->json(['message'=> "Store update" ], 200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to update  store" . collect($request->all())  ."  Error: " .$th->getMessage() );
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
    }
}
