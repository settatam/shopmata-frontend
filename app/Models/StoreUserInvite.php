<?php

namespace App\Models;

use App\Services\EventNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StoreUser;
use Illuminate\Support\Facades\Mail;

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

            }else{
                return self::createNewInvite($data);
            }
    }

    private function generateInviteToken() {
        return base64_encode($this->store_id . ':' .$this->email);
    }

    public static function createNewInvite($data) {
        $invite = new static;

        $invite->first_name = $data['first_name'];
        $invite->last_name = $data['last_name'];
        $invite->email = $data['email'];
        $invite->token = $invite->generateInviteToken();
        $invite->store_id = $data['store'];
        if($invite->save()) {
            //Send Email to User
            \Log::info('New user invite has been created by ' . Auth::id(), $data);
            $notify = (new EventNotification('User Invite', [
                'store' => Store::find($invite->store_id),
                'user' => $invite,
            ]));
        }
    }

    public static function acceptInvite($id, $data, $userExists=false) {
        $invite  = self::find($id);
        $invite->status = self::CONFIRMED;
        if($userExists) {

        }
        if($invite->save()) {
            $user = User::firstOrNew([
                'email' => $invite->email
            ]);

            if(!$user->id) {
                 // User::createNew();
            }


            //Create a new store user ...
        }
    }
}
