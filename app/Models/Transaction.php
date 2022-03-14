<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function notes() {
        return $this->hasMany(TransactionNote::class,);
    }

    public function customer() {
    	return $this->belongsTo(Customer::class);
    }

    public function getCreatedAtAttribute($value){
    	return \Carbon\Carbon::parse($value)->diffForHumans();
	}

	public function items(){
		return $this->hasMany(CartDetail::class, 'cart_id', 'cart_id');
	}
}
