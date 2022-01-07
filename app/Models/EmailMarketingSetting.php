<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailMarketingSetting extends Model
{
    use HasFactory;

    protected $fillable = ['double_opt_in','open_tracking','store_id'];
}
