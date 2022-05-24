<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreNotificationMessage extends Model
{
    use HasFactory;

    protected $fillable = [
                        'message',
                        'store_notification_id',
                        'store_id',            
                        'user_id',  
                        'channel',
                        'email_subject' ,
                        'is_custom'   
                    ];


    public static function addNotification($request, $user) {

        foreach ($request->channels as $key => $channel) {
            $message  = $channel."_message";
            $input = $request->only(['sms_message','email_message']);
            $store = self::updateOrCreate(
                ['store_notification_id' => $request->store_notification_id, 'channel' => $channel],
                [
                    'message' => $input[$message],
                    'store_notification_id' => $request->store_notification_id,
                    'store_id' =>  $user->store_id,
                    'user_id'  =>  $user->id,
                    'channel' => $channel,
                    'email_subject' => $request->subject,
                    'is_custom' => $request->is_custom ? 1 :0

                ]
            );
        }

    }


    public function store_notification() {
        return $this->belongsTo(StoreNotification::class);
    }


    public function getCustomMessages($store_id) {
        return $this->where(['store_id'=>$store_id, 'is_custom' =>true])->get();
    }



    public static function getAllMessages($store_id, $event){
        return self::with('store_notification')->whereHas('store_notification', function($q) use ($event, $store_id) {
            $q->where('name', $event)
                ->where(function($query) use($store_id) {
                $query->where('is_default', 1)->orWhere('store_id', $store_id);
            });
        })->get();
    }

    public function getIsCustomerAttribute(){
        return $this->store_notification->is_customer;
    }
}
