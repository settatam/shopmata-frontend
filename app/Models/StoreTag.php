<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreTag extends Model
{
    use HasFactory;

    public $fillable = ['tag_id', 'store_id','type'];

    public function taggable()
    {
        return $this->morphTo();
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }
}
