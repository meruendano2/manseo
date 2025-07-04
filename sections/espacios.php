<!-- Espacios Section -->
<div id="espacios" class="espacios">
    <div class="section-container">
        <h2 class="section-title playfair">UN LOCAL ÚNICO LLENO DE TRADICIÓN Y VANGUARDIA</h2>
        <p class="section-description">
            Manseo es un espacio multigastronómico    
            
        </p>
        <div class="espacios-grid">
            <?php
            $sql="SELECT * FROM espacios where activo=1 order by orden";
            $espacios=$trabajo->getRegistrosSQL($sql);
           

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
    </div>
</div> 