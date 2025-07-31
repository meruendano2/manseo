<!-- Espacios Section -->
<div id="espacios" class="espacios">
    <div class="section-container">
        <h2 class="section-title playfair">UN LOCAL ÚNICO LLENO DE TRADICIÓN Y VANGUARDIA</h2>
        <p class="section-description">
            Manseo es un espacio multigastronómico    
            
        </p>
         <?php
            $sql="SELECT * FROM fotos where activo=1 and seccion='local' order by orden";
            $espacios=$trabajo->getRegistrosSQL($sql);
            ?>
            <!-- Carrusel solo en móvil -->
         <?php if (esDispositivoMovil()){ ?>
        <div class="d-block d-md-none mb-4">
            <div id="espaciosCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $first = true; foreach($espacios as $espacio): ?>
                        <div class="carousel-item<?= $first ? ' active' : '' ?>">
                            <img src="<?php echo "img/local/".htmlspecialchars($espacio['imagen']); ?>"
                                 class="d-block w-100"
                                 alt="<?php echo htmlspecialchars($espacio['nombre']); ?>">
                            <div class="carousel-caption d-block bg-dark bg-opacity-50 rounded p-2">
                                <h5><?php echo htmlspecialchars($espacio['nombre']); ?></h5>
                                <p><?php echo htmlspecialchars($espacio['descripcion']); ?></p>
                            </div>
                        </div>
                    <?php $first = false; endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#espaciosCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#espaciosCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
        <?php }
        else{ ?>
        <div class="espacios-grid   ">
           
             <?php 

            foreach($espacios as $espacio): ?>
            <div class="espacio-card">
                <img src="<?php echo "img/local/".htmlspecialchars($espacio['imagen']); ?>" 
                     alt="<?php echo htmlspecialchars($espacio['nombre']); ?>"
                     class="espacio-image">
                <div class="espacio-overlay">
                    <div class="espacio-content">
                        <h3 class="espacio-title"><?php echo htmlspecialchars($espacio['nombre']); ?></h3>
                        <p><?php echo htmlspecialchars($espacio['descripcion']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php } ?>
    </div>
</div> 