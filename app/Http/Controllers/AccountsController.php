<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Roles};
use Illuminate\Support\Facades\Auth;
use Hash;

class AccountsController extends Controller
{
    public function index(){
        $user = count(User::all());
        $role = count(Roles::all());
        return view('dashboard/dashboard',compact('user','role'));
    }
    public function login(){
        return view('accounts/login');
    }
    public function loginAction(Request $request){
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('index');
        }
        return redirect()->back()->withErrors(['error' => 'Username or Password is incorrect.']);
    }
    public function registration(){
        return view('accounts/registration');
    }
    public function registrationAction(Request $request){
        $validasi = $request->validate([
            'name'=>'required|min:3|max:40',
            'username'=>'required|min:3|max:30',
            'email'=>'required|min:5|max:60',
            'password'=>'required|min:8',
            'confirmpassword'=>'required|min:8|same:password',
        ]);

        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'Username has already been taken.']);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('login')->with('success', 'User registered successfully.');
        }
    }
    public function add_user(){
        return view('configuration/user');
    }
    public function add_user_action(Request $request){
        $validasi = $request->validate([
            'name'=>'required|min:3|max:40',
            'username'=>'required|min:3|max:30',
            'email'=>'required|min:5|max:60',
            'password'=>'required|min:8',
            'confirmpassword'=>'required|min:8|same:password',
        ]);
        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'Username has already been taken.']);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back();
        }
    }
    public function userData(){
        $users = User::all();
        return response()->json($users);
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
