<?php

namespace App\Http\Controllers\Beheer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Overzicht van alle permissies.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('beheer.permissions.index', compact('permissions'));
    }

    /**
     * Formulier voor een nieuwe permissie.
     */
    public function create()
    {
        return view('beheer.permissions.create');
    }

    /**
     * Permissie opslaan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('beheer.permissions.index');
    }

    /**
     * Formulier om een permissie te wijzigen.
     */
    public function edit(Permission $permission)
    {
        return view('beheer.permissions.edit', compact('permission'));
    }

    /**
     * Permissie bijwerken.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('beheer.permissions.index');
    }

    /**
     * Permissie verwijderen.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('beheer.permissions.index');
    }
}