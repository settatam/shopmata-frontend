<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    protected $table = "images";
    protected $fillable = ['url', 'rank', 'image','imageable_type','imageable_id'];


    public function imageable()
    {
        return $this->morphTo();
    }
}
