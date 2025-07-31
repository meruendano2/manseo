public function enviarMailPHPMailer($destinatario, $asunto, $cuerpoHtml, $nombreRemitente = 'Restaurante ManSeo', $mailRemitente = 'reservas@manseo.es') {
   $salida="enviarMailPHPMailer";
 
	require_once __DIR__ . '/../vendor/autoload.php'; // Ajusta la ruta si es necesario

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'manseo-es.correoseguro.dinaserver.com'; // Cambia por tu servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'reservas@manseo.es'; // Cambia por tu usuario SMTP
        $mail->Password   = 'Manseo_635241'; // Cambia por tu contraseña SMTP
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remitente y destinatario
        $mail->setFrom($mailRemitente, $nombreRemitente);
        $mail->addAddress($destinatario);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpoHtml;

        $mail->send();
        $salida= 'Correo enviado correctamente';
    } catch (Exception $e) {
        $salida= 'Error al enviar correo: ' . $mail->ErrorInfo;
    }
	 

		return $salida;
}

 