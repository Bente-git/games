<?php

namespace App\Http\Controllers\Beheer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('beheer.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('beheer.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('beheer.roles.index');
    }

    public function edit(Role $role)
    {
        return view('beheer.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('beheer.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('beheer.roles.index');
    }
}