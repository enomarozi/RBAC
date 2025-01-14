<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    public function role(){
        $title = "Manage | Role";
        return view('configuration/role',compact('title'));
    }
    public function crudRole(Request $request){
        if($request->action == "DELETE"){
            $roles = Roles::findOrFail($request->id);
            if($roles->name !== "administrator"){
                $roles->delete();
                return redirect()->back()->withSuccess('Role Deleted successfully!');
            }
            return redirect()->back()->withErrors(['error'=>'Administrator status cannot be changed.']);
        }
        $validasi = $request->validate([
            'name'=>'required|max:30',
            'permissions' => 'required|array',
            'permissions.*' => 'in:CREATE,READ,UPDATE,DELETE',
            'description'=>'max:100',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            Roles::create([
                'name' => $request->name,
                'permissions' => $request->permissions,
                'description'=> $request->description,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->back()->withSuccess('Role Created successfully!');
        }elseif($request->action == "UPDATE"){
            $roles = Roles::findOrFail($request->id);
            if($roles->name !== "administrator"){
                $roles->update([
                    'name' => $request->name,
                    'permissions' => $request->permissions,
                    'description' => $request->description,
                    'updated_at' => now(),
                ]);
                return redirect()->back()->withSuccess('Role Updated successfully!');
            }
        }
        return redirect()->back()->withErrors(['error' => 'Action failed. Please try again.']);
    }
    public function getRole(){
        $menus = Roles::all();
        return response()->json($menus);
    }
}
