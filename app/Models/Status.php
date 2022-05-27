<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = "statuses";


    protected $fillable = [
        'name',
        'store_id'
    ];

    static function findById($id) {
        $status = self::where('status_id', $id)->first();
        if(null !== $status) {
            return $status->name;
        }

        return '';
    }
}
