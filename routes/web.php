<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController,MenusController,RolesController,PermissionsController,AccessRoleController};


Route::GET('/',[AccountsController::class,'index'])->middleware('auth')->name("index");

Route::group(['prefix' => 'account'], function () {
	Route::GET('/login',[AccountsController::class,'login'])->name("login");
	Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
	Route::GET('/logout',[AccountsController::class,'logout'])->name('logout');
	Route::GET('/registration',[AccountsController::class,'registration'])->name('registration');
	Route::POST('/registrationAction',[AccountsController::class,'registrationAction'])->name('registrationAction');
});

Route::group(['prefix' => 'configuration','middleware' => 'auth'], function () {
	Route::GET('/menu',[MenusController::class,'menu'])->name('menu');
	Route::POST('/crudMenu',[MenusController::class,'crudMenu'])->name('crudMenu');
	Route::GET('/getMenu',[MenusController::class,'getMenu'])->name("getMenu");
});

Route::group(['prefix' => 'configuration','middleware' => 'auth'], function () {
	Route::GET('/role',[RolesController::class,'role'])->name("role");
	Route::POST('/crudRole',[RolesController::class,'crudRole'])->name('crudRole');
	Route::GET('/getRole',[RolesController::class,'getRole'])->name("getRole");
});

Route::group(['prefix' => 'configuration','middleware' => 'auth'], function () {
	Route::GET('/user',[AccountsController::class,'user'])->name("user");
	Route::POST('/crudUser',[AccountsController::class,'crudUser'])->name("crudUser");
	Route::GET('/getUser',[AccountsController::class,'getUser'])->name("getUser");
});


Route::GET('/role_access',[AccessRoleController::class,'indexroleAccess'])->name('indexroleAccess');
Route::POST('/roleAction',[AccessRoleController::class,'roleAction'])->name('roleAction');
Route::GET('/getDataAccessRole',[AccessRoleController::class,'getDataAccessRole'])->name('getDataAccessRole');