<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ToolUsage;
use Illuminate\Support\Facades\Auth;
use Exception;

class AiToolController extends Controller
{
    const MODEL_URL = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=';

    public function handle(Request $request)
    {
        $validated = $request->validate([
            'mode'      => 'required|string|in:language-translate,database-convert,dictionary',
            'input'     => 'required|string|max:10000',
            'from'      => 'nullable|string|max:100',
            'to'        => 'nullable|string|max:100',
        ]);

        $apiKey = config('services.gemini.key');
        if (empty($apiKey) || $apiKey === 'your_gemini_api_key_here') {
            return response()->json(['success' => false, 'message' => 'GEMINI_API_KEY no configurada.'], 500);
        }

        try {
            $prompt = $this->buildPrompt($validated);

            $response = Http::post(self::MODEL_URL . $apiKey, [
                'contents' => [['parts' => [['text' => $prompt]]]],
                'generationConfig' => ['temperature' => 0.2],
            ]);

            if ($response->failed()) {
                throw new Exception("AI request failed: " . $response->body());
            }

            $data = $response->json();
            if (isset($data['error'])) {
                throw new Exception($data['error']['message']);
            }

            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
            $text = $this->stripMarkdown($text);

            // Log usage
            $toolName = match($validated['mode']) {
                'language-translate' => "Traductor de Idiomas: {$validated['from']} → {$validated['to']}",
                'database-convert'   => "DB Converter: {$validated['from']} → {$validated['to']}",
                'dictionary'         => "Diccionario: {$validated['input']}",
            };

            ToolUsage::create([
                'user_id'    => Auth::check() ? Auth::id() : null,
                'tool_name'  => $toolName,
                'input_data' => substr($validated['input'], 0, 1000),
            ]);

            return response()->json(['success' => true, 'data' => $text]);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function buildPrompt(array $data): string
    {
        return match($data['mode']) {

            'language-translate' =>
                "Eres un traductor experto de idiomas humanos. Traduce el siguiente texto de {$data['from']} a {$data['to']}.\n" .
                "Reglas:\n" .
                "- Responde ÚNICAMENTE con el texto traducido. Sin explicaciones, sin notas, sin encabezados.\n" .
                "- Mantén el formato original (saltos de línea, puntuación, mayúsculas).\n" .
                "- Si el texto ya está en el idioma destino, devuélvelo tal cual.\n\n" .
                "Texto a traducir:\n" . $data['input'],

            'database-convert' =>
                "Eres un experto en bases de datos relacionales y no relacionales. Tu tarea es convertir el siguiente schema o query de {$data['from']} a {$data['to']}.\n" .
                "Reglas:\n" .
                "- Responde ÚNICAMENTE con el código/schema convertido.\n" .
                "- NO uses bloques de markdown (```).\n" .
                "- Si conviertes de SQL a MongoDB, usa sintaxis de operaciones de la shell de MongoDB o del driver de Node.js/PHP según corresponda.\n" .
                "- Si hay tipos de datos sin equivalente directo, usa el más cercano y añade un comentario inline.\n\n" .
                "Código {$data['from']} a convertir:\n" . $data['input'],

            'dictionary' =>
                "Eres un diccionario técnico exhaustivo para desarrolladores de software.\n" .
                "El usuario busca información sobre: \"{$data['input']}\"\n" .
                "Idioma de respuesta preferido: {$data['from']}\n\n" .
                "Por favor proporciona en ese idioma:\n" .
                "1. **Definición clara**: Qué es y para qué sirve.\n" .
                "2. **Categoría**: (Ej: Keyword de PHP, Etiqueta de HTML, Método de JavaScript, Concepto de BD, etc.)\n" .
                "3. **Lenguajes donde aparece**: Lista los lenguajes/frameworks donde existe.\n" .
                "4. **Ejemplo de código simple**: Un ejemplo corto y funcional.\n" .
                "5. **Términos relacionados**: 3-5 términos similares o complementarios.\n\n" .
                "Sé conciso pero completo. Usa formato limpio con los números de sección visibles.",
        };
    }

    private function stripMarkdown(string $text): string
    {
        if (str_starts_with($text, '```') && str_ends_with(trim($text), '```')) {
            $lines = explode("\n", $text);
            array_shift($lines);
            if (str_ends_with(trim(end($lines)), '```')) {
                array_pop($lines);
            }
            return trim(implode("\n", $lines));
        }
        return trim($text);
    }
}
