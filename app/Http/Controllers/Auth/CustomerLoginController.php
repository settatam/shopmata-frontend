<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginToken;
use Illuminate\Http\Request;

use App\Models\Login;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Customer;
use App\Models\StoreEngagement;
use Illuminate\Support\Str;

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
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function getLogin() {
        $store = Store::find(session()->get('store_id'));
        $pageToFind = 'customer.login';
        $pageType = 'page';
        $data = [];
        $page = $store->pageContent($pageToFind, $data, $pageType);
        return view('pages.index', compact('page'));
    }

    public function resetPassword()
    {
        $store = Store::find(session()->get('store_id'));
        $pageToFind = 'reset-password';
        $pageType = 'template';
        $data = [];
        $page = $store->pageContent($pageToFind, $data, $pageType);
        return view('pages.index', compact('page'));
    }

    public function changePassword(Request $request)
    {
        $store = Store::find(session()->get('store_id'));
        $tokenString = base64_decode($request->t);

        $tokens = explode('---', $tokenString);
        if(count($tokens) !== 2) {
          return redirect('/customer/login?error=Incorrect Tokens');
        }

        $customer = Customer::with('passwordToken')->where('email', $tokens[0])->first();
        if(null === $customer) return redirect('/customer/login?error=Customer not found');
        if ($token = $customer->passwordToken) {
          if ($token->token === $tokens[1]) {
            $pageToFind = 'change-password';
            $pageType = 'template';
            $data = [
              'customer' => $customer
            ];
            $page = $store->pageContent($pageToFind, $data, $pageType, $token);
            return view('pages.index', compact('page', 'customer', 'token'));
          }
        }
        return redirect('/customer/login?error=Unknown Error');
    }

    public function postChangePassword (Request $request)
    {

      $request->validate([
        'password' => 'required',
        'confirm_password' => 'required'
      ]);

      dd($request->t);

      if($request->password !== $request->confirm_password) {
        //error - go back
        return response()->json('Your passwords do not match', 400);
      }


      if ($customer = $request->session()->get('customer')) {
        $customer->password = Hash::make($request->password);
        if($customer->save()) {
          //
          Log::info($customer->full_name . 'updated their password');
          $customer->passwordToken->is_active = false;
          $customer->passwordToken->save();
          Auth::LoginUsingId($customer->id);
          return response()->json('Request Successful');
        }
      }

      return response()->json('There is a problem', 400);

    }

    public function postResetPassword(Request $request)
    {
      $request->validate([
        'email' => 'required'
      ]);

      if($request->has('token')) {
        $tokenExists = LoginToken::where('token', $request->token)->where('is_active', 1)->first();

      }

      $store = Store::find(session()->get('store_id'));

      $email = $request->email;
      $token = Str::random(60);
      $user = Customer::where('email', $request->email)->first();

      $request->session()->put('customer', $user);

      if (null !== $user) {
        $token = $user->generateTokenForPassword($store);
        return response()->json($token);
      } else {
        return response()->json('Not Done', 400);
      }

    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');
    }

    public function loginWithToken(Request $request) {
        if($request->has('token')) {
            $tokenExists = LoginToken::where('token', $request->token)->where('is_active', 1)->first();
            if(null !== $tokenExists) {
                if($tokenExists->tokenable_type === Customer::class) {
                    if(Auth::loginUsingId($tokenExists->tokenable_id)) {
                        $tokenExists->is_active = 0;
                        $tokenExists->save();
                        return redirect('/transactions');
                    }
                }
            }
        }
        return redirect('/customer/login');
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
            if(Auth::guard()->attempt($credentials)) {
           // if (Auth::loginUsingId($customer->id)) {
                if($request->session()->has('store_engagement_id')) {
                    StoreEngagement::find($request->session()->get('store_engagement_id'))
                        ->update(['engageable_id' => Auth::id()]);
                }
                return response()->json($customer);
//                if($request->ajax()) {
//                    return response()->json($customer);
//                }else{
//                    return redirect('/transactions');
//                }
            }else{
                return response()->json(['errors' => [
                'Could not login the user'
            ]], 422);
            }
        }else{
            return response()->json(['errors' => [
                'Authentication Failed'
            ]], 422);
        }

        return response()->json(['errors' => [
                'This email does not exist'
            ]], 422);

        //return redirect('/customer/login');
    }

}
