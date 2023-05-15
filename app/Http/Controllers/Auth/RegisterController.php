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

    //This Register the User.
    protected function create(array $data)
    {

        $referred_by = $data['referred_by'] ?? '';

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'referred_by'   => $referred_by,
            'affiliation_link' => Str::random(12),
        ]);

        //get the welcome_bonus value from Database
        $welcome_bonus = Bonus::where('bonus_name','welcome_bonus')->select('coins')->first();

        Alert::success('Success', 'You\'ve Successfully Registered');

        //new 5 coins added in the new user
        $wallet_coins =0;
        Wallet::create([
            'wallet_coin' => $wallet_coins + $welcome_bonus->coins,
            'user_id' => $user->id,
        ]);

        //new user welcome bonus transaction.
        $wallet = Wallet::where('user_id',$user->id)->select('id')->first();

        TransactionHistory::create([
            'wallet_id' => $wallet->id,
            'transaction_type'=> 'credit',
            'transaction_amount' => $welcome_bonus->coins,
            'description' => 'WELCOME BONUS'.' At: '.date('Y-m-d H:i:s'),
        ]);

        if($referred_by == ''){
            // Mail::to($user->email)->send(new WelcomeEmail($user));
            Mail::to($user->email)->send(new WelcomeEmail($data['name'], $data['email']));
        }
        //it check if the user has referral code so do  this.
        if($referred_by){
            //get the id of  user based on referral code
            $referral_user_id = User::where('affiliation_link',$data['referred_by'])->select('id')->first();

            //get the wallet_coin of  user based on referral_user_id
            $referral_user_id_wallet_coin = Wallet::where('user_id',$referral_user_id->id)->select('wallet_coin')->first();

            //get the referral_bonus value from Database
            $referral_bonus = Bonus::where('bonus_name','referral_bonus')->select('coins')->first();

            //get the Current present coin
            $coin = $referral_user_id_wallet_coin->wallet_coin + $referral_bonus->coins;
            //update the wallet coin
            Wallet::where('user_id', $referral_user_id->id)->update(['wallet_coin' => $coin]);
            //get the Wallet Coin
            $referral_wallet = Wallet::select('id')->where('user_id',$referral_user_id->id)->first();

            //get the max referral for the user
            $referral_user_max_referral_count = User::where('affiliation_link',$data['referred_by'])->select('max_referral')->first();
            // dd($referral_user_max_referral_count);


            //check the max_referral is upto 10
            if($referral_user_max_referral_count->max_referral < 10){

                //get the max_referral and  +1 init
                $max_referral_count = $referral_user_max_referral_count->max_referral + 1;

                //update the max_referral for the referral user
                User::where('id', $referral_user_id->id)->update(['max_referral'=> $max_referral_count]);

                TransactionHistory::create([
                    'wallet_id' => $referral_wallet->id,
                    'transaction_type'=> 'credit',
                    'transaction_amount' => $referral_bonus->coins,
                    'description' => 'REFERRAL BONUS'.' At: '.date('Y-m-d H:i:s'),
                ]);

                Mail::to($user->email)->send(new ReferralEmail($user));
            }
        }

        return $user;
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
