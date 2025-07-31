	
<?php
//require_once("cfg/conexion.php");
//equire_once("class/resize.php");

class Trabajo  extends Configuracion {
	 private $con;

	private $album;
	private $resultado;


	public function __construct(){

			$this->album=array();
			$this->resultado=array();
			 $this->con = parent::conectar(); //creo una variable con la conexión
        return $this->con;  
	 
			
	

	}//*********************************************************************



	public function verificarUsuario ($id,$user,$categoria){

       $consulta = "SELECT * FROM clientes where id='$id'  and user='$user'  and categoria='$categoria'";
             $valores = null;
 
        $oConectar = new conectorDB; //instanciamos conector
        $total=$this->resultado = $oConectar->consultarBD($consulta,$valores);
		$result = count($total);
		
        if ($result==1){
			$mensaje="bienvenido";
			}
			else{
				session_destroy();
			echo "<script type='text/javascript'>window.location.assign('../index.php')</script>";
		

			}
	return $mensaje;

	
}//*********************************************************************




public function getMenu(){
   $consulta = "SELECT *  FROM  tumenu   ORDER BY id   DESC ";
          // $consulta = "SELECT *  FROM  tumenu  "  ;
        $valores = null;
 
        $oConectar = new conectorDB; //instanciamos conector
        $this->resultado = $oConectar->consultarBD($consulta,$valores);
         return $this->resultado;
} //Termina funcion  **************************************************************************************************************************

public function getRegistrosSQL($sql){
	$consulta = $sql;
		   // $consulta = "SELECT *  FROM  tumenu  "  ;
		 $valores = null;
  
		 $oConectar = new conectorDB; //instanciamos conector
		 $this->resultado = $oConectar->consultarBD($consulta,$valores);
		  return $this->resultado;
 } //Termina funcion  **************************************************************************************************************************
 
 


public function editarRegistro($tabla,$valores){// para editr
        $id = "no id"; //cpara historial
		$mensaje=" modificado ";

if ($tabla=='prueba'){
		return $mensaje;
	}
if ($tabla=='tumenu'){

	$consulta = "UPDATE tumenu   SET 
		categoria='".$valores['categoria']."',
		nombre='".$valores['nombre']."',
		precio1='".$valores['precio1']."',
		precio2='".$valores['precio2']."',
		precio3='".$valores['precio3']."',
		precio4='".$valores['precio4']."',
		precio5='".$valores['precio5']."'
		WHERE id='".$valores['id']."'";
		$id=$valores['id'];
	}
	if ($tabla=='cartas'){

		$consulta = "UPDATE cartas   SET 
			 
			nombre='".$valores['nombre']."',
			seccion='".$valores['seccion']."',
			descripcion='".$valores['descripcion']."',
			activo='".$valores['activo']."',
			archivo='".$valores['archivo']."',
			imagen='".$valores['imagen']."' 
			WHERE id='".$valores['id']."'";
			$id=$valores['id'];
		}
	if ($tabla=='menu_dia'){

			$consulta = "UPDATE  menu_dia   SET 
			primer_plato1='".$valores['primer_plato1']."',
			primer_plato2='".$valores['primer_plato2']."',
			primer_plato3='".$valores['primer_plato3']."',
			primer_plato4='".$valores['primer_plato4']."',
			segundo_plato1='".$valores['segundo_plato1']."',
			segundo_plato2='".$valores['segundo_plato2']."',
			segundo_plato3='".$valores['segundo_plato3']."',
			segundo_plato4='".$valores['segundo_plato4']."',
			precio='".$valores['precio']."',
			fecha='".$valores['fecha']."' 
			WHERE id='".$valores['id']."'";
			$id=$valores['id'];
		}
		if ($tabla=='fotos'){

			$consulta = "UPDATE  fotos   SET 
			nombre='".$valores['nombre']."',
			descripcion='".$valores['descripcion']."',
			imagen='".$valores['imagen']."',
			activo='".$valores['activo']."',		 
			seccion='".$valores['seccion']."' 
			WHERE id='".$valores['id']."'";
			$id=$valores['id'];
		}


		if ($tabla=='vacaciones'){

			$consulta = "UPDATE vacaciones   SET 
				 
				nombre='".$valores['nombre']."',
				activo='".$valores['activo']."'
				
				WHERE id='".$valores['id']."'";
				$id=$valores['id'];
			}


if ($tabla=='clientes'){
		$consulta = "UPDATE clientes   SET 
		categoria='".$valores['categoria']."',
		user='".$valores['user']."',
		pass='".$valores['pass']."',
		dni='".$valores['dni']."',
		nombre='".$valores['nombre']."',
		apellidos='".$valores['apellidos']."',
		direccion='".$valores['direccion']."',
		codigo_postal='".$valores['codigo_postal']."',
		localidad='".$valores['localidad']."',
		provincia='".$valores['provincia']."',
		pais='".$valores['pais']."',
		tel_empresa='".$valores['tel_empresa']."',
		movil='".$valores['movil']."',
		mail='".$valores['mail']."'
		WHERE id='".$valores['id']."'";
		$id=$valores['id'];
	}

// iniciamos la  consulta	
	$this->con->beginTransaction();
	$transaccion=$this->con->exec($consulta);
	//$this->con->query($consulta);
	if ($transaccion == true)	 {
			$this->con->commit();
			$mensaje=" Se han actualizado los datos  ".$tabla;
			$this->agregarHistorial("actualizar",$tabla,$id); // guardo historial	
			}
			else {
			$this->con->rollback();
			$mensaje="NO se han actualizado los datos. ".$tabla;
		}
	$this->agregarHistorial("Modificar",$tabla,$id); // guardo historial
	return $mensaje;

} //Termina funcion 	



public function agregarRegistro($tabla,$valores){// para saber el ulttimo
        $registrar = true; //creamos una variable de control
		$mensaje="insertando registro ";


if ($tabla=='tumenu'){
		$this->con->beginTransaction();
			$consulta = "INSERT INTO $tabla (categoria,nombre) ";
					$consulta.="VALUES (";
					$consulta.=" 'Entrantes',";
					$consulta.=" 'Nuevo'";
					
					$consulta.=" )";
			 if ($this->con->exec($consulta) == 0) $registrar =false; 
				if ($registrar == true) {
						$this->con->commit();
					$mensaje="registro agregado <br>";
					$this->agregarHistorial("agregar","menu","nuevo"); // guardo historial	
					}
					else {
					$this->con->rollback();
					$mensaje="registro NO insertado <br> ";
			};
			return $mensaje;
	}
	else{
		$this->con->beginTransaction();
			$consulta = "INSERT INTO $tabla ()  ";
					$consulta.= "VALUES ()";
				 
					
					 
			 if ($this->con->exec($consulta) == 0) $registrar =false; 
				if ($registrar == true) {
						$this->con->commit();
					$mensaje="registro agregado <br>";
					$this->agregarHistorial("agregar",$tabla,"nuevo"); // guardo historial	
					}
					else {
					$this->con->rollback();
					$mensaje="registro NO insertado <br> ";
			};
			return $mensaje;

	}

return $mensaje;
} //Termina funcion 



/// *****************/            CON DB   NOTIFICACIONES    elimnar   EN TABLAS         ////////
/// *************************************************************** *********************************
 
public function eliminarRegistro($tabla,$campo,$valor){//tabla=inmuebles  id=1 label_id=nombre del campo Id_inmueble
        $registrar = true; //creamos una variable de control
		$this->con->beginTransaction();
        $consulta = "DELETE FROM  ". $tabla . " WHERE  ".$campo."=".$valor;
	
		 if ($this->con->exec($consulta) == 0) $registrar =false; 
			if ($registrar == true) {
				$this->con->commit();
				$mensaje="tabla ".$tabla." Registro ".$valor." eliminado <br> ";
				$this->agregarHistorial("aliminar","tumenu",$valor); // guardo historial	
				return $mensaje;
			}
			else {
				$this->con->rollback();
				$mensaje="tabla ".$tabla." Registro NO eliminado <br> ";
				return $mensaje;
			}
		$this->con = null; //cerramos la conexión

} //Termina funcion




public function getClienteID($id){
        $consulta = "SELECT *  FROM  clientes WHERE id=$id  ";
        $valores = null;
 
        $oConectar = new conectorDB; //instanciamos conector
        $this->resultado = $oConectar->consultarBD($consulta,$valores);
         return $this->resultado[0];
    } //Termina funcion 




/// *************************************************************** *********************************
public function agregarHistorial($accion,$tabla,$registro){// para s
		$registrar = true; //creamos una variable de control
		$fecha_actual = date("Y/m/d H:i");
		$hora_actual=date("H:i");
		$usuario=$_SESSION['nombre'];
		$ip=$_SERVER['REMOTE_ADDR']; //A la variable ip le asignamos la ip remota;
		$this->con->beginTransaction();
		$consulta="INSERT INTO historial (`idhistorial`, `fecha`, `hora`, `accion`, `tabla`, `registro`, `usuario`, `ip`, `otro1`) VALUES 
		(NULL, '$fecha_actual', '$hora_actual', '$accion', '$tabla', '$registro', '$usuario', '$ip', 'no')";
		 if ($this->con->exec($consulta) == 0) $registrar =false; 
			if ($registrar == true) {
				$this->con->commit();
				$mensaje="Se ha Insertado ";
			}
			else {
				$this->con->rollback();
				$mensaje="NO se ha Insertado ";
			}
			
} //Termina funcion 




















}//*****fin trabajo
?>