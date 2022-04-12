<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    protected $fillable = [   
        'id',        
        'message',
        'from',
        'to',
        'is_read',
        'created_at',                       
        'user_id',
        'smsable_id',
        'smsable_type',
        'is_coming',
        'payload',
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
