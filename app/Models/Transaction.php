<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
    ];

    
    public function activities()
    {
        return $this->morphMany(Activity::class, 'activityable');
	}


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}


    public function notes() 
    {
        return $this->hasMany(TransactionNote::class);
    }
  
     
    public function customer() 
    {
    	return $this->belongsTo(Customer::class,'user_id', 'id');
    }


    public function getCreatedAtAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->diffForHumans();
	}


    public function items() 
    {
        return $this->hasMany(TransactionItem::class);
    }


    public function histories() 
    {
        return $this->hasMany(TransactionHistory::class);
    }


    public function offers() 
    {
        return $this->hasMany(TransactionOffer::class);
    }


    public function sms()
    {
        return $this->morphMany(Sms::class, 'smstable');
    } 
}
