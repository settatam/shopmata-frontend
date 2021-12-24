<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\StoreActualNotification;

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
        ]);

        $user = $request->user();
        $store_actual_notifications = new StoreActualNotification;
        $store_actual_notifications->subject = $request->subject;
        $store_actual_notifications->notification = $request->message;
        $store_actual_notifications->store_notification_id = $request->store_notification_id;
        $store_actual_notifications->store_id =  $user->store_id;
        $store_actual_notifications->user_id  =   $user->id;
        if ( $store_actual_notifications->save() ) {
            //Log events

            return response()->json(['message' => "Notification saved successfully."],200);
        } 
        return response()->json(['message'=>'Notification could not be saved'], 422);
    }

}
