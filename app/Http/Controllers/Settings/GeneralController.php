<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\Currency;
use App\Models\GiftCard;
use App\Models\Login;
use App\Models\PaymentGateway;
use App\Models\Settings;
use App\Models\ShippingProfile;
use App\Models\Store;
use App\Models\StoreGroup;
use App\Models\StoreIndustry;
use App\Models\StoreNotification;
use App\Models\StorePaymentGateway;
use App\Models\StoreUser;
use App\Models\Timezone;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $store = Store::find(session('store_id'));
        $countries = Country::where('status', 1)->get(); //Should be cached
        if($store->country_id) {
            $states = State::where('country_id', $store->country_id)->get();
        }else{
            $states = [];
        }
        $currencies = Currency::all(); //should by cached
        $units = Unit::all(); //should be cached
        $industries = StoreIndustry::all(); //Should be cached
        $timezones = Timezone::all(); //should be cached
        return Inertia::render('Settings/Index', compact('store', 'countries', 'currencies', 'units', 'industries', 'timezones', 'states'));
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
