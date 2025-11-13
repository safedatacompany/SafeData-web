<?php

namespace App\Policies;

use  App\Models\System\Users\User;


use App\Models\System\Users\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_permissions');
    }
    public function view(User $user, Permission $permissions)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_permissions');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_permissions');
    }

    public function update(User $user, Permission $permissions)
    {
        return $user->hasDirectPermission('edit_permissions');
    }

    public function delete(User $user, Permission $permissions)
    {
        return $user->hasDirectPermission('delete_permissions');
    }

    public function restore(User $user, Permission $permissions)
    {
        return $user->hasDirectPermission('delete_permissions');
    }
}
