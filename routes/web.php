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

use App\Http\Controllers\WidgetsController;



use App\Http\Controllers\MessagesController;


use App\Http\Controllers\NotificationsController as NewNotificationsController;

//Client

use App\Http\Controllers\Client\HomeController as ClientHomeController;

//Shopmata Routes

use App\Http\Controllers\Shopmata\HomeController as ShopmataHomeController;

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

Route::get('test', function () {
    return view('emails.sender');
})->name('landing');


//$shopmataRoutes = function() {
//    Route::domain('{account}.'.env('APP_URL')) {
//        Route::get('/', [ShopmataHomeController::class, 'index']);
//    };
//
//};

Route::domain('{account}.'.env('APP_URL'))->group(function () {
    Route::get('/', [ClientHomeController::class, 'index']);
    Route::get('transactions', [ClientHomeController::class, 'index']);
    Route::get('transactions/{id}', [ClientHomeController::class, 'show']);
    Route::get('customer/account', [ClientHomeController::class, 'index']);
    Route::get('customer/login', [ClientHomeController::class, 'index'])->name('customer.login');
    Route::post('customer/login', [LoginController::class, 'customerLogin']);
    Route::get('thank-you', [ClientHomeController::class, 'index']);
    Route::get('thank-you/{id}', [ClientHomeController::class, 'index']);
    Route::post('customer/verify-address', [ClientHomeController::class, 'verifyAddress']);
});




// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
// 	return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');

Route::get('login', [LoginController::class, 'getLogin'])->name('login');
Route::get('logout', [LoginController::class, 'logout']);
Route::post('logout', [LoginController::class, 'logout']);

Route::get('register/step-2', [RegisterController::class, 'registerStep2'])->name('register-step-2');
Route::get('register/step-3', [RegisterController::class, 'registerStep3'])->name('register-step-3');
Route::get('register', [RegisterController::class, 'getRegister'])->name('register');
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('password/reset', [LoginController::class, 'ForgotPassword']);

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


