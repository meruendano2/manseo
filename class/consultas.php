	
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




/// *************************************************************** *********************************
public function agregarHistorial($accion,$tabla,$registro){// para s
		$registrar = true; //creamos una variable de control
		$fecha_actual = date("Y/m/d H:i");
		$hora_actual=date("H:i");
		$usuario=$registro['nombre'];
		$telefono=$registro['telefono'];
		$ip=$_SERVER['REMOTE_ADDR']; //A la variable ip le asignamos la ip remota;
		$this->con->beginTransaction();
		$consulta="INSERT INTO historial (`idhistorial`, `fecha`, `hora`, `accion`, `tabla`, `registro`, `usuario`, `ip`, `otro1`) VALUES 
		(NULL, '$fecha_actual', '$hora_actual', '$accion', '$tabla', '$registro', '$usuario', '$ip', '$telefono')";
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


public function getMenu($cat){
      //  $consulta = "SELECT *  FROM  tumenu WHERE categoria='".$cat."'  ORDER BY `tumenu`.`nombre` "  ;
           $consulta = "SELECT *  FROM  tumenu WHERE categoria='".$cat."'  "  ;
        $valores = null;
 
        $oConectar = new conectorDB; //instanciamos conector
        $this->resultado = $oConectar->consultarBD($consulta,$valores);
         return $this->resultado;
    } //Termina funcion 


public function enviarMailMenu($tipo,$valores){
	 $mensaje = 'mensaje No';
    if ($tipo=="menu" ){ 
			$asunto="Presupuesto grupos Restaurante ManSeo";
			$de="Restaurante ManSeo";
			$mailfrom="info@manseo.es";
            $dest ="info@manseo.es"; //Email de destino
            $nombre = $valores['nombre'];
            $mail = $valores['mail'];
			
            $cuerpo ="<br>";
			$cuerpo .="\r\n <br> Nuevo presupuesto";
			$cuerpo .="\r\n <br> ";
		foreach($valores as $nombre_campo => $valor){
			if ( substr($valor, 1,2)==".-"){
				 $cuerpo.=$valor."<br>" ;
			}
		}
			$cuerpo .="\r\n <br> ";
			$cuerpo .="<br> Adultos: ".$valores['adultos'];
			$cuerpo .="<br> Niños: ".$valores['ninos'];
			$cuerpo .="<br> Niños menores de 4: ".$valores['ninos2'];
			$cuerpo .="\r\n <br> ";
			$cuerpo .="<br> precio por persona: ".$valores['porpersona'];
			$cuerpo .="<br> importe adultos: ".$valores['importeadultos'];
			$cuerpo .="<br> importe niños: ".$valores['importeninos'];
			$cuerpo .="\r\n <br> ";
			$cuerpo .="<br> importe total: ".$valores['importetotal'];

			$cuerpo .="\r\n <br> ";
			$cuerpo .="<br> Nombre: ".$valores['nombre'];
			$cuerpo .="<br> Mail: ".$valores['mail'];
			$cuerpo .="<br> Telefono: ".$valores['telefono'];
			$cuerpo .="<br>  ";
		
			$cuerpo .="<br> Fecha: ".$valores['fecha'];
			$cuerpo .="<br> Hora: ".$valores['hora'];
			 $cuerpo .="<br>";
			$cuerpo .="<br> comentario: ".$valores['comentario'];
			

		
		
            //Cabeceras del correo
            $headers = "From: $de <$mailfrom>\r\n"; //Quien envia?
            $headers .= "X-Mailer: PHP5\n";
            $headers .= 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; //
 
            if(mail($dest,$asunto,$cuerpo,$headers)){


            	 if(mail($mail,$asunto,$cuerpo,$headers)){
                $mensaje = 'mensaje enviado';

                $this->agregarHistorial("Reserva",$mail,$valores); // guardo historial	
                // si el envio fue exitoso reseteamos lo que el usuario escribio:
                  }else{
                $mensaje = 'mensaje NO enviado';
           		 }
            };
   		};




   		return $mensaje;
    } //Termina funcion 



























	public function getRegistrosSQL($consulta){
 
		$valores = null;
  
		$oConectar = new conectorDB; //instanciamos conector
		$this->resultado = $oConectar->consultarBD($consulta,$valores);
		 return $this->resultado;
	} 















}//*****fin trabajo

//Termina funcion 
?>