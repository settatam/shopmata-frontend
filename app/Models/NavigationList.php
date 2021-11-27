<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationList extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'handle',
    	'store_id',
    	'navigation_id',
    	'parent_id'
    ];
}
