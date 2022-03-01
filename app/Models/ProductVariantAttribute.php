<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariantAttribute extends Model
{
    use HasFactory;

    protected $table = "product_attributes";

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'sku','sku');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
