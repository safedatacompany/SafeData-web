<?php

namespace App\Http\Controllers\System\Users;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\System\Users\Role;
use App\Http\Controllers\Controller;
use App\Models\System\Users\Permission;
use App\Traits\HandlesSorting;
use App\Traits\LogsActivity;

class RoleController extends Controller
{
    use LogsActivity, HandlesSorting;
    public function index(Request $request)
    {
        $filters = $this->getFilters($request);
        $this->authorize('viewAny', Role::class);
        $query = Role::query()
            ->search($filters['search']);

        $this->applySortingToQuery($query, $filters['sort_by'], $filters['sort_direction'], $this->getSortableFields());

        $roles = $query->paginate($filters['number_rows']);

        return Inertia::render('System/Users/Roles/Index', [
            'roles' => $roles,
            'permissions' => Permission::query()
                ->with('layerOnePermission')
                ->get()->groupBy('layer_one_permission_id')
        ]);
    }



    private function getSortableFields(): array
    {
        return [
            // Simple column sorting (clients table)
            'id' => $this->simpleSort('roles.id'),
            'name' => $this->simpleSort('roles.name'),

        ];
    }

    public function create()
    {
        $this->authorize('create', Role::class);
        return Inertia::render('System/Users/Roles/Form', [
            'roles' => Role::query()->with('permissions')->get(),
            'permissions' => Permission::query()
                ->with('layerOnePermission')
                ->get()->groupBy('layer_one_permission_id')
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => strtolower($request->name)]);

        $this->logCreated('Role ' . $role->name, $role->id);

        $role->syncPermissions(collect($request->permissions ?? [])->pluck('id'));

        // Assign the permissions to the user if the any user has the role
        $users = $role->users;
        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                $user->syncPermissions(collect($request->permissions ?? [])->pluck('id'));
            }
        }

        return redirect()->route('control.system.users.roles.index');
    }


    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        return Inertia::render('System/Users/Roles/Form', [
            'role' => $role->load('permissions'),
            'roles' => Role::query()->with('permissions')->get(),
            'permissions' => Permission::query()
                ->with('layerOnePermission')
                ->get()->groupBy('layer_one_permission_id')
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($role->id),
            ],
            'permissions' => 'array',
        ]);

        $role->update(['name' => strtolower($request->name)]);

        $this->logUpdated('Role ' . $role->name, $role->id);

        // Fix: Use permission names directly (not pluck('id') from strings)
        $role->syncPermissions($request->permissions ?? []);

        // Force refresh the relationship cache
        $role->load('permissions');

        // Assign the permissions to users who have this role
        $users = $role->users;
        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                // Get all permissions from all roles the user has
                $allUserPermissions = $user->getAllPermissionsViaRoles()->pluck('name')->toArray();
                $user->syncPermissions($allUserPermissions);
            }
        }

        return redirect()->route('control.system.users.roles.index');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $this->logDeleted('Role ' . $role->name, $role->id);

        $role->delete();

        return redirect()->back();
    }

    protected function getFilters(Request $request)
    {
        $filter = $request->query('filter', []);

        return collect([
            'search' => $filter['search'] ?? '',
            'number_rows' => $filter['number_rows'] ?? 10,
            'sort_by' => $filter['sort_by'] ?? 'id',
            'sort_direction' => $filter['sort_direction'] ?? 'desc',
        ]);
    }
}
