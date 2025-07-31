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
           $consulta = "SELECT *  FROM  tumenu  WHERE  categoria='".$cat."'  "  ;
        $valores = null;
 
        $oConectar = new conectorDB; //instanciamos conector
        $this->resultado = $oConectar->consultarBD($consulta,$valores);
         return $this->resultado;
    } //Termina funcion 

 

public function enviarMailMenu($tipo,$valores){
	 $mensaje = 'mensaje No';
    if ($tipo=="configuramenu" ){ 
			$asunto="Presupuesto grupos Restaurante ManSeo";
			$de="Restaurante ManSeo";
			$mailfrom="reservas@manseo.es";
            $dest ="reservas@manseo.es"; //Email de destino
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
			$cuerpo .="<br> Nombre:cliente ".$valores['nombre'];
			$cuerpo .="<br> Mail Cliente: ".$valores['mail'];
			$cuerpo .="<br> Telefono cliente: ".$valores['telefono'];
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
                $mensaje = 'mensaje enviado a ' .$dest;

                $this->agregarHistorial("Reserva",$mail,$valores); // guardo historial	
                // si el envio fue exitoso reseteamos lo que el usuario escribio:
                  }else{
                $mensaje = 'mensaje NO enviado';
           		 }
            };
   	
		} else {
			 $mensaje = 'otro mail';

			};




   		return $mensaje;
} //Termina funcion 



public function enviarMailPHPMailer($destinatario, $asunto, $cuerpoHtml, $nombreRemitente = 'Restaurante ManSeo', $mailRemitente = 'reservas@manseo.es') {
    // Incluye la configuración SMTP desde config.php
   // require __DIR__ . '/../config.php'; // Asegúrate de que las variables estén definidas en config.php
    require_once __DIR__ . '/../vendor/autoload.php';

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Configuración del servidor SMTP usando variables de config.php
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = SMTP_PORT;

        // Remitente y destinatario
        $mail->setFrom($mailRemitente, $nombreRemitente);
        $mail->addAddress($destinatario);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpoHtml;

        $mail->send();
        $salida = 'Correo enviado correctamente';
    } catch (Exception $e) {
        $salida= 'Error al enviar correo: ' . $mail->ErrorInfo;
    }
	 

		return $salida;
}
 
















	public function getRegistrosSQL($consulta){
 
		$valores = null;
  
		$oConectar = new conectorDB; //instanciamos conector
		$this->resultado = $oConectar->consultarBD($consulta,$valores);
		 return $this->resultado;
	} 















}//*****fin trabajo

//Termina funcion 
?>