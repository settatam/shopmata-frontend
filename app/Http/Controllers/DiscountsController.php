<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Discount;
use App\Models\DiscountCategory;
use App\Models\DiscountCountry;
use App\Models\DiscountProduct;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DiscountsController extends Controller
{
    /**Class 'App\Http\Controllers\Validator' not found
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $discounts = Discount::orderBy('id', 'desc')->paginate(50);
        $filters = $request->all('search', 'orders', 'location', 'total');
        $countries = Country::all();
        $categories = Category::all();
        $products = Product::all();

        Log::info("store id" . session()->get('store_id'));

        return Inertia::render('Discounts/Index', compact('discounts', 'filters', 'countries', 'categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Discounts/Create',);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            \Log::info("Create Discount Received" . print_r($data, true));

            $validator = Validator::make($data, [
                'code' => "required|string",
                'type' => "required|in:percentage,fixed,free-shipping",
                'discount' => "required|numeric",
                'start_date' => "string|nullable",
                'end_date' => 'string|nullable',
                'applies_to' => 'string|in:all_products,all_categories,entire_order,products,categories',
                "countries" => 'required_if:type,free-shipping|array',
                "products" => 'required_if:applies_to,products|array',
                "categories" => 'required_if:applies_to,categories|array',
            ]);

            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors(),
                ];
                return response()->json(['notification' => $notification], 400);
            }

            switch ($request->type) {
                case 'fixed':
                    $data['type'] = Discount::$fixed;
                    break;
                case 'percentage':
                    $data['type'] = Discount::$percentage;
                    break;
                case 'free-shipping':
                    $data['type'] = Discount::$free_shipping;
                    break;
            }

            $discount_data = [
                'store_id' => session('store_id'),
                'status' => $data['applies_to'],
                'type' => $data['type'],
                'entire_order' => $data['applies_to'] === 'entire_order' ? 1 : 0,
                'active' => 1,
                'discount' => $data['discount'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'code' => $data['code'],
            ];

            if ($discount = Discount::create($discount_data)) {

                Log::info(Auth::id() . 'created a new discount code', $discount_data);

                ###create for countries
                if ($data['type'] === 'free-shipping') {
                    foreach ($data['countries'] as $countryId) {
                        DiscountCountry::create([
                            'country_id' => $countryId,
                            'discount_id' => $discount->id,
                            'user_id' => Auth::id(),
                        ]);
                    }
                }

                ###create for categories
                if ($data['applies_to'] === 'categories') {
                    foreach ($data['categories'] as $cat) {
                        DiscountCategory::create([
                            'category_id' => $cat,
                            'discount_id' => $discount->id,
                        ]);
                    }
                }

                ###create for products
                if ($data['applies_to'] === 'products') {
                    foreach ($data['products'] as $sku) {
                        DiscountProduct::create([
                            'sku' => $sku,
                            'discount_id' => $discount->id,
                        ]);
                    }
                }

                ###create for customers

                return response()->json([
                    "title" => "Discount Created",
                    "type" => "success",
                    "message" => "Discount #$discount->id Created",
                ]);
            } else {
                Log::error(Auth::id() . ' could not new discount code', $discount_data);
                return response()->json([
                    "title" => "Discount Not Created",
                    "type" => "error",
                    "message" => "Discount #$discount->id Created",
                ], 422);
            }

            // return Redirect::route('discounts')->with('success', 'Discount added.');
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("create store exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 500);
        }
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $data = $request->all();

            \Log::info("Update Discount Received" . print_r($data, true));

            $validator = Validator::make($data, [
                'type' => "required|in:percentage,fixed,free-shipping",
                'discount' => "required|numeric",
                'start_date' => "string|nullable",
                'end_date' => 'string|nullable',
                'applies_to' => 'string|in:all_products,all_categories,entire_order,products,categories',
                "countries" => 'required_if:type,free-shipping|array',
                "products" => 'required_if:applies_to,products|array',
                "categories" => 'required_if:applies_to,categories|array',
            ]);

            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors(),
                ];
                return response()->json(['notification' => $notification], 400);
            }

            switch ($request->type) {
                case 'fixed':
                    $data['type'] = Discount::$fixed;
                    break;
                case 'percentage':
                    $data['type'] = Discount::$percentage;
                    break;
                case 'free-shipping':
                    $data['type'] = Discount::$free_shipping;
                    break;
            }

            $discount = Discount::where('store_id', session('store_id'))->first();

            if ($discount === null) {
                $notification = [
                    "title" => "Not Found",
                    "type" => "failed",
                    "message" => "Discount Not Found"
                ];
                return response()->json(['notification' => $notification], 404);
            }

            $discount_data = [
                'status' => $data['applies_to'],
                'type' => $data['type'],
                'entire_order' => $data['applies_to'] === 'entire_order' ? 1 : 0,
                'discount' => $data['discount'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
            ];

            if ($discount->update($discount_data)) {

                Log::info(Auth::id() . 'Updated new Discount', $discount_data);

                ###create for countries
                if ($data['type'] === 'free-shipping') {
                    foreach ($data['countries'] as $countryId) {
                        DiscountCountry::create([
                            'country_id' => $countryId,
                            'discount_id' => $discount->id,
                            'user_id' => Auth::id(),
                        ]);
                    }
                }

                ###create for categories
                if ($data['applies_to'] === 'categories') {
                    foreach ($data['categories'] as $cat) {
                        DiscountCategory::create([
                            'category_id' => $cat,
                            'discount_id' => $discount->id,
                        ]);
                    }
                }

                ###create for products
                if ($data['applies_to'] === 'products') {
                    foreach ($data['products'] as $sku) {
                        DiscountProduct::create([
                            'sku' => $sku,
                            'discount_id' => $discount->id,
                        ]);
                    }
                }

                ###create for customers

                return response()->json([
                    "title" => "Discount Created",
                    "type" => "success",
                    "message" => "Discount #$discount->id Updated",
                ]);
            } else {
                Log::error(Auth::id() . ' could not update discount', $discount_data);
                return response()->json([
                    "title" => "Discount Not Created",
                    "type" => "error",
                    "message" => "Discount #$discount->id Created",
                ], 422);
            }
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("update discount exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 500);
        }
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

    public function createDiscountCode()
    {
        try {
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

            $code = substr(str_shuffle($str_result), 0, 9);

            do {
                $code = substr(str_shuffle($str_result), 0, 9);
            } while ($this->codeExists($code) === false);

            return response()->json(['code' => $code], 200);
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("create discount code exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }

    private function codeExists($code)
    {
        $code = Discount::where('code', $code)->first();
        return $code === null;
    }
}
