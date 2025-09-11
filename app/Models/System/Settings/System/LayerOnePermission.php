<?php

namespace App\Models\System\Settings\System;


use App\Models\System\Clients\Package;
use App\Models\System\Users\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\System\Settings\System\LayerOneGroupNamePermissions;

class LayerOnePermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'layer_one_group_id', 'user_id'];

    public function layer_one_group_name_permissions()
    {
        return $this->belongsTo(LayerOneGroupNamePermissions::class, 'layer_one_group_id', 'id');
    }
    // public function group_name()
    // {
    //     return $this->belongsTo(LayerOneGroupNamePermissions::class, 'layer_one_group_id');
    // }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'layer_one_permission_id', 'id');
    }

    // public function packages()
    // {
    //     return $this->belongsToMany(Package::class, 'package_permissions', 'package_id', 'layer_one_permission_id');
    // }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
