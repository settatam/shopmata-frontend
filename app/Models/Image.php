<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Traits\FileUploader;



class Image extends Model
{
    use HasFactory, FileUploader;

    protected $table = "images";

    protected $fillable = ['url', 'rank', 'image','imageable_type','imageable_id','thumbnail'];

    public function imageable()
    {
        return $this->morphTo();
    }


    public static function addImage($request){
        $response  = FileUploader::upload($request);
        if ( $request->model && $request->model_id ) {
            $class = "\App\Models\\".$request->model;
            if (class_exists($class)) {
                $model =  $class::find($request->model_id);
                if ( isset($response[0]['thumb']) ){
                    $l_image = $response[0]['large'];
                    $tn_image = $response[0]['thumb'];
                    $imgs= new Image(['url' => $l_image, 'thumbnail' =>  $tn_image, 'rank' => 1]);
                    $model->images()->save($imgs);
                    return $model->images;
                }
            } else {
                return false;
            }
        } 
        return $response;
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
