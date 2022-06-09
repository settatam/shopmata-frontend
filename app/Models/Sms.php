<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'id',
        'smsable_id',
        'smsable_type',
        'message',
        'from',
        'to',
        'payload',
        'user_id'
    ];


    public function smsable()
    {
        return $this->morphTo();
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}


    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'smsable_id','id');
	}


}
