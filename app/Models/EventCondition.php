<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCondition extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'event_id', 'action', 'condition', 'model','action', 'field'];


    public static function check($model, $field, $value, $action, $condition='==') {
        return self::where([
            ['model', '=', $model],
            ['field', '=', $field],
            ['value', '=', $value],
            ['action', '=', $action],
            ['condition', '==', $condition],
        ])->with('notification')->first();
    }

    public function notification() {
        return $this->belongsTo(StoreNotification::class, 'store_notification_id', 'id');
    }
    
    public static function addCondition($input) {
       $input['field']  = $input['status_id'];
       $input['model']  = 'App\\Models\\'. $input['model'];
       $input['action'] = 'updated';
       $event = self::create($input);
       return $event;
    }


}
