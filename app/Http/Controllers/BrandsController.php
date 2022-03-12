<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Store;
use App\Validators\Product\BrandsControllerValidators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BrandsController extends Controller
{
    use BrandsControllerValidators;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // \Log::info("brand request".print_r($request->all(), true));
        $brands = Brand::orderBy('name', 'desc')->where('name', 'like', '%' . $request->search . '%')->paginate(50);

        $filters = $request->all('search');
        return Inertia::render('Brands/Index', compact('brands', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Brands/Create');
    }

    public function store(Request $request)
    {
        $this->validateStoreRequest($request);
        $brand_name = $request->input('name');
        $append = Brand::where('slug', '=', $brand_name)->count();
        $slug = Str::slug($brand_name);
        Brand::create([
            'store_id' => session()->get('store_id'),
            'name' => $brand_name,
            'slug' => $slug . ($append > 0 ? "-$append" : ""),
            'page_title' => '',
            'description' => '',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keyword' => '',
        ]);
        return response([
            'status' => 'success',
            'message' => 'Brand created successfully',
        ]);
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        // dd($request);
//        $store = Store::store();
//        $store_id = $store[0]->id;
//        $slug = Str::slug($request->title);
//
//        if ($brand = Brand::create([
//            'store_id' => 2,
//            'name' => $request->name,
//            'page_title' => $request->page_title,
//            'description' => $request->description,
//            'meta_title' => $request->meta_title,
//            'meta_description' => $request->meta_decription,
//            'meta_keyword' => $request->meta_keyword,
//            'slug' => $slug
//        ])) {
//            Log::info('dddd');
//        } else {
//            Log::error('asdfasdf');
//        }
//
//        return Redirect::route('brands')->with('success', 'Brand created.');
//    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $brand = Brand::find($id);
        if (is_null($brand)) {
            throw new HttpException(404);
        }
        return Inertia::render('Brands/Update', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->input());
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        $brand->meta_keyword = $request->meta_keyword;
        $brand->save();

        return Redirect::route('brands')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
