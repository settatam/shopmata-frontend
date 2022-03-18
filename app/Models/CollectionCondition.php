<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionCondition extends Model
{
    use HasFactory;

    protected $fillable = [
    	'collection_id',
    	'condition',
    	'value',
    	'user_id'
    ];

    public static $condition_options = [
    	['title'=>'is equal to', 'type'=>'string'],
    	['title'=>'is not equal to', 'type'=>'string'],
    	['title'=>'is greater than', 'type'=>'int'],
    	['title'=>'is less than', 'type'=>'int'],
    	['title'=>'starts with', 'type'=>'string'],
    	['title'=>'ends with', 'type'=>'string'],
    	['title'=>'contains', 'type'=>'string'],
    	['title'=>'does not contain', 'type'=>'string'],
    	['title'=>'is not empty', 'type'=>'string'],
    	['title'=>'is empty', 'type'=>'string']
    ];

    public static $product_options = [
    	['title'=>'Product Title', 'type'=>'string'],
    	['title'=>'Product Type', 'type'=>'string'],
    	['title'=>'Product Vendor', 'type'=>'int'],
    	['title'=>'Product Price', 'type'=>'int'],
    	['title'=>'Product Tag', 'type'=>'string'],
    	['title'=>'Stock Quantity', 'type'=>'string'],
    	['title'=>'Weight', 'type'=>'string'],
    ];

}
