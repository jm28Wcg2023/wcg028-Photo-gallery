<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Mail\ImageDeleted;
use App\Mail\UserImageDeleted;
use App\Http\Controllers\ImageController;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Mail;

class ImageObserver
{
    /**
     * Handle the Image "created" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function created(Image $image)
    {
        //
        $controller = new ImageController();
        $request = new UploadRequest();
        // dd($request);
        $controller->dynamicImageUploadForm($request);
    }

    /**
     * Handle the Image "updated" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function updated(Image $image)
    {
        //
    }

    /**
     * Handle the Image "deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleted(Image $image)
    {
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


    }

    /**
     * Handle the Image "restored" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function restored(Image $image)
    {
        //
    }

    /**
     * Handle the Image "force deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function forceDeleted(Image $image)
    {
        //
    }
}
