<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Branch extends Model
{
    use HasFactory, SoftDeletes, HasTranslations, LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'color',
        'phone',
        'email',
        'address',
        'map_url',
        'order',
        'is_active',
    ];

    public $translatable = [
        'name',
        'description',
        'address',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all news for this branch.
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }

    /**
     * Get all campuses for this branch.
     */
    public function campuses()
    {
        return $this->hasMany(Campus::class);
    }

    /**
     * Get all classrooms for this branch.
     */
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    /**
     * Scope a query to only include active branches.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by the order column.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'description', 'logo', 'color', 'phone', 'email', 'address', 'map_url', 'order', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Branch {$eventName}");
    }
}
