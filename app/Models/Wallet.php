<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
                            'wallet_coin',
                            'user_id',
                          ];

    //user table belongTo Relation  with wallet table.
    public function user(){
        return $this->belongsTo(User::class);
    }

    //wallet table hasMany Relation  with transaction_histories table.
    public function transaction_histories(){
        return $this->hasMany(Wallet::class);
    }
}
