<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
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
use App\Models\StoreNotificationMessage;
use App\Services\EventNotification;

use App\Models\StorePaymentGateway;

use App\Models\StoreUser;
use App\Models\Timezone;
use App\Models\Unit;
use App\Models\User;
use App\Models\EmailMarketingSetting;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\ThemeFile;



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
        $store_id = session('store_id');
        $email_marketing_settings = EmailMarketingSetting::where('store_id', $store_id)->get();

        $notification = [];

        foreach($notifications_data as $data) {
            $notifications[optional($data->category)->name][] = $data;
        }

        return Inertia::render('Settings/Notifications/Index', compact('notifications','email_marketing_settings'));
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
        $email = StoreNotificationMessage::where(['store_notification_id' => $id,'channel' => 'email'])->first();
        $sms   = StoreNotificationMessage::where(['store_notification_id' => $id,'channel' => 'sms'])->first();
        $notification = StoreNotification::with('event_condition')->find($id);

        $statuses  = Status::orderBy('sort_order')->get();

        return Inertia::render('Settings/Notifications/Show',compact('email','notification','sms','statuses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
    
        $data['transaction'] = Transaction::whereHas('customer')->first();
        $data['transactions'] = Transaction::whereHas('customer')->take(5)->get();
        $data['customer'] = $data['transaction']->customer;
        $store_id = session()->get('store_id');
        $data['store'] = Store::find($store_id);
        //get the email template
        $template = ThemeFile::query()->where('title', 'email.twig')->where('store_id', $store_id)->first();
        //get the email content
        $messages = StoreNotificationMessage::with('store_notification')
            ->whereHas('store_notification', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->where('channel', 'email')
//            ->where('store_id', $store_id)
            ->first();

        $data['content_for_email'] = html_entity_decode(ThemeFile::generateParsedContent($messages->message, $data));
        $page = html_entity_decode(ThemeFile::generateParsedContent($template->content, $data));

        return view('pages.index', compact('page'));
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
