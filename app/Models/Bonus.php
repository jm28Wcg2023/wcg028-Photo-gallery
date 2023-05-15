<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;


class Bonus extends Model
{
    use HasFactory, Uuids;

    public $timestamps = false;

}
