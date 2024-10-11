<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController,MenusController,RolesController};


Route::GET('/login',[AccountsController::class,'login'])->name("login");
Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");

Route::GET('/',[MenusController::class,'indexmenu'])->name("indexmenu");
Route::POST('/dataMenu',[MenusController::class,'dataMenu'])->name('dataMenu');
Route::GET('/getDataMenu',[MenusController::class,'getDataMenu'])->name("getDataMenu");

Route::GET('/indexrole',[RolesController::class,'indexrole'])->name("indexrole");
Route::POST('/datarole',[MenusController::class,'datarole'])->name('datarole');
Route::GET('/getDataRole',[MenusController::class,'getDataRole'])->name("getDataRole");