<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;
use Auth;
class ImageViewController extends Controller
{
    //
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
