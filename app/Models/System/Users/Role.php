<?php

namespace App\Models\System\Users;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
