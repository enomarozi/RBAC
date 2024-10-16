<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Roles,Menus};

class RolesController extends Controller
{
    public function role(){
        $menus = Menus::all();
        return view('configuration/role',compact('menus'));
    }
    public function crudRole(Request $request){
        if($request->action == "DELETE"){
            $roles = Roles::findOrFail($request->id);
            $roles->delete();
            return redirect()->back()->withErrors(['success' => 'Role Deleted successfully!']);
        }
        $validasi = $request->validate([
            'path'=>'required|max:50',
            'name'=>'required|max:30',
            'description'=>'max:100',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            Roles::create([
                'path'=>$request->path,
                'name' => $request->name,
                'description'=> $request->description,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->back()->withErrors(['success' => 'Role Created successfully!']);
        }elseif($request->action == "UPDATE"){
            $roles = Roles::findOrFail($request->id);
            $roles->update([
                'path'=>$request->path,
                'name' => $request->name,
                'description' => $request->description,
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors(['success' => 'Role Updated successfully!']);
        }
    }
    public function getRole(){
        $menus = Roles::all();
        return response()->json($menus);
    }
}
