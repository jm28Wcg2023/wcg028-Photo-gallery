<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ImageViewController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\ImagePurchaseController;
use App\Http\Controllers\MarketController;
use App\Models\TransactionHistory;
use App\Models\Image;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Wallet;
use App\Models\Bonus;



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
Route::get('/sample',function(){
    return view('temp.sample');
});
Route::get('/hello',function(){
    // $wallet = Wallet::select('wallet_coin')->where('id','=','1')->first();
    // dd($wallet->wallet_coin+5);
    $welcome_bonus = Bonus::where('id',1)->select('welcome_bonus')->first();
    dd($welcome_bonus->welcome_bonus);
});

Route::get('/newlogin',function(){
    // return view('auth.newlogin');
    $user = User::with('image')->get();
    dd($user);
});

//Task date: 25/04/2023
Route::get('buy/{cookies}', function ($cookies) {
    if($cookies < 1){
        return 'Failed, you have bought atleast 1 cookies!';
    }else{
        if ($cookies > Auth::user()->wallet) {
            return 'Error, insufficient funds.';
        }
        Auth::user()->wallet -= $cookies;
        Auth::user()->save();

        Log:info('User ' . Auth::user()->email . ' have bought ' . $cookies . ' cookies');
        return 'Success, you have bought ' . $cookies . ' cookies!';
    }
})->middleware(['auth']);

Route::get('/get',function(){
    $users = Auth::user()->id;
    $user = User::where([
                            // ['role',0],
                            ['id',$users],
                        ])->with('wallet')->first();
    // $wallet_coin = Wallet::->first();
    // $wallet_coin = $user->where('user_id',1)->get()->toArray();
    dd($user->wallet->wallet_coin);
});

Route::get('/imp',function(){
    // $users = Auth::user()->id;
    $user = User::where([
                            ['role',0],
                            ['id',2],
                        ])->with('user_image')->get();
    dd($user);
});


Route::get('/rel-data',function(){

    // $user = Wallet::with('transaction_histories')->get();
    $user = User::where('role',0)->with('wallet')->with('transaction_histories')->get()->toArray();
    dd($user);
});


//-----------------------------------------------------------------------------------------------------------//

//Project Routes Starts form Here
Auth::routes([
    'verify' => true
]);

//Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');;

//Market
Route::get('/Market', [ImageController::class, 'index'])->name('market');

// Route::get('/Market/search', [ImageController::class,'index'])->name('search');

Route::get('/cards', [ImageController::class, 'getImageCards'])->name('cards');


//Referral Register
// Route::get('/referral-register',[RegisterController::class,'referralRegister'])->name('referralRegister');

//change password view
Route::get('/changePassword', [HomeController::class, 'showChangePasswordGet'])->name('changePasswordGet');
Route::post('/changePassword', [HomeController::class, 'changePasswordPost'])->name('changePasswordPost');

//admin
Route::group(['middleware' => ['auth', 'admin']], function () {
    //Admin Dashboard
    Route::get('/admin',[AdminController::class,'AdminView'])->name('admin');

    //Admin User Add

    //Bonus-----------------------------BELOW
    Route::get('/admin/bonus',[BonusController::class,'bonusView'])->name('bonusView');
    //view
    Route::get('/admin/bonus/{id}',[BonusController::class,'bonusEdit'])->name('bonusEdit');
    //update
    Route::put('/admin/bonus/{id}',[BonusController::class,'bonusUpdate'])->name('bonusUpdate');
    //Bonus-----------------------------ABOVE

    //Admin User List-----------------------------
    Route::get('/admin/userlist',[AdminController::class,'AdminUserListView'])->name('userlist');

    // Route::post('/admin/userlist',[AdminController::class,'addUser'])->name('addUser');

    Route::get('/admin/userlist/{id}',[AdminController::class,'editUserView'])->name('editUserView');

    Route::put('/admin/userlist/{id}',[AdminController::class,'updateUser'])->name('updateUser');

    Route::delete('/admin/userlist/{id}',[AdminController::class,'deleteUser'])->name('deleteUser');

    //Admin User List-----------------------------

    //Admin Image List -----------------------------
        Route::get('/admin/imagelist',[AdminController::class,'AdminImageListView'])->name('imagelist');
    //Admin Image List -----------------------------

    //Admin Image --------------
        //Admin Edit Image -----------------------------
            //view
            Route::get('/admin/imagelist/{id}',[AdminController::class,'AdminEditImage'])->name('AdminEditImage');
            //update
            Route::put('/admin/imagelist/{id}',[AdminController::class,'AdminUpdateImage'])->name('AdminUpdateImage');
        //Admin Edit Image -----------------------------



        Route::get('/admin/imagelist', [ImageController::class, 'imagelist'])->name('imagelist');

        //Image Delete by Admin
        Route::delete('admin/imagelists/{id}', [ImageController::class, 'deleteImage'])->name('ImageDeleteAdmin');

        //Admin Image --------------

        //extra admin
        // Route::get('/admin/userlist',[AdminController::class,'index'])->name('admin');

});

//user
Route::group(['middleware' => ['auth', 'user']], function () {
    //User Dashboard
    Route::get('/user',[UserController::class,'UserView'])->name('user');

    //Image Add form
    Route::get('/user/addimage',[UserController::class,'uploadImage'])->name('addimage');

    //wallet
    Route::get('/user/wallet',[UserController::class,'userWallet'])->name('wallet');
    Route::get('/user/wallets',[UserController::class,'walletData'])->name('walletdata');

    //User Image List
    Route::get('/user/userimagelist',[ImageViewController::class,'userImageList'])->name('userimagelist');

    //User Edit Image -----------------------------
        //view
        Route::get('/user/userimagelist/{id}',[UserController::class,'UserEditImage'])->name('UserEditImage');
        //update
        Route::put('/user/userimagelist/{id}',[UserController::class,'UserUpdateImage'])->name('UserUpdateImage');
    //User Edit Image -----------------------------

    //Image Delete by Admin
    Route::delete('user/userimagelist/{id}', [ImageController::class, 'deleteImage'])->name('ImageDeleteUser');

    //Image Upload form view
    Route::get('/upload', [ImageController::class, 'create'])->name('images.create');

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


Route::get('/market',[ImagePurchaseController::class, 'plzLogin'])->name('plzLogin');

// -------------------------------------------
// Route::get('/admin',[DemoController::class,'demoview'])->middleware(['auth','admin']);

// Route::get('/user',[UserController::class,'userview'])->middleware(['auth','user']);

// -----------------------------
// Route::group(['middleware' => ['auth', 'admin']], function () {

//     Route::get('admin', [DemoController::class, 'demoview']);
// });


// Route::group(['middleware' => ['auth', 'user']], function () {
//     Route::get('user', [DemoController::class, 'userview'])->name('product.index');
// });

// Route::middleware(['auth','role'])->group(function(){
//     Route::get('/home',function(){
//         $user = auth()->user();
//         if($user->role ==='admin'){
//             return view('admin');
//         }
//         return view('user');
//     })->name('home');
// });
