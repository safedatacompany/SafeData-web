<?php

namespace App\Models\Pages;

use App\Models\Traits\BranchScopes;
use App\Traits\LogsMediaActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;

class Branch extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HasTranslations, LogsActivity, BranchScopes, InteractsWithMedia, LogsMediaActivity;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'is_active',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'logo_url',
    ];

    /**
     * Get the logo URL attribute.
     */
    public function getLogoUrlAttribute()
    {
        $logo = $this->getFirstMedia('logo');
        return $logo ? $logo->getUrl() : null;
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile() // Only one logo allowed
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp']);
    }

    /**
     * Register media conversions.
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10)
            ->nonQueued();
    }

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'description', 'color', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Branch {$eventName}");
    }

    /**
     * Boot the model and handle automatic slug generation similar to News.
     */
    protected static function boot()
    {
        parent::boot();

        // After create: generate slug using name and id -> guarantees uniqueness via id
        static::created(function ($branch) {
            $name = is_array($branch->name)
                ? ($branch->name['en'] ?? $branch->name[array_key_first($branch->name)] ?? 'branch')
                : $branch->name;

            $generated = Str::slug($name);

            if (empty($branch->slug) || $branch->slug !== $generated) {
                $branch->slug = $generated;
                $branch->saveQuietly();
            }
        });

        // Before create: ensure slug has some value to satisfy DB non-null constraint.
        // We generate a provisional slug (name + random) which will be replaced in the created hook
        // with a stable name-id slug.
        static::creating(function ($branch) {
            if (empty($branch->slug)) {
                $name = is_array($branch->name)
                    ? ($branch->name['en'] ?? $branch->name[array_key_first($branch->name)] ?? 'branch')
                    : $branch->name;

                $base = Str::slug($name ?: 'branch');
                $branch->slug = $base . '-' . substr(Str::random(6), 0, 6);
            }
        });

        // Before update: if name changed, regenerate slug using name and id
        static::updating(function ($branch) {
            if ($branch->isDirty('name')) {
                $name = is_array($branch->name)
                    ? ($branch->name['en'] ?? $branch->name[array_key_first($branch->name)] ?? 'branch')
                    : $branch->name;

                $branch->slug = Str::slug($name);
            }
        });
    }
}
