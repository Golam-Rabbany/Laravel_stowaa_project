<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\FrontendUserController;
use App\Http\Controllers\Frontend\FrontendUserRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product\ColorController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\SizeController;
use Illuminate\Contracts\View\View;

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

Route::get('/', [FrontendController::class, 'index'])->name('forntend.home');
Route::name('frontend.')->group(function(){
    Route::get('/frontend/dashboard', [FrontendUserController::class, 'index'])->name('dashboard.user');
    //register
    Route::get('user/register', [FrontendUserRegisterController::class, 'register'])->name('user.register');
    Route::post('user/register', [FrontendUserRegisterController::class, 'store'])->name('user.register');
    //frontend shop
    Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');

});

Auth::routes();

Route::name('backend.')->group(function(){
    
    Route::group(['middleware' => ["role_or_permission:Super Admin"]],function(){
        
    Route::get('/backend/dashboard', [BackendController::class, 'backend'])->name('home');
    Route::resource('/banner', BannerController::class);
    //Banner active status
    Route::get('/banner/status/{banner}', [BannerController::class, 'activeStatus'])->name('banner.status');
    //trashed banner data
    Route::get('/destroy', [BannerController::class, 'trash'])->name('trash');
    //Banner data restore
    Route::get('/banner/restore/{id}', [BannerController::class, 'bannerRestore'])->name('banner.restore');
    //parmanent Delete
    Route::get('/banner/parmanent/delete/{id}',[BannerController::class, 'parmenentDelete'])->name('parmanent.delete');

    //Products Size
    Route::resource('product/size', SizeController::class);
    //Product Color
    Route::resource('/product/color', ColorController::class);
    //Product Category
    Route::resource('/category', CategoryController::class);
    

    //Product
    Route::resource('/product', ProductController::class);
    });

});

Route::get('/test', [HomeController::class, 'test']);


