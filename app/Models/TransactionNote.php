<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'notes',
        'type',
        'transaction_id'
    ];

}
