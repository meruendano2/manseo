
<?php
abstract class Configuracion {
    public static function conectar() {
        $servidor = "localhost"; //servidor como localhost o 127.0.0.1 usar este ultimo cuando el puerto sea diferente
    	$basedatos = "db1601manseo"; //nombre de la base de datos
		$usuario = "db1601manseo";//usuario 
		$pass = "bugattipass"; //consu452150955_gordotrasena
		$puerto = "3307"; // <-- Puerto personalizado

	 
        // $puerto = '3306'; // Descomenta y usa si el puerto no es el estándar

        // Puedes incluir el puerto en el DSN si es distinto al 3306:
        // $dsn = "mysql:host=$servidor;port=$puerto;dbname=$basedatos;charset=utf8";

        
		$dsn = "mysql:host=$servidor;dbname=$basedatos;charset=utf8";
		//$dsn = "mysql:host=$servidor;port=$puerto;dbname=$basedatos;charset=utf8";
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];

        try {
            $con = new PDO($dsn, $usuario, $pass, $opciones);
            return $con;
        } catch (PDOException $e) {
            // Puedes registrar el error en un log en vez de mostrarlo en producción
            die("❌ Error en la conexión con la base de datos: " . $e->getMessage());
        }
    }
}
?>