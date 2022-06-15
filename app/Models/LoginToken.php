<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LoginToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'tokenable_id',
        'tokenable_type',
        'type',
        'token',
        'duration'
    ];

    static function createNew($user, $type='email', $duration=3600) {
        //update all existing tokens to be inactive
        self::where('tokenable_id', $user->id)->where('tokenable_type', get_class($user))->update(['is_active' => 0]);
        return self::create([
            'tokenable_id' => $user->id,
            'tokenable_type' => get_class($user),
            'type' => $type,
            'token' => $type == 'email' ? Str::random(60) : mt_rand(1111,9999),
            'duration' => $duration
        ]);
    }

    static function createForSms($user, $duration=3600) {
        return self::create([
            'tokenable_id' => $user->id,
            'tokenable_type' => get_class($user),
            'type' => 'sms',
            'token' => mt_rand(1111,9999),
            'duration' => $duration
        ]);
    }

}
