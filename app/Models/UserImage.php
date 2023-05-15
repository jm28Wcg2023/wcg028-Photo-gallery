<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Traits\Uuids;


class UserImage extends Model
{
    use HasFactory;

    protected $table = 'user_image';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'image_id',
    ];


}
