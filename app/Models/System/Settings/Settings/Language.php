<?php

namespace App\Models\System\Settings\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Models\System\Users\UserSettings;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','slug', 'direction'];

    protected $appends = ['can_be_deleted'];

    public function getCanBeDeletedAttribute()
    {
        return $this->can_be_deleted();
    }

    // A language can be deleted if no user is using it in their settings
    public function can_be_deleted()
    {
        return $this->user_setting()->exists() ? false : true;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($language) {
            // Soft delete all related translations when language is soft deleted
            $language->translations()->delete();
        });
    }

    public function translations()
    {
        return $this->hasMany(Translations::class);
    }



    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }

    public function user_setting()
    {
        return $this->hasMany(UserSettings::class);
    }

}
