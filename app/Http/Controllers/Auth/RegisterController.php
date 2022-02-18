<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Login;
use App\Models\Store;
use App\Models\StoreUser;
use App\Models\StoreGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Torann\GeoIP\Facades\GeoIP;
use App\Models\StoreIndustry;
use App\Models\SalesMethod;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
use Auth as UserAuth;
use App\Models\Country;
use App\Models\State;
use App\Models\Timezone;


class RegisterController extends Controller
{
    
    public function getRegister() {
        return \Inertia\Inertia::render('Register');
    }

    public function registerStep2(Request $request, $step=null) {
       // $store_id = session()->get('store_id');
        $industries = StoreIndustry::orderBy('name', 'asc')->get();
        $methods    = SalesMethod::orderBy('name', 'asc')->get();
        $countries  = Country::where('status', 1)->get();
        return \Inertia\Inertia::render('RegisterStep2', compact('industries', 'methods', 'countries'));
    }

    public function registerStep3() {
        // $store_id = session()->get('store_id');
        // $store = Store::find($store_id);
        // if(null !== $store && $store->step == 3) {
            $countries = Country::where('status', 1)->get();
            $states = State::where(['country_id' => 1 , 'country_id' => 158])->get();
            return \Inertia\Inertia::render('RegisterStep3', compact('states', 'countries'));
       // }
       // return \Redirect::route('register');
    }
    
    public function RegisterUser(Request $request)
    {
        
        $data = $request->input();

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
            'first_name'   => ['required', 'min:1', 'max:100'],
            'last_name'    => ['required','min:1','max:200'],
        ]);

        try {
            

            $user_details = [
                'email' => $data['email'],
                'first_name' => $data['first_name'],
                'last_name' => $data['first_name'],
                'password' => Hash::make($data['password'])
            ];
          
            if($user = User::create($user_details)) {
                Log::info('A new user has been created', $user_details);
            }else{
                Log::error('A new could not be created', $user_details);
            }

            $credentials = ['email' => $data['email'], 'password' => $data['password']];

            if (!Auth::attempt($credentials)) {
                return \Redirect::route('register');
            }

            return \Redirect::route('register-step-2');

        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("create user exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }

    private function generateSlug($str)
    {
        return str_replace(" ", "-", $str);
    }
}
