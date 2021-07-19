<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Scopes\StoreScope;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'title',
        'description',
        'weight',
        'compare_at_price',
        'has_variants',
        'store_id',
        'slug',
        'date_available',
        'minimum_order',
        'brand'
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

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }



    public static function makeSlug($title, $store_id)
    {
        if (!$title || !$store_id) return '';

        $slug = Str::slug($title);

        $slug_count  = Product::where('title', $title)->where('store_id', $store_id)->count();

        if ($slug_count >= 1) {
            $slug .= '_';
            $slug .= $slug_count + 1;
        }

        return $slug;
    }
}
