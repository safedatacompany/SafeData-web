<?php

namespace App\Models\System\Settings\Settings;

use App\Models\Traits\RangeScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Key extends Model
{
    use HasFactory, SoftDeletes, RangeScopes, LogsActivity;

    protected $fillable = [
        'key',
    ];

    public function translations()
    {
        return $this->hasMany(Translations::class, 'key_id');
    }
    
    public function scopeSearch($query, $search)
    {
        return $query->where('key', 'like', "%$search%");
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['key'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Translation Key {$eventName}");
    }
}
