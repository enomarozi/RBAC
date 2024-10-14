<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permissions,Roles,User,AccessRole};

class AccessRoleController extends Controller
{
    public function indexroleAccess(){
        $users = User::all();
        $roles = Roles::all();
        $permissions = Permissions::all();
        
        return view('configuration/roleAccess',compact('users','roles','permissions'));
    }
}
