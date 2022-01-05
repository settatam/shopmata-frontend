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

        if ( $store ) {
            //Log event
            return response()->json(['message' => "Notification saved successfully."],200);
        } 
        
        return response()->json(['message'=>'Notification could not be saved'], 422);

    }

}
