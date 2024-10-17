<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permissions,Roles,User,AccessRole};

class AccessRoleController extends Controller
{
    public function access_role(){
        $users = User::all();
        $roles = Roles::all();
        
        return view('configuration/roleAccess',compact('users','roles'));
    }
    public function crudAccessRole(Request $request){
        $validasi = $request->validate([
            'username'=>'required|min:2|max:30',
            'role'=>'required|min:2|max:30',
            'permission'=>'required|min:2|max:30',
        ]);
        if($request->action == "SAVE"){
                AccessRole::create([
                'user' => $request->username,
                'role' => $request->role,
                'permission'=>$request->permission,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->back()->withSuccess('Access Role Created successfully!');

        }elseif($request->action == "UPDATE"){
            $access_role = AccessRole::findOrFail($request->id);
            $access_role->update([
                'user' => $request->username,
                'role' => $request->role,
                'permission'=>$request->permission,
                'updated_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Access Role Updated successfully!');
        }
        return redirect()->back()->withErrors(['error' => 'Action failed. Please try again.']);
    }
    public function getAccessRole(){
        $ars = AccessRole::all();
        return response()->json($ars);
    }
}
