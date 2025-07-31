<!-- Bootstrap CSS (en el <head>) -->


<!-- Navbar -->
<?php
// Color personalizado para todos los menús con sombra negra
$colorMenu = 'style="color: #caa65c !important; text-shadow: 2px 2px 4px #000, 0 1px 0 #fff;"';

// Detecta si es móvil para cambiar el fondo
$navbarBg = esDispositivoMovil() ? 'bg-secondary' : 'bg-light';
?>
<nav class="navbar navbar-expand-lg navbar-light <?= $navbarBg ?>" style="background: rgba(34, 34, 34, 0.40) !important;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="img/logo2.png" alt="MANSEO" class="logo-img" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" <?= $colorMenu ?> href="#inicio">INICIO</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" <?= $colorMenu ?> href="#carta">CARTA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" <?= $colorMenu ?> href="#" data-bs-toggle="modal" data-bs-target="#menudia">MENÚ DEL DÍA</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" <?= $colorMenu ?> href="#celebraciones">CELEBRACIONES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" <?= $colorMenu ?> href="#espacios">ESPACIOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" <?= $colorMenu ?> href="#fotosplatos">PLATOS</a>
                </li>
                <?php
                    if (esDispositivoMovil()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" <?= $colorMenu ?> href="#secciontumenu">CONFIGURA TU MENÚ</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" <?= $colorMenu ?> href="#" data-bs-toggle="modal" data-bs-target="#tumenu">CONFIGURA TU MENÚ</a>
                        </li>
                    <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" <?= $colorMenu ?> href="#contacto">CONTACTO</a>
                </li>
               
            </ul>
        </div>
    </div>
</nav>

<script>
// Cierra el menú hamburguesa al hacer clic en cualquier enlace del menú (solo en móvil)
document.addEventListener('DOMContentLoaded', function () {
    var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    var navbarCollapse = document.getElementById('navbarNav');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 992) { // lg breakpoint
                var bsCollapse = bootstrap.Collapse.getOrCreateInstance(navbarCollapse);
                bsCollapse.hide();
            }
        });
    });
});
$(document).on('click', '.navbar-nav .nav-link', function() {
    $('#celebracion-descripcion').hide();
});
</script>

