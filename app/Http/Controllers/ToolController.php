<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ToolUsage;
use Illuminate\Support\Facades\Auth;

class ToolController extends Controller
{
    public function index()
    {
        return view('tools.dashboard');
    }

    public function sqlToEloquent()
    {
        return view('tools.sql-to-eloquent');
    }

    public function jsonFormatter()
    {
        return view('tools.json-formatter');
    }

    public function routeGenerator()
    {
        return view('tools.route-generator');
    }

    public function history()
    {
        $histories = ToolUsage::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            
        return view('history', compact('histories'));
    }
}
