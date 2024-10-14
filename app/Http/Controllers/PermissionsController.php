<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permissions,Roles}; 

class PermissionsController extends Controller
{
    public function indexpermission(){
        $roles = Roles::all();
        return view('configuration/permission',compact('roles'));
    }
    public function datapermission(Request $request){
        if($request->action == "DELETE"){
            $menu = Permissions::findOrFail($request->id);
            $menu->delete();
            return redirect()->route('indexpermission')->with('success', 'Menu deleted successfully!');
        }
        $validasi = $request->validate([
            'role'=>'required|max:30',
            'permission'=>'required|max:30',
            'description'=>'max:100',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            Permissions::create([
                'role' => $request->role,
                'permission'=>$request->permission,
                'description'=> $request->description,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->route('indexpermission')->with('success', 'Menu add successfully!');
        }elseif($request->action == "UPDATE"){
            $menu = Permissions::findOrFail($request->id);
            $menu->update([
                'role' => $request->role,
                'permission'=>$request->permission,
                'description' => $request->description,
                'updated_at' => now(),
            ]);
            return redirect()->route('indexpermission')->with('success', 'Menu update successfully!');
        }
        return redirect()->route('indexpermission')->with('success',"Menu Created Successfully!");
    }
    public function getDataPermission(){
        $menus = Permissions::all();
        return response()->json($menus);
    }
}
