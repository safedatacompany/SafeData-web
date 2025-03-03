<?php

namespace App\Models\Traits;

trait ClientScopes
{
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
