<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = \Spatie\Permission\Models\Permission::all();
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission->name);
            $category = $parts[0];
            if (strtolower($category) === 'creacionusuarios' || strtolower($category) === 'creacionusuario') {
                $category = 'creacionusuario';
            }
            if (strtolower($category) === 'crearnovedad' || strtolower($category) === 'novedad' || strtolower($category) === 'novedades') {
                $category = 'novedades';
            }
            $groupedPermissions[$category][] = $permission;
        }
        return view('roles.create', [
            'groupedPermissions' => $groupedPermissions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        $permisos = Permission::whereIn('name', $request->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permisos);

        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente.');
    }

    public function edit(Role $role)
    {
        $permissions = \Spatie\Permission\Models\Permission::all();
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission->name);
            $category = $parts[0];
            if (strtolower($category) === 'creacionusuarios' || strtolower($category) === 'creacionusuario') {
                $category = 'creacionusuario';
            }
            if (strtolower($category) === 'crearnovedad' || strtolower($category) === 'novedad' || strtolower($category) === 'novedades') {
                $category = 'novedades';
            }
            $groupedPermissions[$category][] = $permission;
        }
        return view('roles.edit', [
            'role' => $role,
            'groupedPermissions' => $groupedPermissions
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
        ]);

        $role->update(['name' => $request->name]);
        $permisos = Permission::whereIn('name', $request->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permisos);

        return redirect()->route('roles.index')
            ->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado exitosamente.');
    }
} 