<?php
use App\Models\TransactionHistory;

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
