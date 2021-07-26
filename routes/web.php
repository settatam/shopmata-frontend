<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StaffsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\StoreTemplatesController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Settings\ShippingProfileController;
use App\Http\Controllers\Settings\GeneralController;
use App\Http\Controllers\Settings\PaymentsController;
use App\Http\Controllers\Settings\ShippingController;
use App\Http\Controllers\Settings\GiftCardsController;
use App\Http\Controllers\StorePreferencesController;
use App\Http\Controllers\StoreDomainsController;
use App\Http\Controllers\OnlineStoreController;
use App\Http\Controllers\StoreThemesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\StoreBlogController;
use App\Http\Controllers\Settings\NotificationsController;
use App\Http\Controllers\OnlineStore\EditorController;
use App\Http\Controllers\OnlineStore\CodeEditorController;
use App\Http\Controllers\OnlineStore\ThemeController;
use App\Http\Controllers\OnlineStore\OpenEditorPagesController;

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

Route::get('/', function () {
	return Inertia\Inertia::render('Landing');
})->name('landing');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::get('login', [LoginController::class, 'getLogin'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('register', [RegisterController::class, 'RegisterUser']);


Route::group(['prefix' => 'auth'], function () {
	Route::get("get-started/{step}", [HomeController::class, 'getStarted']);
	Route::post('create-store', [StoreController::class, 'createStore']);
	Route::get('recover-password', [HomeController::class, 'passwordRecovery']);
	Route::post('recover-password', [HomeController::class, 'sendRecoveryMail']);
	Route::get('change-password', [HomeController::class, 'changePassword']);
	Route::post('change-password', [HomeController::class, 'changeUserPassword']);
	Route::post('initiate-store-registration', [HomeController::class, 'initializeStore']);
});


Route::get('staff/registration/new', [StaffsController::class, 'registration']);
Route::post('staff/registration/new', [StaffsController::class, 'createStaff']);

Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::get('dashboard/data', [DashboardController::class, 'index']);

	Route::get('/get/user/store/products', [StoreController::class, 'getStoreProducts']);

	#Products
	Route::get('products', [ProductsController::class, 'index'])->name('products');
	Route::get('products/create', [ProductsController::class, 'create'])->name('products.create');
	Route::post('products', [ProductsController::class, 'store']);
	Route::get('products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
	Route::put('products/{id}', [ProductsController::class, 'update']);
	Route::post('products/get-order-products', [ProductsController::class, 'getOrderProducts']);

	#Brands
	Route::get('brands', [BrandsController::class, 'index'])->name('brands');
	Route::get('brands/create', [BrandsController::class, 'create'])->name('brands.create');
	Route::post('brands', [BrandsController::class, 'store']);
	Route::get('brands/{id}/edit', [BrandsController::class, 'edit'])->name('brands.edit');
	Route::put('brands/{id}', [BrandsController::class, 'update']);

	#Categories
	Route::get('categories', [CategoryController::class, 'index'])->name('categories');
	Route::any('categories/search/{query}', [CategoryController::class, 'search']);
	Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
	Route::post('categories', [CategoryController::class, 'store']);
	Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
	Route::put('categories/{id}', [CategoryController::class, 'update']);

	#Orders
	Route::get('orders', [OrdersController::class, 'index'])->name('orders');
	Route::get('orders/create', [OrdersController::class, 'create'])->name('orders.create');
	Route::post('orders/create', [OrdersController::class, 'store']);
	Route::get('orders/{id}', [OrdersController::class, 'show'])->name('orders.view');

	#Settings
	Route::get('settings', [GeneralController::class, 'index'])->name('settings');

	#Settings -> General
	Route::get('settings/general', [GeneralController::class, 'index'])->name('settings.general');
	Route::put('settings/general', [SettingsController::class, 'updateStore'])->name('settings.updateStore');

	#Settings -> Plan and Permissions
	Route::get('settings/plan-and-permissions', [SettingsController::class, 'permissions'])->name('settings.permissions');
	Route::get('settings/plan-and-permissions/staffs/invite', [StaffsController::class, 'create'])->name('settings.iviteStaff');
	Route::post('settings/plan-and-permissions/staffs/invite', [StaffsController::class, 'inviteStaff']);

	#Settings -> Shipping and Delivery
	Route::get('settings/shipping-and-delivery', [ShippingController::class, 'index'])->name('settings.shipping');
	Route::get('settings/shipping-and-delivery/local-delivery/manage', [SettingsController::class, 'manageLocalDelivery'])->name('settings.shipping.manageLocalDelivery');
	Route::get('settings/shipping-and-delivery/local-pickup/manage', [SettingsController::class, 'manageLocalPickup'])->name('settings.shipping.manageLocalPickup');
	Route::get('settings/shipping-and-delivery/general-shipping-rate', [SettingsController::class, 'generalShippingRate'])->name('settings.shipping.generalShippingRate');
	Route::post('settings/shipping-and-delivery/general-shipping-rate', [SettingsController::class, 'createGeneralShippingRate']);
	Route::get('settings/shipping-and-delivery/shipping-profile', [SettingsController::class, 'shippingProfile'])->name('settings.shipping.shippingProfile');

	#Settings -> Payments
	Route::get('settings/payments', [PaymentsController::class, 'index'])->name('settings.payments');
	Route::get('settings/payments/gateways', [SettingsController::class, 'addPaymentOption'])->name('settings.payments.addPaymentOption');
	Route::get('settings/payments/gateways/{gateway_id}', [SettingsController::class, 'paymentOptionInfo']);
	Route::post('settings/payments/gateways', [SettingsController::class, 'savePaymentOption']);
	Route::delete('settings/payments/{id}', [SettingsController::class, 'deletePayment']);

	#Settings -> Gift Cards
	Route::get('settings/gift-cards', [GiftCardsController::class, 'index'])->name('settings.giftCards');
	Route::post('settings/gift-cards', [SettingsController::class, 'createGiftCards']);

	#Settings -> Notifications
	Route::get('settings/notifications', [NotificationsController::class, 'index']);

	#Settings -> User
	Route::get('settings/user', [SettingsController::class, 'user'])->name('settings.user');
	Route::post('settings/user', [SettingsController::class, 'createUser'])->name('settings.user');

	#Settings -> Shipping Profiles
	Route::get('settings/shipping-profiles', [ShippingProfileController::class, 'index'])->name('settings.shipping.shippingProfiles');
	Route::post('settings/shipping-profiles', [ShippingProfileController::class, 'store']);

	#Analytics
	Route::get('analytics', [AnalyticsController::class, 'index']);

	#Discounts
	Route::get('discounts', [DiscountsController::class, 'index'])->name('discounts');
	Route::post('discounts', [DiscountsController::class, 'store']);
	Route::put('discounts', [DiscountsController::class, 'update']);

	Route::post('/generate/user/discount/code', [DiscountsController::class, 'createDiscountCode']);

	#Customers
	Route::get('customers', [CustomersController::class, 'index'])->name('customers');
	Route::post('customers', [CustomersController::class, 'store']);
	Route::get('customers/{id}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
	Route::put('customers/{id}', [CustomersController::class, 'update']);
	Route::get('customers/{id}/view', [CustomersController::class, 'show'])->name('customers.view');
	Route::delete('customers/{id}', [CustomersController::class, 'destroy']);
	Route::post('product-images', [ImagesController::class, 'store']);
	Route::get('product-images', [ImagesController::class, 'index']);

	## Store Preferences

	Route::resource('preferences', 'StorePreferencesController');

	## Online Store

	// Route::resource('store/themes', 'ThemeController');

	Route::get('online-store/code-editor', [CodeEditorController::class, 'index']);
	Route::post('online-store/code-editor', [CodeEditorController::class, 'store']);
	Route::put('online-store/code-editor/{id}', [CodeEditorController::class, 'update']);
	Route::get('online-store/code-editor/{id}', [CodeEditorController::class, 'show']);
    Route::get('online-store/editor', [CodeEditorController::class, 'index']);

    //Open editor pages

    Route::delete('editor-pages', [OpenEditorPagesController::class, 'destroy']);

	Route::get('online-store/themes', [ThemeController::class, 'index']);

	Route::get('store/pages/generate-slug/{title}', [PagesController::class, 'generateSlug']);
	Route::get('store/pages/editor/{id?}', [PagesController::class, 'editor']);
	Route::get('store/pages/code-editor/{id?}', [PagesController::class, 'codeEditor']);
	Route::resource('store/pages', PagesController::class);
	Route::resource('store/blog', StoreBlogController::class);
	##Store Domains

	Route::resource('store/domains', StoreDomainsController::class);
	// Route::resource('store/themes', StoreThemesController::class);
});
