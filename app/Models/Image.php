<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Image extends Model
{
    use HasFactory;

    protected $table = "images";

    protected $fillable = ['url', 'rank', 'image','imageable_type','imageable_id','thumbnail'];

    public function imageable()
    {
        return $this->morphTo();
    }


    public static function deleteImage($request)
    {
        
        if ($request->filled('image_id')){
            $image =  self::find($request->image_id);
        } elseif($request->filled('image_url')) {
            Storage::disk('DO')->delete($request->image_url);
            Storage::disk('DO')->delete($request->image_url.'_thumb');
            return true;
        }

        if ($image->url){
            Storage::disk('DO')->delete($image->url);
        }

        if ($image->thumb){
            Storage::disk('DO')->delete($image->thumb);
        }
            
        $image->delete();

        return $image;
    }

}
