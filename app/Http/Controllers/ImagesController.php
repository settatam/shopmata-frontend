<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use App\Models\Store;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
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
                    return response()->json($response);
                }
                try {
                    $image_thumb = Image::make($image)->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg');
                } catch(\Intervention\Image\Exception\NotReadableException $e) {
                    $response = ['status'=>1, 'message'=>'Could not create image'];
                    return response()->json($response);
                }
                
                $image_normal = $image_normal->stream();
                $image_thumb = $image_thumb->stream();

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
        
        return response()->json($response);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
