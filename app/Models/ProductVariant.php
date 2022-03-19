<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'product_id',
        'price',
        'quantity',
        'barcode',
        'is_active'
    ];

    protected $with = ['attributes'];

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductVariantAttribute::class, 'sku', 'sku');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'sku', 'sku');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function images(): MorphMany
    {
       return $this->morphMany(Image::class, 'imageable');
    }
}
