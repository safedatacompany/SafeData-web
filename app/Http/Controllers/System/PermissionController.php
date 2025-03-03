<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return Inertia::render('System/Permissions', [
            'permissions' => Permission::all()->groupBy('group'), // Group permissions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'group' => 'required',
        ]);


        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web', // Default guard
            'group' => $request->group,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
            'group' => 'required',
        ]);

        $permission->update([
            'name' => $request->name,
            'group' => $request->group,
        ]);

        return redirect()->back();
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->back();
    }
}