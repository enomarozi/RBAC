<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function registrationAction(){
        return 123;
    }
}
