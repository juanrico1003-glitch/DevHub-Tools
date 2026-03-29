<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class CodeConverterService
{
    /**
     * Calls Gemini API to convert code from one language to another.
     *
     * @param string $sourceCode
     * @param string $sourceType
     * @param string $targetType
     * @return string
     * @throws Exception
     */
    public function convert(string $sourceCode, string $sourceType, string $targetType): string
    {
        $apiKey = config('services.gemini.key');

        if (empty($apiKey) || $apiKey === 'your_gemini_api_key_here') {
            throw new Exception("The Gemini API Key is missing. Please set GEMINI_API_KEY in your .env file or Railway variables.");
        }

        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

        $prompt = "You are an expert developer tool. Your only task is to convert the following code snippet from {$sourceType} to {$targetType}.\n";
        $prompt .= "Guidelines:\n";
        $prompt .= "- Provide ONLY the converted code snippet.\n";
        $prompt .= "- DO NOT wrap the code in markdown blocks (e.g. ```php), just raw text, UNLESS it is absolutely necessary for readability.\n";
        $prompt .= "- DO NOT provide explanations, apologies, or conversational text. Just the code.\n";
        $prompt .= "- If the conversion is conceptually impossible (e.g. converting a database schema to a frontend button), do your absolute best to interpret the meaning or return an informative error comment inside the target language syntax.\n\n";
        $prompt .= "--- SOURCE CODE ({$sourceType}) ---\n" . $sourceCode;

        $payload = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $prompt]
                    ]
                ]
            ],
            // Low temperature for more deterministic code logic output
            "generationConfig" => [
                "temperature" => 0.1
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($url, $payload);

        if ($response->failed()) {
            throw new Exception("AI conversion failed: " . $response->body());
        }

        $data = $response->json();

        if (isset($data['error'])) {
            throw new Exception("API Error: " . $data['error']['message']);
        }

        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

        // Strip backticks if the AI accidentally wrapped it
        if (str_starts_with($text, '```') && str_ends_with(trim($text), '```')) {
            $lines = explode("\n", $text);
            array_shift($lines); // remove first line (```lang)
            array_pop($lines); // remove last line (```)
            if (empty(trim(end($lines))) && count($lines) > 0) {
               // sometimes the last line is empty
            }
            $text = implode("\n", $lines);
        }

        return trim($text);
    }
}
