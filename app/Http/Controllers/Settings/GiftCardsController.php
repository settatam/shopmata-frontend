<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class GiftCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::find(session('store_id'));
        return Inertia::render('Settings/GiftCards/Index', compact('store'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function createGiftCards(Request $request)
    {
        try {
            // 'store_id', 'expire', 'period', 'duration'
            $data = $request->all();
            $validator = Validator::make($data, [
                "expire" => "required|in:1,2",
                "duration" => "nullable|string|in:years,months,days",
                "period" => "nullable|string",
            ]);

            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "errors" => $validator->errors(),
                ];
                return response()->json(['notification' => $notification], 400);
            }

            $updateGiftCard = Store::where('id', session('store_id'))
                ->update([
                    'gift_card_should_expire' => $data['expire'],
                    'gift_card_expire_after' => $data['period'],
                    'gift_card_expiry_duration' => $data['duration']
                ]);

            \Log::info(Auth::id() . "Updated gift cards" . print_r($data, true));

            $notification = [
                "title" => "Successful",
                "type" => "success",
                "message" => "Gift Card Settings Updated",
            ];

            return response()->json(['notification' => $notification]);
        } catch (\Throwable $th) {
            $exceptionDetails = [
                "message" => $th->getMessage(),
                'file' => basename($th->getFile()),
                'line' => $th->getLine(),
                'type' => class_basename($th),
            ];

            \Log::info("Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "An Exception Occurred Please Try Again",
            ];

            return response()->json(['notification' => $notification], 422);
        }
    }

    
}
