<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    public function getData(){
        $menus = Menus::query();
        return DataTables::of($menus)
            ->addColumn('action',function($menu){
                return '<button class="btn btn-xs btn-primary data-id="'.$menu->id.'">Edit</button>
                    <button class="btn btn-xs btn-danger data-id="'.$menu->id.'">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function storeMenu(Request $request){
        $validasi = $request->validate([
            'name'=>'required|max:30',
            'path'=>'required|max:30',
        ]);
        
        Menus::create([
            'name' => $request->name,
            'path' => $request->path,
            'description'=> $request->description,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        return redirect()->route('index')->with('success',"Menu Created Successfully!");
    }
}
