<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;
use App\Models\Traits\CampusScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Campus extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations, CampusScopes;

    public $translatable = ['name', 'description', 'full_description', 'location', 'address'];

    protected $fillable = [
        'user_id',
        'branch_id',
        'name',
        'slug',
        'description',
        'full_description',
        'location',
        'address',
        'phone',
        'email',
        'map_url',
        'facilities',
        'metadata',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'facilities' => 'array',
        'metadata' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $appends = ['featured_image_url', 'gallery_images'];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($campus) {
            if (empty($campus->slug)) {
                // Get English name for slug, fallback to first available language
                $name = is_array($campus->name) 
                    ? ($campus->name['en'] ?? reset($campus->name)) 
                    : $campus->name;
                $campus->slug = Str::slug($name);
            }
        });

        static::updating(function ($campus) {
            if ($campus->isDirty('name') && empty($campus->slug)) {
                $name = is_array($campus->name) 
                    ? ($campus->name['en'] ?? reset($campus->name)) 
                    : $campus->name;
                $campus->slug = Str::slug($name);
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
     * Get the user that created this campus.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the branch for this campus.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Scope a query to only include active campuses.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured campuses.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
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
}
