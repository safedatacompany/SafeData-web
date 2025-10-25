<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CalendarEvent extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'event_type',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'location',
        'color',
        'is_recurring',
        'recurring_pattern',
        'metadata',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_recurring' => 'boolean',
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that created this event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include active events.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by event type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('event_type', $type);
    }

    /**
     * Scope a query to get upcoming events.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', Carbon::today());
    }

    /**
     * Scope a query to get events in a date range.
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate])
                ->orWhere(function ($q2) use ($startDate, $endDate) {
                    $q2->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $endDate);
                });
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'description', 'event_type', 'start_date', 'end_date', 'start_time', 'end_time', 'location', 'color', 'is_recurring', 'recurring_pattern', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Calendar Event {$eventName}");
    }
}
