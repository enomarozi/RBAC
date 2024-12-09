<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ParentMenu,Roles};

class ParentMenuController extends Controller
{
    public function parent_menu(){
        $roles = Roles::all();
        $parent = ParentMenu::all();
        $title = "Manage | Parent Menu";
        return view('configuration/parentMenu',compact('parent','roles','title'));
    }
    public function crudParentMenu(Request $request){
        if($request->action == "DELETE"){
            $menu = ParentMenu::findOrFail($request->id);
            $menu->delete();
            return redirect()->back()->withSuccess('Parent Menu Deleted successfully!');
        }
        $validasi = $request->validate([
            'role'=>'required|max:30',
            'parent_code'=>'required|max:30',
            'parent_name'=>'required|max:30',
            'ordered'=>'required',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            ParentMenu::create([
                'role'=>$request->role,
                'parent_code'=>$request->parent_code,
                'parent_name' => $request->parent_name,
                'ordered'=>$request->ordered,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->back()->withSuccess('Parent Menu Created successfully!');
        }elseif($request->action == "UPDATE"){
            $menu = ParentMenu::findOrFail($request->id);
            $menu->update([
                'role'=>$request->role,
                'parent_code'=>$request->parent_code,
                'parent_name' => $request->parent_name,
                'ordered'=>$request->ordered,
                'updated_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Parent Menu Updated successfully!');
        }
        return redirect()->back()->withErrors(['error' => 'Action failed. Please try again.']);
    }
    public function getParentMenu(){
        $pm = ParentMenu::all();
        return response()->json($pm);
    }
}