<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use App\Models\Store;
use App\Models\StoreDomain;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Auth;
use Browser;
use App\Models\StoreEngagement;
use App\Models\StoreEngagementPage;

class StoreInit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $protectedUrls = [
            'www',
            'seth',
            'me'
        ];


        if($request->token && !Auth::check()) {
            $isTest = false;
            if($request->is_test) {
                $isTest = true;
            }
            if($customer = Customer::loginUsingToken($request->token, $isTest)) {
                //Customer is logged in
            }else{
                abort(404);
            }
        }

        $url = URL::to('/');
        $storeDomain = StoreDomain::with('store')->where('name', $url)->first();

        if(null !== $storeDomain) {
            $store = $storeDomain->store;
            session()->put('store_id', $storeDomain->store->id);
            $data = StoreEngagement::fields($request->ip(), $storeDomain->store->id);

            if ($request->session()->has('store_engagement_id')) {
                    $store_engagement_id = session('store_engagement_id');
                    $data_pages = [
                        'store_engagement_id' => $store_engagement_id,
                        'page_url' => $request->path(),
                        'query_params' => json_encode($request->all())
                    ];
                    StoreEngagementPage::createOrUpdate($data_pages);
                }else{
                    $store_engagement = StoreEngagement::createOrUpdate($data, null);
                    if (null !== $store_engagement) {
                        session(['store_engagement_id' => $store_engagement->id]);
                        $data_pages = [
                            'store_engagement_id' => $store_engagement->id,
                            'page_url' => $request->path(),
                            'query_params' => json_encode($request->all())
                        ];
                        StoreEngagementPage::createOrUpdate($data_pages);
                    }
                }

        }else{
            abort(404);
        }

        return $next($request);
    }
}
