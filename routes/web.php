<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\UserLoginController;

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



Route::group(['namespace' => 'Site'], function() {
    Route::group(['middleware' => 'guest:web'],function() {
        Route::get('login', [UserLoginController::class, 'getLogin']) -> name('login');
        Route::post('login', [UserLoginController::class, 'Login']) -> name('post.login');
    });

    Route::group(['middleware' => 'auth:web'],function() {
        Route::get('/',[HomeController::class,'index'])->name('home');
        Route::get('user-logout', [UserLoginController::class, 'logout']) -> name('user.logout');
        Route::get('search-data',[HomeController::class,'search'])->name('search.data');
        Route::post('activities-by-criteria', [HomeController::class,'getActivitiesByCriteria'])->name('user.get.activities.criteria');
    });
});
