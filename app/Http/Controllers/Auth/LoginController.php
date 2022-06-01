<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Customer;


class LoginController extends Controller
{
    use AuthenticatesUsers;


    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
        // $this->middleware('guest:customer', ['except' => ['logout']]);
    }



    public function getLogin() {
        return \Inertia\Inertia::render('Login');
    }



    public function ForgotPassword(){
        return \Inertia\Inertia::render('Auth/ForgotPassword');
    }

    /**
     * Handle an authentication attempt for a customer.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */

    public function customerLogin(Request $request) {
        $credentials = $request->only('email', 'password');
        $storeId = request('storeId');
        $validator = Validator::make($credentials, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $customer = Customer::where('email', $request->email)
            ->where('store_id', $request->session()->get('store_id'))
            ->first();

        if(null !== $customer) {
            if(Auth::guard('customer')->attempt($credentials)) {
                //
                dd('We are authenticated');
            }else{
                dd('We are not authenticated');
            }
        }

        dd('The user was not found');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *Shopmata
     * @return Response
     */
    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            $storeId = request('storeId');
            $validator = Validator::make($credentials, [
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors(),
                ];
                return response()->json(['notification' => $notification], 400);
            }

            $query = User::query();
            if($request->session()->has('store_id')) {
                $query->whereHas('store_users', function($q) use ($request) {
                    $q->where('store_id', $request->session()->get('store_id'));
                });
            }
            $user = $query->with('store_users')
                ->where('email', $request->email)->first();
            if ($user === null) {
                $notification = [
                    "title" => "User not found",
                    "type" => "failed",
                    "message" => "Your account details are not correct. Please try again",
                ];
                return response()->json(['notification' => $notification], 422);
            } else {
                if (Auth::attempt($credentials)) {
                    Login::create([
                        'user_id' => Auth::id(),
                         'store_id' => $user->store_id,
                        'ip_address' => $request->ip()
                    ]);

                    //Log the user ..
                    session(['store_id' => $user->store_id]);

                    $notification = [
                        "title" => "Successful",
                        "type" => "success",
                        "message" => "Login Successful",
                    ];

                    return response()->json(['notification' => $notification, 'storeCount' => 1, 'stores' => null]);
                } else {
                    $notification = [
                        "title" => "Failed",
                        "type" => "failed",
                        "message" => "Password Does Not Match",
                    ];
                    return response()->json(['notification' => $notification], 400);
                }


                // if (count($user->store_users) == 1) {
                //     if (Auth::attempt($credentials)) {
                //         Login::create(
                //             ['user_id' => Auth::id(),
                //             'store_id' => $user->store_users[0]->store_id,
                //             'ip_address' => $request->ip()
                //         ]
                //         );

                //         //Log the user ..
                //         session(['store_id' => $user->store_users[0]->store_id]);

                //         $notification = [
                //             "title" => "Successful",
                //             "type" => "success",
                //             "message" => "Login Successful",
                //         ];

                //         return response()->json(['notification' => $notification, 'storeCount' => 1, 'stores' => null]);
                //     } else {
                //         $notification = [
                //             "title" => "Failed",
                //             "type" => "failed",
                //             "message" => "Password Does Not Match",
                //         ];
                //         return response()->json(['notification' => $notification], 400);
                //     }
                // } else {
                //     $stores = [];
                //     for ($i = 0; $i < count($user->store_users); $i++) {
                //         $user->store_users[$i]->name = null !== $user->store_users[$i]->store ? $user->store_users[$i]->store->name : '';
                //         $user->store_users[$i]->id = null !== $user->store_users[$i]->store ? $user->store_users[$i]->store->id : '';
                //     }

                //     if ($storeId !== 0) {
                //         //the user selected a store Id

                //         $storeExists = false;
                //         $selectedStore = null;
                //         foreach ($user->store_users as $storeUsers) {
                //             if ($storeUsers->store_id === $storeId) {
                //                 \Log::info('store exists'.print_r($storeUsers, true));
                //                 $storeExists = true;
                //                 $selectedStore = $storeUsers;
                //                 break;
                //             }
                //         }
                //         if ($storeExists === false) {
                //             $notification = [
                //                 "title" => "Store not found",
                //                 "type" => "failed",
                //                 "message" => "The Selected Store is Invalid",
                //             ];
                //             return response()->json(['notification' => $notification], 422);
                //         }

                //         if (Auth::attempt($credentials)) {
                //             Login::create(
                //                 ['user_id' => Auth::id(),
                //                  'store_id' => $selectedStore->store->id,
                //                  'ip_address'=>$request->ip()
                //                 ]
                //             );
                //             //Log the user ..
                //             session(['store_id' => $selectedStore->store->id ]);
                //             \Log::info("session store id". session('store_id'));

                //             $notification = [
                //                 "title" => "Successful",
                //                 "type" => "success",
                //                 "message" => "Login Successful",
                //             ];

                //             return response()->json(['notification' => $notification, 'storeCount' => 1, 'stores' => null]);
                //         } else {
                //             $notification = [
                //                 "title" => "Failed",
                //                 "type" => "failed",
                //                 "message" => "Password Does Not Match",
                //             ];
                //             return response()->json(['notification' => $notification], 400);
                //         }
                //     }

                //     //Display the stores for the user which he wants to log into
                //     $notification = [
                //         "title" => "Choose your store",
                //         "type" => "success",
                //         "message" => 'You have Multiple Stores',
                //     ];

                //     return response()->json(['notification' => $notification, 'storeCount' => count($user->store_users), 'stores' => $user->store_users], 200);

                // }

            }

            $notification = [
                "title" => "Not Found",
                "type" => "failed",
                "message" => "User with $credentials[email] Does Not Exist",
            ];
            return response()->json(['notification' => $notification], 404);

            // return redirect()->back();
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Login user exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 422);
        }
    }


    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');
    }
}
