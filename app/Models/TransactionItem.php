<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'is_jewelry'
    ];



    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}
}
