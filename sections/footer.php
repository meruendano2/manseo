<!-- Footer -->
<footer class="footer">
    <div class="footer-container d-flex flex-column flex-md-row justify-content-between align-items-center py-3" style="gap: 10px;">
        
        <div class="footer-links d-flex align-items-center" style="gap: 15px;">
            <span class="fw-bold playfair " style="color:#caa65c;">Restaurante ManSeo</span>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalPrivacidad" class="text-decoration-none" style="color:#caa65c;">Política Privacidad</a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalConcidiciones" class="text-decoration-none" style="color:#caa65c;">Condiciones Uso</a>
        </div>

        <div class="social-links d-flex align-items-center">
            <a href="<?= $facebook; ?>" target="_blank" aria-label="Facebook" style="color:#caa65c; margin-right:10px;">
                <i class="bi bi-facebook" style="font-size: 2rem; vertical-align: middle;"></i>
            </a>
            <a href="<?= $instagram; ?>" target="_blank" aria-label="Instagram" style="color:#caa65c;">
                <i class="bi bi-instagram" style="font-size: 2rem; vertical-align: middle;"></i>
            </a>
        </div>
    </div>
</footer>

<!-- Modal Política de Privacidad -->
<div class="modal fade" id="modalPrivacidad" tabindex="-1" aria-labelledby="modalPrivacidadLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background:#caa65c; color:#fff;">
        <h5 class="modal-title" id="modalPrivacidadLabel"><?= $politica['nombre']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" style="color:#333;">
        <p>
       
            <?= $politica['descripcion']; ?>
        </p>
        
        <p>
          Para más información, contacta con nosotros en <a href="mailto:<?= $mail_empresa; ?>"><?= $mail_empresa; ?></a>.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Política de modalConcidiciones -->
<div class="modal fade" id="modalConcidiciones" tabindex="-1" aria-labelledby="modalcondicionesLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background:#caa65c; color:#fff;">
        <h5 class="modal-title" id="modalcondicionesLabel"> <?= $condiciones['nombre']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" style="color:#333;">
        <p>
       
            <?= $condiciones['descripcion']; ?>
        </p>
        
        <p>
          Para más información, contacta con nosotros en <a href="mailto:<?= $mail_empresa; ?>"><?= $mail_empresa; ?></a>.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>