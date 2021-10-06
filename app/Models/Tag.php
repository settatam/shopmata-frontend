<?php

namespace App\Models;

use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
    	'page_id',
    	'name'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
