<?php

namespace App\Models;

use App\Services\EventNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StoreUser;
use Illuminate\Support\Facades\Mail;
use Auth;

class StoreUserInvite extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const CONFIRMED = 'confirmed';
    const DECLINED = 'declined';

    protected $fillable = [
    	'first_name',
    	'last_name',
    	'store_id',
    	'store_group_id',
    	'token',
    	'email',
    	'status'
    ];

    public static function createNew(Store $store, $invitee) {
        //Check if user already exists for the store ..
        $hasErrors = false;
        $isUser = StoreUser::where('email', $data['email'])->first();

            if(null !== $isUser) {
                $hasErrors = true;

                if($isUser->status == StoreUser::$ACCEPTED) {
                    $errors = ['You have already invited this user'];
                }
                if($isUser->status == StoreUser::$PENDING) {
                    $errors = ['This user has a pending invitation.'];
                }
                if($isUser->status == StoreUser::$DECLINED) {
                    $errors = ['This user has declined your invitation.'];
                }
                return $errors;
            }else{
                return self::createNewInvite($store, $data);
            }
    }

    private function generateInviteToken($store_id, $email) {
        return base64_encode($store_id . ':' .$email);
    }

    public static function createNewInvite(Store $store, StoreUser $user) {
        //Do validation ...
        //Check for existing invites ...
        $invite = new static;

        $checkUser = $invite->where('store_user_id', $user->id)
                            ->first();

        if(null !== $checkUser) {
            throw new \Exception('This user already exists in the system');
        }

        $invite->store_user_id = $user->id;
        $invite->token = $this->generateInviteToken($store->id, $user->email);
        $invite->status = self::PENDING;

        if($invite->save()) {
            //Send Email to User
            \Log::info('New user invite has been created by ' . Auth::id() . '  for store ' . $store->id);
            $notify = (new EventNotification('Store User Invite', [
                'store' => $store,
                'user' => $user,
            ]));
        }
    }

    public static function updateInviteByToken($token, $status) {
        return self::where('token', $token)->update(['status'=>$status]);
    }
}
