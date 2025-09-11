<?php

namespace App\Models\System\Settings\System;


use App\Models\System\Clients\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\System\Settings\System\LayerOnePermission;


class LayerOneGroupNamePermissions extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'user_id', 'description'];

    public function permissions()
    {
        return $this->hasMany(LayerOnePermission::class, 'layer_one_group_id', 'id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_permissions', 'package_id', 'layer_one_group_name_permission_id');
    }
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")->orWhere('description', 'like', "%$search%");
    }
}
