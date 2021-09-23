<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\StoreUser;
use App\Models\StoreGroup;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function store(Request $request){
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'store' => ['required', 'string', 'max:255'],
            ]);

            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors()
                ];
                return response()->json(['notification' => $notification ], 400);
            }

            $user = User::find(Auth::id());

            \Log::info('creating store for user'.print_r($user, true));

            if(!$user){
                $notification = [
                    "title" => "Invalid User",
                    "type" => "failed",
                    "message" => "You must be Logged In",
                ];

                return response()->json([ 'notification' => $notification ], 401);
            }
            
            $store = Store::create([
                'user_id' => $user->id,
                'slug' => $this->generateSlug($data['store']),
                'name' => $data['store'],
                'email' => $user->email
            ]);

            $user->store_id = $store->id;
            $user->save();

            $storeOwnerDetails = StoreGroup::where('name', 'Owner')->first();

            $store_user = [
                'store_id' => $store->id,
                'user_id' => $user->id,
                'store_group_id' => $storeOwnerDetails->id ?? 1
            ];
            
            if(StoreUser::create($store_user)) {
                Log::info('Created a new owner with the following details', $store_user);
            }


            //create 
            
            $notification = [
                "title" => "Store Created Successfully",
                "type" => "success",
                "message" => "$data[store] Store has been Created",
            ];

            return response()->json([ 'notification' => $notification ], 200);
            
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename( $e->getFile() ),
                'line' => $e->getLine(),
                'type' => class_basename( $e ),
            ];

            \Log::info("create store exception".print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message']
            ];

            return response()->json(['notification' => $notification ], 500);
        }
    }

    public function update(Request $request) {
        
        $redirect = false;
        $input = $request->input();
        $redirect = 'settings.general';
        
        if($request->has('step')) {
            if($request->step == 2) {
                $request->validate([
                    'country_id'=>['required'],
                    'sales_method_id'=>['required'],
                    'has_website'=>['required']
                ]);
                $input['step'] = 3;

                $country = Country::find($request->country_id);
                if(null !== $country) {
                    $input['timezone_id'] = $country->default_time_zone_id;
                    $input['currency_id'] = $country->currency_id;
                    $input['unit_id'] = $country->unit_id;
                }
                $redirect = 'register-step-3';
            }else if($request->step == 3){
                
                $request->validate([
                    'first_name'=>['required'],
                    'last_name'=>['required'],
                    'business_name'=>['required']
                ]);

                $country = Country::find($request->country_id);
                
                if(null !== $country) {
                    $input['timezone_id'] = $country->default_time_zone_id;
                    $input['currency_id'] = $country->currency_id;
                    $input['unit_id'] = $country->unit_id;
                }

                $user = User::find(Auth::id());
                $user_details = [
                                    'first_name'=>$input['first_name'], 
                                    'last_name'=>$input['last_name']
                                ];

                if(null !== $user){
                    if($user->update($user_details)){
                        Log::info(Auth::id() . ' updated user details', $user_details);
                    }else{
                        Log::error(Auth::id() . ' Could not update user details', Auth::id());
                    }
                }
                
                unset($input['first_name']);
                unset($input['last_name']);
                unset($input['id']);
                unset($input['created_at']);
                unset($input['updated_at']);
                
                $input['step'] = 4;
                $redirect = 'dashboard';

                foreach($input as $index => $value) {
                    if(is_array($value)) unset($input[$index]);
                    if(is_null($value)) unset($input[$index]);
                }

            }
            
        }else{

            //This is the if the store update when not in a step
        }

        $store_id = $request->session()->get('store_id');
        if($store_id) {
            $store = Store::find($store_id);
            if($store->update($input)) {
                Log::info(Auth::id() . ' updated store ' . $store_id . ' with the following details', $input);
            }else{
                Log::info(Auth::id() . ' could not update store ' . $store_id . ' with the following details', $input);
            }
        }

        return \Redirect::route($redirect);
    }

    private function generateSlug($str){
        return str_replace(" ","-", $str);
    }

    public function getStoreProducts(){
        $products = Product::orderBy('id', 'desc')->paginate(50);

        return response()->json(['products' => $products]);
    }
}
