<?php

use Illuminate\Support\Facades\Route;
//Auth Controllers
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;

//Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ImageViewController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ImagePurchaseController;
//Models
use App\Models\Image;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Wallet;
use App\Models\Bonus;
use App\Models\TransactionHistory;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Project Routes Starts form Here
Auth::routes([
    'verify' => true
]);

//Home Page
Route::get('/home', [ChangePasswordController::class, 'index'])->name('home')->middleware('verified');;

//Market view With Lazy Loading, search, sort
Route::get('/Market',[ImageController::class,'lazyLoadData'])->name('market');

//Referral Register
Route::get('/referral-register',[RegisterController::class,'referralRegister'])->name('referralRegister');

//change password view
Route::get('/changePassword', [ChangePasswordController::class, 'showChangePasswordGet'])->name('changePasswordGet');
Route::post('/changePassword', [ChangePasswordController::class, 'changePasswordPost'])->name('changePasswordPost');

//admin
Route::group(['middleware' => ['auth', 'admin']], function () {
    //Admin Dashboard
    Route::get('/admin',[AdminController::class,'adminView'])->name('admin');

    //Admin User Add

    //Bonus-----------------------------
    Route::resource('/admin/bonuses', BonusController::class);


    //Admin User List--------------------------
    Route::resource('/admin/userlist', AdminUserController::class);

    //Admin Image List -----------------------------
        Route::get('/admin/imagelist',[AdminController::class,'adminImageListView'])->name('imagelist');


    //Admin Image --------------
        Route::get('/admin/imagelist', [ImageController::class, 'imageList'])->name('imagelist');

        //Image Delete by Admin
        Route::delete('admin/imagelists/{id}', [ImageController::class, 'deleteImage'])->name('ImageDeleteAdmin');

    //Admin Image --------------
});

//user
Route::group(['middleware' => ['auth', 'user']], function () {
    //User Dashboard
    Route::get('/user',[UserController::class,'userView'])->name('user');

    //Image Add form
    Route::get('/user/addimage',[UserController::class,'uploadImage'])->name('addimage');

    //wallet
    Route::get('/user/wallet',[UserController::class,'userWallet'])->name('wallet');
    Route::post('/user/wallets',[UserController::class,'walletData'])->name('walletdata');

    //User Image List
    Route::get('/user/userimagelist',[ImagePurchaseController::class,'userImageList'])->name('userimagelist');

    //User Edit Image -----------------------------
        //view
        Route::get('/user/userimagelist/{id}',[UserController::class,'userEditImage'])->name('UserEditImage');
        //update
        Route::put('/user/userimagelist/{id}',[UserController::class,'userUpdateImage'])->name('UserUpdateImage');
    //User Edit Image -----------------------------

    //Image Delete by Admin
    Route::delete('user/userimagelist/{id}', [ImageController::class, 'deleteImage'])->name('ImageDeleteUser');

    //Image Upload form view
    Route::get('/upload', [ImageController::class, 'create'])->name('images.create');

    Route::post('images/upload',[ImageController::class,'dynamicImageUploadForm'])->name('images.upload');
});

//Image Purchase button Route
Route::get('image-purchase/{image}', [ImagePurchaseController::class, 'purchaseImage'])->name('purchase.image');

Route::get('image-download/{image}', [ImageController::class, 'downloadImage'])->name('download.image');

//Plz Login To buy Image
Route::get('/market',[ImagePurchaseController::class, 'pleaseLogin'])->name('plzLogin');
