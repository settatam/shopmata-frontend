<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreActualNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message',
        'store_notification_id',
        'store_id',
        'user_id',
        'store_notification_id'
    ];
}
