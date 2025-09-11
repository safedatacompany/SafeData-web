<?php

namespace App\Models\System\Settings\System;

use App\Models\System\Clients\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ClientDatabase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'username', 'password', 'port', 'type', 'client_id', 'user_id'];

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
