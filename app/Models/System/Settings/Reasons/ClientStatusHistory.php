<?php

namespace App\Models\System\Settings\Reasons;

use App\Models\System\Clients\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\Settings\System\SubscriptionStatusType;

class ClientStatusHistory extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function beforeStatus()
    {
        return $this->belongsTo(SubscriptionStatusType::class, 'before_status_id');
    }

    public function afterStatus()
    {
        return $this->belongsTo(SubscriptionStatusType::class, 'after_status_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('note', 'like', "%$search%");
    }
}
