<?php

namespace App\Models\System\Settings\Settings;

use App\Models\Traits\RangeScopes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Theme extends Model
{
    use RangeScopes, LogsActivity;
    
    protected $guarded = [];
    
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")
                     ->orWhere('slug', 'like', "%$search%");
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Theme {$eventName}");
    }
}
