<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'asc')->paginate(50);
        $filters = $request->all('search', 'level');
        return Inertia::render('Categories/Index', compact('categories', 'filters'));
    }

    public function search(Request $request)
    {
        $query = $request->route('query');
        $categories = Category::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('slug', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->orWhere('meta_title', 'LIKE', '%' . $query . '%')
            ->orWhere('meta_description', 'LIKE', '%' . $query . '%')
            ->orWhere('meta_keyword', 'LIKE', '%' . $query . '%')
            ->paginate(50);
        $categories->appends(['search' => $query]);
        // return $categories;
        return Inertia::render('Categories/Index', compact('categories', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = Store::store();
        $store_id = $store[0]->id;
        $slug = Str::slug($request->name);

        if ($category = Category::create([
            'store_id' => 2,
            'name' => $request->name,
            'level' => $request->level,
            'mechant_id' => 1,
            'merchant_id' => 1,
            'slug' => $slug
        ])) {
            Log::info('dddd');
        } else {
            Log::error('asdfasdf');
        }

        return Redirect::route('categories')->with('success', 'Category created.');
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
        $category = Category::find($id);
        if (is_null($category)) {
            throw new HttpException(404);
        }
        return Inertia::render('Categories/Update', compact('category'));
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
        $slug = Str::slug($request->title);
        //
        $category = Category::find($id);
        // dd($category);
        $category->name = $request->name;
        $category->slug = $slug;
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->level = $request->level;
        $category->meta_description = $request->meta_description;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_title = $request->meta_title;
        $category->save();

        return Redirect::route('categories')->with('success', 'Category updated successfully.');
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
