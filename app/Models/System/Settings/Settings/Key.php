<?php

namespace App\Models\System\Settings\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Key extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'key',
    ];
    public function translations()
    {
        return $this->hasMany(Translations::class, 'key_id');
    }
    public function scopeSearch($query, $search)
    {
        return $query->where('key', 'like', "%$search%");
    }
}
