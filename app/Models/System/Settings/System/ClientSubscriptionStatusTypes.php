<?php

namespace App\Models\System\Settings\System;

use App\Models\System\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\System\Settings\System\ClientSubscription;

class ClientSubscriptionStatusTypes extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name','slug','code', 'user_id'];

    protected $appends = ['subscriptions_count'];

    public function getSubscriptionsCountAttribute()
    {
        return $this->subscriptions()->count();
    }

    public function subscriptions()
    {
        return $this->hasMany(ClientSubscription::class, 'client_subscription_status_type_id');
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
