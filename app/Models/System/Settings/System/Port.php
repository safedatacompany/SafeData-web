<?php

namespace App\Models\System\Settings\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Port extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['port', 'user_id'];

    public function scopeSearch($query, $search)
    {
        return $query->where('port', 'like', "%$search%");
    }
}
