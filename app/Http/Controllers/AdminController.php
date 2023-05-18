<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Image;
use App\Models\UserImage;
use Illuminate\Support\Str;
use App\Http\Requests\AdminUserCreateRequest;
use App\Http\Requests\UpdateUserRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\Wallet;
use App\Models\Bonus;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //View the Admin Dashboard
    public function adminView(){
        $userCount = User::where('role','0')->count();
        $imageCount = Image::count();
        $purchaseCount = UserImage::count();
        return view('temp.admin.admin', compact('userCount', 'imageCount','purchaseCount'));
    }

    //View the Present Images-List in the Admin view
    public function adminImageListView(){
        return view('temp.admin.imagelist');
    }

}
