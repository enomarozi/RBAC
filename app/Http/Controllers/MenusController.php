<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Menus,Roles};

class MenusController extends Controller
{
    public function menu(){
        $roles = Roles::all();
        return view('configuration/menu',compact('roles'));
    }
    public function crudMenu(Request $request){
        if($request->action == "DELETE"){
            $menu = Menus::findOrFail($request->id);
            $menu->delete();
            return redirect()->back()->withSuccess('Menu Deleted successfully!');
        }
        $validasi = $request->validate([
            'role'=>'required|max:30',
            'content'=>'required|max:30',
            'path'=>'max:30',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            Menus::create([
                'role' => $request->role,
                'content' => $request->content,
                'path'=> $request->path,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->back()->withSuccess('Menu Created successfully!');
        }elseif($request->action == "UPDATE"){
            $menu = Menus::findOrFail($request->id);
            $menu->update([
                'role' => $request->role,
                'content' => $request->content,
                'path' => $request->path,
                'updated_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Menu Updated successfully!');
        }
        return redirect()->back()->withErrors(['error' => 'Action failed. Please try again.']);
    }
    public function getMenu(){
        $menus = Menus::all();
        return response()->json($menus);
    }
}
