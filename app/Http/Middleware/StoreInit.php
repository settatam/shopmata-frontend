<?php

namespace App\Http\Middleware;

use App\Models\Store;
use App\Models\StoreDomain;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

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
        if(env('APP_ENV') !== 'development') {

            Request::macro('subdomain', function () {
                return current(explode('.', $this->getHost()));
            });

            if($subdomain = $request->subdomain()) {
                if(in_array($subdomain, $protectedUrls)) return $next($request);
                $storeDomain = StoreDomain::where('name', $subdomain)->where('is_active', 1)->first();
                if(null !== $storeDomain) {
                    session()->put('store_id', $storeDomain->store_id);
                }else{
                    abort(404);
                }
            }
        }
        return $next($request);
    }
}
