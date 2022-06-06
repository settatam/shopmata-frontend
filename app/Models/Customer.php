<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;
use App\Http\Helpers\Helper;
use Carbon\Carbon;


class Customer extends Authenticatable
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
        'timezone',
        'transaction_count',
    ];

    protected $fillable = [
        'user_id',
        'store_id',
        'country',
        'state_id',
        'phone',
        'city',
        'first_name',
        'last_name',
        'phone',
        'street_address',
        'street_address2',
        'accepts_marketing',
        'is_active',
        'zip',
        'password',
        'customer_notes',
        'gender',
        'home_phone_number',
        'ext'

    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }


    public function customer_address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }


    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }


    public function age()
    {
        return Carbon::parse($this->dob)->age;
    }

    public static function addNew(Store $store, $input,)
    {
        $customer = new static;

        $customer->first_name   = $input['first_name'];
        $customer->last_name    = $input['last_name'];
        $customer->email        = $input['email'];
        $customer->phone_number = $input['phone'];
        $customer->store_id     = $store->id;
        //$customer->customer_notes  = $input['description'];
        $customer->password = bcrypt($input['first_name']);
        $customer->is_active    = 1;
        $customer->accepts_marketing = 1;

        if ( $customer->save() ) {
            $address = new Address([
                'first_name' => $input['first_name'],
                'last_name'  => $input['last_name'],
                'state'      => $input['state'],
                'state_id'   => Helper::getStateId($input['state']),
                'city'       => $input['state'],
                'is_default' => 1,
                'address'    => $input['address'],
                'address2'   => $input['apt'],
                'zip'        => $input['zip'],
            ]
          );
          $customer->address()->save($address);
        }

        return $customer;
    }



    public static function createOrUpdateCustomer($store_id, Request $request, $customer = null)
    {
        if (!$customer) {
           $customer = new static;
        }


        $customer->first_name   = $request->first_name;
        $customer->last_name    = $request->last_name;
        $customer->email        = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->lead_id      = $request->lead_id;
        $customer->store_id     = $store_id;
        $customer->home_phone_number    = $request->home_work;
        $customer->customer_notes       = $request->customer_notes;
        $customer->ext                  = $request->ext;
        $customer->gender               = $request->gender;
        $customer->password             = bcrypt($request->first_name);
        $customer->dob                  = $request->dob;
        $customer->is_active    = 1;
        $customer->accepts_marketing = 1;

        if ( $customer->save() ) {
            $address = new Address([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'state'      => $request->state,
                'state_id'   => Helper::getStateId($request->state),
                'city'       => $request->city,
                'is_default' => 1,
                'address'    => $request->address,
                'address2'   => $request->address2,
                'zip'        => $request->zip,
            ]
          );
          $customer->address()->save($address);
        }

        return $customer;
    }


    public static function createAddress($request, $customer)
    {
        $customer->first_name   = $request->first_name;
        $customer->last_name    = $request->last_name;
        $customer->email        = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->lead_id      = $request->lead_id;
        $customer->home_phone_number    = $request->home_work;
        $customer->customer_notes       = $request->customer_notes;
        $customer->ext                  = $request->ext;
        $customer->gender               = $request->gender;
        $customer->dob                  = $request->dob;
        $customer->is_active    = 1;
        $customer->accepts_marketing = 1;

        return $customer;
    }



    public static function addBehaviorTag($tag_id, $id) {

        $customer = self::findOrFail($id);
        //This will become a problem if we don't have a store ....
        $store_tag   =  StoreTag::where([ 'tagable_id' => $id, 'tag_id' => $tag_id ])->first();
        if (null !== $store_tag){
            $store_tag->delete();
            Log::info("Tag(s) deleted!", );
            return true;
        } else {
            $tags  = new StoreTag(['tag_id' => $tag_id, 'type' => 'behavior']);
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


    public function behavior()
    {
        return $this->morphOne(StoreTag::class, 'tagable')->where('type','behavior');
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

    public function payment_address()
    {
        return $this->hasOne(TransactionPaymentAddress::class);
    }

    public function getTransactionCountAttribute() {
        return count($this->transactions);
    }

    public function getNameAttribute() {
        return $this->first_name  . ' ' . $this->last_name;
    }

    public function getPhoneAttribute() {
        return optional($this->address)->phone;
    }

//    public function getStateAttribute() {
////        return optional($this->address)->state->code;
//    }

}
