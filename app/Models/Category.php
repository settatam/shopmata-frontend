<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'store_id',
        'name',
        'level',
        'mechant_id',
        'merchant_id',
        'parent_id',
        'description',
        'meta_description',
        'meta_keyword',
        'meta_title',
        'id'
    ];

    public $types = [
        'transaction_category',
        'transaction_item_category',
    ];

    

    // protected static function booted()
    // {
    //     static::addGlobalScope(new StoreScope);
    // }
}
