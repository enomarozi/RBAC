<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController,MenusController,RolesController,PermissionsController,AccessRoleController};


Route::GET('/login',[AccountsController::class,'login'])->name("login");
Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
Route::GET('/logout',[AccountsController::class,'logout'])->name('logout');

Route::GET('/registration',[AccountsController::class,'registration'])->name('registration');
Route::POST('/registrationAction',[AccountsController::class,'registrationAction'])->name('registrationAction');

Route::GET('/',[AccountsController::class,'index'])->name("index");

Route::group(['prefix' => 'configuration'], function () {
	Route::GET('/menu',[MenusController::class,'menu'])->name('menu');
	Route::POST('/crudMenu',[MenusController::class,'crudMenu'])->name('crudMenu');
	Route::GET('/getMenu',[MenusController::class,'getMenu'])->name("getMenu");
});

Route::group(['prefix' => 'configuration'], function () {
	Route::GET('/role',[RolesController::class,'role'])->name("role");
	Route::POST('/crudRole',[RolesController::class,'crudRole'])->name('crudRole');
	Route::GET('/getRole',[RolesController::class,'getRole'])->name("getRole");
});


Route::GET('/indexpermission',[PermissionsController::class,'indexpermission'])->name("indexpermission");
Route::POST('/datapermission',[PermissionsController::class,'datapermission'])->name('datapermission');
Route::GET('/getDataPermission',[PermissionsController::class,'getDataPermission'])->name("getDataPermission");

Route::GET('/add_user',[AccountsController::class,'add_user'])->name("add_user");
Route::POST('/add_user_action',[AccountsController::class,'add_user_action'])->name("add_user_action");
Route::GET('/userData',[AccountsController::class,'userData'])->name("userData");

Route::GET('/role_access',[AccessRoleController::class,'indexroleAccess'])->name('indexroleAccess');
Route::POST('/roleAction',[AccessRoleController::class,'roleAction'])->name('roleAction');
Route::GET('/getDataAccessRole',[AccessRoleController::class,'getDataAccessRole'])->name('getDataAccessRole');