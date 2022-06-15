<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LoginToken;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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


    public function loginWithToken(Request $request)
    {   
        $token = $request->token;
        $login_token = LoginToken::where('token', $token)->firstOrFail();

        try {
            if (null !== $login_token) {
               $customer = $login_token->customer;
               if(Auth::guard('customer')->login($customer)) {
                  $login_token->is_active = 0;
                  $login_token->save();
                  return redirect('/');
                }else{
                    abort(404);
                }
            }
        } catch (\Throwable $th) {
            abort(404);
        }
    }

}
