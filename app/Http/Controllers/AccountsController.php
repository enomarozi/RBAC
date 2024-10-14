<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    }
    public function registration(){
        return view('accounts/registration');
    }
    public function registrationAction(Request $request){
        $validasi = $request->validate([
            'username'=>'required|min:3|max:10',
            'email'=>'required|min:5|max:50',
            'password'=>'required|min:8|max:30',
            'confirmpassword'=>'required|min:8|max:30',
        ]);
        if(strlen($request->password)>=8 && strlen($request->confirmpassword)>=8){
            if($request->password == $request->confirmpassword){
                dd(123);
            }else{
                return redirect()->back()->withErrors(['error' => 'The password must be at least 8 characters.']);
            }
        }else{
            return redirect()->back()->withErrors(['error' => 'The password and confirm password must match.']);
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
