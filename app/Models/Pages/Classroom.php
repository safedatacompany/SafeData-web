<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;
use App\Models\Traits\ClassroomScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations, ClassroomScopes;

    public $translatable = ['name', 'description', 'full_description', 'location'];

    protected $fillable = [
        'user_id',
        'branch_id',
        'name',
        'slug',
        'description',
        'full_description',
        'classroom_type',
        'location',
        'building',
        'floor',
        'room_number',
        'capacity',
        'equipment',
        'features',
        'schedule',
        'metadata',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'equipment' => 'array',
        'features' => 'array',
        'schedule' => 'array',
        'metadata' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $appends = ['featured_image_url', 'gallery_images', 'floor_plan_url'];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($classroom) {
            if (empty($classroom->slug)) {
                $name = is_array($classroom->name) ? ($classroom->name['en'] ?? reset($classroom->name)) : $classroom->name;
                $classroom->slug = Str::slug($name);
            }
        });

        static::updating(function ($classroom) {
            if ($classroom->isDirty('name') && empty($classroom->slug)) {
                $name = is_array($classroom->name) ? ($classroom->name['en'] ?? reset($classroom->name)) : $classroom->name;
                $classroom->slug = Str::slug($name);
            }
        });
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp']);

        $this->addMediaCollection('floor_plan')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg', 'application/pdf']);

        $this->addMediaCollection('documents')
            ->acceptsMimeTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
    }

    /**
     * Register media conversions.
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(800)
            ->height(600)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(900)
            ->sharpen(10)
            ->nonQueued();
    }

    /**
     * Get the user that created this classroom.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the branch for this classroom.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Scope a query to only include active classrooms.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured classrooms.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by classroom type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('classroom_type', $type);
    }

    /**
     * Scope a query to filter by branch.
     */
    public function scopeOfBranch($query, $branchId)
    {
        if ($branchId) {
            return $query->where('branch_id', $branchId);
        }
        return $query;
    }

    /**
     * Scope a query to order by the order column.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Get the featured image URL.
     */
    public function getFeaturedImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('featured_image');
    }

    /**
     * Get all gallery images.
     */
    public function getGalleryImagesAttribute()
    {
        return $this->getMedia('gallery')->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->getUrl(),
                'thumb' => $media->getUrl('thumb'),
            ];
        });
    }

    /**
     * Get the floor plan URL.
     */
    public function getFloorPlanUrlAttribute()
    {
        return $this->getFirstMediaUrl('floor_plan');
    }
}
