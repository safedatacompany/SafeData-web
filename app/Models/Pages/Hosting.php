<?php

namespace App\Models\Pages;

use App\Models\Traits\HostingScopes;
use App\Models\System\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hosting extends Model
{
    use HasFactory, SoftDeletes, HostingScopes;

    protected $fillable = [
        'name',
        'description',
        'popular',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
