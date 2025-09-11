<?php

namespace App\Models\System\Settings\Reasons;

use Illuminate\Database\Eloquent\Model;
use App\Models\System\Resellers\Reseller;
use App\Models\System\Settings\System\SubscriptionStatusType;

class ResellerStatusHistory extends Model
{

    protected $guarded = [];
    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
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
