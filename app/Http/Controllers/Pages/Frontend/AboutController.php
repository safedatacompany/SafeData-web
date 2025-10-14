<?php

namespace App\Http\Controllers\Pages\Frontend;

use App\Models\Pages\Client;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $services = Service::query()->get();
        $clients = Client::query()->get();
        $products = Product::query()->get();
        $hosting = Hosting::query()->get();

        // dd($services, $clients, $products, $hosting);

        return inertia('Frontend/Pages/About/Index', [
            'clients' => $clients,
            'services' => $services,
            'products' => $products,
            'hosting' => $hosting,
        ]);
    }
}
