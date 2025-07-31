<?php
if (!isset($_SESSION)) {
session_start();
}
?>

<?php  
	$mensaje=array('mensaje' => 'false','usuario' => 'uuuuser','password' =>'passs','categoria' =>'Cliente');
 if (isset($_POST['accion'])) {

	 
 require_once("cfg/config.php"); 
 require_once("cfg/database.php"); 
 require_once("class/conexion.php"); 
 require_once("class/verificaruser.php"); 



$usuario = $_POST['user'];
$password =$_POST['pass'];
$logeo=new Login;

$mensaje=$logeo->loguearUsuario($usuario,$password);
//echo json_encode($datosJson);	


}
	

	echo json_encode($mensaje);
?>
