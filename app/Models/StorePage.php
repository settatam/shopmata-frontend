<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'theme_file_id',
        'store_id',
        'store_id',
        'footer_content',
        'title',
        'seo_content'
    ];

    public function theme() {
        return $this->belongsTo(ThemeFile::class, 'theme_id', 'id');
    }

    public function template() {
        return $this->belongsTo(ThemeFile::class, 'template_id', 'id');
    }

    public function store() {
        return $this->belongsTo(Theme::class, 'template_id', 'id');
    }
}
