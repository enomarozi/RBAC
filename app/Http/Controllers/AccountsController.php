<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class AccountsController extends Controller
{
    public function login(){
        return view('accounts/login');
    }
    public function loginAction(Request $request){
        $validasi = $request->validate([
            'username'=>'required|min:8|max:30',
            'password'=>'required|min:8',
        ]);
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('indexmenu');
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
            'email'=>'required|min:5|max:50',
            'password'=>'required|min:8',
            'confirmpassword'=>'required|min:8|max:30',
        ]);
        if(strlen($request->password)>=8 && strlen($request->confirmpassword)>=8){
            if($request->password === $request->confirmpassword){
                $username = $request->input('username');
                $exists = User::where('username', $username)->exists();
                if ($exists) {
                    return redirect()->back()->withErrors(['error' => 'Username has already been taken.']);
                } else {
                    $user = new Users();
                    $user->name = $request->name;
                    $user->username = $request->username;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return redirect()->route('login')->with('success', 'User registered successfully.');
                }
            }else{
                return redirect()->back()->withErrors(['error' => 'The password and confirm password must match.']);
            }
        }else{
            return redirect()->back()->withErrors(['error' => 'The password must be at least 8 characters.']);
        }

    }
    public function add_user(){
        return view('configuration/user');
    }
    public function add_user_action(Request $request){
        $validasi = $request->validate([
            'name'=>'required|min:2|max:40',
            'username'=>'required|min:2|max:30',
            'email'=>'required|min:8|max:50',
            'password'=>'required|min:8',
            'confirmpassword'=>'required|min:8|max:30',
        ]);
        if(strlen($request->password)>=8 && strlen($request->confirmpassword)>=8){
            if($request->password === $request->confirmpassword){
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
                }
            }else{
                return redirect()->back()->withErrors(['error' => 'The password and confirm password must match.']);
            }
        }else{
            return redirect()->back()->withErrors(['error' => 'The password must be at least 8 characters.']);
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
