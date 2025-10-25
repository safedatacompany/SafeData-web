<?php

namespace App\Models\System\Users;

use App\Models\System\Settings\System\GroupPermission;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Permission extends SpatiePermission
{
    use LogsActivity;
    protected $fillable = [
        'name',
        'guard_name',
        'group_permission_id',
    ];

    public function groupPermissions()
    {
        return $this->belongsTo(GroupPermission::class, 'group_permission_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'guard_name', 'group_permission_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Permission {$eventName}");
    }
}
