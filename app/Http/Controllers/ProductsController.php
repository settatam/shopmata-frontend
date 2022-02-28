<?php

namespace App\Http\Controllers;

use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use App\Exceptions\InvalidInputException;
use App\Http\Resources\Product as ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CollectionProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductType;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttribute;
use App\Models\Store;
use App\Utils\RandomFunctions;
use App\Validators\Product\ProductControllerValidators;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductsController extends Controller
{
    use HasFactory;
    use ProductControllerValidators;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->has('pageSize') ? $request->pageSize : 50;
        $filters = $request->all('search', 'brand', 'tag', 'status');
        $store_id = $request->session()->get('store_id');

        // $products = Product::whereHas('images')->with('categories')->with('images')->orderBy('created_at', 'desc')->filter((new Request)->only('search', 'brand', 'tag', 'status'))->paginate($pageSize);

        // $products = Product::whereHas('images', function (Builder $query) use ($request) {
        //     if ($request->search) $query->where('title', 'like', '%' . $request->search . '%');
        //     if ($request->status) $query->where('status', $request->status);
        //     if ($request->brand) $query->where('brand', $request->brand);
        //     if ($request->tag) $query->where('tag', $request->tag);
        // })
        //     ->where('store_id', '=', $store_id)
        //     ->orderBy('id', 'desc')->with('categories')->with('images')->paginate($pageSize);

        $products = Product::where(function (Builder $query) use ($request) {
            if ($request->search) $query->where('title', 'like', '%' . $request->search . '%');
            if ($request->status) $query->where('status', $request->status);
            if ($request->brand) $query->where('brand', $request->brand);
            if ($request->tag) $query->where('tag', $request->tag);
        })
            ->where('store_id', '=', $store_id)
            ->orderBy('id', 'desc')->with('categories')->with('images')->paginate($pageSize);

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
     * @return Response
     */
    public function getData(Request $request)
    {
        $products = Product::where('title', 'LIKE', '%' . $request->term . '%')->take(20)->get();
        return response()->json($products);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getSingle($id)
    {
        $product = Product::find($id);
        return new ProductResource($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $store_id = session()->get('store_id');
        $categories = Category::orderBy('name', 'desc')->get();
        $brands = Brand::where('store_id', $store_id)->orderBy('name', 'desc')->get();
        $product_types = ProductType::orderBy('name', 'asc')->get();
        return Inertia::render('Products/Create', compact('categories', 'brands', 'product_types'));
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        \Log::info("Request Logged" . print_r($request->all(), true));
//
//        $store_id = $request->session()->get('store_id');
//        $handle = '';
//
//        if($request->has('handle')) {
//            $slug_count = Product::where('handle', $request->handle)->count();
//            if($slug_count >= 1) {
//                $handle = $request->handle.'-'.$slug_count;
//            }
//        }else{
//            $slug_count  = Product::where('title', $request->title)->count();
//
//            if ($slug_count >= 1) {
//                $handle = Str::slug($request->title);
//                $handle .= '-';
//                $handle .= $slug_count;
//            }
//        }
//
//
//        $not_availables = [
//            'date_available',
//            'minimum_order'
//        ];
//
//        $input = [
//            'store_id' => $request->session()->get('store_id'),
//            'handle' => $slug,
//            'title' => $request->title,
//            'description' => $request->description,
//            'weight' => $request->weight,
//            'compare_at_price' => $request->compare_at_price,
//            'handle'=>$handle,
//            // 'has_variants' => $request->has_variants,
//            'brand_id' => $request->brand,
//            // 'minimum_order' => 2,
//            // 'date_available' => date('Y-m-d H:i:s')
//        ];
//
//        $product = Product::create($input);
//
//        if(count($request->variants)) {
//            //Create Variants
//        }else{
//            //Create default variant
//            //..db should know system has no variants
//
//        }
//
//        ProductVariant::create([
//            'sku' => $request->sku,
//            'product_id' => $product->id,
//            'price' => $request->price,
//            'quantity' => $request->quantity,
//            'barcode' => $request->sku,
//            'is_active' => 1
//        ]);
//
//        if ($request->has('category')) {
//            foreach ($request->category as $category) {
//                ProductCategory::firstOrCreate([
//                    'product_id' => $product->id,
//                    'category_id' => $category['id'],
//                    'level' => 1
//                ]);
//            }
//        }
//
//        if (is_array($request->images) && count($request->images)) {
//            foreach ($request->images as $image) {
//                $product_image = ProductImage::find($image);
//                if(null !== $image) {
//                    $product_image->product_id = $image;
//                    $product_image->save();
//                }
//
//            }
//        }
//
//        return Redirect::route('products')->with('success', 'Product created.');
//    }


    private function generateSku(Product $product, ?string $sku): string
    {
        if ($sku) {
            // Sku uniqueness already checked in validator.
            return $sku;
        }

        $firstPortion = strtoupper(substr($product->title, 0, 4));
        $secondPortion = $product->brand ? strtoupper(substr($product->brand->name, 0, 4)) : strtoupper(RandomFunctions::generateRandomString(4, true));
        $thirdPortion = $product->type ? strtoupper(substr($product->type->name, 0, 4)) : strtoupper(RandomFunctions::generateRandomString(4, true));
        $sku = "$firstPortion-$secondPortion-$thirdPortion";
        $count = ProductVariant::where([
            ['store_id', '=', $product->store_id,],
            ['sku', '=', $sku,],
        ])->count();
        return $sku . ($count ?: '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param ProductsControllerValidators $validator
     * @return Response
     * @throws InvalidInputException
     */
    public function store(Request $request): Response
    {
        \Log::info("Request Logged" . print_r($request->all(), true));

        $this->validateStoreRequest($request);

        $store_id = $request->session()->get('store_id');
        $user_id = $request->session()->get('user_id');
        $handle = $request->input('handle');

        if ($handle) {
            $slug_count = Product::where('handle', $request->input('handle'))->count();
            if ($slug_count >= 1) {
                $handle = $request->input('handle') . '-' . $slug_count;
            }
        } else {
            $slug_count = Product::where('title', $request->input('title'))->count();

            if ($slug_count >= 1) {
                $handle = Str::slug($request->input('title'));
                $handle .= '-';
                $handle .= $slug_count;
            }
        }

        try {
            DB::beginTransaction();
            $product = new Product();
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->weight = $request->input('weight');
            $product->compare_at_price = $request->input('compare_at_price');
            $product->store_id = $store_id;
            $product->handle = $handle;
            $product->upc = $request->input('upc');
            $product->ean = $request->input('ean');
            $product->jan = $request->input('jan');
            $product->isbn = $request->input('isbn');
            $product->mpn = $request->input('mpn');
            $product->location = $request->input('location');
            $product->tax_class = $request->input('tax_class');
            $product->length = $request->input('length');
            $product->width = $request->input('width');
            $product->height = $request->input('height');
            $product->brand_id = $request->input('brand_id');
            $product->sort_attribute = $request->input('sort_attribute');
            $product->has_variants = $request->input('has_variants');
            $product->country_of_origin = $request->input('country_of_origin');
            $product->seo_page_title = $request->input('seo_page_title');
            $product->seo_description = $request->input('seo_description');
            $product->step = $request->input('step');
            $product->sell_out_of_stock = $request->input('sell_out_of_stock');
            $product->quantity = $request->input('quantity');
            $product->min_quantity = $request->input('min_quantity');
            $product->charge_taxes = $request->input('charge_taxes');
            $product->track_quantity = $request->input('track_quantity');
            $product->custom_product_type_id = $request->input('custom_product_type_id');
            $product->product_type_id = $request->input('product_type_id');
            $product->is_draft = !(boolean)$request->input('publish_product');
            $product->is_published = (boolean)$request->input('publish_product');
            if ($request->input('date_available')) {
                $product->date_available = Carbon::createFromFormat('m-d-Y', $request->input('date_available'));
            } else {
                $product->date_available = Carbon::now();
            }
            $product->save();

            $collections = $request->input('collections');

            if($collections) {
                foreach($collections as $collectionID) {
                    $collectionProduct = new CollectionProduct();
                    $collectionProduct->store_id = $store_id;
                    $collectionProduct->user_id = $user_id;
                    $collectionProduct->collection_id = $collectionID;
                    $collectionProduct->product_id = $product->id;
                    $collectionProduct->save();
                }
            }

            if ($product->has_variants) {
                foreach ($request->input('variants') as $variant) {
                    $productVariant = new ProductVariant();
                    $productVariant->product_id = $product->id;
                    $productVariant->sku = $this->generateSku($product, $variant['sku'] ?? null);
                    $productVariant->price = $variant['price'];
                    $productVariant->quantity = $variant['quantity'];
                    $productVariant->barcode = $variant['barcode'] ?? null;
                    $productVariant->is_active = true;
                    $productVariant->store_id = $product->store_id;
                    $productVariant->save();

                    $variantAttributeTypes = $request->input('available_variant_attributes');
                    $variantAttributeTypesHashTable = array_combine($variantAttributeTypes, array_fill(0, count($variantAttributeTypes), true));
                    if (count($variant['attributes']) !== count($variantAttributeTypesHashTable)) {
                        throw new InvalidInputException("The variant attributes must match the available variant attributes");
                    }

                    foreach ($variant['attributes'] as $attribute) {
                        if (!array_key_exists($attribute['attribute'], $variantAttributeTypesHashTable)) {
                            throw new InvalidInputException("The attribute '" . $attribute['attribute'] . "' does not exist in the defined available variant attributes.");
                        }
                        $productVariantAttribute = new ProductVariantAttribute();
                        $productVariantAttribute->product_id = $product->id;
                        $productVariantAttribute->attribute = $attribute['attribute'];
                        $productVariantAttribute->value = $attribute['value'];
                        $productVariantAttribute->sku = $productVariant->sku;
                        $productVariantAttribute->save();
                    }

                    if (array_key_exists('assets', $variant)) {
                        foreach ($variant['assets'] as $asset) {
                            $productImage = new ProductImage();
                            $productImage->url = $asset['url'];
                            $productImage->alt = $asset['description'];
                            $productImage->rank = $asset['rank'];
                            $productImage->thumb = $asset['thumb'] ?? $asset['url'];
                            $productImage->store_id = $request->input('store_id');
                            $productImage->product_id = $product->id;
                            $productImage->sku = $productVariant->sku;
                            $productImage->save();
                        }
                    }

                }
            } else {
                $productVariant = new ProductVariant();
                $productVariant->product_id = $product->id;
                $productVariant->sku = $this->generateSku($product, $request->input('sku'));
                $productVariant->price = $request->input('price');
                $productVariant->quantity = $request->input('quantity');
                $productVariant->barcode = $request->input('barcode');
                $productVariant->store_id = $product->store_id;
                $productVariant->is_active = true;
                $productVariant->save();
            }

            foreach ($request->input('assets') as $index => $asset) {
                $productImage = new ProductImage();
                $productImage->url = $asset['url'];
                $productImage->alt = $asset['description'];
                $productImage->thumb = $asset['thumb'] ?? $asset['url'];
                if (isset($asset['rank'])) {
                    $productImage->rank = $asset['rank'];
                } else {
                    $productImage->rank = $index;
                }
                $productImage->store_id = $request->input('store_id');
                $productImage->product_id = $product->id;
                $productImage->save();
            }

            DB::commit();

            // Fire new Product Created Event to send out emails and other similar stuff.
            $product->refresh();
            $product->load(['variants.assets', 'variants.attributes', 'assets']);


            ProductCreated::dispatch($product);
            return response([
                'message' => 'Product created successfully',
                'status' => 'success',
                'data' => [
                    'product' => $product
                ]
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name', 'desc')->get(['id', 'name']);
        $brands = Brand::orderBy('name', 'desc')->get();
        $product = Product::with('variants')->with('categories')->with('assets', 'images')->with('brand')->find($id);
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
        return Inertia::render('Products/Edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        \Log::info('edit product request received' . print_r($request->all(), true));
        $this->validateProductUpdate($request);


        try {
            $product = Product::findOrFail($id);
            $storeID = session()->get('store_id');

            $handle = $request->input('handle');


            if ($handle) {
                $slug_count = Product::where([
                    ['handle', '=', $request->input('handle')],
                    ['id', '<>', $id]
                ])->count();
                if ($slug_count >= 1) {
                    $handle = $request->input('handle') . '-' . $slug_count;
                }
            } else {
                $handle = $product->handle;
            }

            if ($product->store_id != $storeID) {
                abort(403);
            }
            DB::beginTransaction();
            $product->title = $request->input('title') ?? $product->title;
            $product->description = $request->input('description') ?? $product->description;
            $product->weight = $request->input('weight') ?? $product->weight;
            $product->compare_at_price = $request->input('compare_at_price') ?? $product->compare_at_price;
            $product->handle = $handle ?? $product->handle;
            $product->upc = $request->input('upc') ?? $product->upc;
            $product->ean = $request->input('ean') ?? $product->ean;
            $product->jan = $request->input('jan') ?? $product->jan;
            $product->isbn = $request->input('isbn') ?? $product->isbn;
            $product->mpn = $request->input('mpn') ?? $product->mpn;
            $product->location = $request->input('location') ?? $product->location;
            $product->tax_class = $request->input('tax_class') ?? $product->tax_class;
            $product->length = $request->input('length') ?? $product->length;
            $product->width = $request->input('width') ?? $product->width;
            $product->height = $request->input('height') ?? $product->height;
            $product->brand_id = $request->input('brand_id') ?? $product->brand_id;
            $product->sort_attribute = $request->input('sort_attribute') ?? $product->sort_attribute;
            $product->country_of_origin = $request->input('country_of_origin') ?? $product->country_of_origin;
            $product->step = $request->input('step') ?? $product->step;
            $product->sell_out_of_stock = $request->input('sell_out_of_stock') ?? $product->sell_out_of_stock;
            $product->quantity = $request->input('quantity') ?? $product->quantity;
            $product->custom_product_type_id = $request->input('custom_product_type_id') ?? $product->custom_product_type_id;
            $product->product_type_id = $request->input('product_type_id') ?? $product->product_type_id;
            $product->is_published = $request->input('publish_product') ?? $product->publish_product;
            $product->seo_page_title = $request->input('seo_page_title') ?? $product->seo_page_title;
            $product->seo_description = $request->input('seo_description') ?? $product->seo_description;
            if ($request->input('date_available')) {
                $product->date_available = Carbon::createFromFormat('m-d-Y', $request->input('date_available'));
            }
            $product->save();

            if($product->has_variants) {
                $product->variants()->delete();
                foreach ($request->input('variants') as $variant) {
                    $productVariant = new ProductVariant();
                    $productVariant->product_id = $product->id;
                    $productVariant->sku = $this->generateSku($product, $variant['sku'] ?? null);
                    $productVariant->price = $variant['price'];
                    $productVariant->quantity = $variant['quantity'];
                    $productVariant->barcode = $variant['barcode'] ?? null;
                    $productVariant->is_active = true;
                    $productVariant->store_id = $product->store_id;
                    $productVariant->save();

                    $variantAttributeTypes = $request->input('available_variant_attributes');
                    $variantAttributeTypesHashTable = array_combine($variantAttributeTypes, array_fill(0, count($variantAttributeTypes), true));
                    if (count($variant['attributes']) !== count($variantAttributeTypesHashTable)) {
                        throw new InvalidInputException("The variant attributes must match the available variant attributes");
                    }

                    foreach ($variant['attributes'] as $attribute) {
                        if (!array_key_exists($attribute['attribute'], $variantAttributeTypesHashTable)) {
                            throw new InvalidInputException("The attribute '" . $attribute['attribute'] . "' does not exist in the defined available variant attributes.");
                        }
                        $productVariantAttribute = new ProductVariantAttribute();
                        $productVariantAttribute->product_id = $product->id;
                        $productVariantAttribute->attribute = $attribute['attribute'];
                        $productVariantAttribute->value = $attribute['value'];
                        $productVariantAttribute->sku = $productVariant->sku;
                        $productVariantAttribute->save();
                    }
                    if (array_key_exists('assets', $variant)) {
                        foreach ($variant['assets'] as $asset) {
                            $productImage = new ProductImage();
                            $productImage->url = $asset['url'];
                            $productImage->alt = $asset['description'];
                            $productImage->rank = $asset['rank'];
                            $productImage->thumb = $asset['thumb'] ?? $asset['url'];
                            $productImage->store_id = $request->input('store_id');
                            $productImage->product_id = $product->id;
                            $productImage->sku = $productVariant->sku;
                            $productImage->save();
                        }
                    }

                }
            } else {
                $defaultVariant = $product->defaultVariant();
                $defaultVariant->price = $request->input('price') ?? $defaultVariant->price;
                $defaultVariant->sku = $request->input('sku') ?? $defaultVariant->sku;
                $defaultVariant->barcode = $request->input('barcode') ?? $defaultVariant->barcode;
                $defaultVariant->save();
            }


            DB::commit();

            return response([
                'message' => 'Product updated successfully',
                'status' => 'success',
            ], 201);
        } catch(ModelNotFoundException $e) {
            DB::rollBack();
            throw new InvalidInputException("Product id does not exist");
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
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

    public function tableSearch(Request $request)
    {
        $search = $request->query("q");
        $brand = $request->query("brand");
        $type = $request->query("type");
        $status = $request->query("status");
        $store_id = $request->session()->get('store_id');

        $products = Product::where(function ($query) use ($search) {
            $query->where('title', 'like', "%" . $search . "%")
                ->orWhere('quantity', 'like', "%" . $search . "%")
                ->orWhere('seo_description', 'like', "%" . $search . "%")
                ->orWhere('seo_page_title', 'like', "%" . $search . "%");
        })->when($brand, function ($query, $brand) {
            $query->where('brand_id', '=', $brand);
        })->when($type, function ($query, $type) {
            $query->where('product_type_id', '=', $type);
        })->when($status, function ($query, $status) {
            $query->where('status', '=', $status);
        })->where('store_id', '=', 'store_id')
            ->get();
        return response([
            'data' => [
                'products' => $products
            ]
        ]);
    }

    public function deleteProduct(Request $request)
    {
        $storeID = $request->query('store_id');
        $productID = $request->query('product_id');
        try {
            Store::findOrFail($storeID);
            $product = Product::findOrFail($productID);
            $productArray = $product->replicate()->toArray();
            if ($product->store_id !== (int)$storeID) {
                throw new InvalidInputException("No product exists with that ID in your store.");
            }
            $this->deleteAProduct($product);
            ProductDeleted::dispatch($productArray);
            return response([
                'message' => 'Product deleted successfully',
                'status' => 'success'
            ], 200);
        } catch (ModelNotFoundException $e) {
            throw new InvalidInputException("The product or store entered does not exist.");
        }
    }

    public function deleteMultipleProducts(Request $request) {
        $storeID = $request->query('store_id');
        $productIDs = $request->input('product_ids');
        DB::beginTransaction();
        foreach($productIDs as $productID) {
            try {
                Store::findOrFail($storeID);
                $product = Product::findOrFail($productID);
                $productArray = $product->replicate()->toArray();
                if ($product->store_id !== (int)$storeID) {
                    throw new InvalidInputException("No product exists with that ID in your store.");
                }
                $this->deleteAProduct($product);
                ProductDeleted::dispatch($productArray);
            } catch (ModelNotFoundException $e) {
                DB::rollBack();
                throw new InvalidInputException("The product or store entered does not exist.");
            }
        }

        DB::commit();
        return response([
            'message' => 'Products deleted successfully',
            'status' => 'success'
        ], 201);
    }

    private function deleteAProduct(Product $product): void
    {
        // Deletes all relevant product relationships
        try {
            DB::beginTransaction();
            // Relationships to delete

            $product->allAssets()->delete();
            foreach ($product->variants as $variant) {
                $variant->attributes()->delete();
                $variant->delete();
            }
            $product->options()->delete();
            $product->metaFields()->delete();
            $product->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function uploadCSV(Request $request) {
        $this->validateUploadCSVRequest($request);
        $csvFile = $request->file('products');
        $fileString = file($csvFile->getRealPath());
        $rows = array_map("str_getcsv", $fileString);
        $header = array_shift($rows);
        $storeID = $request->query('id') ?? $request->session()->get('store_id');

        try {
            DB::beginTransaction();
            foreach ($rows as $row) {
                $product =  array_combine($header, array_map('strtolower', $row));
                // Extract the product creation code to a separate function
                $this->validateCSVRow($product);
                if(isset($product['assets']) && !empty($product['assets'])) {
                    $assets = explode(" ", trim($product['assets']));
                    $product['assets'] = [];
                    foreach($assets as $key=>$asset) {
                        if (filter_var($asset, FILTER_VALIDATE_URL) === FALSE) {
                            throw new InvalidInputException("The image url: '$asset' is invalid.");
                        }
                        $product['assets'][$key]['url'] = $asset;
                        $product['assets'][$key]['thumb'] = $asset;
                        $product['assets'][$key]['description'] = $product['title'];
                        $product['assets'][$key]['rank'] = $key;
                    }
                }
                $this->updateProductFromArray( $product, $storeID);
            }
            DB::commit();
            return response([
                'message' => 'Products added successfully',
                'status' => 'success',
            ], 201);
        } catch(Exception $exp) {
            DB::rollBack();
            throw new InvalidInputException($exp->getMessage());
        }

    }

    private function updateProductFromArray(array $productArray, int $storeID, ?Product $product = null) {
        $handle = $productArray['handle'];

        if ($handle) {
            $slug_count = Product::where('handle', $productArray['handle'])->count();
            if ($slug_count >= 1) {
                $handle = $productArray['handle'] . '-' . $slug_count;
            }
        } else {
            $slug_count = Product::where('title', $productArray['title'])->count();

            if ($slug_count >= 1) {
                $handle = Str::slug($productArray['title']);
                $handle .= '-';
                $handle .= $slug_count;
            }
        }

        if($productArray['store_id'] != $storeID) {
            throw new InvalidInputException("You do not have access to a store with that id: " . $productArray['store_id']);
        }

        $product = is_null($product) ? new Product() : $product;
        $product->title = $productArray['title'];
        $product->description = $productArray['description'];
        $product->weight = $productArray['weight'] ?: null;
        $product->compare_at_price = $productArray['compare_at_price'] ?: null;
//        dd($productArray);
        $product->store_id = $productArray['store_id'];
        $product->handle = $handle;
        $product->upc = $productArray['upc'] ?: null;
        $product->ean = $productArray['ean'] ?: null;
        $product->jan = $productArray['jan'] ?: null;
        $product->isbn = $productArray['isbn'] ?: null;
        $product->mpn = $productArray['mpn'] ?: null;
        $product->location = $productArray['location'] ?: null;
        $product->tax_class = $productArray['tax_class'] ?: null;
        $product->length = $productArray['length'] ?: null;
        $product->width = $productArray['width'] ?: null;
        $product->height = $productArray['height'] ?: null;
        $product->brand_id = $productArray['brand_id'] ?: null;
        $product->sort_attribute = $productArray['sort_attribute'] ?: null;
        $product->country_of_origin = $productArray['country_of_origin'] ?: null;
        $product->seo_page_title = $productArray['seo_page_title'] ?: null;
        $product->seo_description = $productArray['seo_description'] ?: null;
        $product->step = $productArray['step'] ?: null;
        $product->sell_out_of_stock = $productArray['sell_out_of_stock'] ?: null;
        $product->quantity = $productArray['quantity'] ?: null;
        $product->custom_product_type_id = $productArray['custom_product_type_id'] ?: null;
        $product->product_type_id = $productArray['product_type_id'] ?? null;
        $product->is_draft = !(boolean)$productArray['publish_product'];
        $product->is_published = (boolean)$productArray['publish_product'];
        if (isset($productArray['date_available']) && $productArray['date_available']) {
            $product->date_available = Carbon::createFromFormat('m-d-Y', $productArray['date_available']);
        } else {
            $product->date_available = Carbon::now();
        }
        $product->save();
         foreach ($productArray['assets'] as $index => $asset) {
             $productImage = new ProductImage();
             $productImage->url = $asset['url'];
             $productImage->alt = $asset['description'];
             $productImage->thumb = $asset['thumb'] ?: $asset['url'];
             if (isset($asset['rank'])) {
                 $productImage->rank = $asset['rank'];
             } else {
                 $productImage->rank = $index;
             }
             $productImage->store_id = $product->store_id;
             $productImage->product_id = $product->id;
             $productImage->save();
         }
    }


}
