<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si el archivo de configuración existe
$configFile = __DIR__ . '/../cfg/gemini_config.php';
if (!file_exists($configFile)) {
    die(json_encode([
        'status' => 'error',
        'error' => 'No se encuentra el archivo de configuración'
    ]));
}

// Verificar si el archivo .env existe
$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    die(json_encode([
        'status' => 'error',
        'error' => 'No se encuentra el archivo .env'
    ]));
}

require_once($configFile);

// Función para enviar la petición a la API de Gemini
function sendToGemini($prompt) {
    try {
        // Obtener API key
        $apiKey = GeminiConfig::getApiKey();
        if (empty($apiKey)) {
            throw new Exception('API key no configurada');
        }

        // URL de la API de Gemini
        $url = 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro:generateContent?key=' . $apiKey;

        // Preparar los datos para la petición
        $data = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ];

        // Configurar la petición cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Ejecutar la petición
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        $info = curl_getinfo($ch);

        curl_close($ch);

        // Verificar si hay errores
        if ($error) {
            throw new Exception('Error en la petición cURL: ' . $error);
        }

        if ($httpCode !== 200) {
            throw new Exception('Error en la respuesta de la API. Código HTTP: ' . $httpCode);
        }

        // Procesar la respuesta
        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error al decodificar la respuesta JSON');
        }

        if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            return [
                'status' => 'success',
                'response' => $result['candidates'][0]['content']['parts'][0]['text'],
                'modelVersion' => $result['modelVersion'] ?? 'desconocida',
                'usage' => $result['usageMetadata'] ?? null
            ];
        } else {
            throw new Exception('Respuesta inesperada de la API');
        }

    } catch (Exception $e) {
        error_log('Error en sendToGemini: ' . $e->getMessage());
        return [
            'status' => 'error',
            'error' => $e->getMessage()
        ];
    }
}

// Manejar la petición
try {
    // Verificar el método de la petición
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido. Solo se aceptan peticiones POST');
    }

    // Obtener el mensaje del cuerpo de la petición
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input || !isset($input['message'])) {
        throw new Exception('No se recibió un mensaje válido');
    }

    // Enviar el mensaje a Gemini
    $result = sendToGemini($input['message']);
    
    // Devolver la respuesta
    echo json_encode($result);

} catch (Exception $e) {
    error_log('Error en gemini.php: ' . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'error' => $e->getMessage()
    ]);
} 