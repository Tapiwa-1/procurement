<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(Request $request){

        $users = User::when($request->item,function($query,$item){
            $query->where('name','LIKE','%'.$item.'%');
        })->with('roles')->paginate(10)
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles,
            ]);

        return Inertia::render('Admin/Users/Index', compact('users'));
   }
    public function show(User $user){
        $allRoles = Role::all();
        $assignedRoles = $user->roles;
        $allPermissions = Permission::all();
        $assignedPermissions = $user->getAllPermissions();
        $userDetails = $user;
        // dd($assignedPermissions);
        return Inertia::render('Admin/Users/EditRole', compact('userDetails','allRoles','allPermissions','assignedRoles','assignedPermissions'));
    }
    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->roleName)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->roleName);
        return back();
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back();
        }

        return back()->with('message', 'Role not exists.');
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permissionName)) {
            return back();
        }
        $user->givePermissionTo($request->permissionName);
        return back();
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission does not exists.');
    }

    public function destroy(User $user)
    {
    
        if ($user->hasRole('admin')) {
            return back()->with('message', 'you are admin.');
        }
        $user->delete();
        return back()->with('message', 'User deleted.');
    }
}
