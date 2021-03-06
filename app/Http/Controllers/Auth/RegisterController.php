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
use App\Http\Requests\RegisterStep1Request;
use App\Http\Controllers\Auth\Register;




class RegisterController extends Controller
{
    use Register;


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getRegister','RegisterUser']]);
    }

    public function getRegister() {
        return \Inertia\Inertia::render('Register');
    }

    public function registerStep2(Request $request, $step=null) 
    {
        $industries = StoreIndustry::orderBy('name', 'asc')->get();
        $methods    = SalesMethod::orderBy('name', 'asc')->get();
        $countries  = Country::where('status', 1)->get();
        $user       = $request->user();
        $store      = null !== $user ? Store::find($user->store_id) : null;
        return \Inertia\Inertia::render('RegisterStep2', compact('industries', 'methods', 'countries','store'));
    }

    public function registerStep3(Request $request) 
    {
        $countries = Country::where('status', 1)->get();
        $countries->load('states');
        $states    = State::where(['country_id' => 1 , 'country_id' => 158])->get();
        return     \Inertia\Inertia::render('RegisterStep3', compact('states', 'countries'));
    }
    
    public function RegisterUser(RegisterStep1Request $request)
    {
        $this->registerStep1($request);
    }

}
