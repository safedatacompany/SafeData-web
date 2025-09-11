<?php

namespace App\Enums;

enum Reasons: string
{

    case DELETED_REASON = 'Item deleted by user.';
    case CREATED_REASON = 'Item created by user.';
    case UPDATED_REASON = 'Item updated by user.';
    case VIEWED_REASON = 'Item viewed by user.';
}