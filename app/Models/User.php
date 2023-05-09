<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'referred_by',
        'affiliation_link',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //users table hasMany Relation  with image table.
    public function image(){
        return $this->hasMany(Image::class);
    }

    //user_image table belongsToMany Relation  with users table.
    public function user_image(){
        return $this->belongsToMany(Image::class,'user_image');
    }

    //users table hasOne Relation  with wallet table.
    public function wallet(){
        return $this->hasOne(Wallet::class);
    }

    //users table hasManyThrough Relation  with transaction_histories table.
    public function transaction_histories(){
        return $this->hasManyThrough(TransactionHistory::class,Wallet::class)->orderBy('id', 'desc');
    }
}
