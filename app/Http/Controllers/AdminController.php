<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Image;
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
        return view('temp.admin.admin');
    }

    //View the Present User-List in the Admin view
    public function adminUserListView(){
        $users = User::where('role',0)
                            ->withCount('image')
                            ->withCount('user_image')
                            ->with('wallet')
                            ->get()->toArray();

        return view('temp.admin.userlist',compact('users'));
    }

    //View the Present Images-List in the Admin view
    public function adminImageListView(){
        return view('temp.admin.imagelist');
    }

    //Edit Image Form from Admin
    public function adminEditImage($id){

        $imageData = Image::find($id);
        return view('temp.admin.admineditimage',compact('imageData'));
    }

    public function deleteUser($id){
        $data = User::find($id);

        $data->delete();
        return response()->json(array('success' => true));
    }

    public function editUserView($id){

        $userData = User::find($id);

        return view('temp.admin.edituserdetails',compact('userData'));

    }


    public function updateUser(UpdateUserRequest $request, $id){

        $userData = User::find($id);
        if ($userData) {
            $userData->update($request->all());
        }

        Alert::success('Success', 'You\'ve updated User Data Successfully');
        return redirect()->route('userlist');
    }
}
