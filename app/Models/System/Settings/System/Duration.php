<?php

namespace App\Models\System\Settings\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Duration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['duration_number', 'user_id'];

    public function scopeSearch($query, $search)
    {
        return $query->where('duration_number', 'like', "%$search%");
    }
}
