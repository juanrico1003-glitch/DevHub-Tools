<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToolUsage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // --- STATS CARDS ---
        $totalConversions = ToolUsage::count();
        $totalUsersRegistered = User::count();
        $conversionsToday = ToolUsage::whereDate('created_at', today())->count();
        $conversionsThisWeek = ToolUsage::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        // --- TOP USERS (only those who are logged in) ---
        $topUsers = ToolUsage::select('user_id', DB::raw('count(*) as total'))
            ->whereNotNull('user_id')
            ->with('user:id,name,email')
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // --- MOST USED LANGUAGES (parse tool_name "AI Converter: X to Y") ---
        $topLanguages = ToolUsage::select('tool_name', DB::raw('count(*) as total'))
            ->groupBy('tool_name')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get()
            ->map(function ($item) {
                // Parse "AI Converter: SQL to Laravel Eloquent" → "SQL → Eloquent"
                preg_match('/AI Converter: (.+) to (.+)/', $item->tool_name, $matches);
                $item->label = isset($matches[1]) ? "{$matches[1]} → {$matches[2]}" : $item->tool_name;
                return $item;
            });

        // --- DAILY TRAFFIC (last 14 days) ---
        $dailyTraffic = ToolUsage::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(14))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // --- LATEST ACTIVITY ---
        $latestActivity = ToolUsage::with('user:id,name,email')
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        return view('admin.dashboard', compact(
            'totalConversions',
            'totalUsersRegistered',
            'conversionsToday',
            'conversionsThisWeek',
            'topUsers',
            'topLanguages',
            'dailyTraffic',
            'latestActivity'
        ));
    }
}
