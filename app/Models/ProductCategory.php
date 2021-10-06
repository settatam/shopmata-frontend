<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'category_id',
        'level'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    public function category() {
    	return $this->belongsTo(Category::class);
    }
}
