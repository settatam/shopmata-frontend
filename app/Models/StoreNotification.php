<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'store_id',
        'user_id'
    ];

    public function category() {
    	return $this->belongsTo(StoreNotificationCategory::class, 'store_notification_category_id', 'id');
    }

    public function messages() {
        return $this->hasMany(StoreNotificationMessage::class);
    }


    public function event_condition() {
        return $this->hasOne(EventCondition::class);
    }

    public static function addNotification($request)
    {
        $user = $request->user();
        $store = self::create([
                                'store_id' =>  $user->store_id,
                                'user_id'  =>  $user->id,
                                'name' => $request->title
                            ]);
        return $store;
    }

}
