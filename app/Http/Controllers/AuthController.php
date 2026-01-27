<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function register(){
        $roles = Role::whereNot('name','admin')->get();
        return view('authentication.register',compact('roles'));
    }

    public function registerAttempt(RegisterRequest $request){
        DB::beginTransaction();
        try{
            $attributes = $request->validated();
            $attributes['status'] = 'active';
            unset($attributes['role']);
            $user = User::create($attributes);
            $role = Role::findById($request->role);
            $user->assignRole($role->name);
            event(new Registered($user));
            $credentials = $request->only(['email','password']);
            Auth::attempt($credentials);
            $request->session()->regenerate();
            DB::commit();
            return redirect()->route('verification.notice');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function login(){
        return view('authentication.login');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('register')->with('success','You have logged out successfully');
    }
}
