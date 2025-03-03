<?php

namespace App\Models\Pages;

use App\Models\Traits\ClientScopes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, ClientScopes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = ['logo']; // Ensure logo is included in JSON

    public function getLogoAttribute()
    {
        return $this->getFirstMediaUrl('logo');
    }
}
