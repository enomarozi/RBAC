<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    public function role(){
        return view('configuration/role');
    }
    public function crudRole(Request $request){
        if($request->action == "DELETE"){
            $roles = Roles::findOrFail($request->id);
            if($roles->name !== "administrator"){
                $roles->delete();
                return redirect()->back()->withSuccess('Role Deleted successfully!');
            }
        }
        $validasi = $request->validate([
            'name'=>'required|max:30',
            'description'=>'max:100',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            Roles::create([
                'name' => $request->name,
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
