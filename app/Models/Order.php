<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [ "user_id", "total", "status", "deleted_at", "store_id", "payment_gateqay_id", "sales_tax", "shipping_cost", "discount_cost", "cart_id", "sub_total", "shipping_weight", "shipping_gateway_id", "order_id" ];

    public static $PENDING = 'pending';
    public static $CONFIRMED = 'confirmed';
    public static $CANCELLED = 'cancelled';
    public static $FULFILLED = 'fulfilled';
    public static $RETURNED = 'returned';
    public static $REFUNDED = 'refunded';
    public static $SHIPPED = 'shipped';
    public static $DELIVERED = 'delivered';

    protected static function booted()
    {
         static::addGlobalScope(new StoreScope);
    }

    public function user() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
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

    public function tags() {
        return $this->hasMany(OrderTag::class);
    }

    public function activities() {
        return $this->hasMany(OrderActivity::class);
    }

    public function shipping_address() {
        return $this->hasOne(OrderShippingAddress::class);
    }

    public function shipping_addresses() {
        return $this->hasMany(ShippingAddress::class, 'user_id', 'user_id');
    }

    public function scopeWithTotalOrders($query, $customer_id) {
        return $query->addSelect(['total_orders'=>Order::selectRaw('sum(total) as total_orders')
                ->where('customer_id', $customer_id)
        ]);
    }

    public function scopeWithAverageOrders($query, $customer_id) {
        return $query->addSelect(['average_orders'=>Order::from('orders as or')->selectRaw('avg(total) as average_orders')
            ->where('customer_id', $customer_id)
                    // ->whereColumn('customer_id', 'orders.customer_id')
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
