<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\StoreLocation;
use Illuminate\Support\Facades\Log;
use App\Models\Country;


class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = StoreLocation::orderBy('id', 'desc')->get();
        $countries = Country::where('status', 1)->get();
        $countries->load('states');
        return Inertia::render('Settings/Shipping/Index', compact('countries','locations'));
    }

}
