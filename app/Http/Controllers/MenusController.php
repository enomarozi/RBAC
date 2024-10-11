<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;

class MenusController extends Controller
{
    public function indexmenu(){
        $menus = Menus::all();
        return view('configuration/menu',compact('menus'));
    }
    public function dataMenu(Request $request){
        if($request->action == "DELETE"){
            $menu = Menus::findOrFail($request->id);
            $menu->delete();
            return redirect()->route('indexmenu')->with('success', 'Menu deleted successfully!');
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
            return redirect()->route('indexmenu')->with('success', 'Menu add successfully!');
        }elseif($request->action == "UPDATE"){
            $menu = Menus::findOrFail($request->id);
            $menu->update([
                'name' => $request->name,
                'path' => $request->path,
                'description' => $request->description,
                'updated_at' => now(),
            ]);
            return redirect()->route('indexmenu')->with('success', 'Menu update successfully!');
        }
        return redirect()->route('indexmenu')->with('success',"Menu Created Successfully!");
    }
    public function getDataMenu(){
        $menus = Menus::all();
        return response()->json($menus);
    }
}
