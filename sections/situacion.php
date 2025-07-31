<!-- Contacto Section -->
 
    <div id="situacion" class="contacto t">
    <div class="container">
        <div class="row  align-items-start">

               
            <div class="  col-md-5">
                <h2 class="section-title playfair  mb-4">DÓNDE ESTAMOS</h2>
                 
                  <p class="mb-2 text-center">
                    <i class="bi bi-geo-alt" style="color:#caa65c;"></i>
                    <?= $direccion_empresa; ?>
                </p>
                <p class="mb-2 text-center">
                    <i class="bi bi-geo" style="color:#caa65c;"></i>
                    <?= $poblacion_empresa; ?> - <?= $cp_empresa; ?>
                </p>
                <p class="mb-2 text-center">
                    <i class="bi bi-whatsapp" style="color:#25d366;"></i>
                    <strong>Whatsapp:</strong>
                    <a href="https://wa.me/<?= preg_replace('/\D+/', '', $whatsapp); ?>" class="text-decoration-none"><?= $tel_empresa; ?></a>
                </p>
                <p class="mb-2 text-center">
                    <i class="bi bi-telephone" style="color:#caa65c;"></i>
                    <strong>Tel:</strong>
                    <a href="tel:<?= preg_replace('/\D+/', '', $tel_empresa); ?>" class="text-decoration-none"><?= $tel_empresa; ?></a>
                </p>
                <p class="mb-2 text-center">
                    <i class="bi bi-envelope" style="color:#caa65c;"></i>
                    <strong>E-mail:</strong>
                    <a href="mailto:<?= $mail_empresa; ?>" class="fw-bold text-decoration-none"><?= $mail_empresa; ?></a>
                </p>
                
                
                <h2 class="section-title playfair  mb-4">NUESTRO HORARIO</h2>
                <div class="horario-item">
                    <?php
                    $sql="SELECT * FROM horarios  where activo=1 ";
                    $horarios=$trabajo->getRegistrosSQL($sql);
                    foreach($horarios as $horario): ?>
                            <p class="mb-2  text-center" ><strong><?php echo htmlspecialchars($horario['nombre']); ?></strong><?php echo htmlspecialchars($horario['horas']); ?></p>
                    <?php endforeach; ?>
                    </div>
            </div>
            <div class="mapa col-md-7">
                <div class="ratio ratio-16x9" style="min-height:200px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2944.888884887077!2d-8.638788684586101!3d42.43009997918229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2f71b7933df6fb%3A0xf23bed3f742992f0!2sR%C3%BAa+San+Antoni%C3%B1o%2C+65%2C+36002+Pontevedra!5e0!3m2!1ses!2ses!4v1472497166011"
                        style="border:0; width:100%; height:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <br /><br />
            </div>
        </div>
    </div>
</div> 
<br><br>