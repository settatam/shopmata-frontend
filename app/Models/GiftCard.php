<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class GiftCard extends Model
{
    use HasFactory;

    protected $fillable = [ 'store_id', 'expire', 'period', 'duration'];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }
}
