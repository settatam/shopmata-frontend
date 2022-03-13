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
use App\Models\CollectionCondition;
use App\Models\Collection;
use Auth;
use App\Models\StoreActivity;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories = Collection::orderBy('id', 'asc')->paginate(50);
        $filters = $request->all('search', 'level');
        return Inertia::render('Products/Categories/Index', compact('categories', 'filters'));
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
        return Inertia::render('Products/Categories/Index', compact('categories', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $condition_options = CollectionCondition::$condition_options;
        $product_options = CollectionCondition::$product_options;
        return Inertia::render('Products/Categories/Create', compact('condition_options', 'product_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $store = Store::store();
        // $store_id = $store[0]->id;
        // $slug = Str::slug($request->name);

        $request->validate([
            'name'=>['required'],
        ]);

        $data = [
            'store_id'      => $request->session()->get('store_id'),
            'title'         => $request->name,
            'handle'        => $request->handle,
            'page_title'    => $request->page_title,
            'description'   => $request->description,
            'user_id'       => Auth::id()
        ];

        if ($collection = Collection::create($data)) {
            Log::info($data['user_id'] . ' added a new collection', $data);

            StoreActivity::create([
                'user_id'       =>Auth::id(),
                'activity'      =>'created a new collection',
                'activity_id'   =>$collection->id,
                'model'         =>'Collection'
            ]);

            foreach($request->conditions as $condition) {
                $cond = CollectionCondition::firstOrNew([
                    'collection_id'  =>$collection->id,
                    'product_tag'           => $condition['tag'],
                    'condition'     => $condition['value']
                    // ''
                ]);

                $cond->value = $condition['condition'];
            }
        } else {
            Log::error($data['user_id'] . ' could not add a new collection', $data);
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
        $category = Collection::find($id);
        if (is_null($category)) {
            throw new HttpException(404);
        }
        return Inertia::render('Products/Categories/Edit', compact('category'));
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
