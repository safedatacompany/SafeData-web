<?php

namespace App\Models\System\Settings\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaxUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'max_users';

    protected $fillable = ['max_user', 'user_id'];

    public function scopeSearch($query, $search)
    {
        return $query->where('max_user', 'like', "%$search%");
    }
}
