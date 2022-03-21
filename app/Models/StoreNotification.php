<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreNotification extends Model
{
    use HasFactory;

    public function category() {
    	return $this->belongsTo(StoreNotificationCategory::class, 'store_notification_category_id', 'id');
    }

    public function messages() {
        return $this->hasMany(StoreNotificationMessage::class);
    }
}
