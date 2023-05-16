<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bonus;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\BonusEditRequest;

class BonusController extends Controller
{
    //Get the All BonusList.
    public function bonusView(){
        $bonus_list = Bonus::all();
        return view('temp.admin.bonus',compact('bonus_list'));
    }

    //Bonus Update Form
    public function bonusEdit($id){
        $bonusEdit = Bonus::find($id);
        return view('temp.admin.bonusEdit',compact('bonusEdit'));
    }

    //Bonus Update function
    public function bonusUpdate(BonusEditRequest $request,$id){
        $bonusUpdate = Bonus::find($id);
        if ($bonusUpdate) {
            $bonusUpdate->update($request->all());
        }

        return response()->json(['success' => true]);
    }
}
