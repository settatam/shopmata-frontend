<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'title',
        'description',
        'weight',
        "weight_unit",
        "price",
        'compare_at_price',
        'has_variants',
        'store_id',
        'slug',
        'date_available',
        'minimum_order',
        'brand_id'
    ];

    // protected static function booted() {
    //     static::addGlobalScope(new StoreScope);
    // }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('inventory', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('vendor', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        })->when($filters['brand'] ?? null, function ($query, $brand) {
            $query->whereBrand($brand);
        })->when($filters['status'] ?? null, function ($query, $status) {
            if ($status === 'active') {
                $query->isActive();
            } elseif ($status === 'inactive') {
                $query->isInactive();
            }
        })->when($filters['tag'] ?? null, function ($query, $tag) {
            $query->whereTag($tag);
        });
    }

    public static function findById($id)
    {
        return static::find($id);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(ProductCategory::class);
    }

//    public function images(): HasMany
//    {
//        return $this->hasMany(ProductImage::class);
//    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function image() {
        $zeroRanked = $this->images()->where('rank', 0)->first();
        return $zeroRanked ?? $this->images()->first();
    }

    public function allAssets(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function assets(): HasMany
    {
        return $this->allAssets()->whereNull('sku');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }

    public function metaFields(): HasMany
    {
        return $this->hasMany(ProductMetaField::class);
    }


    public static function makeSlug($title, $store_id): string
    {
        if (!$title || !$store_id) return '';

        $slug = Str::slug($title);

        $slug_count = Product::where('title', $title)->where('store_id', $store_id)->count();

        if ($slug_count >= 1) {
            $slug .= '_';
            $slug .= $slug_count + 1;
        }

        return $slug;
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function defaultVariant()
    {
        return $this->variants()->orderBy('id', 'asc')->first();
    }

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class);
    }

}
