<?php

namespace App\Traits;

use View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Twig;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Image;
use App\Models\ProductImage;



use App\Models\Store;


trait FileUploader {

	public static function upload(Request $request) {

		$images = $request->file('files');

        $store_id = $request->session()->get('store_id');
        $store = Store::find($store_id);
        $response = [];

        if(null !== $store) {
            $slug = $store->slug;
            $rank = 0;

            foreach($images as $image) {

                $path = $image->path();
                $name = md5($image->getClientOriginalName());

                $filename = "item_".time().$name.'.jpg';
                $filename_thumb = "item_".time().$name.'_thumb.jpg';

                try {
                    $image_normal = Image::make($image)->widen(1000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg');
                } catch(\Intervention\Image\Exception\NotReadableException $e) {
                    $response = ['status'=>1, 'message'=>'Could not create image'];
                    return $response;
                }
                try {
                    $image_thumb = Image::make($image)->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg');
                } catch(\Intervention\Image\Exception\NotReadableException $e) {
                    $response = ['status'=>1, 'message'=>'Could not create image'];
                    return $response;
                }

                $image_normal = $image_normal->stream();
                $image_thumb  = $image_thumb->stream();

                Storage::disk('DO')->put($slug.'/'.$filename, $image_normal->__toString(), 'public');
                Storage::disk('DO')->put($slug.'/'.$filename_thumb, $image_thumb->__toString(), 'public');

                $data = [
                       'url'=>env('DO_URL').$slug.'/'.$filename,
                       'thumb'=>env('DO_URL').$slug.'/'.$filename_thumb,
                       'rank'=>$rank,
                       'store_id'=>$store_id
                ];

                $insert = ProductImage::create($data);

                // $rank++;

                $response[] = ['status'=>0,
                            'message'=>'Image Created',
                            'thumb'=>$data['thumb'],
                            'large'=>$data['url'],
                            'alt'=>'',
                            'id'=>$insert->id,
                ];
            }
        }

        return $response;
	}

    public function uploadImageToCloud(Store $store, $images, $filename='', $rank=1) {
        $slug = $store->slug;
        $rank = 0;

        if(!is_array($images)) {
            $images = [$images];
        }

        foreach($images as $image) {
            if(!$filename) {
                $name = md5($image->getClientOriginalName());
                $filename = "item_" . time() . $name . '.jpg';
                $filename_thumb = "item_" . time() . $name . '_thumb.jpg';
            }else{
                 $filename_thumb = $image->getClientOriginalName() . '_thumb.jpg';
            }

            try {
                $image_normal = Image::make($image)->widen(1000, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg');
            } catch (\Intervention\Image\Exception\NotReadableException $e) {
                $response = ['status' => 1, 'message' => 'Could not create image'];
                return $response;
            }
            try {
                $image_thumb = Image::make($image)->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg');
            } catch (\Intervention\Image\Exception\NotReadableException $e) {
                return ['status' => 1, 'message' => 'Could not create image'];
            }

            $image_normal = $image_normal->stream();
            $image_thumb = $image_thumb->stream();

            Storage::disk('DO')->put($slug . '/' . $filename, $image_normal->__toString(), 'public');
            Storage::disk('DO')->put($slug . '/' . $filename_thumb, $image_thumb->__toString(), 'public');

            return [
                'url' => env('DO_URL') . $slug . '/' . $filename,
                'thumb' => env('DO_URL') . $slug . '/' . $filename_thumb,
            ];
        }

	}

    public function uploadAssetToCloud(Store $store, $file) {
        $slug = $store->slug;
        Storage::disk('DO')->put($slug . '/' . $file, 'public');
    }

    public function addImage(Store $store, $images, $id=null, $rank=1) {
        if($id) {
            $object = $this->find($id);
            if ($data = $this->uploadImageToCloud($store, $images)) {
                return $object->images()->create([
                    'url' => $data['url'],
                    'thumbnail' => $data['thumb'],
                    'rank' => $rank,
                ]);
            }
        }
    }

	public function uploadAsset() {

		$needs_interpretation = false;

		if(strpos($this->title, 'js.twig') !== false) {
			//File is a js.twig
		}else if(strpos($this->title, 'css.twig') !== false) {
			//File is a css.twig
		}else if(strpos($this->title, 'css') !== false) {
			//plain css file
		}else if(strpos($this->title, 'js') !== false) {
			//plain js file
		}else{
			return false;
		}

		$file_name = str_replace('.twig', '', $this->title);
		$store = Store::find(session()->get('store_id'));

		$slug = $store->slug;
		$content = $this->content;

		Storage::disk('DO')->put($slug.'/'.$file_name, View::make('theme_files.index', compact('content')), 'public');

	}
}
