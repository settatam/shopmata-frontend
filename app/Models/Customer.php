<?php

namespace App\Models;

use App\Services\EventNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\Helper;
use Carbon\Carbon;
use App\Traits\FileUploader;
use Auth;
use App\Traits\HasMeta;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
use Numeral\Numeral;


class Customer extends Authenticatable
{
    use HasFactory, FileUploader, HasMeta;

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
        'age',
        'full_name'
    ];

    protected $hidden = ['password'];

    protected $fillable = [
        'user_id',
        'store_id',
        'country',
        'state_id',
        'phone_number',
        'first_name',
        'last_name',
        'accepts_marketing',
        'is_active',
        'password',
        'customer_notes',
        'gender',
        'home_phone_number',
        'ext',
        'customerDifficulty',
        'allows_sms_updates',
        'allows_email_updates',
        'email'
    ];

     /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

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


    public function scopeWithGroupedBehavior($query) {
        $query->join('store_tags', 'store_tags.tagable_id', '=', 'customers.id')
            ->where('type', 'behavior')
            ->join('tags', 'store_tags.tag_id', '=', 'tags.id')
            ->selectRaw("tags.name, store_tags.tag_id, COUNT(store_tags.tag_id) AS `tagIdCount`")->groupBy('tag_id');
    }


    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }


    public function age()
    {
        return Carbon::parse($this->dob)->age;
    }

    public function addImage(Store $store, $request, $rank =1)
    {
        $images =  $request->file('files');
        $customer   = Customer::find($request->customer_id);
        if ($data = $this->uploadImageToCloud($store, $images)) {
            $customer->images()->create([
                'url' => $data['url'],
                'thumbnail' => $data['thumb'],
                'rank' => $rank,
            ]);
            return $customer->images;
        }
    }


    public static function addNew(Store $store, $input)
    {
        $customer = new static;

        $customer->first_name      = $input['first_name'];
        $customer->last_name       = $input['last_name'];
        $customer->email           = $input['email'];
        $customer->phone_number    = $input['phone'];
        $customer->store_id        = $store->id;
        //$customer->customer_notes  = $input['description'];
        $customer->password        = bcrypt($input['first_name']);
        $customer->is_active       = 1;
        $customer->accepts_marketing = 1;
        $customer->allows_sms_updates = data_get($input, 'allows_sms_updates', 0);
        $customer->allows_email_updates = data_get($input, 'allows_email_updates', 0);
        if ( $customer->save() ) {
          Log::info('new customer created', $customer->toArray());
          //$customer->address()->save($address);
        }

        return $customer;
    }

    public static function addNewFromApi(Store $store, $input)
    {
        $customer = new static;

        $customer->first_name      = data_get($input, 'first_name');
        $customer->last_name       = data_get($input, 'last_name');
        $customer->email           = data_get($input, 'email');
        $customer->phone_number    = data_get($input, 'phone');
        $customer->store_id        = $store->id;
        //$customer->customer_notes  = data_get($input, 'email');
        $customer->password        = bcrypt($input['first_name']);
        $customer->is_active       = 1;
        $customer->accepts_marketing = 1;
        if ( $customer->save() ) {
          Log::info('new customer created', $customer->toArray());
        }

        return $customer;
    }

    public  function createOrUpdateCustomer($store, $input, $customer = null)
    {
        $input['store_id']    = $store->id;
        $input['is_active']   = 1;
        $input['accepts_marketing'] = 1;

        if (null === $customer) {
            $customer = $this->create($input);
            $customer->address()->save($customer->address->addFields($input));
        } else  {
            $customer->update($input);
            $customer->address()->update($customer->address->addFields($input));
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

//    public function shippingAddress() {
//        return $this->morphOne(Address::class, 'addressable');
//    }

    public function payment_address()
    {
        return $this->hasOne(TransactionPaymentAddress::class);
    }

    public function getTransactionCountAttribute() {
        return count($this->transactions);
    }

    public function scopeTotalPayout() {
        $totalPayout = 0;
        return Numeral::number($totalPayout)->format('$0,0.00');
    }

    public function getNameAttribute() {
        return $this->first_name  . ' ' . $this->last_name;
    }

    public function getPhoneAttribute() {
        return optional($this->address)->phone;
    }

    public function getAgeAttribute() {
        if(null !== $this->dob) {
            return \Carbon\Carbon::parse($this->dob)->age;
        }
        return '';
    }

    public function generateLoginTokenForEmail($notify = true) {
        $token = null;
        if($token = LoginToken::createNew($this, 'email', '600')) {
            if($notify) {
                $sender = (new EventNotification('Email Login Token', [
                    'customer' => $this,
                    'store' => $this->store,
                    'token' => $token
                ], ['for' => 'customer']));
            }
        }

        return $token;
    }

    public function getPasswordResetToken() {
        $token = null;
        return $this->passwordToken;
    }

    public function generateTokenForPassword ( Store $store, $notify = true )
    {
      $token = null;

      if($token = LoginToken::createNew($this, 'password', '600')) {
            if($notify) {
                $sender = (new EventNotification('Customer Password Reset', [
                    'customer' => $this,
                    'store' => $store,
                    'token' => $token
                ], ['for' => 'customer']));
            }
        }

        return $token;

    }

    public function generateLoginTokenForSms(Store $store)
    {
        if($token = LoginToken::createNew($this, 'sms', 600)) {
            $this->load('loginToken');
            $sender = (new EventNotification('Sms Login Token', [
                'customer' => $this,
                'store' => $store,
                'token' => $token
            ]));
        }
    }

    public function loginToken()
    {
        return $this->morphOne(LoginToken::class, 'tokenable')->where('is_active', 1);
    }

    public function passwordToken()
    {
        return $this->morphOne(LoginToken::class, 'tokenable')
          ->where('is_active', 1)
          ->where('type', 'password')
          ->latest();
    }

    public static function loginUsingToken($token, $is_test=false) {

        if($is_test) {
            if(Auth::LoginUsingId(704)) {
                //session()->put('store_id', Auth::user()->store->id);
            }
            return Auth::user();
        }

        $token = LoginToken::whereHas('customer')->where('token', $token)->first();
        if(null !== $token) {
            if (Auth::LoginUsingId($token->customer->id)) {
                //session()->put('store_id', Auth::user()->store->id);
            }
            return Auth::user();
        }
        return false;
    }

    public function shippingAddress() {
        $address = $this->address;
        $address->company_name = 'WBGAS';
        $address->country = 'US';
        $address->state = $address->resolvedState->code;
        return $address;
    }

}
