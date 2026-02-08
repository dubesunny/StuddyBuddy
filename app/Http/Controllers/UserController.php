<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        abort_if(!Auth::user()->can('view_user'),403);
        $this->breadcrumbs([
            'User' => route('users.index')
        ]);
        $roles = Role::all();
        return $dataTable->render('admin.user.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!Auth::user()->can('add_user'),403);
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        abort_if(!Auth::user()->can('add_user'),403);
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $imagename = 'Image_' . User::max('id') + 1 . '.jpg';
                Storage::putFileAs('image', $data['image'], $imagename);
                $data['image'] = $imagename;
            }
            unset($data['role']);
            $user = User::create($data);
            $role = Role::findById($request->role);
            $user->assignRole($role->name);
            DB::commit();
            return response()->json(['message' => 'User added successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
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
    public function edit(User $user)
    {
        abort_if(!Auth::user()->can('edit_user'),403);
        $roles = Role::all();
        $user = $user->load('roles');
        return view('admin.user.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        abort_if(!Auth::user()->can('edit_user'),403);
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                if ($user->getRawOriginal('image')) {
                    Storage::disk('public')->delete('image/' . $user->getRawOriginal('image'));
                }

                $imagename = 'Image_' . User::max('id') + 1 . '.jpg';
                Storage::putFileAs('image', $data['image'], $imagename);
                $data['image'] = $imagename;
            }
            unset($data['role']);
            $user->update($data);
            $role = Role::findById($request->role);
            $user->assignRole($role->name);
            DB::commit();
            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        abort_if(!Auth::user()->can('delete_user'),403);
        DB::beginTransaction();
        try {
            if ($user->getRawOriginal('image')) {
                Storage::disk('public')->delete('image/' . $user->getRawOriginal('image'));
            }
            $user->delete();
            DB::commit();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
