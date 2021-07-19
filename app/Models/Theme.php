<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    public function layout() {
    	return $this->hasMany(ThemeFile::class)->where('title', 'theme.twig');
    }

    public function images() {
    	return $this->hasMany(ThemeImage::class);
    }

    public function store()  {
    	return $this->hasOne(Store::class);
    }
}
