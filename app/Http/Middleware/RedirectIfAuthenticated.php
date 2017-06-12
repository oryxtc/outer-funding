<?php

namespace App\Http\Middleware;

use App\Http\Controllers\PublicController;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $url = $guard ? '/admin':'/home';
            if($url==='/home'){
                return PublicController::apiJson([],'success','你已经登录!');
            }
            return redirect($url);
        }

        return $next($request);
    }
}
