<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Auth;
use App\Models\User;
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
        $userId = Auth::user()->id;

        //Get the image Coin from image id
        $imageCoin = $image->coin;
        $wallet = Wallet::where('user_id',$userId)->first();
        $walletCoin = $wallet->wallet_coin;

        //checks the user has coins if "true" goes inside else return with error
        if($walletCoin >= $imageCoin){

            UserImage::create([
                'user_id' => $userId,
                'image_id' => $image->id,
            ]);

            $remain_coin = $walletCoin - $imageCoin;

            // $change_owner = $image->user
            Image::where('id',$image->id)->update(['user_id' => $userId]);

            updateWalletCoin($userId, $remain_coin);

            //Helper Function
            createTransaction($wallet->id,'debit',$imageCoin,'IMAGE PURCHASE ID:'.$image->id .' At: '.date('Y-m-d H:i:s'));

            $image_owner_wallet = Wallet::where('user_id',$image->user_id)->first();

            $owner_wallet_coin = $image_owner_wallet->wallet_coin;

            $update_coin = $owner_wallet_coin + $image->coin;

            updateWalletCoin($image->user_id, $update_coin);

            createTransaction($image_owner_wallet->id,'credit',$image->coin,'MARKET IMAGE PURCHASE ID:'.$image->id .' At: '.date('Y-m-d H:i:s'));

            Alert::success('Success', 'You have Purchased Image');

        }else{
            Alert::warning('Low Coins', 'Wallet has Low Balance');
            return redirect()->route('market');
        }
        return redirect()->route('market');
    }

    //this check if user is not login it will give message
    public function pleaseLogin(){
        if(!Auth::check()){
            Alert::error('Failed', 'Please Login');
            return back();
        }
    }

    public function userImageList(){

        //User Purchased Image data in userimagelist view in model
        $purchasedImageData = User::where([
                                        ['role',0],
                                        ['id',Auth::user()->id],
                                    ])->with('user_image')->get();

        $userOwnImageList = Image::where('user_id',Auth::user()->id)->latest()->get();

        return view('temp.user.userimagelist',compact('userOwnImageList','purchasedImageData'));

    }
}
