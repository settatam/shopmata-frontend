<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    const SMS_PROVIDER = 'twilio';
    const SMS_NUMBER = 'sms_send_from';
    const SMS_SID = 'sms_sid';

    protected $fillable = [
        'field',
        'value',
        'user_id',
        'store_id'
    ];

    public function metaable()
    {
        return $this->morphTo();
    }

}
