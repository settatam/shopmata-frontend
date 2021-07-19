<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'store_id',
        'name',
        'page_title',
        'description',
        'meta_title',
        'meta_description',
        'meta_keyword'
    ];
}
