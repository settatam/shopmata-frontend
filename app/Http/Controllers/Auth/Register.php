<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{Country,Login,Product,Store,StoreUser,StoreGroup,User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Auth,Validator,Log,Notification};
use App\Http\Helpers\Helper;

use App\Events\UserAndStoreCreated;


use Exception;

trait Register 
{
    public  function registerStep1($request) {

        try {

            //You must be logged in
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            if($user = User::create($data)) {
                $input = $request->only(['email', 'password']);
                if (!Auth::attempt($input)) {
                    throw new Exception("Login failed");
                }
                Log::info('A new user has been created', $data);
                return  response()->json([
                    'next_url' => 'register-step-2',
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'user' => $user
                ], 200);
            } 

            throw new Exception("Failed to save user");
        
        } catch (\Exception $e) {
            $errorMessages = $this->exMessage($e);
            \Log::info("Exception" . print_r($errorMessages['exceptionDetails'], true));
            return response()->json(['status' => $errorMessages['notification']], 422);
        }
    }


    public  function registerStep2($request) {

        try {

            $user = $request->user();
            $store = new Store;
            $store_name = $request->store_name;
            $store_data = [
                'is_active'=>0,
                'name'=>$store_name,
                'store_domain'=>$request->store_domain,
                'slug'=>Helper::generateSlug($store_name),
                'store_plan_id'=>1,
                'step'=>2,
                'account_email'=>$user->email,
                'user_id'=>$user->id,
                'theme_id'=>1,
                'industry_id' => $request->industry_id,
                'sales_method_id' => $request->sales_method_id,
                'has_website' => $request->has_website ? 1 : 0,
            ];

            //Log new user

            

            if(!$request->store_id  && $store = Store::create($store_data)) {
                $user->store_id = $store->id;
                $user->save();
                $storeOwnerDetails = StoreGroup::where('name', 'Owner')->first(); //Cache this
                Log::info('Created a new store for user_id: ' . $user->id, $store_data);
                $store_user = [
                    'store_id' => $store->id,
                    'user_id' => $user->id,
                    'store_group_id' => $storeOwnerDetails->id ?? 1,
                ];

                if(StoreUser::create($store_user)) {
                    Log::info('created a new store user', $store_user);
                }
                
                Login::create(
                    ['user_id'=> $user->id, 'store_id' => $store->id]
                );

                return  response()->json([
                    'next_url' => 'step-3',
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'store' => $store
                ], 200);

            }

            if ($request->store_id) {
                $store = Store::find($request->store_id);
                if($store->update($store_data)) { 
                    Log::info('Updated  store for user_id: ' . $user->id, $store_data);
                }
            }

            Log::error('Could not create store for user_id: ' . $user->id, $store_data);
            throw new Exception("Failed to create your store");
        } catch (\Exception $e) {
            $errorMessages = $this->exMessage($e);
            \Log::info("Exception" . print_r($errorMessages['exceptionDetails'], true));
            return response()->json(['status' => $errorMessages['notification']], 422);
        }
    }


    public  function updateStep2($request) {

        try {

            $user = $request->user();
            $store = new Store;
            $store_name = $request->store_name;
            $store_data = [
                'is_active'=>0,
                'name'=>$store_name,
                'store_domain'=>$request->store_domain,
                'slug'=>Helper::generateSlug($store_name),
                'store_plan_id'=>1,
                'step'=>2,
                'account_email'=>$user->email,
                'user_id'=>$user->id,
                'theme_id'=>1,
                'industry_id' => $request->industry_id,
                'sales_method_id' => $request->sales_method_id,
                'has_website' => $request->has_website ? 1 : 0,
            ];

            //Log new user

        
            if(!$request->store_id  && $store = Store::create($store_data)) {
                $user->store_id = $store->id;
                $user->save();
                session(['store_id' => 'value']);
                $storeOwnerDetails = StoreGroup::where('name', 'Owner')->first(); //Cache this
                Log::info('Created a new store for user_id: ' . $user->id, $store_data);
                $store_user = [
                    'store_id' => $store->id,
                    'user_id' => $user->id,
                    'store_group_id' => $storeOwnerDetails->id ?? 1,
                ];

                if(StoreUser::create($store_user)) {
                    Log::info('created a new store user', $store_user);
                }
                
                Login::create(
                    ['user_id'=> $user->id, 'store_id' => $store->id]
                );

                return  response()->json([
                    'next_url' => 'step-3',
                    'status' => 'success',
                    'message' => 'Store created successfully',
                    'store' => $store
                ], 200);

            }

            if ($request->store_id) {
                $store = Store::find($request->store_id);
                if($store->update($store_data)) { 
                    Log::info('Updated  store for user_id: ' . $user->id, $store_data);
                    return  response()->json([
                        'next_url' => 'step-3',
                        'status' => 'success',
                        'message' => 'Store updated successfully',
                        'store' => $store
                    ], 200);
                }
            }

            Log::error('Could not create store for user_id: ' . $user->id, $store_data);
            throw new Exception("Failed to create your store");
        } catch (\Exception $e) {
            $errorMessages = $this->exMessage($e);
            \Log::info("Exception" . print_r($errorMessages['exceptionDetails'], true));
            return response()->json(['status' => $errorMessages['notification']], 422);
        }
    }



    public  function registerStep3($request) 
    {

        try {
            $redirect = false;
            $user = $request->user();
            $input = $request->input();
            $store_id = $user->store_id;
            $redirect = 'settings.general';
            if($request->has('step')) {
                if($request->step == 3){
                    $country = Country::find($request->country_id);
                    if(null !== $country) {
                        $input['timezone_id'] = $country->default_time_zone_id;
                        $input['currency_id'] = $country->currency_id;
                        $input['unit_id'] = $country->unit_id;
                    }                   
                    $input['step'] = 4;
                    $redirect = 'dashboard';
                } 
            }

            $store = Store::find($store_id);
            if($store->update($input)) {
                Log::info(Auth::id() . ' updated store ' . $store_id . ' with the following details', $input);
            }else{
                Log::info(Auth::id() . ' could not update store ' . $store_id . ' with the following details', $input);
            }

            event(new UserAndStoreCreated($user));
            
            return  response()->json([
                'next_url' => 'step-3',
                'status' => 'success',
                'message' => 'User created successfully',
            ], 200);

        } catch (\Exception $e) {
            $errorMessages = $this->exMessage($e);
            \Log::info("Exception" . print_r($errorMessages['exceptionDetails'], true));
            return response()->json(['status' => $errorMessages['notification']], 422);
        }
    }


    public function exMessage($e) {

        $data = [];
        $data['exceptionDetails'] = [
            "message" => $e->getMessage(),
            'file' => basename($e->getFile()),
            'line' => $e->getLine(),
            'type' => class_basename($e),
        ];

        $data['notification'] = [
            "title" => "An Exception Occurred",
            "type" => "failed",
            "message" => $e->getMessage(),
        ];

        return $data;
    }

}
