<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Wallet;
use App\Models\TransactionHistory;
use App\Models\UserImage;
use App\Models\User;
use App\Models\Bonus;
// use Session;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\UploadNewRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('temp.user.addimage');
    }

    //View the data in the ImageList
    public function imagelist(){
        $images = Image::all();
        return view('temp.admin.imagelist', compact('images'));
    }

    // market view
    public function index(Request $request)
    {
        // dd($image_own_id);
        $images = Image::latest()->with('user')->paginate(15);
        // $images = Image::latest()->with('user')->paginate(10);
        $search =  $request->search;

        if($request->search != ''){
            $images = Image::where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%")
                        ->paginate(4);
            // dd($images);
        }

            // return redirect()->route('market');

        if(Auth::check()){
            $user = Auth::user()->id;
            // dd($user);
            $user_id = Auth::user()->id;
            $image_own_id= Image::where('user_id',$user_id)->pluck('id')->toArray();

            $imageId = UserImage::where('user_id',$user)->pluck('image_id')->toArray();
            // dd($imageId);
            return view('market', compact('images','imageId','image_own_id'));
        }
        return view('market', compact('images'));
    }


    public function getImageCards(Request $request)
    {
        //get the input data from the search input
        $query = $request->input('search');
        //get the select value from the select option
        $sort = $request->input('sort');

        $cards = Image::query()->latest()->with('user');

        // this search images by there name and description
        if ($query) {
            $cards->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
            });
        }

        // this sort images by there name in asc/desc and by there coin value
        if ($sort == 'name_asc') {
            $cards->orderBy('name');
          } elseif ($sort == 'name_desc') {
            $cards->orderBy('name', 'desc');
          } elseif ($sort == 'coin_asc') {
            $cards->orderBy('coin', 'asc');
          } elseif ($sort == 'coin_desc') {
            $cards->orderBy('coin', 'desc');
          }

        $cards = $cards->get();
        $checkLogin = Auth::check();
        if($checkLogin) {
            $user_id = Auth::user()->id;
            $image_own_id= Image::where('user_id',$user_id)->pluck('id')->toArray();
            $imageId = UserImage::where('user_id',$user_id)->pluck('image_id')->toArray();
             // Loop through the cards and add the is_owned and is_purchased variables
            foreach ($cards as $card) {
                $card->is_owned = in_array($card->id, $image_own_id) ;
                $card->is_purchased = in_array($card->id, $imageId);
                $card->$checkLogin;
            }
        }




        return response()->json($cards);
    }



    //Deletes the Image From the Admin Or User Login in the Image List Or In Market.
    public function deleteImage($id){

        $image = Image::find($id);

        //Remove image From the Public Folder
        unlink("images/".$image->image_path);

        $image->delete();
        Log::warning('User : '.Auth::user()->email.' has delete image id'.$image.' at'.date('Y-m-d H:i:s'));

        if(Auth::user()->role == 0){
            return redirect()->route('userimagelist');
        }
        return redirect()->route('imagelist');
    }

    //Image Uploaded here from addimage view
    public function addMoreImage(Request $request){

        $request->validate([
            'addmore.*.name' => 'required',
            'addmore.*.description' => 'required',
            'addmore.*.coin' => 'required',
            'addmore.*.image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($files = $request->file('addmore.*.image')) {
            foreach($files as $img) {

                $imageUploadName =uniqid() . '-' .$img->getClientOriginalName();
                $img->move(public_path('images'), $imageUploadName);
                $images[] = $imageUploadName;

                $user = Auth::user()->id;

                $wallet_coin = Wallet::select('wallet_coin')->where('user_id','=',$user)->first();

                $wallet_id = Wallet::select('id')->where('user_id','=',$user)->first();

                //get the image_upload_bonus value from Database
                $image_upload_bonus = Bonus::where('bonus_name','image_upload_bonus')->select('coins')->first();

                $coin = $wallet_coin->wallet_coin + $image_upload_bonus->coins;

                Wallet::where('user_id', $user)->update(['wallet_coin' => $coin]);

                TransactionHistory::create([
                    'wallet_id' => $wallet_id->id,
                    'transaction_type'=> 'credit',
                    'transaction_amount' => $image_upload_bonus->coins,
                    'description' => 'IMAGE ADD BONUS'.' At: '.date('Y-m-d H:i:s'),
                ]);
                Log::info('User : '.Auth::user()->email.' has uploaded image at'.date('Y-m-d H:i:s'));
            }
            foreach ($images as $key => $image) {
                $user = Auth::user()->id;
                // Save the image details to the database
                $imageData = new Image;
                $imageData->name = $request->addmore[$key]['name'];
                $imageData->description =$request->addmore[$key]['description'];
                $imageData->coin = $request->addmore[$key]['coin'];
                $imageData->user_id = $user;
                $imageData->image_path = $image;
                $imageData->save();
            }

            return response()->json(['success' => true]);
        }


    }

}
