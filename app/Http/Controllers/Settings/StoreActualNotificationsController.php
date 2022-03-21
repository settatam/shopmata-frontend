<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\StoreActualNotification;
use App\Http\Controllers\Controller;


class StoreActualNotificationsController extends Controller
{
    

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'subject'=>['required'],
            'message'=>['required'],
            'store_notification_id'=>['required']
        ]);
        $user = $request->user();

        try {
            $store = StoreActualNotification::updateOrCreate(
                ['store_notification_id' => $request->store_notification_id],
                [
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'store_notification_id' => $request->store_notification_id,
                    'store_id' =>  $user->store_id,
                    'user_id'  =>  $user->id
                ]
            );
            \Log::info("Updated store actual notifications with".  collect($request->all()));
            return response()->json(['message' => "Notification saved successfully."], 200);
        } catch (\Throwable $th) {
            \Log::error("Failed to Update store actual notifications with" . collect($request->all())  ."Error: " .$th->getMessage() );
            return response()->json(['message'=>"Failed to save notification"], 422);
        }
    }

}
