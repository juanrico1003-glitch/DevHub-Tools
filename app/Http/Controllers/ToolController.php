<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToolUsage;
use Illuminate\Support\Facades\Auth;

class ToolController extends Controller
{
    public function universalConverter()
    {
        return view('tools.universal-converter');
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
