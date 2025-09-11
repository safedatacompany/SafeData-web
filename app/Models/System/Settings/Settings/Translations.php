<?php

namespace App\Models\System\Settings\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Models\System\Settings\Settings\Key;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\Settings\Settings\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Translations extends Model
{
    use HasFactory,SoftDeletes;
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
}
 