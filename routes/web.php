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
    // Route::get('/',[HomeController::class,'index'])->name('home');

    // Route::get('/', [HomeController::class,'createStepOne'])->name('create.data.step.one');
    // Route::get('create-step-two', [HomeController::class,'createStepTwo'])->name('create.data.step.two');
    // Route::get('create-step-three', [HomeController::class,'createStepThree'])->name('create.data.step.three');

    Route::get('/', [HomeController::class,'createStepOne'])->name('create.data.step.one');
    Route::post('store-step-one', [HomeController::class,'storeStepOne'])->name('store.data.step.one');
    Route::get('create-step-two', [HomeController::class,'createStepTwo'])->name('create.data.step.two');
    Route::post('store-step-two', [HomeController::class,'storeStepTwo'])->name('store.data.step.two');
    Route::get('create-step-three', [HomeController::class,'createStepThree'])->name('create.data.step.three');
    Route::post('store-step-three', [HomeController::class,'storeStepThree'])->name('store.data.step.three');

    Route::post('sub-categories', [HomeController::class,'getSubCats'])->name('get.sub.categories');



});
