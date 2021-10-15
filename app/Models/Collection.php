<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class Collection extends Model
{
    use HasFactory;



    protected $fillable = [
		            'store_id',
		            'title',
		            'handle',
		            'page_title',
		            'description',
		            'user_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }
}
