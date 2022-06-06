<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class StoreTheme extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    public function theme() {
        return $this->belongsTo(Theme::class, 'theme_id', 'id');
    }
}
