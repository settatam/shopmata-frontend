<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCondition extends Model
{
    use HasFactory;

    public static function check($model, $field, $value, $action, $condition='==') {
        return self::where([
            ['model', '=', $model],
            ['field', '=', $field],
            ['action', '=', $action],
            ['condition', '==', $condition],
        ])->with('notification')->first();
    }

    public function notification() {
        return $this->belongsTo(StoreNotification::class, 'store_notification_id', 'id');
    }
}
