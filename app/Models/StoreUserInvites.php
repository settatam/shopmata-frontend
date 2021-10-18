<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreUserInvites extends Model
{
    use HasFactory;

    public static $PENDING = 'pending';
    public static $CONFIRMED = 'confirmed';
    public static $DECLINED = 'declined';

    protected $fillable = [
    	'first_name',
    	'last_name',
    	'store_id',
    	'store_group_id',
    	'token',
    	'email',
    	'status'
    ];

}
