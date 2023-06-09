<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Traits\Uuids;



class Image extends Model
{
    use HasFactory,SoftDeletes,Notifiable, Uuids;

    protected $fillable = [
                            'name',
                            'description',
                            'coin',
                            'user_id',
                            'image_path'
                        ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function user_image(){
        return $this->belongsToMany(Image::class,'user_image');
    }

}
