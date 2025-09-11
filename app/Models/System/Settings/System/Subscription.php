<?php

namespace App\Models\System\Settings\System;

use App\Models\System\Users\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\System\Resellers\Reseller;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\System\Settings\System\SubscriptionStatusType;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['start_date', 'end_date', 'user_amount', 'client_amount', 'reseller_id', 'subscription_status_type_id', 'storage_amount', 'user_id'];

    public function statusType()
    {
        return $this->belongsTo(SubscriptionStatusType::class, 'subscription_status_type_id');
    }
    public function reseller()
    {
        return $this->belongsTo(Reseller::class, 'reseller_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
