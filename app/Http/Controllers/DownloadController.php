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

    //Download image mate
    // $.ajax({
    //     type: 'GET',
    //     url: '/download-image/' + imageId, // Replace with your route URL
    //     success: function(response) {
    //       // Handle successful response
    //       // This response should contain the image data to be downloaded
    //       // You can use the 'response' variable to do whatever you need to do with the image data
    //       // For example, if you want to download the image, you can use the following code:
    //       const link = document.createElement('a');
    //       link.href = window.URL.createObjectURL(new Blob([response]));
    //       link.download = 'image.png';
    //       link.click();
    //     },
    //     error: function(error) {
    //       // Handle error response
    //     }
    //   });
}
