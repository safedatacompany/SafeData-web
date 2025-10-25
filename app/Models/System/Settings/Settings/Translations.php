<?php

namespace App\Models\System\Settings\Settings;

use App\Models\Traits\RangeScopes;
use Illuminate\Database\Eloquent\Model;
use App\Models\System\Settings\Settings\Key;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\Settings\Settings\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Translations extends Model
{
    use HasFactory, SoftDeletes, RangeScopes, LogsActivity;

    protected $fillable = ['key_id', 'value', 'language_id'];

    public function keys()
    {
        return $this->belongsTo(Key::class, 'key_id');
    }

    public function languages()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('value', 'like', "%$search%");
    }
    
    public function scopeSearchByLanguage($query, $languageId)
    {
        if($languageId === null || $languageId === []){
            return $query;
        }
        return $query->where('language_id', $languageId);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['key_id', 'value', 'language_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Translation {$eventName}");
    }
}
 