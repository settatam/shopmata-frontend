<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OnlineStore\CodeEditorController;
use App\Http\Controllers\OnlineStore\LocationController;
use App\Http\Controllers\OnlineStore\NavigationController;
use App\Http\Controllers\OnlineStore\OpenEditorPagesController;
use App\Http\Controllers\OnlineStore\StoreUserController;
use App\Http\Controllers\OnlineStore\ThemeController;
use App\Http\Controllers\OrderCustomerNoteController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Settings\EmailMarketingSettingsController;
use App\Http\Controllers\Settings\GeneralController;
use App\Http\Controllers\Settings\GiftCardsController;
use App\Http\Controllers\Settings\NotificationsController;
use App\Http\Controllers\Settings\PaymentsController;
use App\Http\Controllers\Settings\PayoutSettingsController;
use App\Http\Controllers\Settings\PlansAndPermissionsController;
use App\Http\Controllers\ReportsController;


use App\Http\Controllers\Settings\ShippingController;
use App\Http\Controllers\Settings\ShippingProfileController;
use App\Http\Controllers\Settings\ShippingRatesController;
use App\Http\Controllers\Settings\StoreNotificationMessageController;
use App\Http\Controllers\Settings\StoreLocationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StaffsController;
use App\Http\Controllers\StoreBlogController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreDomainsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectionsController;
use App\Http\Controllers\OnlineStore\EditorController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransactionsItemsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransactionItemsController;
use App\Http\Controllers\StoresController;

use App\Http\Controllers\WidgetsController;

use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\TransactionPaymentAddressController;


use App\Http\Controllers\MessagesController;

use App\Http\Controllers\PDFController;

use App\Http\Controllers\NotificationsController as NewNotificationsController;

//Client

use App\Http\Controllers\Client\HomeController as ClientHomeController;
use Illuminate\Support\Facades\View;

//Shopmata Routes

use App\Http\Controllers\Shopmata\HomeController as ShopmataHomeController;
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


//Route::domain('{account}.'.env('APP_URL'))->group(function () {
    Route::get('/', [ClientHomeController::class, 'index']);
    Route::get('transactions', [ClientHomeController::class, 'index']);
    Route::get('transactions/{id}', [ClientHomeController::class, 'index']);
    Route::post('transactions/{id}', [ClientHomeController::class, 'update']);
    Route::get('customer/account', [ClientHomeController::class, 'index']);
    Route::get('my-settings',      [ClientHomeController::class, 'index']);
    Route::get('my-settings/{id}', [ClientHomeController::class, 'index']);
    Route::post('my-settings',     [ClientHomeController::class, 'settings']);
    Route::get('track-my-kit', [ClientHomeController::class, 'index']);
    Route::get('customer/login', [ClientHomeController::class, 'index'])->name('customer.login');
    Route::get('customer/logout', [ClientHomeController::class, 'logout'])->name('customer.logout');
    Route::post('customer/login', [CustomerLoginController::class, 'customerLogin']);
    Route::get('thank-you', [ClientHomeController::class, 'index']);
    Route::get('thank-you/{id}', [ClientHomeController::class, 'index']);
    Route::post('customer/verify-address', [ClientHomeController::class, 'verifyAddress']);
//});




// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
// 	return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');

Route::get('pdf', [PDFController::class, 'index']);

Route::get('login',           [LoginController::class,    'getLogin'])->name('login');
Route::get('logout',          [LoginController::class,    'logout']);
Route::post('logout',         [LoginController::class,    'logout']);
Route::get('register/step-2', [RegisterController::class, 'registerStep2'])->name('register-step-2');
Route::get('register/step-3', [RegisterController::class, 'registerStep3'])->name('register-step-3');
Route::get('register',        [RegisterController::class, 'getRegister'])->name('register');
Route::post('login',          [LoginController::class,    'authenticate']);
Route::get('password/reset',  [LoginController::class,    'ForgotPassword']);
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


Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

});



Route::get('check-migrations', function() {
   return response()->json([
       'tables' => \Illuminate\Support\Facades\DB::table('migrations')->get()
   ]);
});



