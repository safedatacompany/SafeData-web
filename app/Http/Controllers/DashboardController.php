<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;

use App\Models\Pages\Client;
use App\Models\Analytics\Visitor;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;
use App\Models\System\Users\Role;
use App\Models\System\Users\User;
use Illuminate\Support\Facades\DB;
use App\Models\System\Settings\Settings\Language;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $totalRoles = Role::count();
        $totalClients = Client::count();

        // Languages
        $totalLanguages = Language::count();

        // Get recent visitors (last 30 days)
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $totalVisitors = Visitor::where('created_at', '>=', $thirtyDaysAgo)->count();
        $uniqueVisitors = Visitor::where('created_at', '>=', $thirtyDaysAgo)
            ->distinct('ip_address')
            ->count('ip_address');

        // Visitors trend (last 7 days)
        $visitorsTrend = Visitor::where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('count')
            ->toArray();

        // Get visitors by device type
        $visitorsByDevice = Visitor::where('created_at', '>=', $thirtyDaysAgo)
            ->select('device_type', DB::raw('count(*) as count'))
            ->groupBy('device_type')
            ->get();

        // Recent users (last 5)
        $recentUsers = User::orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_active' => $user->is_active,
                    'created_at' => $user->created_at->format('Y-m-d H:i'),
                ];
            });

        $recentClients = Client::orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'created_at' => $user->created_at->format('Y-m-d H:i'),
                ];
            });

        // Popular content (by views)
        $popularHosting = Hosting::where('popular', true)
            ->take(5)
            ->get()
            ->map(function ($hosting) {
                return [
                    'id' => $hosting->id,
                    'name' => $hosting->name,
                ];
            });


        // Monthly data for chart (last 12 months)
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyData[] = [
                'month' => $date->format('M'),
                'users' => User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'visitors' => Visitor::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }

        return Inertia::render('Dashboard', [
            'stats' => [
                'users' => [
                    'total' => $totalUsers,
                    'active' => $activeUsers,
                ],
                'clients' => $totalClients,
                'roles' => $totalRoles,
                'languages' => $totalLanguages,
                'visitors' => [
                    'total' => $totalVisitors,
                    'unique' => $uniqueVisitors,
                    'trend' => $visitorsTrend,
                ],
            ],
            'visitorsByDevice' => $visitorsByDevice->isEmpty() ? [] : $visitorsByDevice,
            'recentClients' => $recentClients,
            'popularHosting' => $popularHosting,
            'recentUsers' => $recentUsers,
            'monthlyData' => $monthlyData,
        ]);
    }
}
