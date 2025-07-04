


<?php
	

//require_once("conexion.php");
	// *************************************************
	// *************************************************
	// *************************************************
	// *************************************************
class Login extends Configuracion //clase principal para midificacion e eliminacion e insercion
{
    private $con;
 	private $resultadoLogin;
    public function __construct(){
   		$this->resultadoLogin=array();
		 $this->con = parent::conectar(); //creo una variable con la conexión
        return $this->con;  
	}
	

	//*********************************************************************
public function loguearprueba($user,$pass){

    
				$mensaje=array('mensaje' => 'false','usuario' => 'uuuuser','password' =>'passs');
	
	return $mensaje;

	
}
//*********************************************************************
//*********************************************************************
public function loguearUsuario($user,$pass){

       $consulta = "SELECT * FROM clientes where user='$user'  and pass='$pass'";
        $valores = null;

        $oConectar = new conectorDB; //instanciamos conector
        $total=$this->resultado = $oConectar->consultarBD($consulta,$valores);
		$result = count($total);
	$mensaje=array('mensaje' => 'false','usuario' => $user,'password' =>$pass);
				
        if ($result>=1){
			$user=$total[0]['user'];
			$pass=$total[0]['pass'];
			$id_cliente=$total[0]['id'];
			$nombre=$total[0]['nombre'];
			$apellidos=$total[0]['apellidos'];
			$categoria=$total[0]['categoria'];
			$movil=$total[0]['movil'];
			$mail=$total[0]['mail'];

					
	
		$_SESSION['id_cliente']=$id_cliente;
		$_SESSION['usuario']=$user;
		$_SESSION['nombre']=$nombre." ".$apellidos;
		$_SESSION['categoria']=$categoria;
		$_SESSION['mail']=$mail;
	    $_SESSION['tel']=$movil;
			
			$mensaje=array('mensaje' => 'true','usuario' => $user,'categoria' =>$categoria);

			}
	return $mensaje;

	
}//*********************************************************************
public function verificarUsuario ($id,$user,$nombre){

       $consulta = "SELECT * FROM admon where usuario='$user'  and nombre='$nombre'  and id_admon='$id'";
        $valores = null;
 
        $oConectar = new conectorDB; //instanciamos conector
        $total=$this->resultado = $oConectar->consultarBD($consulta,$valores);
		$result = count($total);
		
        if ($result==1){
			$mensaje=" ";
			}
			else{
				session_destroy();
			echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
			}
	return $mensaje;

	
}//*********************************************************************

} //Termina funcion 		
		

?>