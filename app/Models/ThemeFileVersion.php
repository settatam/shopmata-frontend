<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeFileVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme_file_id',
        'user_id',
        'content'
    ];
}
