<?php

namespace App\Policies;

use  App\Models\System\Users\User;

use App\Models\System\Settings\Settings\Theme;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThemesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_themes');
    }
    public function view(User $user, Theme $theme)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_themes');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_themes');
    }

    public function update(User $user, Theme $theme)
    {
        return $user->hasDirectPermission('edit_themes');
    }

    public function delete(User $user, Theme $theme)
    {
        return $user->hasDirectPermission('delete_themes');
    }

    public function restore(User $user, Theme $theme)
    {
        return $user->hasDirectPermission('delete_themes');
    }
}
