<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bonus;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function bonusUpdate(Request $request,$id){
        // dd($id);
        $request->validate([
            'bonus_name' => 'required',
            'coins' => 'required'
        ]);

        $bonusUpdate = Bonus::find($id);
        $bonusUpdate->bonus_name = $request->input('bonus_name');
        $bonusUpdate->coins = $request->input('coins');

        $bonusUpdate->update();


        return response()->json(['success' => true]);
    }
}
