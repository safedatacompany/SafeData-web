<?php

namespace App\Http\Controllers\System\Settings\Settings;

use App\Http\Controllers\Controller;

class UserTypeController extends Controller
{
    // Deprecated: user types removed from the system.
    // If this controller is accidentally invoked, return 404 for safety.
    public function __call($method, $parameters)
    {
        abort(404);
    }
}

