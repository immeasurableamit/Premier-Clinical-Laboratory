<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Session::has('email')){
            return $next($request);
        }
        // return Session::has('email');
        return redirect()->route('login.view')->withErrors('Please Login In Application');

    }
}
