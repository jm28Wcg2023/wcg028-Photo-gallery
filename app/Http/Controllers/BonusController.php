<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bonus;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\BonusEditRequest;

class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonus_list = Bonus::all();
        return view('temp.admin.bonus',compact('bonus_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bonusEdit = Bonus::find($id);
        return view('temp.admin.bonusEdit',compact('bonusEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BonusEditRequest $request, $id)
    {
        $bonusUpdate = Bonus::find($id);
        if ($bonusUpdate) {
            $bonusUpdate->update($request->all());
        }
        return response()->json(['success' => true]);
    }

}
