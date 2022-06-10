<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\StoreNotificationMessage;
use App\Http\Controllers\Controller;


class StoreNotificationMessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'subject'=>['required'],
        //     'message'=>['required'],
        //     'store_notification_id'=>['required']
        // ]);
        $user = $request->user();
        try {
            StoreNotificationMessage::addNotification($request, $user);
            \Log::info("Updated store  notifications with".  collect($request->all()));
            return response()->json(['message' => "Notification saved successfully."], 200);
        } catch (\Throwable $th) {
            \Log::error("Failed to Update store actual notifications with" . collect($request->all())  ."Error: " .$th->getMessage() );
            return response()->json(['message'=>$th->getMessage()], 422);
        }
    }

}
