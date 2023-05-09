<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
// use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
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
            if(!Auth::check()){
                return redirect('/login');
            }
            $user = Auth::user();
            if($user->role==1){
                return $next($request);
            }
            if($user->role==0){
                return redirect('/user');
            }
            // return $next($request);
        }


    // public function handle(Request $request, Closure $next)
    // {

        // if (Auth::check()) {
        //     if (Auth::user()->role == '1') { // if the current role is Administrator
        //         return $next($request);
        //     }
        // }
        // abort(403, "Cannot access to restricted page");

        //-------------------------
        // if( Auth::check() )
        // {
        //     $user = Auth::user();

        //     // if user is not admin take him to his dashboard
        //     if ( $user->hasRole('user') ) {
        //         return redirect(route('user'));
        //     }

        //     // allow admin to proceed with request
        //     else if ( $user->hasRole('admin') ) {
        //         return $next($request);
        //     }
        // }

        // abort(403,"Cannot access to restricted page");  // permission denied error

        //   if (Auth::user()->role == '1'){
        //     return $next($request);
        //   } else {
        //     return redirect('/home');
        //   }
        // return $next($request);
    // }
}
