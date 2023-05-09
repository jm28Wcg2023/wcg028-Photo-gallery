<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use DataTables;

class UserController extends Controller
{
    //
    // public function view(){
    //     return view('user');
    // }

    //User Image Upload Form view
    public function uploadImage(){
        return view('temp.user.addimage');
    }

    // pass the data to the user view
    public function UserView(){

        $login_user_id = Auth::user()->id;

        $availableWalletCoin = Wallet::where('user_id',$login_user_id)->with('user')->get()->toArray();

        return view('temp.user.user',compact('availableWalletCoin'));
    }

    // User Wallet view with data
    public function userWallet(){

        $login_user_id = Auth::user()->id;

        $availableWalletCoin = Wallet::where('user_id',$login_user_id)->with('user')->get()->toArray();

        $login_user_transaction_history = User::where('id','=',$login_user_id)->with('transaction_histories')->latest()->get()->toArray();

        return view('temp.user.wallet',compact('availableWalletCoin','login_user_transaction_history'));
    }

    // Yajara Datatable Of Transaction History
    public function walletData(Request $request){

        $login_user_id = Auth::user()->id;

        $availableWalletCoin = Wallet::where('user_id',$login_user_id)->with('user')->get()->toArray();

        if ($request->ajax()) {

            $login_user_transaction_history = User::where('id','=',$login_user_id)->with('transaction_histories')->latest()->get();

            return Datatables::of($login_user_transaction_history[0]['transaction_histories'])
                                                                                            ->addIndexColumn()
                                                                                            ->rawColumns(['action'])
                                                                                            ->make(true);
        }
    }

    // User  Image Data Edit From
    public function UserEditImage($id){
        $imageData = Image::find($id);
        return view('temp.user.usereditimage',compact('imageData'));
    }

    // User Image Data Update
    public function UserUpdateImage(Request $request,$id){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'coin' => 'required',
        ]);

        $imageData = Image::find($id);
        $imageData->name = $request->input('name');
        $imageData->description = $request->input('description');
        $imageData->coin = $request->input('coin');

        $imageData->update();

        return response()->json(['success'=>'done']);
    }


}
