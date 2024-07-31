<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    
    
        public function index()
        {
            $roles = (new Role)->newQuery();
            $roles->latest();
            $roles = $roles->paginate(100)->onEachSide(2)->appends(request()->query());

            return Inertia::render('Admin/Role/Index', [
                'roles' => $roles,
                'can' => [
                    'create' => Auth::user()->can('role create'),
                    'edit' => Auth::user()->can('role edit'),
                    'delete' => Auth::user()->can('role delete'),
                ]
            ]);
        }

        public function create()
        {
            $roles = Role::all();  // Fetch all roles
            $permissions = Permission::latest()->paginate(100)->onEachSide(2)->appends(request()->query());

            return Inertia::render('Admin/Role/create', [
                'roles' => $roles,
                'permissions' => $permissions,
            ]);
        }

        public function store(Request $request)
        {
            // \Log::info('Store method called', $request->all());

            $role = Role::create(['name' => $request->name]);
            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }

            return redirect()->route('role.index')->with('success', 'Role created successfully.');
        }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions()->pluck('id')->toArray();

        return Inertia::render('Admin/Role/edit', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array'
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }


    public function destroy(Role $role)
    {
        if ($role->name === 'Administrator') {
            return redirect()->back()->with('error', 'Cannot delete the Administrator role.');
        }

        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
    }

}