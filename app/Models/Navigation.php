<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class Navigation extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'handle',
    	'store_id'
    ];

    protected static function booted()
    {
//        static::addGlobalScope(new StoreScope);
    }

    public function items() {
    	return $this->hasMany(NavigationList::class);
    }
}
