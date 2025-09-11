<?php

namespace App\Models\System\Settings\System;

use App\Models\System\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserType extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];


    protected $appends = ['users_count'];
    
    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }

    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
