<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    const TAGS = [
        'Easy',
        'Med',
        'Hard'
    ];

    protected $appends = [
        'activation_status',
        'timezone'
    ];

    protected $fillable = [
        'user_id',
        'store_id',
        'country',
        'state',
        'phone',
        'city',
        'first_name',
        'last_name',
        'phone',
        'address',
        'address2',
        'accepts_marketing',
        'is_active',
        'zip',
        'password'
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public static function addtag($tag_id, $id) {

        $customer = self::findOrFail($id);
        //This will become a problem if we don't have a store ....
        $store_tag   =  StoreTag::where(
                            [
                                'tagable_id' => $id,
                                'tag_id'     => $tag_id
                            ]
                        )->first();
        if (null !== $store_tag){
            $store_tag->delete();
            Log::info("Tag(s) deleted!", );
            return true;
        } else {
            $tags  = new StoreTag(['tag_id' => $tag_id]);
            if ( $customer->tags()->save($tags) ) {
                return true;
            }
        }

        return false;
    }

    public function public_note()
    {
        return $this->hasOne(TransactionNote::class)->where('type','public');
    }

    function getTimezoneAttribute()
    {
      // TODO: make it configurable
      return 'America/New_York';
    }

    public function private_note()
    {
        return $this->hasOne(TransactionNote::class)->where('type','private');
    }

    public function tags()
    {
        return $this->morphMany(StoreTag::class, 'tagable');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getActivationStatusAttribute()
    {
        return 'Email Sent';
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function store_users()
    {
        return $this->hasMany(StoreUser::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class,'customer_id','id');
    }


    public function state()
    {
        return $this->belongsTo(State::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeWithTotalOrders($query, $customer_id){
        return $query->addSelect(['total_orders'=>Order::selectRaw('sum(total) as total_orders')
            ->where('customer_id', $customer_id)
        ]);
    }

    public function shippingAddress() {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function transaction_payment_address()
    {
        return $this->hasOne(TransactionPaymentAddress::class);
    }

}
