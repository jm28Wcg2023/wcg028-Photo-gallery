<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;


class TransactionHistory extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'wallet_id',
        'transaction_type',
        'transaction_amount',
        'description',
    ];

    //transaction_histories table hasOne Relation  with wallet table.
    public function wallet(){

        return $this->belongsTo(Wallet::class);
    }

    //user table hasOne Relation with transaction_histories table.
    public function user(){
        return $this->belongsTo(User::class);
    }
}
