<?php

namespace App\Models\System\Settings\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaxClients extends Model
{
    use HasFactory;

    protected $fillable = ['max_clients','user_id'];
        public function scopeSearch($query, $search)
    {
        return $query->where('max_clients', 'like', "%$search%");
    }

}
