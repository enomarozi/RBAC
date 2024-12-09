<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Menus,Roles,ParentMenu};

class MenusController extends Controller
{
    public function menu(){
        $parents = ParentMenu::all();
        $title = "Manage | Child Menu";
        return view('configuration/menu',compact('parents','title'));
    }
    public function crudMenu(Request $request){
        if($request->action == "DELETE"){
            $menu = Menus::findOrFail($request->id);
            $menu->delete();
            return redirect()->back()->withSuccess('Menu Deleted successfully!');
        }
        $validasi = $request->validate([
            'parent_code'=>'required|max:30',
            'content'=>'required|max:30',
            'route_name'=>'required|max:40',
            'ordered'=>'required|max:2',
            'icon'=>'required',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            Menus::create([
                'parent_code' => $request->parent_code,
                'content' => $request->content,
                'route_name'=> $request->route_name,
                'ordered'=> $request->ordered,
                'icon'=> $request->icon,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->back()->withSuccess('Menu Created successfully!');
        }elseif($request->action == "UPDATE"){
            $menu = Menus::findOrFail($request->id);
            $menu->update([
                'parent_code' => $request->parent_code,
                'content' => $request->content,
                'route_name' => $request->route_name,
                'ordered'=> $request->ordered,
                'icon'=> $request->icon,
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
