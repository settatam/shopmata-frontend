<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CountriesController;
use App\Http\Controllers\API\StatesController;
use App\Http\Controllers\API\StoreLocationController;
use App\Http\Controllers\ProductsController;
use App\Models\Status;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('countries', [CountriesController::class, 'index']);
Route::get('states', [StatesController::class, 'index']);
Route::get('store-locations/{id}', [StoreLocationController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/status', function (Request $request) {
    return response()->json(Status::all());
});



Route::post('products/upload-csv', [ProductsController::class, 'uploadCSV']);