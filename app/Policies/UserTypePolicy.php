<?php

namespace App\Policies;

use App\Models\System\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserTypePolicy
{
    use HandlesAuthorization;

    // Deprecated policy: user types removed. Deny all by default.
    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, $model)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, $model)
    {
        return false;
    }

    public function delete(User $user, $model)
    {
        return false;
    }

    public function restore(User $user, $model)
    {
        return false;
    }
}
