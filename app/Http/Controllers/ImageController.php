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
use Illuminate\Support\Facades\Validator;
use Notification;
use App\Mail\DeleteImageMail;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\UploadNewRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Notifications\DeleteImageNotifiaction;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImageDeleted;
use App\Mail\UserImageDeleted;


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
    public function imageList(){
        $images = Image::all();
        return view('temp.admin.imagelist', compact('images'));
    }

    public function lazyLoadMarket(){
        return view('market');
    }

    //Market View
    public function lazyLoadData(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');

        $query = Image::query();

        // Apply search filter if provided
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                   ->where('description', 'like', '%' . $search . '%');
        }

        // Apply sort criteria if provided
        if ($sort) {
            if ($sort === 'lazyname_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sort === 'lazyname_desc') {
                $query->orderBy('name', 'desc');
            } elseif ($sort === 'price_asc') {
                $query->orderBy('coin', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('coin', 'desc');
            }
        }
        $images = $query->paginate(6);

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $image_own_id= Image::where('user_id',$user_id)->pluck('id')->toArray();

            $imageId = UserImage::where('user_id',$user_id)->pluck('image_id')->toArray();
            if ($request->ajax()) {

                $view = view('image-card-data', compact('images','imageId','image_own_id'))->render();
                return response()->json(['html' => $view]);
            }
            return view('market', compact('images','imageId','image_own_id'));
        }
        if ($request->ajax()) {

            $view = view('image-card-data', compact('images'))->render();
            return response()->json(['html' => $view]);
        }
        return view('market', compact('images'));

    }



    //Deletes the Image From the Admin Or User Login in the Image List Or In Market.
    public function deleteImage($id){

        $image = Image::find($id);

        //Remove image From the Public Folder
        unlink("images/".$image->image_path);

        $image->delete();
        Log::warning('User : '.Auth::user()->email.' has delete image id'.$image.' at'.date('Y-m-d H:i:s'));

        $user = Auth::user();

        if(Auth::user()->role == 0){
            // Send email to user when admin delete the image
            $email = Auth::user()->where('role',1)->select('email')->first();
            Mail::to($email)->send(new ImageDeleted($user, $image));

            return redirect()->route('userimagelist');
        }
        // Send email to admin when user delete the image
        $email = Auth::user()->where('id',$image->user_id)->select('email')->first();
        Mail::to($email)->send(new UserImageDeleted($user, $image));

        return redirect()->route('imagelist');
    }


    //Image Uploaded here from Dynamic select images view
    public function dynamicImageUploadForm(UploadRequest $request)
    {
        // dd($request->all());
        $user = Auth::user()->id;

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $name);
                $images[] = $name;

                $user = Auth::user()->id;

                $wallet = Wallet::where('user_id','=',$user)->first();

                //get the image_upload_bonus value from Database
                $imageUploadBonus = Bonus::where('bonus_name','image_upload_bonus')->value('coins')->first();


                $coin = $wallet->wallet_coin + $imageUploadBonus->coins;

                Wallet::where('user_id', $user)->update(['wallet_coin' => $coin]);

                //helper Function
                createTransaction($wallet->id,'credit',$imageUploadBonus->coins,'IMAGE ADD BONUS'.' At: '.date('Y-m-d H:i:s'));

                Log::info('User : '.Auth::user()->email.' has uploaded image at'.date('Y-m-d H:i:s'));
            }
        }

        foreach ($images as $key => $image) {
            $names = $request->input('titles.' . $key);
            $description = $request->input('descriptions.' . $key);
            $coin = $request->input('coins.' . $key);


            // Save the image details to the database
            $imageData = new Image;
            $imageData->name = $names;
            $imageData->description = $description;
            $imageData->coin = $coin;
            $imageData->user_id = $user;
            $imageData->image_path = $image;
            $imageData->save();


            // send email to user
            // $userdata = Auth::user();
            // Mail::to($userdata->email)->send(new ImageUpload($userdata, $imageData));
            // //change the Mail file for Admin.
            // Mail::to('admin@example.com')->send(new ImageUpload($userdata, $imageData));


        }

        Alert::success('Success', 'You\'ve Successfully Uploaded Images');

        return response()->json(['success' => true]);
    }



}
