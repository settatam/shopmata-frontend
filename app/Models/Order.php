<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [ "user_id", "total", "status", "deleted_at", "store_id", "payment_gateqay_id", "sales_tax", "shipping_cost", "discount_cost", "cart_id", "sub_total", "shipping_weight", "shipping" ];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value){
    	return \Carbon\Carbon::parse($value)->diffForHumans();
	}

	public function items(){
		return $this->hasMany(CartDetail::class, 'cart_id', 'cart_id');
	}

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'created_at' => 'datetime',
    // ];

}
