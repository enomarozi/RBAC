<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    public function indexrole(){
        return view('configuration/role');
    }
    public function datarole(Request $request){
        if($request->action == "DELETE"){
            $menu = Roles::findOrFail($request->id);
            $menu->delete();
            return redirect()->route('indexrole')->with('success', 'Menu deleted successfully!');
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
            return redirect()->route('indexrole')->with('success', 'Menu add successfully!');
        }elseif($request->action == "UPDATE"){
            $menu = Roles::findOrFail($request->id);
            $menu->update([
                'name' => $request->name,
                'description' => $request->description,
                'updated_at' => now(),
            ]);
            return redirect()->route('indexrole')->with('success', 'Menu update successfully!');
        }
        return redirect()->route('indexrole')->with('success',"Menu Created Successfully!");
    }
    public function getDataRole(){
        $menus = Roles::all();
        return response()->json($menus);
    }
}
