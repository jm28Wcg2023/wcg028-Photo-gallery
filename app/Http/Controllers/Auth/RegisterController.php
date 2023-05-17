<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Wallet;
use App\Models\Bonus;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Mail\ReferralEmail;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    //Validating the data has been Provided
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'phone' => ['required','regex:/^\+[1-9]{1}[0-9]{3,14}$/', 'min:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // create user
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'referred_by' => $data['referred_by'] ?? '',
            'affiliation_link' => Str::random(12),
        ]);

        $this->processWelcomeBonus($user);

        if ($user->referred_by == '') {
            Mail::to($user->email)->send(new WelcomeEmail($user->name, $user->email));
        }

        if ($user->referred_by) {
            $this->processReferralBonus($user);
        }

        return $user;
    }

    //welcome user Logic
    protected function processWelcomeBonus(User $user)
    {
        $welcomeBonus = Bonus::where('bonus_name', 'welcome_bonus')->select('coins')->first();
        $walletCoins = 0;

        $wallet = Wallet::create([
            'wallet_coin' => $walletCoins + $welcomeBonus->coins,
            'user_id' => $user->id,
        ]);

        //Helper Function
        createTransaction($wallet->id,'credit',$welcomeBonus->coins,'WELCOME BONUS' . ' At: ' . date('Y-m-d H:i:s'));
    }

    //Referal user Logic
    protected function processReferralBonus(User $user)
    {
        $referralUser = User::where('affiliation_link', $user->referred_by)->first();
        $referralBonus = Bonus::where('bonus_name', 'referral_bonus')->select('coins')->first();
        $referralWallet = Wallet::where('user_id', $referralUser->id)->select('id')->first();
        $referralUserMaxReferralCount = User::where('affiliation_link', $user->referred_by)->select('max_referral')->first();

        $referralUserWalletCoins = $referralWallet->wallet_coin + $referralBonus->coins;
        Wallet::where('user_id', $referralUser->id)->update(['wallet_coin' => $referralUserWalletCoins]);

        if ($referralUserMaxReferralCount->max_referral < 10) {
            $maxReferralCount = $referralUserMaxReferralCount->max_referral + 1;
            User::where('id', $referralUser->id)->update(['max_referral' => $maxReferralCount]);

            //Helper Function
            createTransaction($referralWallet->id,'credit',$referralBonus->coins,'REFERRAL BONUS' . ' At: ' . date('Y-m-d H:i:s'));
        }

        Mail::to($user->email)->send(new ReferralEmail($user));
    }

    public function referralRegister(Request $request){
        if(isset($request->ref)){
            $referral_code = $request->ref;
            $userData = User::where('affiliation_link',$referral_code)->get();

            if(count($userData) > 0){
                Log::info('New User Come with Referral User Code: '.$referral_code );
                return view('auth.referral-register',compact('referral_code'));
            }else{
                Log::warning('Invalid Referral Code/Referral User is not Present: '.$referral_code );
                return view('404');
            }
        }else {
            return redirect()->route('login');
        }
    }

}
