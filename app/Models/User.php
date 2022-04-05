<?php

namespace App\Models;

use App\Services\EventNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Notifiable;


    public static $merchant = 'merchant';
    public static $customer = 'store';
    public static $admin = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

      /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function stores(){
        return $this->hasMany(Store::class);
    }

    public function store_users() {
        return $this->hasMany(StoreUser::class, 'user_id', 'id');
    }

    public function shipping_addresses() {
        return $this->hasMany(ShippingAddress::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function login() {
        return $this->hasOne(Login::class)->latest();
    }

    public function canDo($permission) {
        return true;
    }

    public function lastLogin()
    {
        return $this->belongsTo(Login::class);
    }

    public function scopeWithLastLogin($query)
    {
        $query->addSelect(['last_login_id' => Login::select('id')
            ->whereColumn('user_id', 'users.id')
            ->latest()
            ->take(1),
        ])->with('lastLogin');
    }

    public static function createForStore(Store $store, $data, $addStoreUser = false) {
        //There has to be a store_id
        //check to see that user doesn't already exist ...

        $checkUser = self::where('email', $data['email'])->first();
        if(null !== $checkUser) {
            throw new \Exception('This user already exists');
        }

        if($user = self::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'store_id' => $store->id,
            'email' => $data['email'],
            'password' => bcrypt($data['first_name'])
//            'password' => bcrypt($data['password'])
        ])) {
            //Check new Store User ...
            if($addStoreUser) {
                 StoreUser::createNew($user, $store, $data['storeGroupId']);
            }

            (new EventNotification('User Registered', [
                'user' => $user,
                'store' => $store
            ]))->getAndSendMessages();

            //Log new email sent ...
            return $user;
        }
    }
}
