<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

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
        
        $image = $request->file('file');
        $path = $request->file->path();
        $name = md5($request->file->getClientOriginalName());

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

        Storage::disk('DO')->put($filename, $image_normal->__toString(), 'public');
        Storage::disk('DO')->put($filename_thumb, $image_thumb->__toString(), 'public');

        $insert = ProductImage::create([
               'image_url'=>env('DO_URL').$filename,
               'thumb'=>$filename_thumb,
               'rank'=>0,
        ]);
           
        $response = ['status'=>0, 
                    'message'=>'Image Created', 
                    'thumb'=>env('DO_URL').$filename_thumb,
                    'large'=>env('DO_URL').$filename,
                    'id'=>$insert->id,
                    'request'=>$path
        ];

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
