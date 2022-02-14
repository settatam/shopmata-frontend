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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                    "validationErrors" => $validator->errors(),
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
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Create Shipping Profile Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "An Exception Occurred Please Try Again",
            ];

            return response()->json(['notification' => $notification], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
