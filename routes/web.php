<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;

Route::GET('/login',[AccountsController::class,'login'])->name("login");
Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
