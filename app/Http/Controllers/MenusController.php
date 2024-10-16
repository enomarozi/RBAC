<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;

class MenusController extends Controller
{
    public function menu(){
        return view('configuration/menu');
    }
    public function crudMenu(Request $request){
        if($request->action == "DELETE"){
            $menu = Menus::findOrFail($request->id);
            $menu->delete();
            return redirect()->back()->withErrors(['success' => 'Menu Deleted successfully!']);
        }
        $validasi = $request->validate([
            'name'=>'required|max:30',
            'path'=>'required|max:30',
            'description'=>'max:100',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            Menus::create([
                'name' => $request->name,
                'path' => $request->path,
                'description'=> $request->description,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->back()->withErrors(['success' => 'Menu Created successfully!']);
        }elseif($request->action == "UPDATE"){
            $menu = Menus::findOrFail($request->id);
            $menu->update([
                'name' => $request->name,
                'path' => $request->path,
                'description' => $request->description,
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors(['success' => 'Menu Update successfully!']);
        }
    }
    public function getMenu(){
        $menus = Menus::all();
        return response()->json($menus);
    }
}
