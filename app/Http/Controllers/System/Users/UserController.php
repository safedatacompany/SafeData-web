<?php

namespace App\Http\Controllers\System\Users;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\System\Users\Role;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\System\Users\Permission;
use App\Models\System\Users\User;
use App\Traits\HandlesSorting;

class UserController extends Controller
{
    use HandlesSorting;
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $filters = $this->getFilters($request);

        $query = User::query()
            ->with('roles', 'permissions')
            ->withTrashed()
            ->search($filters['search']);

        $this->applySortingToQuery($query, $filters['sort_by'], $filters['sort_direction'], $this->getSortableFields());

        $users = $query->paginate($filters['number_rows']);
        return Inertia::render('System/Users/Users/Index', [
            'users' => $users,
            'filter' => $filters,
        ]);
    }

    private function getSortableFields(): array
    {
        return [
            // Simple column sorting
            'id' => $this->simpleSort('users.id'),
            'name' => $this->simpleSort('users.name'),
            'email' => $this->simpleSort('users.email'),

            // Related model sorting
            'roles.name' => $this->relatedSort(
                Role::class,
                'name',
                'id',
                'users.role_id'
            ),
        ];
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return Inertia::render('System/Users/Users/Form', [
            ...$this->options(),
        ]);
    }

    public function store(UserRequest $request)
    {

        $this->authorize('create', User::class);

        // $data = request()->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'phone' => 'required',
        //     'password' => 'required|min:8',
        //     'is_active' => 'required',
        //     'roles' => 'array',
        //     'permissions' => 'array',
        // ]);
        $data = $request->validated();

        // user_type has been removed from the system; no defaulting required

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $user->syncRoles(collect($data['roles'])->pluck('id'));
        $user->syncPermissions(collect($data['permissions'])->pluck('id'));

        return redirect()->route('control.system.users.index');
    }

    public function edit($user)
    {
        $this->authorize('update', User::class);

        $user = User::with('roles', 'permissions')->findOrFail($user);

        return Inertia::render('System/Users/Users/Form', [
            'user' => $user->load('roles', 'permissions'),
            ...$this->options(),
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        // Avatar handling
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar');
            $user->addMediaFromRequest('avatar')->preservingOriginal()->toMediaCollection('avatar');
        } elseif ($request->input('remove_avatar')) {
            $user->clearMediaCollection('avatar');
        }

        // Sync roles only if provided
        if (isset($data['roles'])) {
            $user->roles()->sync(collect($data['roles'])->pluck('id'));
        }

        // Sync permissions only if provided
        if (isset($data['permissions'])) {
            $user->permissions()->sync(collect($data['permissions'])->pluck('id'));
        }

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_avatar' => 'boolean'
        ]);

        $user = User::findOrFail(auth()->id());

        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar');
            $user->addMediaFromRequest('avatar')->preservingOriginal()->toMediaCollection('avatar');
        } elseif ($request->input('remove_avatar')) {
            $user->clearMediaCollection('avatar');
        }

        // Refresh the user to get the updated avatar URL
        $user->refresh();

        return redirect()->back()->with([
            'success' => 'Profile picture updated successfully.',
            'user' => $user->load('roles') // Include updated user data
        ]);
    }


    public function destroy($user)
    {
        $this->authorize('delete', User::class);

        $user = User::findOrFail($user);

        $user->delete();

        // return redirect()->route('control.system.users.index');
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $this->authorize('delete', $user);

        // Remove avatar media if exists
        try {
            $user->clearMediaCollection('avatar');
        } catch (\Exception $e) {
            // ignore media removal errors
        }

        $user->forceDelete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $this->authorize('restore', $user);

        $user->restore();

        return redirect()->back();
    }

    protected function options()
    {
        $roles = Role::query()
            ->with([
                'permissions' => function ($query) {
                    $query->select(['id', 'name']);
                },
            ])
            ->get();
        $permission_groups = Permission::query()
            ->select(['id', 'name', 'group_permission_id'])
            ->with(['groupPermissions:id,name'])
            ->get()
            ->groupBy(function ($permission) {
                return $permission->groupPermissions->name ?? 'Uncategorized';
            });

        return [
            'roles' => $roles,
            'permission_groups' => $permission_groups,
        ];
    }
}

