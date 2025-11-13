<?php

namespace App\Policies;

use  App\Models\System\Users\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\System\Settings\Settings\Translations;

class TranslationsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_translations');
    }
    public function view(User $user, Translations $translations)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_translations');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_translations');
    }

    public function update(User $user, Translations $translations)
    {
        return $user->hasDirectPermission('edit_translations');
    }

    public function delete(User $user, Translations $translations)
    {
        return $user->hasDirectPermission('delete_translations');
    }

    public function restore(User $user, Translations $translations)
    {
        return $user->hasDirectPermission('delete_translations');
    }
}
