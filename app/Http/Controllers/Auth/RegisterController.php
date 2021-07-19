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

class RegisterController extends Controller
{
    public function RegisterUser(Request $request)
    {
        try {
            $data = $request->all();

            $data['email'] = session('email');
            $data['store'] = session('store');
            $data['store_domain'] = session('store_domain');

            $validator = Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'store' => ['required', 'string'],
                'store_domain' => ['required', 'string'],
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

            $registered = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $store = Store::create([
                'user_id' => $registered->id,
                'slug' => $this->generateSlug($data['store']),
                'name' => $data['store'],
                'email' => $data['email'],
            ]);

            $registered->store_id = $store->id;
            $registered->save();

            $storeOwnerDetails = StoreGroup::where('name', 'Owner')->first();

            StoreUser::create([
                'store_id' => $store->id,
                'user_id' => $registered->id,
                'store_group_id' => $storeOwnerDetails->id ?? 1,
            ]);

            session()->flush();

            $credentials = ['email' => $data['email'], 'password' => $data['password']];

            if (!Auth::attempt($credentials)) {
                $notification = [
                    "title" => "Login Failed",
                    "type" => "failed",
                    "message" => "User Login Failed, Please Login and Create Store",
                ];

                return response()->json(['notification' => $notification], 422);
            }

            Login::create(
                ['user_id'=> $registered->id, 'store_id' => $store->id]
            );

            //Log the user ..
            session(['store_id' => $store->id]);

            $notification = [
                "title" => "User Created Successfully",
                "type" => "success",
                "message" => "$data[email] has been Created",
                // 'user' => $registered
            ];

            return response()->json(['notification' => $notification], 200);

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
