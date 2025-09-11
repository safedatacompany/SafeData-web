<?php

namespace App\Http\Controllers\System\Users;

use Inertia\Inertia;

use Illuminate\Http\Request;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Models\System\Users\Permission;
use App\Traits\HandlesSorting;
use App\Http\Requests\LayerTwoPermissionRequest;
use App\Traits\LogsActivity;
use App\Models\System\Settings\System\LayerOnePermission;


class PermissionController extends Controller
{
    use LogsActivity, HandlesSorting;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Permission::class);

        $filters = $this->getFilters($request);

        $query = Permission::query()
            ->with('layerOnePermission')
            ->search($filters['search']);

        $this->applySortingToQuery($query, $filters['sort_by'], $filters['sort_direction'], $this->getSortableFields());

        $permissions = $query->paginate($filters['number_rows']);

        $layerOnePermissions = LayerOnePermission::query()->select('id', 'name','layer_one_group_id')->get();
        return Inertia::render('System/Users/Permissions/Index', [
            'permissions' => $permissions,
            'layerOnePermissions' => $layerOnePermissions,
            'filter' => $filters,
        ]);
    }


    private function getSortableFields(): array
    {
        return [
            // Simple column sorting (clients table)
            'id' => $this->simpleSort('permissions.id'),
            'name' => $this->simpleSort('permissions.name'),

            // Related model sorting (package belongsTo)
            'layerOnePermission.name' => $this->relatedSort(
                LayerOnePermission::class,
                'name',
                'layer_one_permissions.id',
                'layer_one_permissions.layer_one_group_id'
            ),

        ];
    }

    public function store(LayerTwoPermissionRequest $request)
    {
        // Todo:: Check if the user has permission to create permissions
        $this->authorize('create', Permission::class);
        $data = $request->validated();

        $permissionName = PermissionHelper::makePermissionName($data['name'], $data['layer_one_permission_id']);

        $permission = Permission::create([
            'name' => $permissionName,
            'guard_name' => 'web', // Default guard
            'layer_one_permission_id' => $data['layer_one_permission_id'],
        ]);

        $this->logCreated('Permission ' . $permissionName, $permission->id);

        return redirect()->back();
    }

    public function update(LayerTwoPermissionRequest $request, Permission $permission)
    {
        // Todo:: Check if the user has permission to update permissions

        $this->authorize('update', $permission);
        $data = $request->validated();

        $permissionName = PermissionHelper::makePermissionName($data['name'], $data['layer_one_permission_id']);

        $permission->update([
            'name' => $permissionName,
            'layer_one_permission_id' => $data['layer_one_permission_id'],
        ]);
        $this->logUpdated('Permission ' . $permissionName, $permission->id);
        return redirect()->back();
    }

    public function destroy(Permission $permission)
    {
        // Todo:: Check if the user has permission to delete permissions

        $this->authorize('delete', $permission);

        $this->logDeleted('Permission ' . $permission->name, $permission->id);

        $permission->delete();

        return redirect()->back();
    }
}
