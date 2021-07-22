<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class OpenEditorPage extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    protected $fillable = [
    	'store_id', 'user_id', 'theme_file_id'
    ];
}
