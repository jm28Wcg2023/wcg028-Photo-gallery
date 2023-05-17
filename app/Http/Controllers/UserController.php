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

    // Yajara Datatable Of Transaction History
    public function walletData(Request $request){

        $login_user_id = Auth::user()->id;

        $availableWalletCoin = Wallet::where('user_id',$login_user_id)->with('user')->get()->toArray();

        if ($request->ajax()) {

            $login_user_transaction_history = User::where('id','=',$login_user_id)->with('transaction_histories')->get();

            return Datatables::of($login_user_transaction_history[0]['transaction_histories'])
                                                                                            //TODO Filter task
                                                                                            // ->addIndexColumn()
                                                                                            // ->orderColumn('created_at', true)
                                                                                            // ->rawColumns(['action'])
                                                                                        //     ->addColumn('transaction_type', function($row){
                                                                                        //         if($row->transaction_type){
                                                                                        //            return '<span class="badge badge-primary">Yes</span>';
                                                                                        //         }else{
                                                                                        //            return '<span class="badge badge-danger">No</span>';
                                                                                        //         }
                                                                                        //    })
                                                                                        //    ->filter(function ($instance) use ($request) {
                                                                                        //         //   dd($request->get('approved'));
                                                                                        //        if ($request->get('approved') == 'debit' || $request->get('approved') == 'credit') {
                                                                                        //            $instance->where('approved', $request->get('approved'));
                                                                                        //        }
                                                                                            //    if (!empty($request->get('search'))) {
                                                                                            //         $instance->where(function($w) use($request){
                                                                                            //            $search = $request->get('search');
                                                                                            //            $w->orWhere('description', 'LIKE', "%$search%");
                                                                                            //        });
                                                                                            //    }
                                                                                        //    })
                                                                                        //    ->rawColumns(['transaction_type'])
                                                                                            ->make(true);
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
