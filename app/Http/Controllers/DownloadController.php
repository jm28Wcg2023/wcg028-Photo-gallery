<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function downloadImage(Image $image){
        $download_path = ( public_path() . '/images/' . $image->image_path);
        return( Response::download( $download_path ) );
    }
}
