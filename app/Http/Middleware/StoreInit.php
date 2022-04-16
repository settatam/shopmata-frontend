<?php

namespace App\Http\Middleware;

use App\Models\Store;
use App\Models\StoreDomain;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
//        dd(session()->get('store_id'));
//        $request->session()->forget('store_id');
        if(env('APP_ENV') !== 'development') {
            //Get
//            if($request->path() == 'login' || $request->path() == 'register') {
//                return $next($request);
//            }
           $url = URL::to('/');
           //if(!session()->has('store_id')) {
               $storeDomain = StoreDomain::where('name', 'http://127.0.0.1:8000')->where('is_active', 1)->first();
               if(null !== $storeDomain) {
                   session()->put('store_id', $storeDomain->store_id);
               }
           //}
        }
        return $next($request);
    }
}
