<?php

namespace App\Models\System\Settings\Reasons;

use App\Models\System\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'action',
        'row_id',
        'user_id',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function scopeSearch($query, $search)
    {
        return $query->where('action', 'like', "%$search%");
    }
}
