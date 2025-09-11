<?php

namespace App\Models\System\Settings\Settings;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $guarded = [];
    
    public function scopeSearch($query, $search)
    {
        return $query->where('theme', 'like', "%$search%");
    }
}
