<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ActivitiesController;
use App\Http\Controllers\Admin\RulesControlller;
use App\Http\Controllers\Admin\MissionsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DataController;


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

define('PAGINATION_COUNT', 8);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['namespace' => 'Admin','prefix' => 'admin'], function() {

    Route::group(['middleware' => 'guest:admin'],function() {
        Route::get('login', [LoginController::class, 'getLogin']) -> name('admin.login');
        Route::post('login', [LoginController::class, 'Login']) -> name('admin.post.login');
    });

    Route::group(['middleware' => 'auth:admin'],function() {
        Route::get('/', [DashboardController::class, 'index']) -> name('admin.dashboard');
        Route::get('logout', [LoginController::class, 'logout']) -> name('admin.logout');

        Route::group(['prefix' => 'profile'],function() {
            Route::get('edit', [ProfileController::class, 'edit']) -> name('edit.profile');
            Route::put('update', [ProfileController::class, 'update']) -> name('update.profile');
        });

        Route::group(['prefix' => 'categories'],function() {
            Route::get('/', [CategoriesController::class,'index'])->name('admin.categories');
            Route::get('create', [CategoriesController::class,'create'])->name('admin.create.category');
            Route::post('store', [CategoriesController::class,'store'])->name('admin.store.category');
            Route::get('edit/{id}', [CategoriesController::class,'edit'])->name('admin.edit.category');
            Route::put('update/{id}', [CategoriesController::class,'update'])->name('admin.update.category');
            Route::get('delete/{id}', [CategoriesController::class,'delete'])->name('admin.delete.category');
        });

        Route::group(['prefix' => 'activities'],function() {
            Route::get('/', [ActivitiesController::class,'index'])->name('admin.activities');
            Route::get('create', [ActivitiesController::class,'create'])->name('admin.create.activity');
            Route::post('store', [ActivitiesController::class,'store'])->name('admin.store.activity');
            Route::get('edit/{id}', [ActivitiesController::class,'edit'])->name('admin.edit.activity');
            Route::put('update/{id}', [ActivitiesController::class,'update'])->name('admin.update.activity');
            Route::get('delete/{id}', [ActivitiesController::class,'delete'])->name('admin.delete.activity');
        });

        Route::group(['prefix' => 'rules'],function() {
            Route::get('/', [RulesControlller::class,'index'])->name('admin.rules');
            Route::get('create', [RulesControlller::class,'create'])->name('admin.create.rule');
            Route::post('store', [RulesControlller::class,'store'])->name('admin.store.rule');
            Route::get('edit/{id}', [RulesControlller::class,'edit'])->name('admin.edit.rule');
            Route::put('update/{id}', [RulesControlller::class,'update'])->name('admin.update.rule');
            Route::get('delete/{id}', [RulesControlller::class,'delete'])->name('admin.delete.rule');
        });

        Route::group(['prefix' => 'missions'],function() {
            Route::get('/', [MissionsController::class,'index'])->name('admin.missions');
            Route::get('create', [MissionsController::class,'create'])->name('admin.create.mission');
            Route::post('store', [MissionsController::class,'store'])->name('admin.store.mission');
            Route::get('edit/{id}', [MissionsController::class,'edit'])->name('admin.edit.mission');
            Route::put('update/{id}', [MissionsController::class,'update'])->name('admin.update.mission');
            Route::get('delete/{id}', [MissionsController::class,'delete'])->name('admin.delete.mission');
        });

        Route::group(['prefix' => 'missions'],function() {
            Route::get('/', [MissionsController::class,'index'])->name('admin.missions');
            Route::get('create', [MissionsController::class,'create'])->name('admin.create.mission');
            Route::post('store', [MissionsController::class,'store'])->name('admin.store.mission');
            Route::get('edit/{id}', [MissionsController::class,'edit'])->name('admin.edit.mission');
            Route::put('update/{id}', [MissionsController::class,'update'])->name('admin.update.mission');
            Route::get('delete/{id}', [MissionsController::class,'delete'])->name('admin.delete.mission');
        });

        Route::group(['prefix' => 'data'],function() {
            Route::get('/', [DataController::class,'index'])->name('admin.data');
            Route::get('create', [DataController::class,'create'])->name('admin.create.data');
            Route::post('store', [DataController::class,'store'])->name('admin.store.data');
            Route::get('edit/{id}', [DataController::class,'edit'])->name('admin.edit.data');
            Route::put('update/{id}', [DataController::class,'update'])->name('admin.update.data');
            Route::get('delete/{id}', [DataController::class,'delete'])->name('admin.delete.data');
            Route::post('activities-by-criteria', [DataController::class,'getActivitiesByCriteria'])->name('get.activities.criteria');
            Route::post('missions-by-rule', [DataController::class,'getMissionsByRules'])->name('get.missions.rule');
        });

        Route::group(['prefix' => 'users'],function() {
            Route::get('/', [UsersController::class,'index'])->name('admin.users');
            Route::get('create', [UsersController::class,'create'])->name('admin.create.user');
            Route::post('store', [UsersController::class,'store'])->name('admin.store.user');
            Route::get('edit/{id}', [UsersController::class,'edit'])->name('admin.edit.user');
            Route::put('update/{id}', [UsersController::class,'update'])->name('admin.update.user');
            Route::get('delete/{id}', [UsersController::class,'delete'])->name('admin.delete.user');
        });
    });


});

