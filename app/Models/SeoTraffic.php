<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTraffic extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'campaign_id',
        'creative_id',
        'keyword',
        'matchtype',
        'adposition',
        'device',
        'device_model'
    ];
}
