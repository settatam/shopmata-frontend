<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Login;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Customer;

class CustomerLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/transactions';
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }



    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');
    }

    public function customerLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $storeId = request('storeId');
        $validator = Validator::make($credentials, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $customer = Customer::where('email', $request->email)
            ->where('store_id', $request->session()->get('store_id'))
            ->first();

        if (null !== $customer) {

//            if(Auth::guard('customer')->attempt($credentials)) {
            if (Auth::guard('customer')->loginUsingId($customer->id)) {
                //return redirect('/transactions');
                if($request->ajax()) {
                    return response()->json($customer);
                }
            }
        }else{
            return response()->json(['errors' => [
                'Authentication Failed'
            ]], 422);
        }

        //return redirect('/customer/login');
    }

}
