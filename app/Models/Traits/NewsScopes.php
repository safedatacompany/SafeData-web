<?php

namespace App\Models\Traits;

trait NewsScopes
{
    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where(function ($query) use ($search) {
            $query->where('title->en', 'like', "%$search%")
                ->orWhere('title->ckb', 'like', "%$search%")
                ->orWhere('content->en', 'like', "%$search%")
                ->orWhere('content->ckb', 'like', "%$search%")
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name->en', 'like', "%$search%")
                        ->orWhere('name->ckb', 'like', "%$search%");
                })
                ->orWhereHas('hashtags', function ($q) use ($search) {
                    $q->where('name->en', 'like', "%$search%")
                        ->orWhere('name->ckb', 'like', "%$search%");
                });
        });
    }
}
