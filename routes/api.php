<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function(){
    /// categories
    Route::resource('categories', CategoryController::class);
    Route::prefix('categories')->group(function () {
    Route::get('restore/{id}',[CategoryController::class,'restore'])->where('id','[0-9]+');
    Route::get('forceDestroy/{id}',[CategoryController::class,'forceDestroy'])->where('id','[0-9]+')->middleware('admin');
    Route::get('subCategories/{id}',[CategoryController::class,'SubCategoriesByCategorie'])->where('id','[0-9]+');
    });
    Route::get('getListingByCategory',[CategoryController::class,'getListingByCategory']);
    Route::get('listingByIdCtegory/{id}',[CategoryController::class,'listingByIdCtegory'])->where('id','[0-9]+');
    // listings 
     Route::resource('listing', ListingController::class);
     Route::get('listingsByUser/{username}',[ListingController::class,'listingsByUser'])->whereAlphaNumeric('username');
     // admin login
     Route::post('adminLogin',[AdminController::class,'index']);
     //// update information about user Auth
     Route::put('/updateUser',[UserController::class,'update']);
    });
    
    

// login 
Route::post('login',[LoginController::class,'index'])->name('login');
// register
