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

    public function tags() {
        return $this->hasMany(OrderTag::class);
    }

    public function activities() {
        return $this->hasMany(OrderActivity::class);
    }

    public function shipping_addresses() {
        return $this->hasMany(ShippingAddress::class, 'user_id', 'user_id');
    }

    public function scopeWithTotalOrders($query) {
        return $query->addSelect(['total_orders'=>Order::selectRaw('sum(total) as total_orders')
                    ->whereColumn('store_id', 'orders.store_id')
                    ->whereColumn('user_id', 'orders.user_id')
                    // ->where('user_id', 'orders.user_id')
                    // ->groupBy('user_id')
                ]);
    }

    public function scopeWithAverageOrders($query) {
        return $query->addSelect(['average_orders'=>Order::selectRaw('avg(total) as average_orders')
                    ->whereColumn('store_id', 'orders.store_id')
                    ->whereColumn('user_id', 'orders.user_id')
                ]);
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
