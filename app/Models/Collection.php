<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
		            'store_id',
		            'title',
		            'handle',
		            'page_title',
		            'description',
		            'user_id'
    ];
}
