<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionNote extends Model
{
    use HasFactory;

    const PUBLIC_TYPE = 'public';
    const PRIVATE_TYPE = 'private';


    protected $fillable = [
        'notes',
        'type',
        'transaction_id',
        'customer_id'
    ];


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}


}
