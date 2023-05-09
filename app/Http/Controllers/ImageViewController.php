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

        //User Purchased Image data in userimagelist view
        $user = Auth::user()->id;
        $data = Image::join('user_image','images.id','=','user_image.image_id')->select('images.*')->where('user_image.user_id',$user)->get()->toArray();

        //User Purchased Image data in userimagelist view in model
        $purchasedImageData = User::where([
                                        ['role',0],
                                        ['id',$user],
                                    ])->with('user_image')->get();

        $userOwnImageList = Image::where('user_id',Auth::user()->id)->latest()->get();

        return view('temp.user.userimagelist',compact('userOwnImageList','purchasedImageData'));

    }


}
