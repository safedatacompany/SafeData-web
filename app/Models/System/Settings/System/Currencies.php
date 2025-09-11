<?php

namespace App\Models\System\Settings\System;

use App\Models\System\Users\User;
use App\Models\Traits\CurrencyScope;
use App\Models\System\Clients\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currencies extends Model
{
    use HasFactory, SoftDeletes, CurrencyScope;
    protected $fillable = [
        'name',
        'slug',
        'symbol',
        'abbreviation',
        'hundredth_name',
        'country',
        'active',
        'user_id'
    ];

    public function clients()
    {
        return $this->hasMany(Client::class,'currency_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
