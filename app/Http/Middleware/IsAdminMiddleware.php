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
}
