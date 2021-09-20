<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\StoreUser;
use App\Models\StoreGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function createStore(Request $request){
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

    }

    private function generateSlug($str){
        return str_replace(" ","-", $str);
    }

    public function getStoreProducts(){
        $products = Product::orderBy('id', 'desc')->paginate(50);

        return response()->json(['products' => $products]);
    }
}
