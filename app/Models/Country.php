<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function currency() {
    	return $this->belongsTo(Country::class, 'currency_id', 'id');
    }

    public function timezone() {
    	return $this->belongsTo(Timezone::class, 'timezone_id', 'id');
    }
}
