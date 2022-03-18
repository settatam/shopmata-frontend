<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = [ 'url', 'rank', 'image','imageable_type','imageable_id'];

=======
    protected $table = "images";
>>>>>>> c0d8e66d12e483896e1d5baa33fcdac26f3f7c1e

    public function imageable()
    {
        return $this->morphTo();
    }
}
