<?php
$enviado = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Limpiar datos recibidos
    $nombre   = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $mensaje  = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';
    $asunto   = "Contacto - "  ;

    // Validaciones
    if ($nombre === '') {
        $errors['nombre'] = "Ingrese su nombre.";
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Ingrese un email válido.";
    }

    if ($telefono === '') {
        $errors['telefono'] = "Ingrese un teléfono.";
    }

    if ($mensaje === '') {
        $errors['mensaje'] = "Ingrese un mensaje.";
    }

    // Si no hay errores, se envía el correo
    if (empty($errors)) {
        $destino = isset($mail_empresa) ? $mail_empresa : 'info@ejemplo.com';

        $cuerpo = "
        <html>
        <head><title>Nuevo Mensaje de Contacto</title></head>
        <body>
            <h2>Contacto desde el sitio web</h2>
            <p><strong>Nombre:</strong> {$nombre}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Teléfono:</strong> {$telefono}</p>
            <p><strong>Mensaje:</strong><br>" . nl2br(htmlspecialchars($mensaje)) . "</p>
        </body>
        </html>";

        $headers = "From: {$nombre} <{$email}>\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (mail($destino, $asunto, $cuerpo, $headers)) {
            $enviado = 'Si';
            $_POST = []; // Vaciar el formulario
        } else {
            $enviado = 'No';
        }
    }
}
?>

<!-- Sección Contacto -->
<div id="contacto" class="contacto py-5 bg-light">
    <div class="container">
        <div class="row g-5 align-items-start">
            <!-- Información de contacto -->
            <div class="col-md-5">
                <h2 class="section-title playfair mb-4">CONTACTO</h2>
                <p class="mb-2"><?= $nombre_empresa; ?></p>
                <p class="mb-2"><?= $direccion_empresa; ?></p>
                <p class="mb-2"><?= $poblacion_empresa; ?> - <?= $cp_empresa; ?></p>
                <p class="mb-2"><strong>Tel:</strong> <?= $tel_empresa; ?></p>
                <p class="mb-2"><strong>E-mail:</strong> <span class="fw-bold"><?= $mail_empresa; ?></span></p>
            </div>

            <!-- Formulario -->
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Formulario de Contacto</h2>

                        <form method="post" class="needs-validation" novalidate>
                            <!-- Nombre -->
                            <div class="mb-1">
                                <label for="nombre" class="form-label">*Nombre</label>
                                <input type="text" class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>" 
                                    id="nombre" name="nombre" maxlength="50"
                                    value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>" required>
                                <?php if (isset($errors['nombre'])): ?>
                                    <div class="invalid-feedback"><?= $errors['nombre'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">*Email</label>
                                <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                                    id="email" name="email" maxlength="50"
                                    value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                                <?php if (isset($errors['email'])): ?>
                                    <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Teléfono -->
                            <div class="mb-3">
                                <label for="telefono" class="form-label">*Teléfono</label>
                                <input type="text" class="form-control <?= isset($errors['telefono']) ? 'is-invalid' : '' ?>" 
                                    id="telefono" name="telefono" maxlength="50"
                                    value="<?= isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : '' ?>" required>
                                <?php if (isset($errors['telefono'])): ?>
                                    <div class="invalid-feedback"><?= $errors['telefono'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Mensaje -->
                            <div class="mb-3">
                                <label for="mensaje" class="form-label">*Mensaje</label>
                                <textarea class="form-control <?= isset($errors['mensaje']) ? 'is-invalid' : '' ?>" 
                                    id="mensaje" name="mensaje" rows="5" required><?= isset($_POST['mensaje']) ? htmlspecialchars($_POST['mensaje']) : '' ?></textarea>
                                <?php if (isset($errors['mensaje'])): ?>
                                    <div class="invalid-feedback"><?= $errors['mensaje'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Botón -->
                            <div class="d-grid">
                                <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
                            </div>

                            <!-- Campos ocultos -->
                            <input type="hidden" name="asunto" value="Contacto - <?= isset($nombre_empresa) ? htmlspecialchars($nombre_empresa) : 'Sitio Web' ?>" />
                            <input type="hidden" name="pagina" value="contacto" />
                        </form>

                        <!-- Mensaje de respuesta -->
                        <div class="mt-4">
                            <?php if ($enviado === 'Si'): ?>
                                <div class="alert alert-success">Mensaje enviado con éxito. ¡Gracias por contactarnos!</div>
                            <?php elseif ($enviado === 'No'): ?>
                                <div class="alert alert-danger">Hubo un error al enviar el mensaje. Por favor intente nuevamente.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

