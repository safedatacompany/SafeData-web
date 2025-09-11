<?php

namespace App\Enums;

enum Reasons: string
{
    case EXPIRE_REASON = 'Status changed: Active → Expired (automatically by the system).';
    case ACTIVE_REASON = 'Status set to Active (automatically by the system).';

    
}
