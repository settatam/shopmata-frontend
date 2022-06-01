<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Models\Store;


class ImagesController extends Controller
{

    use FileUploader;
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

        $data = $request->input();
        $data['model'] = 'TransactionNote';

        $class = $data['model'];

        if (!Str::startsWith($class, $namespace = 'App\\Models\\')) {
          $class = $namespace . $class;
        }

        $store = Store::find($request->session()->get('store_id'));

        $model = new $class;

        return $model->addImage($store, $request->file('files'), $request->model_id);

//        try {
//          $response =   Image::addImage($request);
//          return response()->json($response,  200);
//        } catch (\Throwable $th) {
//            \Log::Error("Failed to Add image" . collect($request->all())  ."  Error: " .$th->getMessage() );
//            return response($th->getMessage() ,422);
//        }
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
    public function destroy(Request $request)
    {
        try {
            Image::deleteImage($request);
            return response()->json(null,  200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to delete image" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response($th->getMessage(), 422);
        }
    }
}
