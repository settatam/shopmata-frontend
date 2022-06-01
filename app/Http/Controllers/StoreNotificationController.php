<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\StoreNotification;
use App\Models\StoreNotificationMessage;

class StoreNotificationController extends Controller
{
    
    

    



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMsg(Request $request)
    {   
        $store_notification = StoreNotification::find($request->store_notification_id);
        $email = StoreNotificationMessage::where(['store_notification_id' => $store_notification->id,'channel' => 'email'])->first();
        $sms   = StoreNotificationMessage::where(['store_notification_id' => $store_notification->id,'channel' => 'sms'])->first(); 
        
        $data = [
            'email' => $email,
            'sms' => $sms
        ];

        return  response()->json($data,200);
    }

}
