<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ContactController;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'admin', 'as' => 'admin.'], function () {


    Route::match(['get','post'],'login',[AuthController::class,'login'])->name('login');

    Route::match(['get','post'],'forgot_password',[AuthController::class,'forgot_password'])->name('forgot_password');
    Route::match(['get','post'],'reset_password',[AuthController::class,'reset_password'])->name('reset_password');


    Route::group(['middleware' => 'admin'], function (){
        Route::match(['get','post'],'profile',[AuthController::class,'profile'])->name('profile');
        Route::match(['get','post'],'change_password',[AuthController::class,'change_password'])->name('change_password');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('test', [DashboardController::class, 'test'])->name('test');

        Route::group(['namespace' => 'contact', 'prefix' => 'contact', 'as' => 'contact.'], function () {
            Route::match(['get','post'],'list',[ContactController::class,'list'])->name('list');
            Route::match(['get','post'],'view',[ContactController::class,'view'])->name('view');
        });
    });


});
