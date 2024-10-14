<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController,MenusController,RolesController,PermissionsController,AccessRoleController};


Route::GET('/login',[AccountsController::class,'login'])->name("login");
Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
Route::GET('/logout',[AccountsController::class,'logout'])->name('logout');

Route::GET('/registration',[AccountsController::class,'registration'])->name('registration');
Route::POST('/registrationAction',[AccountsController::class,'registrationAction'])->name('registrationAction');

Route::GET('/',[MenusController::class,'indexmenu'])->name("indexmenu");
Route::POST('/dataMenu',[MenusController::class,'dataMenu'])->name('dataMenu');
Route::GET('/getDataMenu',[MenusController::class,'getDataMenu'])->name("getDataMenu");

Route::GET('/indexrole',[RolesController::class,'indexrole'])->name("indexrole");
Route::POST('/datarole',[RolesController::class,'datarole'])->name('datarole');
Route::GET('/getDataRole',[RolesController::class,'getDataRole'])->name("getDataRole");

Route::GET('/indexrole',[RolesController::class,'indexrole'])->name("indexrole");
Route::POST('/datarole',[RolesController::class,'datarole'])->name('datarole');
Route::GET('/getDataRole',[RolesController::class,'getDataRole'])->name("getDataRole");

Route::GET('/indexpermission',[PermissionsController::class,'indexpermission'])->name("indexpermission");
Route::POST('/datapermission',[PermissionsController::class,'datapermission'])->name('datapermission');
Route::GET('/getDataPermission',[PermissionsController::class,'getDataPermission'])->name("getDataPermission");

Route::GET('/add_user',[AccountsController::class,'add_user'])->name("add_user");
Route::POST('/data_user',[AccountsController::class,'data_user'])->name("data_user");
Route::GET('/userData',[AccountsController::class,'userData'])->name("userData");

Route::GET('/role_access',[AccessRoleController::class,'indexroleAccess'])->name('indexroleAccess');