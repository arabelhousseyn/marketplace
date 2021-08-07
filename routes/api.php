<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AdminController;
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
    Route::get('categories/restore/{id}',[CategoryController::class,'restore'])->where('id','[0-9]+');
    Route::get('categories/forceDestroy/{id}',[CategoryController::class,'forceDestroy'])->where('id','[0-9]+')->middleware('admin');
    Route::get('categories/subCategories/{id}',[CategoryController::class,'SubCategoriesByCategorie'])->where('id','[0-9]+');
    Route::get('getListingByCategory',[CategoryController::class,'getListingByCategory']);
    // listings 
     Route::resource('listing', ListingController::class);
     // admin login
     Route::post('adminLogin',[AdminController::class,'index']);
    });
    
    

// login 
Route::post('login',[LoginController::class,'index'])->name('login');
// register
