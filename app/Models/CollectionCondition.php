<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionCondition extends Model
{
    use HasFactory;

    $fillable = [
    	'collection_id',
    	'condition',
    	'value',
    	'user_id'
    ];

}
