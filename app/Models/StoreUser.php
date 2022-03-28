<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StoreUser extends Model
{
    use HasFactory;

    public static $PENDING = 'invite sent';
    public static $ACCEPTED = 'accepted';
    public static $DECLINED = 'declined';

    protected static function booted()
    {
        //static::addGlobalScope(new StoreScope);
    }

    protected $fillable = ['store_id', 'user_id', 'store_group_id'];

    public function store() {
    	return $this->belongsTo(Store::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function group() {
    	return $this->belongsTo(StoreGroup::class, 'store_group_id', 'id');
    }

    public static function createNew($data, Store $store) {

        $storeUser = new static;

        $checkUser = $storeUser->where('email', $data['email'])->first();

        if(null !== $checkUser) {
            throw new \Exception('This user already exists');
        }
        $storeUser->store_id = $store->id;
        $storeUser->user_id = Auth::id();
        $storeUser->first_name = $data['first_name'];
        $storeUser->email = $data['email'];
        $storeUser->last_name = $data['last_name'];
        $storeUser->store_group_id = $data['role_id'];
        $storeUser->status = self::$PENDING;

        if($storeUser->save()) {
            Log::info(Auth::id() . ' Created new store user', $data);
            StoreUserInvite::createNewInvite($store, $storeUser);
        }
    }

    public static function respondToUserRequest(Request $request) {
        $storeUser = new static;
        $storeUser->store_id = $store->id;
        $storeUser->user_id = $user->id;
        $storeUser->storeGroupId = $storeGroupId;
        $storeUser->status = self::$ACCEPTED;

        if($storeUser->save()) {
            StoreUserInvite::createNewInvite($store, $storeUser);
        }
    }
}
