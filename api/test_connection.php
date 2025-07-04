<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si el archivo de configuración existe
$configFile = __DIR__ . '/../cfg/gemini_config.php';
if (!file_exists($configFile)) {
    die("Error: No se encuentra el archivo de configuración en: " . $configFile);
}

// Verificar si el archivo .env existe
$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    die("Error: No se encuentra el archivo .env en: " . $envFile);
}

require_once($configFile);

echo "<pre>";
echo "=== Prueba de conexión a Gemini API ===\n\n";

// Verificar cURL
echo "1. Verificando cURL:\n";
if (function_exists('curl_init')) {
    echo "✓ cURL está instalado\n";
} else {
    echo "✗ cURL NO está instalado\n";
    exit;
}

// Verificar API key
echo "\n2. Verificando API key:\n";
try {
    $apiKey = GeminiConfig::getApiKey();
    if (empty($apiKey)) {
        echo "✗ API key NO configurada\n";
    } else {
        echo "✓ API key configurada\n";
        echo "   Longitud: " . strlen($apiKey) . " caracteres\n";
        echo "   Formato: " . substr($apiKey, 0, 5) . "..." . substr($apiKey, -5) . "\n";
    }
} catch (Exception $e) {
    echo "✗ Error al obtener API key: " . $e->getMessage() . "\n";
}

// Listar modelos disponibles
echo "\n3. Listando modelos disponibles:\n";
$modelsUrl = 'https://generativelanguage.googleapis.com/v1/models?key=' . $apiKey;

$ch = curl_init($modelsUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);

curl_close($ch);

if ($error) {
    echo "   Error al listar modelos: " . $error . "\n";
} else {
    $models = json_decode($response, true);
    if (isset($models['models'])) {
        echo "   Modelos disponibles:\n";
        foreach ($models['models'] as $model) {
            echo "   - " . $model['name'] . "\n";
        }
    } else {
        echo "   No se pudieron obtener los modelos. Respuesta: " . $response . "\n";
    }
}

// Probar conexión simple
echo "\n4. Probando conexión simple:\n";
$testUrl = 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro:generateContent?key=' . $apiKey;

// Preparar los datos para la petición
$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => 'Hola, ¿puedes responder?']
            ]
        ]
    ]
];

$ch = curl_init($testUrl);
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
curl_setopt($ch, CURLOPT_VERBOSE, true);

// Capturar la salida de depuración
$verbose = fopen('php://temp', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $verbose);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
$info = curl_getinfo($ch);

// Obtener la salida de depuración
rewind($verbose);
$verboseLog = stream_get_contents($verbose);
fclose($verbose);

curl_close($ch);

echo "   Código HTTP: " . $httpCode . "\n";
echo "   URL de prueba: " . $testUrl . "\n";
echo "   Información de cURL:\n";
echo "   - Tiempo total: " . $info['total_time'] . " segundos\n";
echo "   - Tiempo de conexión: " . $info['connect_time'] . " segundos\n";
echo "   - Tiempo de DNS: " . $info['namelookup_time'] . " segundos\n";
echo "   - Tamaño de la petición: " . $info['request_size'] . " bytes\n";
echo "   - Tamaño de la respuesta: " . $info['size_download'] . " bytes\n";

if ($error) {
    echo "   Error de cURL: " . $error . "\n";
    echo "   Log detallado:\n" . $verboseLog . "\n";
} else {
    echo "   Conexión exitosa\n";
    echo "   Respuesta: " . $response . "\n";
}

echo "\n5. Información del servidor:\n";
echo "   PHP Version: " . PHP_VERSION . "\n";
echo "   cURL Version: " . curl_version()['version'] . "\n";
echo "   SSL Version: " . curl_version()['ssl_version'] . "\n";
echo "   Host: " . $_SERVER['HTTP_HOST'] . "\n";

// Mostrar información adicional de depuración
echo "\n6. Información adicional:\n";
echo "   Directorio actual: " . __DIR__ . "\n";
echo "   Archivo .env: " . (file_exists($envFile) ? "Existe" : "No existe") . "\n";
echo "   Contenido de .env: " . file_get_contents($envFile) . "\n";
echo "</pre>"; 