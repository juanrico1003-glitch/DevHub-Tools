<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToolUsage;
use Illuminate\Support\Facades\Auth;

class ToolUsageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tool_name' => 'required|string|max:255',
            'input_data' => 'required|string',
        ]);

        $usage = ToolUsage::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'tool_name' => $validated['tool_name'],
            'input_data' => $validated['input_data'],
        ]);

        return response()->json([
            'success' => true,
            'data' => $usage
        ]);
    }
}
