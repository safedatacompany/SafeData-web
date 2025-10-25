<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Hashtag extends Model
{
    use HasFactory, SoftDeletes, HasTranslations, LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'usage_count',
        'is_active',
    ];

    public $translatable = [
        'name',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all news articles with this hashtag
     */
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_hashtag');
    }

    /**
     * Increment the usage count
     */
    public function incrementUsage()
    {
        $this->increment('usage_count');
    }

    /**
     * Decrement the usage count
     */
    public function decrementUsage()
    {
        $this->decrement('usage_count');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'usage_count', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Hashtag {$eventName}");
    }
}
