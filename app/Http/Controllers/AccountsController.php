<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\{User,Roles};
use Hash;
use Mail;
use DB;

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
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember');
        if (Auth::attempt($request->only('username', 'password'), $remember)) {
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
            return redirect()->route('login')->withSuccess('User registered successfully.');
        }
    }
    public function forgotpassword(){
        return view('accounts/forgotpassword');
    }
    public function forgotpasswordAction(Request $request){
        $request->validate([
            'username'=>'required|exists:users',
        ]);

        $user = User::where('email',$request->username)
                    ->orWhere('username',$request->username)
                    ->first();

        if(!$user){
            
        }
        $token = Str::random(24);
        dd($user);
        DB::table('password_reset_tokens')->insert([
            'email'=>$request->username,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
        Mail::send('emails.reset_password',['token'=>$token],function($message) use($request){
            $message->to($request->username);
            $message->subject('Reset Password');
        });
        return redirect()->back()->withSuccess(['success'=>'User registered successfully.']);

    }
    public function profile(){
        $user = Auth::user();
        $fullname = DB::table('users')
                ->select('users.name')
                ->leftJoin('access_roles', 'access_roles.user', '=', 'users.name')
                ->where('users.username', $user->username)
                ->get();
        $role = DB::table('access_roles')
                ->where('user', 'administrator')
                ->pluck('role')
                ->first();
        return view('accounts/profile',compact('user','fullname','role'));
    }
    public function setting(){
        return view('accounts/setting');
    }
    public function passwordAction(Request $request){
        $validasi = $request->validate([
            'oldpassword'=>'required|min:8',
            'newpassword'=>'required|min:8',
            'confirmpassword'=>'required|min:8|same:newpassword',
        ]);
        if(Hash::check($request->oldpassword,Auth::user()->password)){
            $user = User::findOrFail(Auth::user()->id);
            $user->update([
                'password' => Hash::make($request->confirmpassword),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Password has been successfully changed.');
        }
        return redirect()->back()->withErrors(['error' => 'Password change failed. Please try again.']);
        
    }
    public function user(){
        return view('configuration/user');
    }
    public function crudUser(Request $request){
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
            return redirect()->back()->withSuccess('User Created successfully.');
        }
    }
    public function getUser(){
        $users = User::all();
        return response()->json($users);
    }
    public function logout(){
        Auth::logout();
        return redirect('account/login');
    }
    public function test(){
        return view('test');
    }
}
