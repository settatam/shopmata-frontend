<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Store;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendLink(Request $request, $customer_id)
    {
        try {
            $customer = Customer::find($customer_id);
            $store    = Store::find(session('store_id'));
            $customer->generateLoginTokenForEmail($store);
            return response()->json(['message'=> "Link sent" ], 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage()], 422);
        }
    }

}
