<!-- Carta Section -->
<?php
// obtengo la carta
$sql="select * from cartas where seccion='Carta' AND activo=1 Limit 1";
 
$carta=$trabajo->getRegistrosSQL($sql);
 

$imagenesRaw = explode(',', $carta[0]['imagen']);

$imagenesCarta = array_filter(array_unique(array_map('trim', $imagenesRaw)));
$cartaPDF=$carta[0]['archivo'];






?>




<div id="carta" class="espacios">
    <div class="section-container">
        <h2 class="section-title playfair">NUESTRA CARTA</h2>
        <p class="section-description">
            Descubre nuestra selección de platos y bebidas. Usa las flechas para navegar.<?php echo count($imagenesCarta); ?>
        </p>
        <div class="carta-container">
            <div class="carta-pdf">
                <button class="nav-arrow prev-arrow" aria-label="Página anterior">❮</button>
                <div id="flipbook">
                    <div class="pages">
                        <?php foreach ($imagenesCarta as $imagen) { ?>
                        <div class="page">
                            <img src="img/<?php echo $imagen; ?>" alt="carta" >
                        </div>
                        <?php } ?>
                      
                    </div>
                </div>
                <button class="nav-arrow next-arrow" aria-label="Página siguiente">❯</button>
            </div>
            <div class="carta-buttons">
                <a href="img/<?php echo $cartaPDF; ?>" class="button button-primary" target="_blank">DESCARGAR CARTA</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var currentPage = 1;
        var totalPages =<?php echo count($imagenesCarta);?>;
        var isAnimating = false;
        var $pages = $('#flipbook .pages');
        var $flipbook = $('#flipbook');

        function adjustSize() {
            var firstImage = $flipbook.find('img').first();
            var imageWidth = firstImage[0].naturalWidth;
            var aspectRatio = imageWidth / firstImage[0].naturalHeight;
            if (imageWidth < $flipbook.width()) {
                $flipbook.css('width', imageWidth + 'px');
            }
            var newHeight = $flipbook.width() / aspectRatio;
            $flipbook.css('height', newHeight + 'px');
        }

        function showPage(pageNum) {
            if (isAnimating) return;
            isAnimating = true;
            var offset = -(pageNum - 1) * 25;
            $pages.css('transform', 'translateX(' + offset + '%)');
            $('.prev-arrow').toggle(pageNum > 1);
            $('.next-arrow').toggle(pageNum < totalPages);
            setTimeout(() => isAnimating = false, 300);
        }

        $('.prev-arrow').click(() => {
            if (currentPage > 1 && !isAnimating) {
                currentPage--;
                showPage(currentPage);
            }
        });

        $('.next-arrow').click(() => {
            if (currentPage < totalPages && !isAnimating) {
                currentPage++;
                showPage(currentPage);
            }
        });

        $(window).on('load resize', adjustSize);
        showPage(1);

        // Soporte táctil
        let startX = 0;
        let endX = 0;

        $flipbook.on('touchstart', function (e) {
            startX = e.originalEvent.touches[0].clientX;
        });

        $flipbook.on('touchend', function (e) {
            endX = e.originalEvent.changedTouches[0].clientX;
            var delta = endX - startX;
            if (Math.abs(delta) > 50) {
                if (delta > 0 && currentPage > 1) {
                    currentPage--;
                } else if (delta < 0 && currentPage < totalPages) {
                    currentPage++;
                }
                showPage(currentPage);
            }
        });
    });
</script>
