<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;

Route::get('/login',[AccountsController::class,'login'])->name("login");
