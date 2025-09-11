<?php

namespace App\Models\System\Settings\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Storage extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['storage_number', 'user_id'];

    public function scopeSearch($query, $search)
    {
        return $query->where('storage_number', 'like', "%$search%");
    }
}
