<?php

namespace App\Models\System\Users;


use App\Models\System\Settings\System\LayerOnePermission;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $fillable = [
        'name',
        'guard_name',
        'group',
        'layer_one_permission_id'
    ];

    public function layerOnePermission()
    {
        return $this->belongsTo(LayerOnePermission::class, 'layer_one_permission_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
