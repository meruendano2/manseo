<!-- Contacto Section -->
<div id="situacion" class="situacion">
    <div class="container">
        <div class="row g-5 align-items-start">

               
            <div class="  col-md-5">
                <h2 class="section-title playfair  mb-4">DÓNDE ESTAMOS</h2>
                <p class="mb-2"><?php echo $nombre_empresa;?> </p> 
                <p class="mb-2"><?php echo $direccion_empresa;?>    </p>
                <p class="mb-2"> <?php echo $poblacion_empresa;?>  - <?php echo $cp_empresa;?></p> 
                <p class="mb-2"><strong>Tel:</strong><?php echo $tel_empresa;?> </p>          
                <p class="mb-2"><strong>E-mail:</strong> <span class="negrita"><?php echo $mail_empresa;?> </p>
           
                
                
                <h2 class="section-title playfair  mb-4">NUESTRO HORARIO</h2>
                <div class="horario-item">
                <?php
                $sql="SELECT * FROM horarios  where activo=1 ";
                $horarios=$trabajo->getRegistrosSQL($sql);
                foreach($horarios as $horario): ?>
                        <p class="mb-2" ><strong><?php echo htmlspecialchars($horario['nombre']); ?></strong><?php echo htmlspecialchars($horario['horas']); ?></p>
                <?php endforeach; ?>
                </div>
                </div>
            <div class="mapa col-md-7">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2944.888884887077!2d-8.638788684586101!3d42.43009997918229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2f71b7933df6fb%3A0xf23bed3f742992f0!2sR%C3%BAa+San+Antoni%C3%B1o%2C+65%2C+36002+Pontevedra!5e0!3m2!1ses!2ses!4v1472497166011"width="700" height="450" frameborder="0" style="border:0" allowfullscreen></iframe><br /><br />

            </div>
        </div>
    </div>
</div> 
<br><br><br><br><br><br><br><br>