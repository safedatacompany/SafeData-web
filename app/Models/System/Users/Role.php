<?php

namespace App\Models\System\Users;

use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Role extends SpatieRole
{
    use LogsActivity;
    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'guard_name'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Role {$eventName}");
    }
}
