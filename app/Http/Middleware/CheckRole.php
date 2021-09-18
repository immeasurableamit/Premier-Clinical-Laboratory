<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$role)
    {

        if(Session::get('role') == $role){
            return $next($request);
        }
        // return $role;
        switch ($role) {
                case User::ADMIN:
                    return redirect()->route('admin.site.dash')->withErrors('Not Allowed');
                    break;
                    case User::SITEOWNER:
                        return redirect()->route('admin.dash')->withErrors('Not Allowed');
                        break;
                default:
                Session::flush();
                    return redirect()->route('login.view')->withInputs()->withErrors('Invalid Request');
                break;
        }
    }
}
