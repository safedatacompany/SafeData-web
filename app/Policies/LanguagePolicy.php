<?php

namespace App\Policies;

use  App\Models\System\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\System\Settings\Settings\Language;

class LanguagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_languages');
    }
    public function view(User $user, Language $language)
    {
        return $user->hasRole('super_admin') || $user->hasDirectPermission('view_languages');
    }

    public function create(User $user)
    {
        return $user->hasDirectPermission('create_languages');
    }

    public function update(User $user, Language $language)
    {
        return $user->hasDirectPermission('edit_languages');
    }

    public function delete(User $user, Language $language)
    {
        return $user->hasDirectPermission('delete_languages');
    }

    public function restore(User $user, Language $language)
    {
        return $user->hasDirectPermission('restore_languages');
    }
}
