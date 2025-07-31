 
<?php require_once("cfg/config.php"); ?>
<?php require_once("cfg/database.php"); ?>

<?php require_once("class/conexion.php"); ?>
<?php require_once("class/resize.php"); ?>
<?php include("class/consultas.php"); ?>
<?php

$ejecutar=new Trabajo();

$mensaje="----<br>";

// bborro el comentario
if(isset($_POST)) {

		foreach($_POST as $nombre_campo => $valor){
			if ( $valor!=''){
			$datosEnviados[$nombre_campo] = $valor ;
			
			}
		}
	
}		 
asort($datosEnviados);

switch ($datosEnviados['accion']) {
	case 'enviarmail':
 		// $mensaje=$ejecutar->enviarMailMenu($datosEnviados['tipo'],$datosEnviados);
		//$mensaje="enviando mensaje";
		if($datosEnviados['tipo']=="configuramenu" ){
				$asunto="Presupuesto grupos Restaurante ManSeo";
			$de="Restaurante ManSeo";
			
            $dest ="reservas@manseo.es"; //Email de destino
            $nombre = $datosEnviados['nombre'];
            $mail = $datosEnviados['mail'];
			$mailfrom=$mail;
			
            $cuerpo ="<br>";
			$cuerpo .="\r\n <br> Nuevo presupuesto";
			$cuerpo .="\r\n <br> ";
			$cuerpo .="<br> Nombre cliente ".$datosEnviados['nombre'];
			$cuerpo .="<br> Mail: cliente ".$datosEnviados['mail'];
			$cuerpo .="<br> Telefono cliente: ".$datosEnviados['telefono'];
			$cuerpo .="<br>  ";
			$cuerpo .="<br> Fecha: ".$datosEnviados['fecha'];
			$cuerpo .="<br> Hora: ".$datosEnviados['hora'];
			$cuerpo .="\r\n <br> ";
			$cuerpo .="<br> Adultos: ".$datosEnviados['adultos'];
			$cuerpo .="<br> Niños: ".$datosEnviados['ninos'];
			$cuerpo .="<br> Niños menores de 4: ".$datosEnviados['ninos2'];
			

			$cuerpo .="\r\n <br> ";
			$cuerpo .="\r\n <br>  Platos seleccionados: <br>";
			foreach($datosEnviados as $nombre_campo => $valor){
				if ( substr($valor, 1,2)==".-"){
					$cuerpo.=$valor."<br>" ;
				}
			}
		
	
			$cuerpo .="\r\n <br> ";
			$cuerpo .="<br> precio por persona: ".$datosEnviados['porpersona'];
			$cuerpo .="<br> importe adultos: ".$datosEnviados['importeadultos'];
			$cuerpo .="<br> importe niños: ".$datosEnviados['importeninos'];
			$cuerpo .="\r\n <br> ";
			$cuerpo .="<br> importe total: ".$datosEnviados['importetotal'];

		
		
			;
			 $cuerpo .="<br>";
			$cuerpo .="<br> comentario: ".$datosEnviados['comentario'];

			  $mensaje=$ejecutar->enviarMailPHPMailer($dest, $asunto, $cuerpo);
		}
		else if ($datosEnviados['tipo']=="contactomail" ){
			$asunto="enviar mail contacto	";
		}
	break;
	default:
		break;
}
  







//echo json_encode ($mensaje);
echo  ($mensaje);
 
?>