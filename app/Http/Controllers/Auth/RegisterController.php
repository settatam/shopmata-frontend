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

    public function registerStep2($step=null) {
            $store_id = session()->get('store_id');
            $store = Store::find($store_id);
            if(null !== $store) {
                if($store->step == 2) {
                    $industries = StoreIndustry::orderBy('name', 'asc')->get();
                    $methods = SalesMethod::orderBy('name', 'asc')->get();
                    $countries = Country::where('status', 1)->get();
                    return \Inertia\Inertia::render('RegisterStep2', compact('industries', 'methods', 'countries'));
                }else if($store->step == 3) {
                    return \Redirect::route('register-step-3');
                }else if($store->step == 4) {
                    return \Redirect::route('dashboard');
                }
            }
        return \Redirect::route('register');
    }

    public function registerStep3() {
        $store_id = session()->get('store_id');
        $store = Store::find($store_id);
        if(null !== $store && $store->step == 3) {
            $countries = Country::where('status', 1)->get();
            $states = State::where('country_id', $store->country_id)->get();
            return \Inertia\Inertia::render('RegisterStep3', compact('states', 'countries'));
        }
        return \Redirect::route('register');
    }
    
    public function RegisterUser(Request $request)
    {
        $data = $request->input();
        // dd($data);
        
        // try {
            // $geoip = geoip($ip=null);

            // $data['email'] = session('email');
            // $data['store_domain'] = session('store_domain');


            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'confirmed', Password::min(8)],
                'name' => ['required', 'string'],
            ]);

            $user_details = [
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ];
          

            if($user = User::create($user_details)) {
                Log::info('A new user has been created', $user_details);
            }else{
                Log::error('A new could not be created', $user_details);
            }

            $store = new Store;
            $store->name = $data['name'];
            $slug = $store->generateSlug();

            //Time to create Store

            $store_data = [
                'is_active'=>0,
                'name'=>$data['name'],
                'slug'=>$slug,
                'store_plan_id'=>1,
                'step'=>2,
                'account_email'=>$data['email'],
                'user_id'=>$user->id,
                'template_id'=>1,

            ];

            //Log new store
            
            //Create Store
            //Create Default TimeZone
            //Create Default Theme
            //Create Default Currency
            //Create Domains
            //Create Default Weight Unit
            //Create Store Users -- Current user will be super user
            //Create Store Plan


            //Log new user

            if($store = Store::create($store_data)) {
                Log::info('Created a new store for user_id: ' . $user->id, $store_data);
            }else{
                Log::error('Could not create store for user_id: ' . $user->id, $store_data);
            }

            $user->store_id = $store->id;
            $user->save();

            $storeOwnerDetails = StoreGroup::where('name', 'Owner')->first(); //Cache this

            $store_user = [
                'store_id' => $store->id,
                'user_id' => $user->id,
                'store_group_id' => $storeOwnerDetails->id ?? 1,
            ];

            if(StoreUser::create($store_user)) {
                Log::info('created a new store user', $store_user);
            }

            session()->flush();

            $credentials = ['email' => $data['email'], 'password' => $data['password']];

            if (!Auth::attempt($credentials)) {
                return \Redirect::route('register');
            }

            Login::create(
                ['user_id'=> $user->id, 'store_id' => $store->id]
            );

            //Log the user ..
            session(['store_id' => $store->id]);

            return \Redirect::route('register-step-2');

        // } catch (\Exception $e) {
        //     $exceptionDetails = [
        //         "message" => $e->getMessage(),
        //         'file' => basename($e->getFile()),
        //         'line' => $e->getLine(),
        //         'type' => class_basename($e),
        //     ];

        //     \Log::info("create user exception" . print_r($exceptionDetails, true));

        //     $notification = [
        //         "title" => "An Exception Occurred",
        //         "type" => "failed",
        //         "message" => $exceptionDetails['message'],
        //     ];

        //     return response()->json(['notification' => $notification], 500);
        // }
    }

    private function generateSlug($str)
    {
        return str_replace(" ", "-", $str);
    }
}
