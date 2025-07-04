<?php
header('Content-Type: application/json');
require_once('../cfg/gemini_config.php');

// Habilitar reporte de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si cURL está instalado
if (!function_exists('curl_init')) {
    echo json_encode(['error' => 'La extensión cURL no está instalada en el servidor']);
    exit;
}

try {
    // Verificar si se recibió un mensaje
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input || !isset($input['message'])) {
        throw new Exception('No se recibió un mensaje válido en la petición');
    }
    
    $prompt = $input['message'];
    $apiKey = GeminiConfig::getApiKey();
    
    if (empty($apiKey)) {
        throw new Exception('La API key de Gemini no está configurada correctamente');
    }
    
    // URL actualizada de la API de Gemini con el modelo correcto
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
    
    // Configuración básica de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    
    // Configuración de SSL y tiempo de espera
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    
    // Capturar la salida de depuración
    $verbose = fopen('php://temp', 'w+');
    curl_setopt($ch, CURLOPT_STDERR, $verbose);
    
    // Ejecutar la petición
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    $info = curl_getinfo($ch);
    
    // Obtener la salida de depuración
    rewind($verbose);
    $verboseLog = stream_get_contents($verbose);
    fclose($verbose);
    
    curl_close($ch);
    
    // Verificar si hay errores
    if ($error) {
        throw new Exception('Error en la petición cURL: ' . $error . "\nInformación: " . print_r($info, true) . "\nLog detallado: " . $verboseLog);
    }
    
    if ($httpCode !== 200) {
        throw new Exception('Error en la respuesta de la API. Código HTTP: ' . $httpCode . '. Respuesta: ' . $response);
    }
    
    // Procesar la respuesta
    $result = json_decode($response, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Error al decodificar la respuesta JSON: ' . json_last_error_msg());
    }
    
    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        echo json_encode([
            'response' => $result['candidates'][0]['content']['parts'][0]['text'],
            'modelVersion' => $result['modelVersion'] ?? 'desconocida',
            'usage' => $result['usageMetadata'] ?? null,
            'status' => 'success'
        ]);
    } else {
        throw new Exception('Respuesta inesperada de la API. Estructura: ' . print_r($result, true));
    }
    
} catch (Exception $e) {
    error_log('Error en gemini_chat.php: ' . $e->getMessage());
    echo json_encode([
        'error' => 'Error al procesar la solicitud: ' . $e->getMessage(),
        'status' => 'error'
    ]);
} 