<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CodeConverterService;
use App\Models\ToolUsage;
use Illuminate\Support\Facades\Auth;
use Exception;

class CodeConverterController extends Controller
{
    protected CodeConverterService $converterService;

    public function __construct(CodeConverterService $converterService)
    {
        $this->converterService = $converterService;
    }

    public function convert(Request $request)
    {
        $validated = $request->validate([
            'source_code' => 'required|string',
            'source_type' => 'required|string|max:50',
            'target_type' => 'required|string|max:50',
        ]);

        try {
            $convertedCode = $this->converterService->convert(
                $validated['source_code'],
                $validated['source_type'],
                $validated['target_type']
            );

            // Log the usage
            ToolUsage::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'tool_name' => "AI Converter: {$validated['source_type']} to {$validated['target_type']}",
                'input_data' => "Source: \n" . substr($validated['source_code'], 0, 1000) . "\n\nResult: \n" . substr($convertedCode, 0, 1000),
            ]);

            return response()->json([
                'success' => true,
                'data' => $convertedCode
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
