<!-- Fotos de Platos Section -->
<div id="fotosplatos" class="espacios">
    <div class="section-container">
        <h2 class="section-title playfair">GALERÍA DE PLATOS</h2>
        <p class="section-description">
            Descubre una selección visual de nuestros platos más destacados y deliciosos.
        </p>
        <div class="fotosplatos-carousel" id="fotosplatos-carousel">
            <?php
            $sql="SELECT * FROM fotos where activo=1 and seccion='plato' order by orden";
            $fotosplatos = $trabajo->getRegistrosSQL($sql);

            foreach($fotosplatos as $campo): ?>
            <div class="plato-card">
                <img src="<?php echo "img/plato/" . htmlspecialchars($campo['imagen']); ?>"
                     alt="<?php echo htmlspecialchars($campo['nombre']); ?>"
                     class="plato-image"
                     onclick="mostrarModal('<?php echo "img/plato/" . htmlspecialchars($campo['imagen']); ?>', '<?php echo htmlspecialchars(addslashes($campo['nombre'])); ?>', '<?php echo htmlspecialchars(addslashes($campo['descripcion'])); ?>')">
                <div class="plato-overlay">
                    <div class="plato-content">
                        <h3 class="plato-title"><?php echo htmlspecialchars($campo['nombre']); ?></h3>
                         
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<br><br><br><br>

<!-- Modal para imagen grande -->
<div id="modalPlato" class="modal-plato" onclick="cerrarModal()" style="display:none;">
    <div class="modal-plato-content" onclick="event.stopPropagation()">
        <span class="modal-plato-close" onclick="cerrarModal()">&times;</span>
        <img id="modalPlatoImg" src="" alt="" />
        <h3 id="modalPlatoTitulo"></h3>
        <p id="modalPlatoDesc"></p>
    </div>
</div>

<style>
.fotosplatos-carousel {
    display: flex;
    overflow-x: auto;
    scroll-behavior: smooth;
    gap: 20px;
    padding-bottom: 16px;
    scrollbar-width: none;
    align-items: flex-start;
}
.fotosplatos-carousel::-webkit-scrollbar {
    display: none;
}
.plato-card {
    min-width: 180px;
    max-width: 180px;
    flex: 0 0 180px;
    position: relative;
    transition: transform 0.3s;
    cursor: pointer;
}
.plato-image {
    width: 100%;
    height: 130px;
    object-fit: cover;
    border-radius: 12px;
    display: block;
}
.plato-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.5);
    color: #fff;
    padding: 8px;
    border-radius: 0 0 12px 12px;
    opacity: 0;
    transition: opacity 0.3s;
    font-size: 13px;
}
.plato-card:hover .plato-overlay {
    opacity: 1;
}
.plato-title {
    font-size: 15px;
    margin: 0 0 2px 0;
}
.plato-content p {
    font-size: 13px;
    margin: 0;
}

/* Modal estilos */
.modal-plato {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 9999;
    left: 0; top: 0; width: 100vw; height: 100vh;
    background: rgba(0,0,0,0.7);
}
.modal-plato-content {
    background: #fff;
    border-radius: 12px;
    padding: 24px 24px 16px 24px;
    max-width: 90vw;
    max-height: 90vh;
    text-align: center;
    position: relative;
    box-shadow: 0 4px 32px rgba(0,0,0,0.3);
}
.modal-plato-content img {
    max-width: 60vw;
    max-height: 60vh;
    border-radius: 10px;
    margin-bottom: 12px;
}
.modal-plato-close {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 32px;
    color: #333;
    cursor: pointer;
    font-weight: bold;
    z-index: 2;
}
@media (max-width: 600px) {
    .modal-plato-content img {
        max-width: 90vw;
        max-height: 40vh;
    }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('fotosplatos-carousel');
    let maxScroll = carousel.scrollWidth - carousel.clientWidth;
    let direction = 1;

    function autoScroll() {
        if (carousel.scrollLeft >= maxScroll) direction = -1;
        if (carousel.scrollLeft <= 0) direction = 1;
        carousel.scrollLeft += direction * 1.5;
    }
    setInterval(autoScroll, 20);
});

// Modal JS
function mostrarModal(src, titulo, desc) {
    document.getElementById('modalPlatoImg').src = src;
    document.getElementById('modalPlatoTitulo').textContent = titulo;
    document.getElementById('modalPlatoDesc').textContent = desc;
    document.getElementById('modalPlato').style.display = 'flex';
}
function cerrarModal() {
    document.getElementById('modalPlato').style.display = 'none';
}
</script>