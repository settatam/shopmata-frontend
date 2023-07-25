<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreDomainsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionsItemsController;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\TransactionPaymentAddressController;
use App\Http\Controllers\PDFController;

use App\Http\Controllers\Client\HomeController as ClientHomeController;
use Illuminate\Support\Facades\View;

//Shopmata Routes

use App\Http\Controllers\TokenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





//$shopmataRoutes = function() {
//    Route::domain('{account}.'.env('APP_URL')) {
//        Route::get('/', [ShopmataHomeController::class, 'index']);
//    };
//
//};

Route::get('customer/login-with-token', [CustomerLoginController::class, 'loginWithToken']);

//Route::domain('{account}.'.env('APP_URL'))->group(function () {
    Route::get('transactions/{id}/track-my-kit', [PDFController::class, 'trackKit']);
    Route::get('my-account.html', [ClientHomeController::class, 'index']);
    Route::get('contact-us', [ClientHomeController::class, 'index']);
    Route::get('track-my-kit.html', [ClientHomeController::class, 'index']);
    Route::get('/', [ClientHomeController::class, 'index']);
    Route::get('b', [ClientHomeController::class, 'index']);
    Route::get('transactions', [ClientHomeController::class, 'index']);
    Route::get('transactions/{id}', [ClientHomeController::class, 'index']);
    Route::post('transactions/{id}', [ClientHomeController::class, 'update']);
    Route::get('customer/account', [ClientHomeController::class, 'index']);
    Route::get('my-settings.html',      [ClientHomeController::class, 'index']);
    Route::get('my-settings/{id}', [ClientHomeController::class, 'index']);
    Route::post('my-settings',     [ClientHomeController::class, 'settings']);
    Route::get('track-my-kit', [ClientHomeController::class, 'index']);
    Route::get('customer/login', [CustomerLoginController::class, 'getLogin'])->name('login');
    Route::get('password/reset', [CustomerLoginController::class, 'resetPassword'])->name('reset-password');
    Route::get('password/change', [CustomerLoginController::class, 'changePassword'])->name('change-password');
    Route::post('password/change', [CustomerLoginController::class, 'postChangePassword']);
    Route::post('password/reset', [CustomerLoginController::class, 'postResetPassword']);
    Route::get('login', [CustomerLoginController::class, 'getLogin']);
    Route::get('customer/logout', [ClientHomeController::class, 'logout'])->name('customer.logout');
    Route::post('customer/login', [CustomerLoginController::class, 'customerLogin']);
    Route::get('thank-you', [ClientHomeController::class, 'index']);
    Route::get('thank-you.html', [ClientHomeController::class, 'index'])->name('thank-you');
    Route::get('thank-you/{id}', [ClientHomeController::class, 'index'])->name('thank-you');
    Route::get('{id}/thank-you', [ClientHomeController::class, 'fix']);
    Route::post('customer/verify-address', [ClientHomeController::class, 'verifyAddress']);
    Route::post('customer/re-verify-address', [ClientHomeController::class, 'reVerifyAddress']);
    Route::post('customer/update-address-verification', [ClientHomeController::class, 'updateAddressVerification']);
    Route::post('customer/meta', [ClientHomeController::class, 'meta']);
    Route::get('customer/track-progress/{id}', [ClientHomeController::class, 'trkProgress']);
    Route::post('customer/track-progress', [ClientHomeController::class, 'postTrkProgress']);
//});



Route::get('logout',          [LoginController::class,    'logout']);
Route::post('logout',         [LoginController::class,    'logout']);
Route::post('login',          [LoginController::class,    'authenticate']);
//Route::get('password/reset',  [LoginController::class,    'ForgotPassword']);
Route::get('login/token',     [TokenController::class,    'loginWithToken']);


Route::post('register', [RegisterController::class, 'RegisterUser']);
//Create Store here

Route::post('store', ['StoreController', 'store'])->name('create-new-store');


Route::group(['prefix' => 'auth'], function () {
    Route::get("get-started/{step}", [HomeController::class, 'getStarted']);
    Route::post('create-store', [StoreController::class, 'createStore']);
    Route::get('recover-password', [HomeController::class, 'passwordRecovery']);
    Route::post('recover-password', [HomeController::class, 'sendRecoveryMail']);
    Route::get('change-password', [HomeController::class, 'changePassword']);
    Route::post('change-password', [HomeController::class, 'changeUserPassword']);
    Route::post('initiate-store-registration', [HomeController::class, 'initializeStore']);
});


