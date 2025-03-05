<?php

namespace App\Http\Controllers\Pages\Frontend;

use App\Models\Pages\Client;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $clients = Client::query()->get();

        // dd($clients);

        return inertia('Frontend/Home', [
            'clients' => $clients,
        ]);
    }
}
