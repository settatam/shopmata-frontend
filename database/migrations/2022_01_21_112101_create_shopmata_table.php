<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateShopmataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accept_marketings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('accept_marketing')->default(false);
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            $table->boolean('is_super')->default(false);
            $table->integer('store_id');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('analytics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('browser', 191)->nullable();
            $table->string('browser_version', 191)->nullable();
            $table->string('platform', 191)->nullable();
            $table->string('platform_version', 191)->nullable();
            $table->string('device', 191)->nullable();
            $table->string('url', 191)->nullable();
            $table->string('page', 191)->nullable();
            $table->string('operating_system', 191)->nullable();
            $table->string('user_agent', 191)->nullable();
            $table->boolean('is_bot')->nullable();
            $table->boolean('is_bounce')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('referrer', 200)->nullable();
            $table->boolean('is_desktop')->nullable();
            $table->boolean('is_mobile')->nullable();
            $table->string('session_id', 45)->nullable();
            $table->integer('store_id')->nullable();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->integer('store_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('page_title', 191)->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title', 191)->nullable();
            $table->string('meta_description', 191)->nullable();
            $table->string('meta_keyword', 191)->nullable();
            $table->tinyInteger('sort_order')->nullable();
            $table->string('slug', 191);
        });

        Schema::create('cart_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku', 191);
            $table->integer('cart_id');
            $table->decimal('price', 12)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('quantity')->nullable();
            $table->string('tracking_number', 191)->nullable();
            $table->string('shipping_status', 191)->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('shipping_carrier', 50)->nullable();
            $table->string('status', 50)->nullable();
        });

        Schema::create('cart_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('status', 191)->nullable();
            $table->dateTime('expiry')->nullable();
            $table->softDeletes();
            $table->integer('store_id')->default(0);
            $table->timestamps();
            $table->integer('discount_id')->nullable();
            $table->integer('shipping_profile_price_id')->nullable();
            $table->integer('shipping_address_id')->nullable();
            $table->boolean('is_completed')->default(false);
        });

        Schema::create('catalog_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->integer('user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->string('slug', 80)->nullable();
            $table->integer('language_id')->default(1);
            $table->string('description', 191)->nullable();
            $table->string('meta_title', 191)->nullable();
            $table->string('meta_description', 191)->nullable();
            $table->string('meta_keyword', 191)->nullable();
            $table->string('parent_id', 191)->default('0');
            $table->integer('sort_order')->nullable();
            $table->integer('column')->nullable();
            $table->integer('mechant_id');
            $table->integer('merchant_id');
            $table->tinyInteger('level')->default(0);
            $table->integer('store_id');

            $table->unique(['store_id', 'slug']);
        });

        Schema::create('category_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('category_paths', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('path_id');
            $table->integer('level');
            $table->timestamps();
        });

        Schema::create('collection_conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('collection_id');
            $table->string('condition');
            $table->string('value');
            $table->integer('user_id');
            $table->string('product_tag', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('handle');
            $table->string('page_title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('counties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id');
            $table->string('name', 191);
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('iso_code_2', 2)->nullable();
            $table->string('iso_code_3', 3)->nullable();
            $table->text('address_format')->nullable();
            $table->boolean('postcode_required')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->integer('default_time_zone_id')->nullable()->default(0);
            $table->integer('currency_id')->nullable()->default(0);
            $table->integer('unit_id')->nullable()->default(0);
        });

        Schema::create('coupon_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coupon_id');
            $table->integer('category_id');
            $table->timestamps();
        });

        Schema::create('coupon_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coupon_id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->decimal('amount', 15, 4);
            $table->timestamps();
        });

        Schema::create('coupon_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coupon_id');
            $table->integer('product_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id');
            $table->string('name', 128);
            $table->string('code', 20);
            $table->string('type', 1);
            $table->decimal('discount', 15, 4);
            $table->decimal('total_amount', 15, 4);
            $table->boolean('is_shipping');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->integer('uses_total');
            $table->tinyInteger('uses_customer')->default(1);
            $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('credit_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('expiry', 191)->nullable();
            $table->string('stripe_payment_method', 191)->nullable();
            $table->boolean('is_active')->nullable();
            $table->integer('stripe_customer_id')->nullable();
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('code', 3);
            $table->string('symbol_left', 12)->nullable();
            $table->string('symbol_right', 12)->nullable();
            $table->string('decimal_place', 1)->nullable();
            $table->double('15,8');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('custom_product_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->integer('user_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('customer_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('activity', 191);
            $table->timestamps();
        });

        Schema::create('customer_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('customer_payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->integer('payment_method_id');
            $table->timestamps();
            $table->boolean('is_default')->nullable();
            $table->string('status', 191)->nullable();
            $table->boolean('is_deactivated')->nullable();
            $table->string('paypal_email', 70)->nullable();
            $table->string('credit_card_last_4', 4)->nullable();
            $table->string('stripe_payment_method', 45)->nullable();
            $table->string('credit_card_expiry', 45)->nullable();
            $table->string('card_type', 45)->nullable();
        });

        Schema::create('customer_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->integer('user_id');
            $table->integer('sale_id');
            $table->string('request', 191);
            $table->timestamps();
        });

        Schema::create('customer_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 191)->nullable();
            $table->string('last_name', 191)->nullable();
            $table->string('email')->nullable();
            $table->integer('store_id');
            $table->boolean('accepts_marketing');
            $table->boolean('is_active')->default(false);
            $table->string('password', 90);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('notify')->default(false);
            $table->string('city')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('zip')->nullable();
            $table->integer('user_id')->nullable();
        });

        Schema::create('default_index_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->text('components')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });

        Schema::create('default_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('content', 191);
            $table->timestamps();
        });

        Schema::create('designers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->string('active', 45)->nullable();
        });

        Schema::create('discount_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount_id');
            $table->integer('category_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('discount_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->integer('discount_id');
            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('discount_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('discount_id');
            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('discount_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 191);
            $table->integer('discount_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 191);
            $table->string('type', 191);
            $table->boolean('everyone')->nullable();
            $table->boolean('entire_order')->nullable();
            $table->boolean('active')->default(false);
            $table->decimal('discount', 5)->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('code', 191);
            $table->integer('store_id');
        });

        Schema::create('email_marketing_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('double_opt_in')->default(false);
            $table->string('open_tracking')->nullable();
            $table->integer('store_id');
            $table->timestamps();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 191)->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->decimal('amount', 12)->nullable();
            $table->string('currency', 191)->nullable();
            $table->string('status', 191)->nullable();
            $table->integer('merchant_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('discount_id', 191)->nullable();
        });

        Schema::create('item_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 191);
            $table->integer('user_id');
            $table->tinyInteger('rank');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('item_views', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 191);
            $table->integer('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('legal_name_of_business', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id');
            $table->string('name', 191);
            $table->string('slug', 191);
            $table->string('url', 191)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->string('domain', 191)->nullable();
            $table->string('account_email', 191)->nullable();
            $table->string('customer_email', 191)->nullable();
            $table->string('legal_name_of_business', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('city', 191)->nullable();
            $table->string('state', 191)->nullable();
            $table->integer('country_id')->nullable();
            $table->string('standards_and_timezone', 191)->nullable();
            $table->decimal('weight_unit')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('theme_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->text('meta_description')->nullable();
            $table->text('meta_title')->nullable();
            $table->string('address2', 191)->nullable();
            $table->string('default_weight_unit', 25)->nullable();
        });

        Schema::create('logins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('store_id');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from');
            $table->integer('to');
            $table->string('title', 191)->nullable();
            $table->timestamps();
        });

        Schema::create('navigation_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('parent_id')->default(0);
            $table->string('name');
            $table->integer('navigation_id');
            $table->string('link')->nullable();
            $table->tinyInteger('sort_order')->nullable()->default(0);
            $table->string('target', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('navigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->string('name');
            $table->string('handle')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 191)->nullable();
            $table->longText('message')->nullable();
            $table->integer('store_id');
            $table->boolean('is_read');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('oauth_access_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->integer('user_id')->nullable()->index();
            $table->integer('client_id');
            $table->string('name', 191)->nullable();
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->timestamps();
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_auth_codes', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->integer('user_id');
            $table->integer('client_id');
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->index();
            $table->string('name', 191);
            $table->string('secret', 100);
            $table->text('redirect');
            $table->boolean('personal_access_client');
            $table->boolean('password_client');
            $table->boolean('revoked');
            $table->timestamps();
        });

        Schema::create('oauth_personal_access_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->index();
            $table->timestamps();
        });

        Schema::create('oauth_refresh_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('access_token_id', 100)->index();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('open_editor_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theme_file_id');
            $table->integer('user_id');
            $table->integer('store_id');
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('is_open')->nullable()->default(0);
        });

        Schema::create('order_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->string('activity');
            $table->timestamps();
        });

        Schema::create('order_billing_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
            $table->string('paypal_address', 50)->nullable();
            $table->string('venmo_address', 50)->nullable();
            $table->integer('order_id')->nullable();
        });

        Schema::create('order_customer_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('note');
            $table->integer('order_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('order_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->nullable();
            $table->integer('discount_id')->nullable();
            $table->timestamps();
        });

        Schema::create('order_shipping_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('address', 191);
            $table->string('address2', 191)->nullable();
            $table->string('city', 60)->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id');
            $table->string('zip', 10);
            $table->string('phone', 30)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('first_name', 45)->nullable();
            $table->string('last_name', 45)->nullable();
        });

        Schema::create('order_shipping_profile_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_shipping_profile_id');
            $table->double('min_weight', 8, 2)->nullable();
            $table->double('max_weight', 8, 2)->nullable();
            $table->decimal('min_amount', 10)->nullable();
            $table->decimal('max_amount', 10)->nullable();
            $table->string('description', 191)->nullable();
            $table->decimal('price', 10)->default(0);
            $table->timestamps();
        });

        Schema::create('order_shipping_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191)->nullable();
            $table->string('profile', 191)->nullable();
            $table->integer('store_id')->nullable();
        });

        Schema::create('order_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->string('title');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->decimal('total', 10);
            $table->string('status', 191)->nullable();
            $table->integer('store_id');
            $table->integer('payment_gateway_id')->nullable();
            $table->decimal('sales_tax', 10)->nullable();
            $table->decimal('shipping_cost')->nullable();
            $table->decimal('discount_cost')->nullable();
            $table->integer('cart_id');
            $table->decimal('sub_total')->nullable();
            $table->decimal('shipping_weight', 6)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('order_id', 100)->nullable();
            $table->integer('shipping_gateway_id')->nullable();
        });

        Schema::create('page_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->integer('user_id')->nullable();
            $table->string('title', 191)->nullable();
            $table->string('content', 191)->nullable();
            $table->string('status', 191)->nullable();
            $table->string('slug', 191)->nullable();
            $table->timestamps();
            $table->tinyInteger('is_blog')->nullable()->default(0);
            $table->string('featured_image', 180)->nullable();
            $table->integer('theme_template_id')->nullable()->default(0);
            $table->string('seo_title', 180)->nullable();
            $table->text('seo_description')->nullable();
            $table->dateTime('visibility_date')->nullable();
            $table->tinyInteger('is_visible')->nullable()->default(0);
            $table->text('excerpt')->nullable();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email', 191)->index();
            $table->string('token', 191);
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('payment_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('payment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card', 191);
            $table->string('token', 191);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('payment_gateway_user_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('payment_gateway_id');
            $table->string('token', 191);
            $table->string('last_digits', 191)->nullable();
            $table->boolean('is_active');
            $table->boolean('is_default');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->boolean('is_active')->default(false);
            $table->string('logo', 191)->nullable();
            $table->string('description', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('group_id')->nullable()->default(true);
        });

        Schema::create('payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_gateway_id');
            $table->integer('store_id')->nullable();
            $table->timestamps();
            $table->string('secret', 100)->nullable();
            $table->string('key', 100)->nullable();
        });

        Schema::create('payment_systems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 6);
            $table->integer('user_id');
            $table->integer('order_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('payout_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->string('account_number')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('payout_schedule')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('paypal_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payer_id', 191);
            $table->string('email', 191);
            $table->string('given_name', 191);
            $table->string('surname', 191);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('paypal_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('email', 191);
            $table->timestamps();
            $table->string('payer_id', 191);
            $table->string('given_name', 191);
            $table->string('surname', 191);
            $table->softDeletes();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tokenable_type', 191);
            $table->unsignedBigInteger('tokenable_id');
            $table->string('name', 191);
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->index(['tokenable_type', 'tokenable_id']);
        });

        Schema::create('point_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('store_id');
            $table->integer('points');
            $table->integer('order_id')->nullable();
            $table->string('reason', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('sale_id')->nullable();
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 191)->nullable();
            $table->string('attribute', 191)->nullable();
            $table->string('value', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('product_id')->nullable();
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->integer('category_id');
            $table->tinyInteger('level')->default(0);
            $table->timestamps();
            $table->integer('store_id')->nullable();
        });

        Schema::create('product_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 191);
            $table->boolean('active')->default(false);
            $table->decimal('discount', 5)->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url', 191)->nullable();
            $table->tinyInteger('rank')->nullable();
            $table->timestamps();
            $table->integer('product_id')->nullable();
            $table->string('color', 191)->nullable();
            $table->string('sku', 191)->nullable();
            $table->string('thumb', 191)->nullable();
            $table->string('variant_value', 50)->nullable();
            $table->integer('store_id')->nullable()->default(0);
            $table->string('alt')->nullable();
        });

        Schema::create('product_meta_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field', 191);
            $table->string('value', 191);
            $table->string('sku', 191);
            $table->timestamps();
            $table->integer('product_id')->nullable();
        });

        Schema::create('product_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 191);
            $table->integer('store_id');
            $table->integer('user_id');
            $table->string('type', 191)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->string('tag');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('product_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('product_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 90)->nullable();
            $table->text('full_path')->nullable();
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('level')->nullable()->default(0);
            $table->integer('google_field_id')->nullable()->default(0);
            $table->timestamps();
            $table->tinyInteger('is_final')->nullable()->default(0);
        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->string('sku', 191)->nullable();
            $table->decimal('price');
            $table->tinyInteger('quantity')->nullable();
            $table->string('barcode', 191)->nullable();
            $table->string('status', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('sort_order')->default(0);
            $table->boolean('is_active');
        });

        Schema::create('product_views', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 191);
            $table->integer('views');
            $table->integer('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 191)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('category_id')->nullable();
            $table->decimal('weight', 4)->nullable();
            $table->string('weight_unit', 191)->nullable();
            $table->decimal('compare_at_price')->nullable();
            $table->string('currency_code', 191)->nullable();
            $table->integer('store_id');
            $table->string('handle', 170);
            $table->string('upc', 12)->nullable();
            $table->string('ean', 14)->nullable();
            $table->string('jan', 13)->nullable();
            $table->string('isbn', 17)->nullable();
            $table->string('mpn', 64)->nullable();
            $table->string('location', 128)->nullable();
            $table->integer('manufacturer_id')->nullable();
            $table->string('tax_class', 191)->nullable();
            $table->dateTime('date_available');
            $table->decimal('length')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->string('length_class', 20)->nullable();
            $table->tinyInteger('minimum_order')->default(1);
            $table->smallInteger('views')->nullable();
            $table->tinyInteger('sort_order')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('sort_attribute', 50)->nullable();
            $table->boolean('has_variants')->nullable();
            $table->string('country_of_origin', 100)->nullable();
            $table->string('step', 45)->nullable()->default('general');
            $table->tinyInteger('is_published')->nullable()->default(0);
            $table->string('is_draft', 45)->nullable()->default('0');
            $table->text('seo_description')->nullable();
            $table->string('seo_page_title', 45)->nullable();
            $table->tinyInteger('track_quantity')->nullable()->default(0);
            $table->tinyInteger('sell_out_of_stock')->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(0);
            $table->integer('custom_product_type_id')->nullable();
            $table->integer('product_type_id')->nullable();
        });

        Schema::create('quote_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id');
            $table->integer('sell_id');
            $table->string('activity', 191);
            $table->integer('user_id');
            $table->integer('sent_by')->nullable();
            $table->timestamps();
        });

        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('status', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('remittances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->integer('user_id')->nullable();
            $table->decimal('amount');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('request_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('returns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 191);
            $table->integer('user_id');
            $table->integer('store_id');
            $table->string('reason', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('invoice_id');
        });

        Schema::create('sale_item_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('activity', 191);
            $table->integer('sale_item_id')->nullable();
            $table->integer('sale_id')->nullable();
            $table->timestamps();
        });

        Schema::create('sale_item_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_url', 191);
            $table->tinyInteger('sort_order')->nullable();
            $table->timestamps();
            $table->integer('sale_item_id');
        });

        Schema::create('sale_item_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_item_id');
            $table->string('field', 191);
            $table->string('meta_value', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sale_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id');
            $table->string('sku', 191);
            $table->string('status', 191)->nullable();
            $table->dateTime('date_purchased')->nullable();
            $table->decimal('offer', 10);
            $table->timestamps();
            $table->string('category', 191)->nullable();
            $table->string('gender', 191)->nullable();
            $table->integer('category_id')->nullable();
            $table->string('name', 191)->nullable();
            $table->string('condition', 191)->nullable();
            $table->string('brand', 191)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('sale_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quote_id', 191)->nullable();
            $table->string('status', 191)->nullable();
            $table->boolean('external_confirmation')->nullable();
            $table->string('message', 191)->nullable();
            $table->timestamps();
            $table->boolean('is_offer');
            $table->integer('sale_id');
            $table->softDeletes();
        });

        Schema::create('sale_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sell_id');
            $table->decimal('low', 10)->nullable();
            $table->decimal('high', 10)->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sale_payment_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 191);
            $table->integer('payment_method_id');
            $table->string('ach_beneficiary_name', 191)->nullable();
            $table->string('ach_bank_name', 191)->nullable();
            $table->string('ach_account_number', 191)->nullable();
            $table->string('ach_routing_number', 191)->nullable();
            $table->string('shipping_address_id', 191)->nullable();
            $table->string('check_first_name', 191)->nullable();
            $table->string('check_last_name', 191)->nullable();
            $table->string('check_mailing_type', 191)->nullable();
            $table->string('wire_beneficiary', 191)->nullable();
            $table->string('wire_bank_name', 191)->nullable();
            $table->string('wire_bank_street_address', 191)->nullable();
            $table->string('wire_bank_street_address_2', 191)->nullable();
            $table->string('wire_bank_zip', 191)->nullable();
            $table->string('wire_bank_city', 191)->nullable();
            $table->string('wire_bank_state', 191)->nullable();
            $table->string('wire_account_number', 191)->nullable();
            $table->string('wire_routing_number', 191)->nullable();
            $table->string('paypal_email', 191)->nullable();
            $table->boolean('is_default')->nullable();
            $table->timestamps();
            $table->string('check_state', 191)->nullable();
            $table->string('check_zip', 191)->nullable();
            $table->string('check_city', 191)->nullable();
            $table->string('check_address', 191)->nullable();
            $table->string('check_address_2', 191)->nullable();
            $table->string('ach_account_type', 191)->nullable();
            $table->string('wire_account_type', 191)->nullable();
        });

        Schema::create('sale_payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('sale_id');
            $table->integer('sale_payment_address_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sale_tracking_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 191);
            $table->integer('sale_id');
            $table->timestamps();
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('quote_id', 191);
            $table->dateTime('date_purchased')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('store_id');
            $table->string('status', 191)->nullable();
        });

        Schema::create('sales_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('sells', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->string('designer', 191)->nullable();
            $table->string('age', 191)->nullable();
            $table->string('date_code', 191)->nullable();
            $table->string('model', 191)->nullable();
            $table->tinyInteger('OriginalBox')->default(0);
            $table->tinyInteger('DustBag')->default(0);
            $table->tinyInteger('OriginalTag')->default(0);
            $table->tinyInteger('AuthCard')->default(0);
            $table->string('status', 191)->nullable();
            $table->decimal('amount');
            $table->softDeletes();
            $table->string('color', 191)->nullable();
            $table->string('brand', 191)->nullable();
            $table->string('condition', 191)->nullable();
            $table->integer('category_id')->nullable();
            $table->string('category', 191)->nullable();
            $table->string('type', 191)->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('quote_id')->nullable();
        });

        Schema::create('seo_urls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id');
            $table->integer('store_id');
            $table->integer('language_id')->default(1);
            $table->string('query', 191);
            $table->string('keyword', 191)->nullable();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 191)->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location', 191)->nullable();
            $table->boolean('status');
            $table->string('currency', 30)->default('USD');
            $table->string('currency_symbol', 5)->default('$');
            $table->integer('store_id');
            $table->timestamps();
        });

        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname', 191)->nullable();
            $table->string('address', 191);
            $table->string('address2', 191)->nullable();
            $table->string('city', 191);
            $table->string('state', 191)->nullable();
            $table->string('country', 191)->nullable();
            $table->string('phone', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('zip', 191)->nullable();
            $table->integer('user_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->boolean('is_default')->default(false);
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('county_id')->nullable();
        });

        Schema::create('shipping_gateways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('shipping_labels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('store_id')->nullable();
            $table->integer('sale_id')->nullable();
            $table->string('tracking_number', 191)->nullable();
            $table->text('base64_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('shipping_profile_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipping_profile_id');
            $table->double('min_weight', 8, 2)->nullable();
            $table->double('max_weight', 8, 2)->nullable();
            $table->decimal('min_amount', 10)->nullable();
            $table->decimal('max_amount', 10)->nullable();
            $table->timestamps();
            $table->text('description')->nullable();
            $table->decimal('price', 10)->nullable();
        });

        Schema::create('shipping_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->string('profile', 191);
            $table->decimal('max_amount')->default(0);
            $table->timestamps();
            $table->string('name', 191);
        });

        Schema::create('shipping_rate_conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tag');
            $table->string('condition');
            $table->text('description')->nullable();
            $table->string('value')->nullable();
            $table->integer('user_id');
            $table->integer('shipping_rate_id');
            $table->timestamps();
        });

        Schema::create('shipping_rate_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('shipping_rate_id');
            $table->text('description')->nullable();
            $table->decimal('price', 10)->default(0);
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10)->default(0);
            $table->integer('user_id');
            $table->tinyInteger('is_domestic')->nullable()->default(0);
            $table->tinyInteger('is_international')->nullable()->default(0);
            $table->tinyInteger('is_flat')->nullable()->default(0);
            $table->tinyInteger('match_all_condition')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('site_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('social_media_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider', 20);
            $table->integer('store_id');
            $table->string('key', 191)->nullable();
            $table->string('secret', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('social_media_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('social_media_provider_id');
            $table->integer('user_id');
            $table->integer('store_id');
            $table->string('social_id', 191);
            $table->timestamps();
        });

        Schema::create('staff_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('store_id')->index();
            $table->string('type', 191);
            $table->integer('is_active')->default(0);
            $table->integer('is_registered')->default(0);
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 6)->nullable();
            $table->string('name', 191);
            $table->integer('country_id')->nullable();
            $table->timestamps();
            $table->integer('timezone_id')->nullable();
        });

        Schema::create('store_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->boolean('is_active');
            $table->softDeletes();
            $table->timestamps();
            $table->boolean('is_created')->default(false);
            $table->string('type', 20)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('email', 60)->nullable();
        });

        Schema::create('store_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('activity');
            $table->string('model')->nullable();
            $table->integer('activity_id')->nullable();
            $table->timestamps();
        });

        Schema::create('store_actual_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_notification_id');
            $table->integer('store_id');
            $table->string('subject');
            $table->longText('message');
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('store_credit_transcations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id');
            $table->decimal('amount', 10);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('store_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reason', 191)->nullable();
            $table->integer('credit');
            $table->integer('sale_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
            $table->decimal('amount', 10);
            $table->decimal('balance', 10);
            $table->integer('store_id');
        });

        Schema::create('store_domains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->boolean('is_shopmata')->default(false);
            $table->integer('user_id')->nullable();
            $table->string('name', 191);
            $table->string('domain_registrar', 191)->nullable();
            $table->string('region', 191);
            $table->string('languages', 191);
            $table->timestamps();
            $table->boolean('is_secure')->nullable()->default(false);
            $table->boolean('record_is_updated')->nullable()->default(false);
            $table->string('is_active', 45)->nullable()->default('0');
        });

        Schema::create('store_group_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_group_id');
            $table->integer('store_permission_id');
            $table->timestamps();
        });

        Schema::create('store_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->text('description')->nullable();
        });

        Schema::create('store_industries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->timestamps();
        });

        Schema::create('store_invites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('email', 191);
            $table->integer('store_id');
            $table->integer('user_id');
            $table->integer('store_group_id');
            $table->boolean('is_accepted')->default(false);
            $table->string('token', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('store_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->string('address', 191);
            $table->string('address2', 191)->nullable();
            $table->integer('county_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id');
            $table->string('postal_code', 191)->nullable();
            $table->timestamps();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->integer('user_id')->nullable()->default(0);
            $table->string('name', 100)->nullable();
        });

        Schema::create('store_notification_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->timestamps();
        });

        Schema::create('store_notification_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->text('message')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('store_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->integer('store_notification_category_id');
            $table->timestamps();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
        });

        Schema::create('store_page_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('store_page_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->integer('theme_id')->nullable();
            $table->string('handle')->nullable();
            $table->string('section');
            $table->longText('content')->nullable();
            $table->longText('json_content')->nullable();
            $table->integer('theme_file_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('store_payment_gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->integer('payment_gateway_id');
            $table->string('key', 191)->nullable();
            $table->string('secret', 191)->nullable();
            $table->boolean('is_active')->nullable();
            $table->tinyInteger('sort_order')->nullable();
            $table->string('description', 191)->nullable();
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('is_test')->default(true);
            $table->enum('default_gateway', ['0', '1'])->default('0');
        });

        Schema::create('store_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('store_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->decimal('amount', 10);
            $table->string('duration', 191)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('store_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location', 191)->nullable();
            $table->boolean('status');
            $table->string('currency', 30)->default('USD');
            $table->string('currency_symbol', 5)->default('$');
            $table->integer('store_id');
            $table->integer('language_id')->default(1);
            $table->string('account_email', 191)->nullable();
            $table->string('customer_email', 191)->nullable();
            $table->string('street', 191)->nullable();
            $table->string('street2', 191)->nullable();
            $table->string('zip_code', 191)->nullable();
            $table->string('weight_unit', 15)->nullable();
            $table->string('default_weight_unit', 191)->nullable();
            $table->string('time_zone', 191)->nullable();
            $table->string('meta_title', 191)->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('theme_id')->nullable()->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('store_themes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('store_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('theme_id')->nullable();
        });

        Schema::create('store_user_invites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('store_id');
            $table->integer('store_group_id');
            $table->string('token');
            $table->string('email');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('store_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('store_id');
            $table->integer('store_group_id');
            $table->string('status', 12)->nullable()->default('invite sent');
            $table->timestamps();
        });

        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('slug', 191);
            $table->string('url', 191)->nullable();
            $table->string('name', 191)->nullable();
            $table->string('account_email', 191)->nullable();
            $table->string('customer_email', 191)->nullable();
            $table->string('business_name', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('address2', 191)->nullable();
            $table->string('city', 191)->nullable();
            $table->string('state', 191)->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('timezone_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('default_weight_unit_id')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('theme_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->text('meta_description')->nullable();
            $table->text('meta_title')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('phone', 15)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('store_domain', 90)->nullable();
            $table->integer('industry_id')->nullable();
            $table->string('order_id_suffix', 45)->nullable();
            $table->string('order_id_prefix', 45)->nullable();
            $table->tinyInteger('gift_card_should_expire')->nullable()->default(1);
            $table->integer('gift_card_expire_after')->nullable();
            $table->string('gift_card_expiry_duration', 45)->nullable();
            $table->integer('store_plan_id')->nullable()->default(1);
            $table->timestamp('last_payment_date')->nullable();
            $table->timestamp('next_payment_date')->nullable();
            $table->tinyInteger('allow_guest_checkout')->nullable()->default(0);
            $table->tinyInteger('login_wall')->nullable()->default(0);
            $table->integer('payment_system_id')->nullable()->default(1);
            $table->tinyInteger('enable_store_pickup')->nullable()->default(0);
            $table->tinyInteger('enable_pay_on_delivery')->nullable()->default(0);
            $table->tinyInteger('step')->nullable()->default(1);
            $table->integer('state_id')->nullable();
            $table->string('storescol', 45)->nullable();
        });

        Schema::create('stripe_customer_payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stripe_customer_id');
            $table->string('payment_method', 191);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('stripe_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('customer_id', 191);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('credit_card_id');
            $table->string('payment_method', 191);
        });

        Schema::create('stripe_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->decimal('amount', 10);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subcategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->integer('category_id')->nullable();
            $table->string('generic', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('slug', 45)->nullable();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->string('name', 191);
            $table->timestamps();
        });

        Schema::create('tax_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->nullable();
            $table->integer('county_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->decimal('rate', 5);
            $table->timestamps();
        });

        Schema::create('team_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('user_id');
            $table->string('role', 191)->nullable();
            $table->timestamps();

            $table->unique(['team_id', 'user_id']);
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name', 191);
            $table->boolean('personal_team');
            $table->timestamps();
        });

        Schema::create('template_page_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('template_page_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('theme_id');
            $table->longText('html_content');
            $table->longText('json_content');
            $table->timestamps();
        });

        Schema::create('theme_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theme_id');
            $table->string('title', 191);
            $table->longText('content')->nullable();
            $table->string('asset_url', 191)->nullable();
            $table->integer('user_id');
            $table->string('type', 40)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('store_id')->nullable();
            $table->integer('type_id')->nullable()->default(0);
        });

        Schema::create('theme_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theme_id');
            $table->string('image_url', 191);
            $table->string('thumb_url', 191)->nullable();
            $table->tinyInteger('sort_by')->default(0);
            $table->timestamps();
        });

        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable();
            $table->integer('developer_id')->nullable();
            $table->tinyInteger('is_active')->nullable()->default(0);
            $table->string('slug', 180)->nullable();
            $table->string('size', 45)->nullable();
            $table->timestamp('last_update')->nullable();
            $table->tinyInteger('is_documented')->nullable()->default(0);
            $table->tinyInteger('is_responsive')->nullable()->default(0);
            $table->timestamp('approval_date')->nullable();
            $table->integer('approved_by')->nullable();
            $table->string('framework_compatibilty', 180)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('timezones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value', 191);
            $table->tinyInteger('offset');
            $table->boolean('isdst')->default(false);
            $table->string('name', 191);
            $table->text('utc');
            $table->timestamps();
            $table->text('text')->nullable();
        });

        Schema::create('trending_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 191);
            $table->integer('store_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 191);
            $table->string('unit', 191);
            $table->timestamps();
        });

        Schema::create('user_social', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('social_id', 191)->nullable();
            $table->string('service', 191)->nullable();
            $table->timestamps();
        });

        Schema::create('user_store_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 191)->nullable();
            $table->string('email', 191);
            $table->string('password', 191)->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('last_name', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('address_2', 191)->nullable();
            $table->string('city', 191)->nullable();
            $table->string('state', 191)->nullable();
            $table->string('country', 191)->nullable();
            $table->softDeletes();
            $table->string('zip_code', 191)->nullable();
            $table->string('phone_number', 191)->nullable()->unique();
            $table->string('slug', 191)->nullable()->unique();
            $table->string('group', 191)->nullable();
            $table->string('type', 20)->nullable();
            $table->string('token', 191)->nullable();
            $table->boolean('is_guest')->default(false);
            $table->integer('store_id')->nullable();
        });

        Schema::create('web_hooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->string('url', 191);
            $table->string('hook', 191);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('store_id');
            $table->string('sku', 40);
            $table->decimal('amount', 10);
            $table->timestamps();
        });

        Schema::create('withdrawal_account_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->integer('user_id');
            $table->string('bank_name');
            $table->string('account_number')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount', 10);
            $table->integer('store_id');
            $table->integer('user_id');
            $table->string('status')->nullable();
            $table->integer('approved_by')->nullable();
            $table->dateTime('approval_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('withdrawals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount');
            $table->integer('store_id');
            $table->string('status')->nullable();
            $table->string('transcation_identifier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');

        Schema::dropIfExists('withdrawal_requests');

        Schema::dropIfExists('withdrawal_account_details');

        Schema::dropIfExists('wishlists');

        Schema::dropIfExists('web_hooks');

        Schema::dropIfExists('users');

        Schema::dropIfExists('user_store_notifications');

        Schema::dropIfExists('user_social');

        Schema::dropIfExists('units');

        Schema::dropIfExists('trending_items');

        Schema::dropIfExists('timezones');

        Schema::dropIfExists('themes');

        Schema::dropIfExists('theme_images');

        Schema::dropIfExists('theme_files');

        Schema::dropIfExists('template_page_sections');

        Schema::dropIfExists('template_page_contents');

        Schema::dropIfExists('teams');

        Schema::dropIfExists('team_user');

        Schema::dropIfExists('tax_rates');

        Schema::dropIfExists('tags');

        Schema::dropIfExists('subcategories');

        Schema::dropIfExists('stripe_payments');

        Schema::dropIfExists('stripe_customers');

        Schema::dropIfExists('stripe_customer_payment_methods');

        Schema::dropIfExists('stores');

        Schema::dropIfExists('store_users');

        Schema::dropIfExists('store_user_invites');

        Schema::dropIfExists('store_themes');

        Schema::dropIfExists('store_settings');

        Schema::dropIfExists('store_plans');

        Schema::dropIfExists('store_permissions');

        Schema::dropIfExists('store_payment_gateways');

        Schema::dropIfExists('store_page_sections');

        Schema::dropIfExists('store_page_contents');

        Schema::dropIfExists('store_notifications');

        Schema::dropIfExists('store_notification_messages');

        Schema::dropIfExists('store_notification_categories');

        Schema::dropIfExists('store_locations');

        Schema::dropIfExists('store_invites');

        Schema::dropIfExists('store_industries');

        Schema::dropIfExists('store_groups');

        Schema::dropIfExists('store_group_permissions');

        Schema::dropIfExists('store_domains');

        Schema::dropIfExists('store_credits');

        Schema::dropIfExists('store_credit_transcations');

        Schema::dropIfExists('store_actual_notifications');

        Schema::dropIfExists('store_activities');

        Schema::dropIfExists('store_accounts');

        Schema::dropIfExists('states');

        Schema::dropIfExists('staff_accounts');

        Schema::dropIfExists('social_media_users');

        Schema::dropIfExists('social_media_providers');

        Schema::dropIfExists('site_credits');

        Schema::dropIfExists('shipping_rates');

        Schema::dropIfExists('shipping_rate_profiles');

        Schema::dropIfExists('shipping_rate_conditions');

        Schema::dropIfExists('shipping_profiles');

        Schema::dropIfExists('shipping_profile_prices');

        Schema::dropIfExists('shipping_labels');

        Schema::dropIfExists('shipping_gateways');

        Schema::dropIfExists('shipping_addresses');

        Schema::dropIfExists('settings');

        Schema::dropIfExists('sessions');

        Schema::dropIfExists('seo_urls');

        Schema::dropIfExists('sells');

        Schema::dropIfExists('sales_methods');

        Schema::dropIfExists('sales');

        Schema::dropIfExists('sale_tracking_infos');

        Schema::dropIfExists('sale_payment_methods');

        Schema::dropIfExists('sale_payment_addresses');

        Schema::dropIfExists('sale_offers');

        Schema::dropIfExists('sale_messages');

        Schema::dropIfExists('sale_items');

        Schema::dropIfExists('sale_item_metas');

        Schema::dropIfExists('sale_item_images');

        Schema::dropIfExists('sale_item_activities');

        Schema::dropIfExists('returns');

        Schema::dropIfExists('request_logs');

        Schema::dropIfExists('remittances');

        Schema::dropIfExists('quotes');

        Schema::dropIfExists('quote_activities');

        Schema::dropIfExists('products');

        Schema::dropIfExists('product_views');

        Schema::dropIfExists('product_variants');

        Schema::dropIfExists('product_types');

        Schema::dropIfExists('product_tags');

        Schema::dropIfExists('product_options');

        Schema::dropIfExists('product_notifications');

        Schema::dropIfExists('product_meta_fields');

        Schema::dropIfExists('product_images');

        Schema::dropIfExists('product_discounts');

        Schema::dropIfExists('product_categories');

        Schema::dropIfExists('product_attributes');

        Schema::dropIfExists('points');

        Schema::dropIfExists('point_histories');

        Schema::dropIfExists('personal_access_tokens');

        Schema::dropIfExists('paypal_payments');

        Schema::dropIfExists('paypal_customers');

        Schema::dropIfExists('payout_settings');

        Schema::dropIfExists('payments');

        Schema::dropIfExists('payment_systems');

        Schema::dropIfExists('payment_methods');

        Schema::dropIfExists('payment_gateways');

        Schema::dropIfExists('payment_gateway_user_tokens');

        Schema::dropIfExists('payment_details');

        Schema::dropIfExists('payment_customers');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('pages');

        Schema::dropIfExists('page_contents');

        Schema::dropIfExists('orders');

        Schema::dropIfExists('order_tags');

        Schema::dropIfExists('order_shipping_profiles');

        Schema::dropIfExists('order_shipping_profile_prices');

        Schema::dropIfExists('order_shipping_addresses');

        Schema::dropIfExists('order_discounts');

        Schema::dropIfExists('order_customer_notes');

        Schema::dropIfExists('order_billing_addresses');

        Schema::dropIfExists('order_activities');

        Schema::dropIfExists('open_editor_pages');

        Schema::dropIfExists('oauth_refresh_tokens');

        Schema::dropIfExists('oauth_personal_access_clients');

        Schema::dropIfExists('oauth_clients');

        Schema::dropIfExists('oauth_auth_codes');

        Schema::dropIfExists('oauth_access_tokens');

        Schema::dropIfExists('notifications');

        Schema::dropIfExists('navigations');

        Schema::dropIfExists('navigation_lists');

        Schema::dropIfExists('messages');

        Schema::dropIfExists('logins');

        Schema::dropIfExists('legal_name_of_business');

        Schema::dropIfExists('item_views');

        Schema::dropIfExists('item_ratings');

        Schema::dropIfExists('invoices');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('email_marketing_settings');

        Schema::dropIfExists('discounts');

        Schema::dropIfExists('discount_products');

        Schema::dropIfExists('discount_customers');

        Schema::dropIfExists('discount_countries');

        Schema::dropIfExists('discount_categories');

        Schema::dropIfExists('designers');

        Schema::dropIfExists('default_pages');

        Schema::dropIfExists('default_index_sections');

        Schema::dropIfExists('customers');

        Schema::dropIfExists('customer_sales');

        Schema::dropIfExists('customer_requests');

        Schema::dropIfExists('customer_payment_methods');

        Schema::dropIfExists('customer_messages');

        Schema::dropIfExists('customer_activities');

        Schema::dropIfExists('custom_product_types');

        Schema::dropIfExists('currencies');

        Schema::dropIfExists('credit_cards');

        Schema::dropIfExists('coupons');

        Schema::dropIfExists('coupon_products');

        Schema::dropIfExists('coupon_histories');

        Schema::dropIfExists('coupon_categories');

        Schema::dropIfExists('countries');

        Schema::dropIfExists('counties');

        Schema::dropIfExists('collections');

        Schema::dropIfExists('collection_conditions');

        Schema::dropIfExists('category_paths');

        Schema::dropIfExists('category_descriptions');

        Schema::dropIfExists('categories');

        Schema::dropIfExists('catalog_items');

        Schema::dropIfExists('carts');

        Schema::dropIfExists('cart_discounts');

        Schema::dropIfExists('cart_details');

        Schema::dropIfExists('brands');

        Schema::dropIfExists('analytics');

        Schema::dropIfExists('admins');

        Schema::dropIfExists('accept_marketings');
    }
}
