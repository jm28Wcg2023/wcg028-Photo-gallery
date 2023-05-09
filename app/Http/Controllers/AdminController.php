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
    //
    // public function view(){
    //     return view('admin');
    // }

    // public function index(){

    //     $data = User::where('role',0)->get();
    //     return view('admin',compact('data'));

    // }

    //View the Admin Dashboard
    public function AdminView(){
        return view('temp.admin.admin');
    }

    //View the Present User-List in the Admin view
    public function AdminUserListView(){
        // $user = User::with('user_image')->where('role',0)->get();

        $users = User::where('role',0)
                            ->withCount('image')
                            ->withCount('user_image')
                            ->with('wallet')
                            ->get()->toArray();

        return view('temp.admin.userlist',compact('users'));
    }

    //View the Present Images-List in the Admin view
    public function AdminImageListView(){
        return view('temp.admin.imagelist');
    }

    //Edit Image Form from Admin
    public function AdminEditImage($id){

        $imageData = Image::find($id);
        // return view('student.edit',compact('student'));
        return view('temp.admin.admineditimage',compact('imageData'));
    }

    //Update Image from Admin
    public function AdminUpdateImage(Request $request,$id){

        $imageData = Image::find($id);
        $imageData->name = $request->input('name');
        $imageData->description = $request->input('description');
        $imageData->coin = $request->input('coin');

        $imageData->update();

        // return view('student.edit',compact('student'));
        // return view('temp.admin.imagelist',compact('imageData'));
        return redirect()->route('imagelist')->with('success', 'Images uploaded successfully.');
    }


    // public function addUser(Request $request){

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'phone' => 'required|regex:/^\+[1-9]{1}[0-9]{3,14}$/|min:10',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);


    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'password' => Hash::make($request->password),
    //         'affiliation_link' => Str::random(12),
    //     ]);
    //     $welcome_bonus = Bonus::where('bonus_name','welcome_bonus')->select('coins')->first();

    //     //new 5 coins added in the new user
    //     $wallet_coins =0;
    //     Wallet::create([
    //         'wallet_coin' => $wallet_coins + $welcome_bonus->coins,
    //         'user_id' => $user->id,
    //     ]);

    //     //new user welcome bonus transaction.
    //     $wallet = Wallet::where('user_id',$user->id)->select('id')->first();

    //     TransactionHistory::create([
    //         'wallet_id' => $wallet->id,
    //         'transaction_type'=> 'credit',
    //         'transaction_amount' => $welcome_bonus->coins,
    //         'description' => 'WELCOME BONUS'.' At: '.date('Y-m-d H:i:s'),
    //     ]);
    //     // Alert::success('Success', 'You\'ve Successfully Add New User');

    //     // if ($validator->passes()) {

    //     //     return response()->json(['success'=>'Added new records.']);

    //     // }
    //     return response()->json(['success'=>'Got Simple Ajax Request.']);
    // }

    public function deleteUser($id){
        $data = User::find($id);

        // Alert::question('Delete User', 'User Deleted Successfully');

        $data->delete();
        return response()->json(array('success' => true));
        // return redirect()->back();
    }

    public function editUserView($id){

        $userData = User::find($id);

        return view('temp.admin.edituserdetails',compact('userData'));

    }


    public function updateUser(UpdateUserRequest $request, $id){

        $userData = User::find($id);
        $userData->name = $request->input('name');
        $userData->email = $request->input('email');
        $userData->phone = $request->input('phone');

        $userData->update();

        Alert::success('Success', 'You\'ve Data updated Successfully');
        return redirect()->route('userlist');
    }
}
