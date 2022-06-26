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
            if($customer = Customer::loginUsingToken($request->token)) {
                //Customer is logged in
            }else{
                abort(404);
            }
        }

        //if(env('APP_ENV') !== 'development') {

            $url = URL::to('/');
            $storeDomain = StoreDomain::with('store')->where('name', $url)->first();

            if(null !== $storeDomain) {
                $store = $storeDomain->store;
                session()->put('store_id', $storeDomain->store->id);
            }else{
                abort(404);
            }

//            Request::macro('subdomain', function () {
//                return current(explode('.', $this->getHost()));
//            });

//            if($subdomain = $request->subdomain()) {
//                if(in_array($subdomain, $protectedUrls)) return $next($request);
//                $storeDomain = Store::where('slug', $subdomain)->first();
//                if(null !== $storeDomain) {
//                    session()->put('store_id', $storeDomain->id);
//                }else{
//                  abort(404);
//                }
//            }
        //}
        return $next($request);
    }
}
