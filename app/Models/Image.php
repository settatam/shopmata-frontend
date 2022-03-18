<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

<<<<<<< HEAD
<<<<<<< HEAD
    protected $fillable = [ 'url', 'rank', 'image','imageable_type','imageable_id'];

=======
    protected $table = "images";
>>>>>>> c0d8e66d12e483896e1d5baa33fcdac26f3f7c1e
=======
    protected $table = "images";
  
    protected $fillable = [ 'url', 'rank', 'image','imageable_type','imageable_id'];

>>>>>>> 41eb7df445eeae94d26ea7eca82ba6e0cab35d20

    public function imageable()
    {
        return $this->morphTo();
    }
}
