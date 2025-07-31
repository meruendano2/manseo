
<?php
// obtengo la carta
$sql="select * from cartas where seccion='Celebraciones' AND activo=1  ";
$cartas=$trabajo->getRegistrosSQL($sql);
?>

<!-- Celebraciones Section -->
<div id="celebraciones" class="espacios">
    <div class="section-container">
        <h2 class="section-title playfair">CELEBRACIONES</h2>
        <p class="section-description">
            Celebra tus momentos especiales con nosotros. Organizamos eventos personalizados para bodas, comuniones, bautizos, cumpleaños y más. ¡Consulta nuestras opciones y haz de tu celebración un recuerdo inolvidable!
        </p>

        <div class="d-flex flex-wrap gap-3 justify-content-center mb-4">
            <?php foreach ($cartas as $i => $carta) { ?>
                <a href="#" class="btn btn-lg rounded-pill px-4 celebracion-btn" data-index="<?php echo $i; ?>" style="background-color: #caa65c;">
                    <?php echo htmlspecialchars($carta['nombre']); ?>
                </a>
            <?php } ?>
        </div>

        <div id="celebracion-descripcion" class="text-center mt-4" style="display:none;"></div>
    </div>
</div>

<script>
const descripciones = <?php echo json_encode(array_column($cartas, 'descripcion')); ?>;
const archivos = <?php echo json_encode(array_column($cartas, 'archivo')); ?>;
$(document).on('click', '.celebracion-btn', function(e) {
    e.preventDefault();
    var idx = $(this).data('index');
    var desc = descripciones[idx] || '';
   // var pdf = archivos[idx] ? '<div class="my-3"><iframe src="img/' + archivos[idx] + '" width="100%" height="500px" style="border:1px solid #ccc; max-width:800px;"></iframe></div>' : '';
    var pdf = archivos[idx] ? '<div class="my-3"><object data="img/' + archivos[idx] + '" type="application/pdf" width="100%" height="800px" style="border:1px solid #ccc; max-width:800px;"><p>No se pudo mostrar el PDF. <a href="img/' + archivos[idx] + '" target="_blank">Haz clic aquí para verlo</a>.</p></object></div>' : '';

    if(desc || pdf) {
        $('#celebracion-descripcion').html('<div class="card card-body">' + desc + '<br>' + pdf + '</div>').show();
    } else {
        $('#celebracion-descripcion').hide();
    }
});
</script> 