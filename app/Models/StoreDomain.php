<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class StoreDomain extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name', 'is_shopmata', 'user_id', 'store_id', 'region', 'languages', 'is_active', 'is_secure', 'domain_registrar', 'record_is_updated'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    public function store() {
    	return $this->belongsTo(Store::class);
    }
}
