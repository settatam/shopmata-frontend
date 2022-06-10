<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreIndustry;
use App\Models\SalesMethod;
use App\Models\Country;
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
        $countries  = Country::where('status', 1)->get();
        $countries->load('states');
        //$user       = $request->user();
        //$store      = null !== $user ? Store::find($user->store_id) : null;
        return Inertia\Inertia::render('Stores/Create', compact('industries', 'methods', 'countries','store'));
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
