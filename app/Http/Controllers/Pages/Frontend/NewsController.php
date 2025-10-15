<?php

namespace App\Http\Controllers\Pages\Frontend;

use App\Models\Pages\Client;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $services = Service::query()->get();
        $clients = Client::query()->get();
        $products = Product::query()->get();
        $hosting = Hosting::query()->get();

        // dd($services, $clients, $products, $hosting);

        return inertia('Frontend/Pages/News/Index', [
            'clients' => $clients,
            'services' => $services,
            'products' => $products,
            'hosting' => $hosting,
        ]);
    }

    public function show($slug)
    {
        return inertia('Frontend/Pages/News/Show', [
            'news' => (object)[
                'id' => 1,
                'title' => 'New Campus Opening',
                'description' => 'We are excited to announce the opening of our new campus in the heart of the city. This state-of-the-art facility is designed to provide students with a modern and inspiring learning environment. The new campus features advanced classrooms, science labs, a library, sports facilities, and more. We look forward to welcoming students and staff to this new chapter in our school\'s history.',
                'date' => '2025-05-17',
                'location' => 'Sulaymaniyah',
                'hashtag' => '#campus',
                'image' => '/img/news/1.jpg',
            ],
        ]);
    }
}
