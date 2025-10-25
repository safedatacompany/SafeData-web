<?php

namespace App\Models\System\Settings\System;


use App\Models\System\Users\Permission;
use App\Models\Traits\RangeScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class GroupPermission extends Model
{
    use HasFactory, SoftDeletes, RangeScopes, LogsActivity;

    protected $fillable = ['name', 'slug', 'description', 'user_id'];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'group_permission_id', 'id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'description', 'user_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Group Permission {$eventName}");
    }
}
