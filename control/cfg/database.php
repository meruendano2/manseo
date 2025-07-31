
<?php
abstract class Configuracion {
	public static function conectar(){
			$controlador = "mysql"; //controlador (MySQL la mayoría de las veces)
        $servidor = "localhost"; //servidor como localhost o 127.0.0.1 usar este ultimo cuando el puerto sea diferente
    	$basedatos = "db1601manseo"; //nombre de la base de datos
		$usuario = "db1601manseo";//usuario 
		$pass = "bugattipass"; //consu452150955_gordotrasena
		 // $puerto = '3306'; //Puerto de la BD
 		$dsn = "mysql:host=$servidor;dbname=$basedatos";
		$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 
        try{
           $con =  new PDO($dsn, $usuario, $pass, $opciones);
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $con;
						
            }
        catch(PDOException $e){
				$error = $e->getCode();
                echo "Error en la conexión con la db: ".$e->getMessage();
            } 
	}
 
}
?>