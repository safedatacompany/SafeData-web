<?php

namespace App\Models\System\Settings\System;

use App\Models\System\Users\User;
use App\Models\Traits\RangeScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class UserType extends Model
{
    use HasFactory, SoftDeletes, RangeScopes, LogsActivity;
    
    protected $guarded = [];

    protected $appends = ['users_count'];
    
    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'description', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "User Type {$eventName}");
    }
}
