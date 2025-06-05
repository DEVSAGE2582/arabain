<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Show list of roles
    public function index()
    {
        $roles = Role::where('id', '!=', 2)->get();
        return view('roles.index', compact('roles'));
    }

    // Show form to create a new role
    public function create()
    {
        // Fetch all permissions and group by prefix
        $permissions = Permission::all()->groupBy(function ($perm) {
            // Ensure $perm->name exists and is a string
            return is_string($perm->name) ? explode('.', $perm->name)[0] : 'ungrouped';
        });

        return view('roles.create', compact('permissions'));
    }

    // Store the new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array|nullable',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
    
        // Group permissions by prefix before the dot (like "user" in "user.create")
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[0]; // Example: "user.create" => "user"
        });
    
        return view('roles.edit', compact('role', 'permissions'));
    }
    
public function destroy(Role $role)
{
    $role->delete();
    return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
}

public function update(Request $request, Role $role)
{
    $request->validate([
        'name' => 'required|unique:roles,name,' . $role->id,
        'permissions' => 'array|nullable',
    ]);

    $role->update(['name' => $request->name]);

    $role->syncPermissions($request->permissions ?? []);

    return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
}


}

