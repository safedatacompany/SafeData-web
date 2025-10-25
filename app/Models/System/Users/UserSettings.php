<?php

namespace App\Models\System\Users;

use App\Models\System\Settings\Settings\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class UserSettings extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_id',
        'font_scale',
        'font_weight',
        'theme',
        'language_id',
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['font_scale', 'font_weight', 'theme', 'language_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "User Settings {$eventName}");
    }
}
