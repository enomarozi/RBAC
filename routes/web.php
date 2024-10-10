<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController,DashboardController};

Route::GET('/',[DashboardController::class,'index'])->name("index");
Route::GET('/login',[AccountsController::class,'login'])->name("login");
Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");

Route::POST('/menu/store',[DashboardController::class,'storeMenu'])->name('storeMenu');
Route::GET('/getData',[DashboardController::class,'getData'])->name("getData");