Route::get('staff/registration/new', [StaffsController::class, 'registration']);
Route::post('staff/registration/new', [StaffsController::class, 'createStaff']);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard/data', [DashboardController::class, 'getData']);
        Route::get('/get/user/store/products', [StoreController::class, 'getStoreProducts']);
        #Products
        Route::get('products/', [ProductsController::class, 'index'])->name('products');
        Route::get('products/get-data', [ProductsController::class, 'getData'])->name('products.data');
        Route::get('products/get-single/{id}', [ProductsController::class, 'getSingle'])->name('products.single');
        Route::get('products/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('products/', [ProductsController::class, 'store']);
        Route::get('products/{id}', [ProductsController::class, 'edit'])->name('products.edit')
            ->where('id', '[0-9]+');
        Route::put('products/{id}', [ProductsController::class, 'update'])
            ->where('id', '[0-9]+');
        Route::post('products/get-order-products', [ProductsController::class, 'getOrderProducts']);
        Route::post('products/upload-csv', [ProductsController::class, 'uploadCSV']);
        Route::post('products/delete', [ProductsController::class, 'deleteProduct']);
        Route::post('products/delete-multiple', [ProductsController::class, 'deleteMultipleProducts']);
        Route::get('products/search', [ProductsController::class, 'tableSearch']);

        //Search
        Route::get('search', [SearchController::class, 'index']);

        #Collections
        Route::prefix('collections')->group(function () {
            Route::post('/', [CollectionsController::class, 'store']);
            Route::get('/', [CollectionsController::class, 'index']);
            Route::post('/update/{id}', [CollectionsController::class, 'update']);
            Route::post('/delete/{id}', [CollectionsController::class, 'delete']);
            Route::post('/delete-multiple', [CollectionsController::class, 'deleteMultiple']);
            Route::get("/search", [CollectionsController::class, 'searchForCollection']);
        });

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
        Route::get('orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
        Route::post('orders/{id}/send-invoice', [OrdersController::class, 'sendInvoice'])->name('orders.create');
        //Bank Details

        #Settings
        Route::get('settings', [GeneralController::class, 'index'])->name('settings');

        #Settings -> External Links
        Route::get('settings/contact', [SettingsController::class, 'support']);
        Route::get('settings/delivery-method', [SettingsController::class, 'deliveryMethod']);
        Route::get('settings/international-payment', [SettingsController::class, 'internationalPayment']);
        Route::get('settings/privacy-policy', [SettingsController::class, 'privacyPolicy']);
        Route::get('settings/shipping-rate', [SettingsController::class, 'aboutShippingRate']);
        Route::get('settings/terms-of-service', [SettingsController::class, 'termsOfService']);


        #Settings -> General
        Route::get('settings/general', [GeneralController::class, 'index'])->name('settings.general');
        Route::put('settings/general', [SettingsController::class, 'updateStore'])->name('settings.updateStore');

        #Settings -> Plan and Permissions
        Route::get('settings/plan-and-permissions', [SettingsController::class, 'permissions'])->name('settings.permissions');
        Route::get('settings/plan-and-permissions/staffs/invite', [StaffsController::class, 'create'])->name('settings.inviteStaff');
        Route::post('settings/plan-and-permissions/staffs/invite', [StaffsController::class, 'inviteStaff']);

        Route::resource('settings/remittance', PayoutSettingsController::class);
        Route::resource('transactions', TransactionsController::class)->names([
            'index' => 'transactions.index',
            'show' => 'transactions.show'
        ]);
        Route::post('transactions/bulk-print-action', [TransactionsController::class, 'bulkPrintAction']);
        Route::post('transactions/bulk-actions/{action}', [TransactionsController::class, 'bulkAction']);
        Route::get('transactions/bulk/messages', [TransactionsController::class, 'messages']);
        Route::post('transactions/send/messages', [TransactionsController::class, 'sendMessages']);


        Route::get('transactions/{id}/{printable}', [TransactionsController::class, 'printable']);
        Route::get('transactions/{id}/{printable}', [TransactionsController::class, 'printable']);

        Route::post('transactions/{id}/{extra}', [TransactionsController::class, 'extras']);
        Route::post('transaction/tag', [TransactionsController::class, 'addTag']);
        Route::post('transaction/notes', [TransactionsController::class, 'addNote']);
        Route::post('transaction/image', [TransactionsController::class, 'addImage']);
        Route::post('transaction/image/delete', [TransactionsController::class, 'deleteTransactionNoteImage']);
        Route::post('transactions/delete', [TransactionsController::class, 'destroy']);

        Route::resource('items', TransactionItemsController::class);
        Route::post('item/{id}/images', [TransactionItemsController::class, 'UpdateImage']);
        Route::post('item/{id}/image/delete', [TransactionItemsController::class, 'deleteImage']);

        Route::post('reports/export', [ReportsController::class, 'export']);
        Route::get('reports/form-group', [ReportsController::class, 'formGroup']);
        Route::resource('reports', ReportsController::class);

        #Settings -> Shipping and Delivery
        Route::get('settings/shipping-and-delivery', [ShippingController::class, 'index'])->name('settings.shipping');
        Route::get('settings/shipping-and-delivery/local-delivery/manage', [SettingsController::class, 'manageLocalDelivery'])->name('settings.shipping.manageLocalDelivery');
        Route::get('settings/shipping-and-delivery/local-pickup/manage', [SettingsController::class, 'manageLocalPickup'])->name('settings.shipping.manageLocalPickup');
        Route::get('settings/shipping-and-delivery/general-shipping-rate', [SettingsController::class, 'generalShippingRate'])->name('settings.shipping.generalShippingRate');
        Route::post('settings/shipping-and-delivery/general-shipping-rate', [SettingsController::class, 'createGeneralShippingRate']);
        Route::get('settings/shipping-and-delivery/shipping-profile', [ShippingProfileController::class, 'index'])->name('settings.shipping.shippingProfile');

        #Settings -> Payments
        Route::get('settings/payments', [PaymentsController::class, 'index'])->name('settings.payments');
        Route::get('settings/payments/gateways', [SettingsController::class, 'addPaymentOption'])->name('settings.payments.addPaymentOption');
        Route::get('settings/payments/gateways/{gateway_id}', [SettingsController::class, 'paymentOptionInfo']);
        Route::post('settings/payments/gateways', [SettingsController::class, 'savePaymentOption']);
        Route::delete('settings/payments/{id}', [SettingsController::class, 'deletePayment']);

        #Settings -> Gift Cards
        Route::get('settings/gift-cards', [GiftCardsController::class, 'index'])->name('settings.giftCards');
        Route::post('settings/gift-cards', [GiftCardsController::class, 'createGiftCards']);

        #Settings -> Notifications
        Route::get('settings/notifications', [NotificationsController::class, 'index']);
        Route::post('settings/notifications', [App\Http\Controllers\StoreNotificationController::class, 'getMsg']);

        Route::get('settings/notifications/{id}', [NotificationsController::class, 'show']);
        //Route::post('settings/notifications/{id}', [NotificationsController::class, 'getMsg']);

        Route::post('settings/notifications/store', [StoreNotificationMessageController::class, 'store']);
        Route::post('settings/notifications/email-marketing', [EmailMarketingSettingsController::class, 'store']);

        #Notifications
        Route::get('temp-notifications', [NewNotificationsController::class, 'index']);
        Route::get('temp-notifications/{id}', [NewNotificationsController::class, 'show'])->where('id', '[0-9]+');
        Route::get('temp-notifications/create', [NewNotificationsController::class, 'create']);
        Route::get('temp-notifications/test', [NewNotificationsController::class, 'test']);

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
        Route::get('discounts/create', [DiscountsController::class, 'create'])->name('discounts.create');

        Route::post('/generate/user/discount/code', [DiscountsController::class, 'createDiscountCode']);

        #Customers
        Route::get('customers',              [CustomersController::class, 'index'])->name('customers');
        Route::get('customers/create',       [CustomersController::class, 'create']);
        Route::post('customers/store',       [CustomersController::class, 'store']);
        Route::get('customers/{id}/edit',    [CustomersController::class, 'edit'])->name('customers.edit');
        Route::put('customers/{id}',         [CustomersController::class, 'update']);
        Route::get('customers/{id}',         [CustomersController::class, 'show'])->name('customers.view');
        Route::delete('customers/{id}',      [CustomersController::class, 'destroy']);
        Route::post('customer/{id}/{extra}', [CustomersController::class, 'extras']);



        Route::post('images', [ImagesController::class, 'store']);
        Route::post('image/delete', [ImagesController::class, 'destroy']);

        Route::get('product-images', [ImagesController::class, 'index']);

        ## Store Preferences

        Route::resource('preferences', 'StorePreferencesController');

        //Widgets

        Route::get('widgets/view', [WidgetsController::class, 'view'])->name('widget.view');



        ## Online Store

        // Route::resource('store/themes', 'ThemeController');

        Route::get('online-store/code-editor', [CodeEditorController::class, 'index']);
        Route::post('online-store/code-editor', [CodeEditorController::class, 'store']);
        Route::post('online-store/code-editor/uploader', [CodeEditorController::class, 'uploader']);
        Route::put('online-store/code-editor/{id}', [CodeEditorController::class, 'update']);
        Route::get('online-store/code-editor/{id}', [CodeEditorController::class, 'show']);
        Route::get('online-store/editor', [CodeEditorController::class, 'index']);

        Route::resource('online-store/locations', LocationController::class);
        Route::resource('online-store/store-users', StoreUserController::class);
        Route::resource('messages', MessagesController::class);


        Route::resource('order-customer-note', OrderCustomerNoteController::class);
        Route::resource('settings/shipping-rates', ShippingRatesController::class);
        // Navigation

        Route::get('online-store/navigation', [NavigationController::class, 'index'])->name('navigation.list');
        Route::get('online-store/navigation/create', [NavigationController::class, 'create']);
        Route::get('online-store/navigation/{id}', [NavigationController::class, 'show'])->name('navigation.show');
        Route::put('online-store/navigation/{id}', [NavigationController::class, 'update']);
        Route::post('online-store/navigation/{id}', [NavigationController::class, 'storeList']);
        Route::post('online-store/navigation', [NavigationController::class, 'store']);
        Route::delete('online-store/navigation/{id}', [NavigationController::class, 'delete']);


        //Open editor pages

        Route::get('editor-pages/{id}', [OpenEditorPagesController::class, 'show']);
        Route::delete('online-store/editor-pages/{id}', [OpenEditorPagesController::class, 'destroy']);

        Route::get('online-store/themes', [ThemeController::class, 'index']);

        Route::post('store/create', [StoreController::class, 'store']);
        Route::put('store/{id}', [StoreController::class, 'update']);

        Route::put('store', [StoreController::class, 'update']);


        Route::get('store/pages/generate-slug/{title}', [PagesController::class, 'generateSlug']);
        Route::get('store/pages/editor/{id?}', [PagesController::class, 'editor']);
        Route::get('store/pages/code-editor/{id?}', [PagesController::class, 'codeEditor']);
        Route::resource('store/pages', PagesController::class);
        Route::resource('store/blog', StoreBlogController::class);
        ##Store Domains

        Route::resource('store/domains', StoreDomainsController::class);
        // Route::resource('store/themes', StoreThemesController::class);
        Route::get('settings/store-users/response', [PlansAndPermissionsController::class, 'response']);

        Route::resource('settings/store-users', PlansAndPermissionsController::class);


        //    Route::get('settings/store-users', [PlansAndPermissionsController::class, 'index'])->name('permissions.list');
        //    Route::get('settings/store-users/{id}', [PlansAndPermissionsController::class, 'show']);
        //    Route::get('settings/store-users/{id}/edit', [PlansAndPermissionsController::class, 'edit']);
        //    Route::post('settings/store-users', [PlansAndPermissionsController::class, 'store']);
        //    Route::delete('settings/store-users/{id}', [PlansAndPermissionsController::class, 'destroy']);

        Route::resource('settings/store-locations', StoreLocationController::class);
    });
});

Route::get('check-migrations', function() {
   return response()->json([
       'tables' => \Illuminate\Support\Facades\DB::table('migrations')->get()
   ]);
});



