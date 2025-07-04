<?php
class GeminiConfig {
    private static $apiKey = null;
    
    public static function getApiKey() {
        if (self::$apiKey === null) {
            // Cargar la API key desde el archivo .env
            $envFile = __DIR__ . '/../.env';
            
            if (!file_exists($envFile)) {
                throw new Exception('No se encuentra el archivo .env en: ' . $envFile);
            }
            
            $env = parse_ini_file($envFile);
            if ($env === false) {
                throw new Exception('Error al leer el archivo .env');
            }
            
            self::$apiKey = isset($env['GEMINI_API_KEY']) ? $env['GEMINI_API_KEY'] : null;
            
            // Si no se encuentra en .env, intentar obtener de las variables de entorno
            if (self::$apiKey === null) {
                self::$apiKey = getenv('GEMINI_API_KEY');
            }
            
            if (self::$apiKey === null) {
                throw new Exception('API key de Gemini no configurada. Por favor, configura la variable GEMINI_API_KEY en el archivo .env');
            }
            
            if (empty(self::$apiKey)) {
                throw new Exception('La API key de Gemini está vacía');
            }
        }
        
        return self::$apiKey;
    }
    
    public static function setApiKey($apiKey) {
        self::$apiKey = $apiKey;
    }
} 