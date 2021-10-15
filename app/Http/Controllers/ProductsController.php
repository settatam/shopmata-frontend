<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductsController extends Controller
{
    use HasFactory;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->has('pageSize') ? $request->pageSize : 50;
        $filters = $request->all('search', 'brand', 'tag', 'status');

        // $products = Product::whereHas('images')->with('categories')->with('images')->orderBy('created_at', 'desc')->filter((new Request)->only('search', 'brand', 'tag', 'status'))->paginate($pageSize);

        $products = Product::whereHas('images', function (Builder $query) use ($request) {
            if ($request->search) $query->where('title', 'like', '%' . $request->search . '%');
            if ($request->status) $query->where('status', $request->status);
            if ($request->brand) $query->where('brand', $request->brand);
            if ($request->tag) $query->where('tag', $request->tag);
        })->orderBy('id', 'desc')->with('categories')->with('images')->paginate($pageSize);

        // \Log::info("products Retrieved".print_r($products, true));

        $brands = Brand::orderBy('name', 'desc')->get();

        foreach ($products as $product) {
            $categories = [];
            $product->image = count($product->images) ? $product->images[0]->thumb ?? $product->images[0]->image_url : '';
            if (count($product->categories)) {
                foreach ($product->categories as $cat) {
                    if (null !== $cat->category) {
                        $categories[] = $cat->category->name;
                    }
                }
            }
            $product->type = implode(', ', $categories);
        }

        return Inertia::render('Products/Index', compact('products', 'filters', 'brands'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $products = Product::where('title', 'LIKE', '%'.$request->term.'%')->take(20)->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'desc')->get();
        $brands = Brand::orderBy('name', 'desc')->get();
        return Inertia::render('Products/Create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info("Request Logged" . print_r($request->all(), true));
        $store = Store::store();
        $store_id = $store[0]->id;

        $slug = Str::slug($request->title);

        $slug_count  = Product::where('title', $request->title)->count();

        if ($slug_count >= 1) {
            $slug .= '_';
            $slug .= $slug_count + 1;
        }

        $product = Product::create([
            'store_id' => 2,
            'slug' => $slug,
            'title' => $request->title,
            'description' => $request->description,
            // 'sku' => $request->sku,
            'weight' => $request->weight,
            'compare_at_price' => $request->compare_at_price,
            // 'has_variants' => $request->has_variants,
            'brand_id' => $request->brand,
            'minimum_order' => 2,
            'date_available' => date('Y-m-d H:i:s')
        ]);

        ProductVariant::create([
            'sku' => $request->sku,
            'product_id' => $product->id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'barcode' => $request->sku,
            'is_active' => 1
        ]);

        if ($request->has('category')) {
            foreach ($request->category as $category) {
                ProductCategory::firstOrCreate([
                    'product_id' => $product->id,
                    'category_id' => $category['id'],
                    'level' => 1
                ]);
            }
        }

        if (is_array($request->images) && count($request->images)) {
            foreach ($request->images as $image) {
                $product_image = ProductImage::find($image);
                $product_image->product_id = $image;
                $product_image->save();
            }
        }


        return Redirect::route('products')->with('success', 'Product created.');
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
        $categories = Category::orderBy('name', 'desc')->get(['id', 'name']);
        $brands = Brand::orderBy('name', 'desc')->get();
        $product = Product::with('variants')->with('categories')->with('images')->with('brand')->find($id);
        \Log::info("products to edit" . print_r($product, true));

        if ($product->store_id != session()->get('store_id')) {
            abort(403);
        }

        if (is_null($product)) {
            throw new HttpException(404);
        }

        if (count($product->categories)) {
            foreach ($product->categories as $value) {
                if (null !== $value->category) {
                    $value->name = $value->category->name;
                    $value->id = $value->category->id;
                }
            }
        }
        return Inertia::render('Products/Update', compact('product', 'categories', 'brands'));
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
        \Log::info('edit product request received' . print_r($request->all(), true));
        $product = Product::find($id);

        if ($product->store_id != session()->get('store_id')) {
            abort(403);
        }

        $product->title = $request->title;
        $product->description = $request->description;
        $product->weight = $request->weight;
        $product->brand = $request->brand ? $request->brand['id'] : null;
        $categories = [];

        //we need to v
        if ($request->has('category') && is_array($request->category)) {
            foreach ($request->category as $category) {
                $categories[] = $category['id'];
            }
        }
        // $product->save();
        $product_category = ProductCategory::whereNotIn('category_id', $categories)
            ->where('product_id', $id)->delete();

        foreach ($categories as $cat) {
            $fields = ['category_id' => $cat, 'product_id' => $id];
            $category = ProductCategory::firstOrCreate($fields);
            Log::info(Auth::id() . ' created a new product category', $fields);
            //Log Result
        }

        #Now variants have a one to one relationship with products 

        $variant = ProductVariant::firstOrNew(['product_id' => $id]);

        $variant->sku = $request->sku;
        $variant->price = $request->price;
        $variant->quantity = $request->quantity;
        $variant->barcode = $request->barcode;
        $variant->save();

        $product->update();

        return Redirect::route('products')->with('success', 'Product updated successfully.');
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

    public function getOrderProducts(Request $request)
    {
        $pageSize = 10;
        $products = Product::whereHas('images', function (Builder $query) use ($request) {
            if ($request->search) $query->where('title', 'like', '%' . $request->search . '%');
            if ($request->status) $query->where('status', 'active');
        })->orderBy('id', 'desc')->with('images')->with('brand')->paginate($pageSize);

        // return Inertia::render('Orders/Create', compact('products'));
        return response()->json($products);
    }
}
