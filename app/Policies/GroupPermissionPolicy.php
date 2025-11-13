<?php

namespace App\Policies;


use  App\Models\System\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\System\Settings\System\GroupPermission;

class GroupPermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_group_permissions');
    }
    public function view(User $user, GroupPermission $permissions)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_group_permissions');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_group_permissions');
    }

    public function update(User $user, GroupPermission $permissions)
    {
        return $user->hasDirectPermission('edit_group_permissions');
    }

    public function delete(User $user, GroupPermission $permissions)
    {
        return $user->hasDirectPermission('delete_group_permissions');
    }

    public function restore(User $user, GroupPermission $permissions)
    {
        return $user->hasDirectPermission('delete_group_permissions');
    }
}
