<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\Http\Requests\userUpdateImageRequest;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;

class UserController extends Controller
{

    //User Image Upload Form view
    public function uploadImage(){
        return view('temp.user.addimage');
    }

    // pass the data to the user view
    public function userView(){

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

    public function walletData(Request $request){
        $login_user_id = Auth::user()->id;
        $selectedType = $request->input('approved');

        $availableWalletCoin = Wallet::where('user_id', $login_user_id)->with('user')->get()->toArray();

        if ($request->ajax()) {
            $query = User::where('id', '=', $login_user_id)->with(['transaction_histories' => function ($q) use ($selectedType) {
                if (!empty($selectedType)) {
                    $q->where('transaction_type', $selectedType);
                }
            }]);

            $login_user_transaction_history = $query->get();

            $filteredTransactionHistories = $login_user_transaction_history->flatMap(function ($user) {
                return $user->transaction_histories;
            });

            return Datatables::of($filteredTransactionHistories)
                                    ->editColumn('created_at', function($data){
                                            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                                            return $formatedDate;
                                    })->make(true);
        }
    }

    // User  Image Data Edit From
    public function userEditImage($id){
        $imageData = Image::find($id);
        return view('temp.user.usereditimage',compact('imageData'));
    }

    // User Image Data Update
    public function userUpdateImage(userUpdateImageRequest $request,$id){
        $imageData = Image::find($id);

        if ($imageData) {
            $requestData = $request->only(['name', 'description', 'coin']);
            $imageData->update($requestData);
        }

        return response()->json(['success'=>'done']);
    }


}
