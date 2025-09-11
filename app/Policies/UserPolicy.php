<?php

namespace App\Policies;

use App\Models\System\Users\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('view_users');
    }

    public function view(User $user)
    {
        return $user->hasPermissionTo('view_users');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create_users');
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo('edit_users');
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo('delete_users');
    }

    public function restore(User $user)
    {
        //
    }

    public function forceDelete(User $user)
    {
        //
    }
}
