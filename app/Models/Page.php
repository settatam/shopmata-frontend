<?php

namespace App\Models;

use App\Models\Tag;
use App\Scopes\StoreScope;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
    	'store_id',
    	'user_id',
    	'title',
    	'content',
    	'slug',
    	'featured_image',
    	'theme_template_id',
    	'seo_title',
    	'seo_description',
    	'visibility_date',
    	'is_visible',
    	'is_blog',
    	'excerpt'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    public function generateSlug() {

    	$slug = Str::slug($this->title);
        $slug_count  = $this->where('title', $this->title)->count();

        if ($slug_count >= 1) {
            $slug .= '-';
            $slug .= $slug_count;
        }
        return $slug;
    }
    
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
