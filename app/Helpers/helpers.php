<?php
use App\Models\TransactionHistory;
use App\Models\Wallet;
use App\Models\Bonus;

/**
 * Write code on Transaction entry
 *
 * @return response()
 */
if (! function_exists('createTransaction')) {
    function createTransaction($walletId,$type, $imageCoin, $description)
    {
        return  TransactionHistory::create([
                    'wallet_id' => $walletId,
                    'transaction_type'=> $type,
                    'transaction_amount' => $imageCoin,
                    'description' => $description,
                ]);

    }
}

/**
 * Write code on Image Create Transaction entry
 *
 * @return response()
 */
if (! function_exists('createImage')) {
    function createImage()
    {
        $user = Auth::user()->id;

        $wallet = Wallet::where('user_id','=',$user)->first();

        //get the image_upload_bonus value from Database
        $imageUploadBonus = Bonus::where('bonus_name','image_upload_bonus')->select('coins')->first();


        $coin = $wallet->wallet_coin + $imageUploadBonus->coins;

        updateWalletCoin($user, $coin);

        //helper Function
        createTransaction($wallet->id,'credit',$imageUploadBonus->coins,'IMAGE ADD BONUS'.' At: '.date('Y-m-d H:i:s'));

        Log::info('User : '.Auth::user()->email.' has uploaded image at'.date('Y-m-d H:i:s'));
    }
}
/**
 * Write code on Wallet Coin Update
 *
 * @return response()
 */
if (! function_exists('updateWalletCoin')) {
    function updateWalletCoin($user, $coin)
    {
        return Wallet::where('user_id', $user)->update(['wallet_coin' => $coin]);
    }
}




