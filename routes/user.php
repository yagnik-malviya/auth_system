<?php

use App\Http\Controllers\user\HomeController;
use Illuminate\Support\Facades\Route;


Route::match(['get','post'],'/',[HomeController::class,'home'])->name('home');
