<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            Auth::login($user);
            DB::commit();
            return redirect()->route('dashboard')->with('success','Registered Successfully');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }
}
