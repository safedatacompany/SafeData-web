<?php

namespace App\Models\System\Settings\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\System\Settings\System\SubscriptionStatusType;
use App\Models\System\Settings\System\ClientSubscriptionStatusTypes;

class ClientSubscription extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'client_id',
        'start_date',
        'end_date',
        'user_amount',
        'storage_amount',
        'reseller_id',
        'subscription_status_type_id',
        'client_subscription_status_type_id',
    ];
    
    public function statusType()
    {
        return $this->belongsTo(SubscriptionStatusType::class, 'subscription_status_type_id');

    }
    public function ClientStatusType()
    {
        return $this->belongsTo(ClientSubscriptionStatusTypes::class, 'client_subscription_status_type_id');

    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    
    
}
