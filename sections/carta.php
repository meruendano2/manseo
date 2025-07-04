<!-- Carta Section -->
<div id="carta" class="espacios">
    <div class="section-container">
        <h2 class="section-title playfair">NUESTRA CARTA</h2>
        <p class="section-description">
            Descubre nuestra selección de platos y bebidas. Usa las flechas para navegar.
        </p>
        <div class="carta-container">
            <div class="carta-pdf">
                <button class="nav-arrow prev-arrow" aria-label="Página anterior">❮</button>
                <div id="flipbook">
                    <div class="pages">
                        <div class="page">
                            <img src="img/carta_masneo_pages-to-jpg-0001.jpg" alt="Página 1">
                        </div>
                        <div class="page">
                            <img src="img/carta_masneo_pages-to-jpg-0002.jpg" alt="Página 2">
                        </div>
                        <div class="page">
                            <img src="img/carta_masneo_pages-to-jpg-0003.jpg" alt="Página 3">
                        </div>
                        <div class="page">
                            <img src="img/carta_masneo_pages-to-jpg-0004.jpg" alt="Página 4">
                        </div>
                    </div>
                </div>
                <button class="nav-arrow next-arrow" aria-label="Página siguiente">❯</button>
            </div>
            <div class="carta-buttons">
                <a href="img/carta_masneo.pdf" class="button button-primary" target="_blank">DESCARGAR CARTA</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var currentPage = 1;
        var totalPages = 4;
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
