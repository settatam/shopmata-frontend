<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class StoreUser extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'user_id', 'store_group_id'];

    public function store() {
    	return $this->belongsTo(Store::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
