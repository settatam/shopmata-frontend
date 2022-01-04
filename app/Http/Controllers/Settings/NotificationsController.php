<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Currency;
use App\Models\GiftCard;
use App\Models\Login;
use App\Models\PaymentGateway;
use App\Models\Settings;
use App\Models\ShippingProfile;
use App\Models\Store;
use App\Models\StoreGroup;
use App\Models\StoreIndustry;
use App\Models\StoreNotification;
use App\Models\StorePaymentGateway;
use App\Models\StoreUser;
use App\Models\Timezone;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpException;


class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $notifications_data = StoreNotification::with('category')->get();
        // \Log::info("Notification Data". print_r($notifications, true));

        $notifications = [
            'orders' => array_filter($notifications_data->all(), function ($el) {
                return $el['store_notification_category_id'] === 1;
            }),

            'shippings' => array_filter($notifications_data->all(), function ($el) {
                return $el['store_notification_category_id'] === 2;
            }),

            'deliveries' => array_filter($notifications_data->all(), function ($el) {
                return $el['store_notification_category_id'] === 3;
            }),

            'pickups' => array_filter($notifications_data->all(), function ($el) {
                return $el['store_notification_category_id'] === 4;
            }),

            'customers' => array_filter($notifications_data->all(), function ($el) {
                return $el['store_notification_category_id'] === 5;
            }),

            'marketings' => array_filter($notifications_data->all(), function ($el) {
                return $el['store_notification_category_id'] === 6;
            }),

            'returns' => array_filter($notifications_data->all(), function ($el) {
                return $el['store_notification_category_id'] === 7;
            }),
        ];

        return Inertia::render('Settings/Notifications/Index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $store_notification = StoreNotification::find($id);
        return Inertia::render('Settings/Notifications/OrderConfirmation',compact('store_notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
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

    
}
