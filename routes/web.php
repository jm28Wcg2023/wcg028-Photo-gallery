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

//Testing Routes Below

//-----------------------------------------------------------------------------------------------------------//
//Market
// Route::get('/Market', [ImageController::class, 'index'])->name('market');

// Route::get('/Market/search', [ImageController::class,'index'])->name('search');
// Route::get('/Market', [ImageController::class, 'lazyLoadMarket'])->name('market');
//-----------------------------------------------------------------------------------------------------------//

//Project Routes Starts form Here
Auth::routes([
    'verify' => true
]);

//Home Page
Route::get('/home', [ChangePasswordController::class, 'index'])->name('home')->middleware('verified');;

//Market view With Lazy Loading, search, sort
Route::get('/Market',[ImageController::class,'lazyLoadData'])->name('market');

// previous market card append
// Route::get('/cards', [ImageController::class, 'getImageCards'])->name('cards');


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

    //Bonus-----------------------------BELOW
    Route::get('/admin/bonus',[BonusController::class,'bonusView'])->name('bonusView');
    //view
    Route::get('/admin/bonus/{id}',[BonusController::class,'bonusEdit'])->name('bonusEdit');
    //update
    Route::put('/admin/bonus/{id}',[BonusController::class,'bonusUpdate'])->name('bonusUpdate');
    //Bonus-----------------------------ABOVE

    //Admin User List-----------------------------
    Route::get('/admin/userlist',[AdminController::class,'adminUserListView'])->name('userlist');

    Route::post('/admin/userlist',[AdminController::class,'addUser'])->name('addUser');

    Route::get('/admin/userlist/{id}',[AdminController::class,'editUserView'])->name('editUserView');

    Route::put('/admin/userlist/{id}',[AdminController::class,'updateUser'])->name('updateUser');

    Route::delete('/admin/userlist/{id}',[AdminController::class,'deleteUser'])->name('deleteUser');

    //Admin User List-----------------------------

    //Admin Image List -----------------------------
        Route::get('/admin/imagelist',[AdminController::class,'adminImageListView'])->name('imagelist');
    //Admin Image List -----------------------------

    //Admin Image --------------
        //Admin Edit Image -----------------------------
            //view
            Route::get('/admin/imagelist/{id}',[AdminController::class,'adminEditImage'])->name('AdminEditImage');
            //update
            Route::put('/admin/imagelist/{id}',[AdminController::class,'adminUpdateImage'])->name('AdminUpdateImage');
        //Admin Edit Image -----------------------------



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
    Route::get('/user/userimagelist',[ImageViewController::class,'userImageList'])->name('userimagelist');

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

    //Image Upload form submit
    Route::post('addmore',[ImageController::class,'addMoreImage'])->name('addmorePost');

});

//Image Purchase button Route
Route::get('image-purchase/{image}', [ImagePurchaseController::class, 'purchaseImage'])->name('purchase.image');
//Download Images button  Route
Route::get('image-market/{image}', [DownloadController::class, 'downloadImage'])->name('download.image');

//Download Images Route
//In Market
//In UserImageList
Route::get('image-download/{image}', [DownloadController::class, 'downloadImage'])->name('sample.image');

//Plz Login To buy Image
Route::get('/market',[ImagePurchaseController::class, 'plzLogin'])->name('plzLogin');
