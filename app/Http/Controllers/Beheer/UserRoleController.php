<?php

namespace App\Http\Controllers\Beheer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('beheer.user-roles.index', compact('users'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('beheer.user-roles.create', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        $user->assignRole($role);

        return redirect()->route('beheer.user-roles.index');
    }

    public function destroy(User $user, Role $role)
    {
        $user->removeRole($role);

        return redirect()->route('beheer.user-roles.index');
    }
}