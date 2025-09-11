<?php

namespace App\Models\System\Settings\System;

use App\Models\System\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\Settings\System\Subscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\System\Settings\Reasons\ClientStatusHistory;

class SubscriptionStatusType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'code', 'user_id'];

    protected $appends = ['subscriptions_count'];
    
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function beforeHistories()
    {
        return $this->hasMany(ClientStatusHistory::class, 'before_status_id');
    }

    public function afterHistories()
    {
        return $this->hasMany(ClientStatusHistory::class, 'after_status_id');
    }

    public function getSubscriptionsCountAttribute()
    {
        return $this->subscriptions()->count();
    }
    
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
