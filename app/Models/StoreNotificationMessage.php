<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreNotificationMessage extends Model
{
    use HasFactory;

    public function store_notification() {
        return $this->belongsTo(StoreNotification::class);
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
