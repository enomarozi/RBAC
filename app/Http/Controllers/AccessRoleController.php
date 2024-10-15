<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permissions,Roles,User,AccessRole};

class AccessRoleController extends Controller
{
    public function indexroleAccess(){
        $users = User::all();
        $roles = Roles::all();
        
        return view('configuration/roleAccess',compact('users','roles'));
    }
    public function roleAction(Request $request){
        $validasi = $request->validate([
            'username'=>'required|min:2|max:30',
            'role'=>'required|min:2|max:30',
            'permission'=>'required|min:2|max:30',
        ]);
        AccessRole::create([
            'user' => $request->username,
            'role' => $request->role,
            'permission'=>$request->permission,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        return redirect()->back();

    }
    public function getDataAccessRole(){
        $ars = AccessRole::all();
        return response()->json($ars);
    }
}
