<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        $this->breadcrumbs([
            'User' => route('users.index')
        ]);
        return $dataTable->render('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->validated();
            if($request->hasFile('image')){
                $imagename = 'Image_'.User::max('id') + 1;
                Storage::putFileAs('image',$data['image'],$imagename);
                $data['image'] = $imagename;
            }
            unset($data['role']);
            $data['status'] = $request->status == 'yes' ? 'active' : 'inactive';
            $user = User::create($data);
            $user->assignRole($request->role);
            DB::commit();
            return response()->json(['message' => 'User added successfully'],200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
