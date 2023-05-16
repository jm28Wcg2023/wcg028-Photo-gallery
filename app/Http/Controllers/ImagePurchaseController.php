<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Auth;
use App\Models\UserImage;
use App\Models\Wallet;
use App\Models\TransactionHistory;
use RealRashid\SweetAlert\Facades\Alert;

class ImagePurchaseController extends Controller
{
    //
    public function purchaseImage($id){
        //get Image Id
        $image = Image::findOrFail($id);

        //get User Id
        $user = Auth::user()->id;

        //Get the image Coin from image id
        $image_coin = $image->coin;

        //get the wallet coin from the user id
        $wallet = Wallet::where('user_id',$user)->select('wallet_coin')->first();
        $wallet_id = Wallet::where('user_id',$user)->select('id')->first();
        $wallet_coin = $wallet->wallet_coin;

        // dd($image->id);
        //checks the user has coins if "true" goes inside else return with error
        if($wallet_coin >= $image_coin){
            UserImage::create([
                'user_id' => $user,
                'image_id' => $image->id,
            ]);

            $remain_coin = $wallet_coin - $image_coin;

            // $change_owner = $image->user
            Image::where('id',$image->id)->update(['user_id' => $user]);
            Wallet::where('user_id', $user)->update(['wallet_coin' => $remain_coin]);

            TransactionHistory::create([
                'wallet_id' => $wallet_id->id,
                'transaction_type'=> 'debit',
                'transaction_amount' => $image_coin,
                'description' => 'IMAGE PURCHASE ID:'.$image->id .' At: '.date('Y-m-d H:i:s'),
            ]);
            //Image Owner Buy and Add transaction
            $image_owner_wallet = Wallet::where('user_id',$image->user_id)->select('wallet_coin')->first();
            $owner_wallet_coin = $image_owner_wallet->wallet_coin;

            $image_owner_wallet_id = Wallet::where('user_id',$image->user_id)->select('id')->first();

            $update_coin = $owner_wallet_coin + $image->coin;

            Wallet::where('user_id', $image->user_id)->update(['wallet_coin' => $update_coin]);

            TransactionHistory::create([
                'wallet_id' => $image_owner_wallet_id->id,
                'transaction_type'=> 'credit',
                'transaction_amount' => $image->coin,
                'description' => 'MARKET IMAGE PURCHASE ID:'.$image->id .' At: '.date('Y-m-d H:i:s'),
            ]);

        Alert::success('Success', 'You have Purchased Image');

        }else{
            Alert::warning('Low Coins', 'Wallet has Low Balance');
            return redirect()->route('market');
        }
        return redirect()->route('market');
    }

    //this check if user is not login it will give message
    public function plzLogin(){
        if(!Auth::check()){
            Alert::error('Failed', 'Please Login');
            return back();
        }
    }
}
