<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Scopes\StoreScope;
use Illuminate\Support\Str;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',
    						'name',
    						'slug',
    						'name',
    						'account_email',
    						'customer_email',
    						'business_name',
    						'address',
    						'address2',
    						'city',
    						'state',
    						'country_id',
                            'state_id',
    						'timezone_id',
    						'unit_id',
    						'default_weight_unit_id',
    						'currency_id',
    						'theme_id',
    						'is_active',
    						'meta_description',
    						'meta_title',
    						'phone',
    						'zip',
    						'store_domain',
    						'industry_id',
    						'order_id_suffix',
    						'order_id_prefix',
                            'allow_guest_checkout',
                            'login_wall',
                            'enable_store_pickup',
                            'enable_pay_on_delivery',
                            'step',
                            'sales_method_id',
                            'has_website'
    					];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new StoreScope);
    // }

    protected $appends = [
        'base_url',
    ];

    public static function store()
    {
        $userId = Auth::user()->id;
        return static::where(['user_id' => $userId])
            ->get();
    }

    public function domains() {
    	return $this->hasMany(StoreDomain::class, 'store_id', 'id')->where('is_active', 1);
    }

    public function payment_gateways() {
        return $this->hasMany(StorePaymentGateway::class, 'store_id', 'id')->where('is_active', 1);
    }

    public function theme() {
        return $this->belongsTo(Theme::class, 'theme_id', 'id');
    }

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function weight() {
        return $this->belongsTo(Unit::class, 'default_weight_unit_id', 'id');
    }

    public function has_product() {
        return $this->hasOne(Product::class, 'store_id', 'id');
    }

    public function unfulfilled_orders() {
        return $this->hasMany(Order::class, 'store_id', 'id');
    }

    public function makeNew() {
        //timezone_id,
        //currency_id
        //default_unit
        //store_plan_id,
        //payment_gateway_id
    }


    public function createNotifications() {

    }

    public function createTheme() {

    }

    public function generateSlug() {

        $slug = Str::slug($this->name);
        $slug_count  = $this->where('name', $this->name)->count();

        if ($slug_count >= 1) {
            $slug .= '-';
            $slug .= $slug_count;
        }
        return $slug;
    }

    public function getDashBoardNotifications() {
        $dashboard_notifications = [];
            if(!count($this->domains)) {
                $dashboard_notifications[] = [
                    'icon'=>'ShoppingBagIcon',
                    'title'=>'Domain',
                    'message'=>'Customize Your Store with your domain name',
                    'link'=>'store/domains'
                ];
            }

            if(!$this->has_product) {
                $dashboard_notifications[] = [
                    'icon'=>'ShoppingBagIcon',
                    'title'=>'Add your first Product',
                    'message'=>"You haven't add a product yet. Click here to add your first product",
                    'link'=>'products/create'
                ];
            }

            if(count($this->unfulfilled_orders)) {
                $dashboard_notifications[] = [
                    'icon'=>'ShoppingBagIcon',
                    'title'=>'Pending Orders',
                    'message'=>'You have unfulfilled orders',
                    'link'=>'/orders?pending=true'
                ];
            }

            if(!$this->theme || $this->theme->id == 1) {
                $dashboard_notifications[] = [
                    'icon'=>'ShoppingBagIcon',
                    'title'=>'Customize your store with a theme',
                    'message'=>'Choose one of our themes to customize your website',
                    'link'=>'online-store/themes'
                ];
            }

        return $dashboard_notifications;
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function shippingAddress() {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function pages() {
        return $this->hasMany(StorePage::class);
    }

    public function transactionStatuses() {
        return $this->hasMany(Status::class);
    }

    public function navLists(){
        return $this->hasMany(Navigation::class, 'store_id', 'id');
    }

    public function getNavigationLists() {
        return Navigation::with('items')->where('store_id', $this->id)->get();
    }

    public function getThemeFiles() {

    }

    public function getThemeFile() {

    }


    /**
     * @param $name
     * @param $data An array of objects. array contains transactions, transaction, product, collections, customer
     * @return string
     */
    public function pageContent($name, $data=[], $type='page') {

        $page = $this->pages()->where('name', $name)->first();
        $pageContent = '';

        $content = '<p> This page could not be found!</p>';
        $template = '';

        if($type == 'page') {
            $page = $this->pages()->where('name', $name)->first();
            if(null !== $page) {
                if($page->content) $data['content_for_page'] = $page->content;
            }
            $template = $page->template->content;
        }else if($type == 'template') {
            $page = ThemeFile::query()->where('title', $name.'.twig')->where('store_id', $this->id)->first();
            $template = $page->content;
        }

        $pageTemplate = '';

        if(null !== $page) {
            $pageTemplate = html_entity_decode(ThemeFile::generateParsedContent($template, $data));
        }else{
            $pageTemplate = '<p> This page could not be found!</p>';
        }

        $theme = $this->theme->files()->where('title', 'theme.twig')->first()->content;

        if($pageTemplate) {
            $data['content_for_page'] =  html_entity_decode(ThemeFile::generateParsedContent($pageTemplate, $data));
        }

        if($theme) {
            $pageContent = html_entity_decode(ThemeFile::generateParsedContent($theme, $data));
        }

        return $pageContent;

    }

    public function getBaseUrlAttribute() {
        return sprintf('https://%s.%s',
            $this->slug,
            env('APP_URL')
        );
    }


    public function addUpdateStore($input, $store = null) {
        if (!$store) {
            $store  = new static;            
        }

        $store->create($input);
        return $store;
    }
}
