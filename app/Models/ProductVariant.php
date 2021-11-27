<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'product_id',
        'price',
        'quantity',
        'barcode',
        'is_active'
    ];

    public function attributes() {
    	return $this->hasMany(ProductAttribute::class, 'sku', 'sku');
    }

    public function product() {
    	return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
