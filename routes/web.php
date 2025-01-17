<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController,ParentMenuController,MenusController,RolesController,PermissionsController,AccessRoleController};

Route::GET('/',[AccountsController::class,'index'])->middleware('auth')->name("index");

Route::group(['prefix' => 'account'], function () {
	Route::GET('/login',[AccountsController::class,'login'])->name("login");
	Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
	Route::GET('/logout',[AccountsController::class,'logout'])->name('logout');
	Route::GET('/registration',[AccountsController::class,'registration'])->name('registration');
	Route::POST('/registrationAction',[AccountsController::class,'registrationAction'])->name('registrationAction');
	Route::GET('/forgotpassword',[AccountsController::class,'forgotpassword'])->name('forgotpassword');
	Route::POST('/forgotpasswordAction',[AccountsController::class,'forgotpasswordAction'])->name('forgotpasswordAction');

	Route::get('/reset-password/{token}', [AccountsController::class, 'showResetPasswordForm'])->name('reset.password.get');

	Route::GET('/profile',[AccountsController::class,'profile'])->middleware('auth')->name('profile');
	Route::GET('/setting',[AccountsController::class,'setting'])->middleware('auth')->name('setting');
	Route::POST('/passwordAction',[AccountsController::class,'passwordAction'])->middleware('auth')->name('passwordAction');
});

Route::group(['prefix' => 'configuration','middleware' => ['auth','role:administrator']], function () {
	Route::GET('/parent_menu',[ParentMenuController::class,'parent_menu'])->name('parent_menu');
	Route::POST('/crudParentMenu',[ParentMenuController::class,'crudParentMenu'])->name('crudParentMenu');
	Route::GET('/getParentMenu',[ParentMenuController::class,'getParentMenu'])->name("getParentMenu");

	Route::GET('/menu',[MenusController::class,'menu'])->name('menu');
	Route::POST('/crudMenu',[MenusController::class,'crudMenu'])->name('crudMenu');
	Route::GET('/getMenu',[MenusController::class,'getMenu'])->name("getMenu");

	Route::GET('/role',[RolesController::class,'role'])->name("role");
	Route::POST('/crudRole',[RolesController::class,'crudRole'])->name('crudRole');
	Route::GET('/getRole',[RolesController::class,'getRole'])->name("getRole");

	Route::GET('/user',[AccountsController::class,'user'])->name("user");
	Route::POST('/crudUser',[AccountsController::class,'crudUser'])->name("crudUser");
	Route::GET('/getUser',[AccountsController::class,'getUser'])->name("getUser");
	Route::GET('/statusUser/{username}/{status}',[AccountsController::class,'statusUser'])->name("statusUser");

	Route::GET('/access_role',[AccessRoleController::class,'access_role'])->name('access_role');
	Route::POST('/crudAccessRole',[AccessRoleController::class,'crudAccessRole'])->name('crudAccessRole');
	Route::GET('/getAccessRole',[AccessRoleController::class,'getAccessRole'])->name('getAccessRole');
});

Route::group(['prefix' => 'dti','middleware' => ['auth','role:dti']], function () {
	Route::GET('/data',[MenusController::class,'menu'])->name('dti.data');
	Route::GET('/admin',[MenusController::class,'menu'])->name('admin.dti');
	Route::GET('/user',[MenusController::class,'menu'])->name('usedata');
});

Route::get('/no-permission', function () {
    return view('accounts.no_permission');
})->name('no_permission');