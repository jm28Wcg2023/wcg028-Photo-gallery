<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
// use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login ControllerYou are logged in!
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(LoginRequest $request){
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        $credentials = $request->validated();
        if(Auth::attempt($credentials)){
            $user_role = Auth::user()->role;
            switch ($user_role){
                case 1:
                    return redirect('/admin');
                    break;
                case 0:
                    return redirect('/user');
                    break;
                default:
                    Auth::logout();
                    return redirect('/login');
            }
        }else{
            return redirect('/login')->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }
}
