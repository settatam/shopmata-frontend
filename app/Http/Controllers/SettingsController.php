<?php

namespace App\Http\Controllers;

// use Auth;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\ShippingRate;
use App\Models\ShippingRateCondition;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Settings::orderBy('id', 'asc')->paginate(50);
        return Inertia::render('Settings/Index', compact('settings'));
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

    public function general()
    {
        $store = Store::find(session('store_id'));
        $countries = Country::all();
        $currencies = Currency::all();
        $units = Unit::all();
        $industries = StoreIndustry::all();
        $timezones = Timezone::all();
        return Inertia::render('Settings/General', compact('store', 'countries', 'currencies', 'units', 'industries', 'timezones'));
    }

    public function permissions()
    {
        $login = Auth::user();
        $groups = StoreGroup::all();
        $storeUsers = StoreUser::with('user')->where('store_id', session()->get('store_id'))->get();
        foreach ($storeUsers as $key => $usr) {
            $storeUsers[$key]->last_login = Login::where('user_id', $usr->user_id)->orderBy('id', 'desc')->first();
        }
        // return session()->get('store_id');
        $login->last_login = Login::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        return Inertia::render('Settings/PlanPermissions', compact('login', 'groups', 'storeUsers'));
    }

    public function shipping()
    {
        return Inertia::render('Settings/ShippingDelivery');
    }

    public function manageLocalDelivery()
    {
        return Inertia::render('Settings/Shipping/Components/ManageLocalDelivery');
    }

    public function manageLocalPickup()
    {
        return Inertia::render('Settings/Components/ManageLocalPickup');
    }

    public function generalShippingRate()
    {
        return Inertia::render('Settings/Shipping/Components/GeneralShippingRate');
    }

    public function shippingProfile()
    {
        $condition_options = ShippingRateCondition::$condition_options;
        $rate_options = ShippingRateCondition::$rate_options;
        $rates = ShippingRate::with('conditions')->orderBy('id', 'desc')->get();
        return Inertia::render('Settings/Shipping/Components/ShippingProfile', compact('rates', 'condition_options', 'rate_options'));
    }

    public function payments()
    {
        $payment_gateways = StorePaymentGateway::all();
        // $gateways = PaymentGateway::where('is_active', 1)->get();
        $gateways = PaymentGateway::all();
        return Inertia::render('Settings/Payments', compact('payment_gateways', 'gateways'));
    }

    public function paymentStore(Request $request)
    {

        #payment_gateway_id

        #key
        #secret if group_id = 1 or 2
        #is_active
        $payment_gateway = PaymentGateway::find($request->payment_gateway_id);
        $input = $request->input();
        $input['store_id'] = $request->session()->get('store_id');

        if (null !== $payment_gateway) {
            if ($payment_gateway->group_id <= 2) {
                $validator = Validator::make($input, [
                    'payment_gateway_id' => ['required', 'integer'],
                    'key' => ['required', 'string'],
                    'secret' => ['required', 'string'],
                ]);
            } else {
                $validator = Validator::make($input, [
                    'payment_gateway_id' => ['required', 'integer'],
                ]);
            }

            if ($store_gateway = StorePaymentGateway::create($input)) {
                Log::info(Auth::id() . 'created a new store payment gateway', $input);
                return response()->json($store_gateway);
            }
        }

        return response()->json('There is a problem with your data', 422);
    }

    public function deletePayment($id)
    {
        $store_gateway = StorePaymentGateway::find($id);
        if($store_gateway === null){
            return response()->json('Gate Way Not Found', 404);
        }
        if ($store_gateway->delete()) {
            Log::info(Auth::id() . 'deleted store payment gateway', $id);
            return response()->json($store_gateway);
        }
        return response()->json('There is a problem with your data', 422);
    }

    public function updateStore(Request $request)
    {
        try {
            $data = $request->all();
            \Log::info("store update request" . print_r($data, true));

            $validator = Validator::make($data, [
                "account_email" => "required|string",
                "address" => "required|string",
                "address2" => "nullable|string",
                "business_name" => "required|string",
                "city" => "required|string",
                "country_id" => "required|numeric",
                "currency_id" => "required|numeric",
                "industry_id" => "required|numeric",
                "customer_email" => "required|string",
                "default_weight_unit_id" => "required|numeric",
                "name" => "required|string",
                "order_id_prefix" => "required|string",
                "order_id_suffix" => "required|string",
                "phone" => "required|string",
                "state" => "required|string",
                "timezone_id" => "required|numeric",
                "unit_id" => "required|numeric",
                "zip" => "required|string",
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

            $store = Store::find(session('store_id'));

            if (null !== $store) {
                if ($store->update($data)) {
                    Log::info(Auth::id() . 'updated the store details for ' . session('store_id'), $data);
                }

                $notification = [
                    "title" => "Store Details Updated",
                    "type" => "success",
                    "message" => "Store Details Updated",
                ];

                return response()->json(['notification' => $notification], 200);
            }
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Update Store Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }

    public function addPaymentOption()
    {
        $countries = Country::all();
        $payment_gateways = PaymentGateway::all();
        return Inertia::render('Settings/Components/AddPaymentOption', compact('payment_gateways', 'countries'));
    }

    public function paymentOptionInfo($gateway_id)
    {
        $gateway = PaymentGateway::find($gateway_id);
        return Inertia::render('Settings/Components/PaymentOptionInfo', compact('gateway'));
    }

    public function savePaymentOption(Request $request)
    {
        try {
            $data = $request->all();
            \Log::info("Save Payment Option Request" . print_r($data, true));

            $validator = Validator::make($data, [
                "gateway_id" => "required|numeric",
                "public_key" => "required|string",
                "secret_key" => "required|string",
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

            $paymentGateway = StorePaymentGateway::firstOrNew(
                [
                    'payment_gateway_id' => $data['gateway_id'],
                    'store_id' => session('store_id'),
                ]
            );

            $paymentGateway->fill([
                'secret' => $data['secret_key'],
                'key' => $data['public_key'],
                'is_active' => 1,
                'created_by' => Auth::id(),
                'is_test' => 0,
            ]);

            if ($paymentGateway->save()) {

                \Log::info(Auth::id() . ' created or updated a payment gateway', $data);

                $notification = [
                    "title" => "Successful",
                    "type" => "success",
                    "message" => "Payment Method Created",
                ];

                return response()->json(['notification' => $notification]);
            } else {
                $notification = [
                    "title" => "Successful",
                    "type" => "failure",
                    "message" => "Could not create payment gateway",
                ];

                return response()->json(['notification' => $notification], 500);
            }
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Save payment option Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "An Exception Occurred Please Try Again",
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }

    public function setDefaultpaymentGateway(Request $request)
    {
        try {
            $data = $request->all();
            \Log::info("Default Payment Option Request" . print_r($data, true));

            $validator = Validator::make($data, [
                "payment_gateway_id" => "required|numeric",
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

            StorePaymentGateway::where('store_id', session('store_id'))
                ->where('default_method', 1)
                ->update(['default_method' => 0]);

            $paymentGateway = StorePaymentGateway::where('store_id', session('store_id'))
                ->where('payment_gateway_id', $data['payment_gateway_id'])->first();

            $paymentGateway->default_method = 1;
            $paymentGateway->save();

            \Log::info('payment gateway Updated' . print_r($paymentGateway));

            $notification = [
                "title" => "Successful",
                "type" => "success",
                "message" => "Payment Method Created",
            ];

            return response()->json(['notification' => $notification]);
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Save payment option Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "An Exception Occurred Please Try Again",
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }

    public function giftCards()
    {
        // $giftCardsSettings = GiftCard::all();
        $store = Store::find(session('store_id'));
        return Inertia::render('Settings/GiftCards', compact('store'));
    }

    public function notifications()
    {
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

        return Inertia::render('Settings/Notifications', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        //
        $groups = StoreGroup::all();
        return Inertia::render('Settings/User', compact('groups'));
    }

    public function createUser(Request $request)
    {
        //
        $user = $request->input();

        $check = User::where('email', $user['email'])->whereHas('store_users', function ($query) {
            $query->where('store_id', session()->get('store_id'));
        })->count();

        if ($check) {
            //This user already exists
            return response()->json('This user already exists', 400);
        } else {
            //Create new user ...
            $user['password'] = Hash::make($user['password']);
            $user['type'] = 'store';
            if ($new_user = User::create($user)) {
                //Create store user
                $store_user = StoreUser::firstOrNew(['user_id' => $new_user->id, 'store_id' => session()->get('store_id')]);
                $store_user->store_group_id = $user['access']['value'];
                $store_user->save();

                //Send Email

            }

            return response()->json('User has been added');
        }
    }

    /**
     * Store a newly created resource in storage.
     *f
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return Redirect::route('settings')->with('success', 'Setting created.');
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
        $setting = Settings::find($id);
        if (is_null($setting)) {
            throw new HttpException(404);
        }
        return Inertia::render('Settings/Update', compact('setting'));
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
        return Redirect::route('settings')->with('success', 'Settings updated successfully.');
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

    public function createGeneralShippingRate(Request $request)
    {
        try {
            // shipping profiles
            // id    store_id    profile    max_amount    created_at    updated_at    name

            // shipping profile prices
            // id    shipping_profile_id    min_weight    max_weight    min_amount    max_amount    created_at    updated_at    description    price
            $data = $request->all();
            \Log::info("Create Shipping profile Request" . print_r($data, true));

            $validator = Validator::make($data, [
                "profile" => "required|string",
                "max_amount" => "required|string",
                "name" => "required|string",
                "min_weight" => "required|numeric",
                "max_weight" => "required|numeric",
                "min_amount" => "required|numeric",
                "max_amount" => "required|numeric",
                "description" => "required|string",
                "price" => "required|numeric",
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

            //prepare shipping data to save in the db
            $shippingProfile = ShippingProfile::create([
                "store_id" => session('store_id'),
                "profile" => $data['profile'],
                "max_amount" => $data['max_amount'],
                "name" => $data['name'],
            ]);

            $shippingProfile->prices()->create([
                "min_weight" => $data["min_weight"],
                "max_weight" => $data["max_weight"],
                "min_amount" => $data["min_amount"],
                "max_amount" => $data["max_amount"],
                "description" => $data["description"],
                "price" => $data["price"],
            ]);

            $notification = [
                "title" => "Successful",
                "type" => "success",
                "message" => "Shipping Profile Created",
            ];

            return response()->json(['notification' => $notification]);
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Create Shipping Profile Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "An Exception Occurred Please Try Again",
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }

    public function createGiftCards(Request $request)
    {
        try {
            // 'store_id', 'expire', 'period', 'duration'
            $data = $request->all();

            $validator = Validator::make($data, [
                "expire" => "required|in:1,2",
                "duration" => "nullable|string|in:years,months,days",
                "period" => "nullable|string",
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

            $updateGiftCard = Store::where('id', session('store_id'))
                ->update([
                    'gift_card_should_expire' => $data['expire'],
                    'gift_card_expire_after' => $data['period'],
                    'gift_card_expiry_duration' => $data['duration']
                ]);

            \Log::info(Auth::id() . "Updated gift cards" . print_r($data, true));

            $notification = [
                "title" => "Successful",
                "type" => "success",
                "message" => "Gift Card Settings Updated",
            ];

            return response()->json(['notification' => $notification]);
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Create Shipping Profile Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "An Exception Occurred Please Try Again",
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }
}
