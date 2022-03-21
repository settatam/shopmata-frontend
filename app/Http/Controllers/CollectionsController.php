<?php

namespace App\Http\Controllers;

use App\Events\ProductDeleted;
use App\Exceptions\InvalidInputException;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Store;
use App\Validators\Product\CollectionsControllerValidators;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;


class CollectionsController extends Controller
{
    use CollectionsControllerValidators;

    private const selectorMap = [
        'is equal to' => [
            '='
        ],
        'is not equal to' => [
            '<>'
        ],
        'is greater than' => [
            '>'
        ],
        'is less than' => [
            '<'
        ],
    ];

    private const operandMap = [
        'Product Title' => [
            'numeric' => false,
        ],
        'Product Type' => [
            'numeric' => false,
        ],
        'Product Vendor' => [
            'numeric' => false,
        ],
        'Product Price' => [
            'numeric' => true,
        ],
        'Product Tag' => [
            'numeric' => false,
        ],
        'Stock Quantity' => [
            'numeric' => true,
        ],
        'Weight' => [
            'numeric' => true,
        ],
    ];

    public function index(Request $request)
    {
        $categories = Collection::orderBy('id', 'asc')->paginate(50);
        $filters = $request->all('search', 'level');
        return Inertia::render('Products/Categories/Index', compact('categories', 'filters'));
    }

    public function store(Request $request)
    {
        $this->validateCreateRequest($request);

        $similarCollections = Collection::where('handle', $request->input('handle'))->count();
        $collectionSlug = Str::slug($request->input('name')) . ($similarCollections ? "-$similarCollections" : "");

        $storeID = session()->get('store_id');
        $userID = $request->user()->id;

        $collection = new Collection();
        $collection->store_id = $storeID;
        $collection->title = $request->input('name');
        $collection->description = $request->input('description');
        $collection->theme_id = $request->input('theme_id');
        $collection->image_url = $request->input('image_url');
        $collection->image_thumb = $request->input('image_thumb');
        $collection->image_alt = $request->input('image_alt');
        $collection->handle = $collectionSlug;
        $collection->conditions = json_encode($request->input('conditions'), JSON_THROW_ON_ERROR);
        $collection->user_id = $userID;
        $collection->save();
        return response([
            'message' => 'Collection created successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validateUpdateRequest($request);

        $storeID = session()->get('store_id');

        try {
            $collection = Collection::findOrFail($id);

            if ($collection->store_id != $storeID) {
                return response([
                    'message' => 'You are not authorized to update this collection',
                ], 400);
            }

            $similarCollections = Collection::where([
                ['handle', '=', $request->input('handle')],
                ['id', '<>', $id]
            ])->count();
            $collectionSlug = Str::slug($request->input('name')) . ($similarCollections ? "-$similarCollections" : "");
            $collection->title = $request->input('name') ?? $collection->title;
            $collection->description = $request->input('description') ?? $collection->description;
            $collection->theme_id = $request->input('theme_id') ?? $collection->theme_id;
            $collection->image_url = $request->input('image_url');
            $collection->image_thumb = $request->input('image_thumb');
            $collection->image_alt = $request->input('image_alt');
            $collection->handle = $collectionSlug;
            $collection->page_title = $request->input('seo_title');
            $collection->conditions = json_encode($request->input('conditions'), JSON_THROW_ON_ERROR);
            $collection->seo_title = $request->input('seo_title');
            $collection->seo_description = $request->input('seo_description');
            $collection->save();
            return response([
                'message' => 'Collection updated successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response([
                'message' => 'No collection exists with the given id',
            ], 400);
        }
    }

    public function deleteMultiple(Request $request) {
        $storeID = session()->get('store_id');
        $collectionIDs = $request->input('collection_ids');
        DB::beginTransaction();
        foreach($collectionIDs as $collectionID) {
            try {
                Store::findOrFail($storeID);
                $collection = Collection::findOrFail($collectionID);
                $productArray = $collection->replicate()->toArray();
                if ($collection->store_id !== (int)$storeID) {
                    throw new InvalidInputException("No collection exists with that ID in your store.");
                }
                $collection->delete();
                ProductDeleted::dispatch($productArray);
            } catch (ModelNotFoundException $e) {
                DB::rollBack();
                throw new InvalidInputException("The collection or store entered does not exist.");
            }
        }

        DB::commit();
        return response([
            'message' => 'Products deleted successfully',
            'status' => 'success'
        ], 201);
    }

    public function delete(Request $request, $id) {
        $storeID = session()->get('store_id');

        try {
            $collection = Collection::findOrFail($id);

            if ($collection->store_id != $storeID) {
                return response([
                    'message' => 'You are not authorized to delete this collection',
                ], 400);
            }

            $collection->delete();
            return response([
                'message' => 'Collection deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response([
                'message' => 'No collection exists with the given id',
            ], 400);
        }
    }

    public function searchForCollection(Request $request) {
        $search = $request->input('q');
        $storeID = session()->get('store_id');
        $collections = Collection::where('title', 'like', "%$search%")
            ->where('store_id', $storeID)->get();
        return response([
            'message' => "Collections retrieved successfully",
            'data' => $collections
        ], 200);
    }

//    public function index(Request $request) {
//        $storeID = session()->get('store_id');
//
//        $collections = Collection::where('store_id', $storeID)->get();
//        return response([
//            'collections' => $collections
//        ], 200);
//    }

    public function getProductsAttachedToCollection(Request $request, $handle) {
        try {
            $collection = Collection::where('handle', $handle)->firstOrFail();
            $conditions = json_decode($collection->conditions, true);

            foreach($conditions as $condition) {

            }
        } catch (ModelNotFoundException $e) {
            return response([
                'message' => "This link is broken. It's content has either been moved or it simply never existed."
            ], 404);
        }
    }
}
