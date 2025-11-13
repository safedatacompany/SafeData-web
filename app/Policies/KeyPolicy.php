<?php

namespace App\Policies;

use  App\Models\System\Users\User;

use App\Models\System\Settings\Settings\Key;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_keys');
    }
    public function view(User $user, Key $key)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_keys');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_keys');
    }

    public function update(User $user, Key $fontSize)
    {
        return $user->hasDirectPermission('edit_keys');
    }

    public function delete(User $user, Key $fontSize)
    {
        return $user->hasDirectPermission('delete_keys');
    }

    public function restore(User $user, Key $fontSize)
    {
        return $user->hasDirectPermission('delete_keys');
    }
}
