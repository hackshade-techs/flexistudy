<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;

class CheckCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // check if no cookie is attached to the incoming request and if it has a ref id, set the cookie before moving on.
        if( !$request->hasCookie('tutorpro_affid') && $request->query('ref') ) {
            return redirect($request->fullUrl())->withCookie(cookie('tutorpro_affid', $request->query('ref'), config('settings.affiliate_cookie_lifetime')));
        }
        return $next($request);
    }
}
