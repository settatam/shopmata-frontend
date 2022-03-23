<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
    ];

    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}


    public function notes() {
        return $this->hasMany(TransactionNote::class);
    }
  
     
    public function customer() {
    	return $this->belongsTo(Customer::class,'user_id', 'id');
    }
    

    public function getCreatedAtAttribute($value){
    	return \Carbon\Carbon::parse($value)->diffForHumans();
	}


    public function items() {
        return $this->hasMany(TransactionItem::class);
    }


    public function histories() {
        return $this->hasMany(TransactionHistory::class);
    }


    public function offer() {
        return $this->hasOne(TransactionOffer::class);
    }
}
