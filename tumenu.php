<?php 
?>
<div class="modal fade" id="tumenu" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"><!-- Cambiado a modal-lg para más ancho -->
    <div class="modal-content" style="border-color: var(--color-principal, #caa65c);">
      <div class="modal-header d-flex justify-content-between align-items-center" style="background: var(--color-principal, #caa65c); color: #fff;">
        <h5 class="modal-title mb-0" id="myModalLabel" style="font-size:1rem;">
          Restaurante ManSeo - Menú grupos (mín. 6 adultos)
        </h5>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body" style="padding: 0.7rem;">
        <!-- Entrantes -->
        <div class="mb-2">
          <div class="card mb-2" style="border-color: var(--color-principal, #caa65c);">
            <div class="card-header py-2" style="background: var(--color-principal, #caa65c); color: #fff; font-size:0.95rem;">
              <h6 class="mb-0" style="font-size:0.95rem;">Entrantes <span id="men1"></span></h6>
            </div>
            <div class="card-body row p-2">
              <?php 
              foreach ($entrantes as $i => $campo) {
                $id = 'entrante_' . $campo['id'];
                echo "
                <div class='col-6 mb-1'>
                  <div class='form-check'>
                    <input class='form-check-input estilo entrantes' type='checkbox' 
                      id='$id'
                      data-label='".$campo['nombre']."'
                      precio1='".$campo['precio1']."'
                      precio2='".$campo['precio2']."'
                      precio3='".$campo['precio3']."'
                      precio4='".$campo['precio4']."'
                      precio5='".$campo['precio5']."'
                      idregistro='".$campo['id']."'>
                    <label class='form-check-label' for='$id' style='color: var(--color-texto, #3b2e2a); font-size:0.90rem;'>".$campo['nombre']."</label>
                  </div>
                </div>";
              }
              ?>
            </div>
          </div>
        </div>

        <!-- Platos -->
        <div class="mb-2">
          <div class="card mb-2" style="border-color: var(--color-secundario, #e5cfc3);">
            <div class="card-header py-2" style="background: var(--color-secundario, #e5cfc3); color: var(--color-principal, #b48a78); font-size:0.95rem;">
              <h6 class="mb-0" style="font-size:0.95rem;">Platos <span id="men2"></span></h6>
            </div>
            <div class="card-body row p-2">
              <?php 
              foreach ($plato as $i => $campo) {
                $id = 'plato_' . $campo['id'];
                echo "
                <div class='col-6 mb-1'>
                  <div class='form-check'>
                    <input class='form-check-input estilo platos' type='checkbox' 
                      id='$id'
                      data-label='".$campo['nombre']."'
                      precio1='".$campo['precio1']."'
                         precio2='".$campo['precio2']."'
                      precio3='".$campo['precio3']."'
                      precio4='".$campo['precio4']."'
                      precio5='".$campo['precio5']."'
                      idregistro='".$campo['id']."'>
                    <label class='form-check-label' for='$id' style='color: var(--color-texto, #3b2e2a); font-size:0.90rem;'>".$campo['nombre']."</label>
                  </div>
                </div>";
              }
              ?>
            </div>
          </div>
        </div>

        <!-- Complementos -->
        <div class="mb-2">
          <div class="card mb-2" style="border-color: var(--color-amarillo, #ffe7b2);">
            <div class="card-header py-2" style="background: var(--color-amarillo, #ffe7b2); color: var(--color-principal, #b48a78); font-size:0.95rem;">
              <h6 class="mb-0" style="font-size:0.95rem;">Complementos <span id="men3"></span></h6>
            </div>
            <div class="card-body row p-2">
              <?php 
              foreach ($complementos as $i => $campo) {
                $id = 'complemento_' . $campo['id'];
                echo "
                <div class='col-6 mb-1'>
                  <div class='form-check'>
                    <input class='form-check-input estilo complementos' type='checkbox' 
                      id='$id'
                      data-label='".$campo['nombre']."'
                      precio1='".$campo['precio1']."'
                      idregistro='".$campo['id']."'>
                    <label class='form-check-label' for='$id' style='color: var(--color-texto, #3b2e2a); font-size:0.90rem;'>".$campo['nombre']."</label>
                  </div>
                </div>";
              }
              ?>
            </div>
          </div>
        </div>

        <!-- Total -->
        <div class="mb-2 text-center">
          <hr>
          <h6 style="color: var(--color-principal, #b48a78); font-size:0.95rem;">Precio por adulto: <span id="preciototal2" class="fw-bold"></span></h6>
        </div>

        <!-- Formulario -->
        <div class="card mb-2" style="border-color: var(--color-principal, #b48a78);">
          <div class="card-header py-2" style="background: var(--color-principal, #b48a78); color: #fff; font-size:0.95rem;">
            <h6 class="mb-0" style="font-size:0.95rem;">Reserva</h6>
          </div>
          <div class="card-body p-2">
            <form class="row" id="formmenu" method="POST" role="form">
              <div class="col-12 mb-2">
                <label for="nombre" style="color: var(--color-principal, #b48a78); font-size:0.90rem;">Nombre</label>
                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Tu nombre" required>
              </div>
              <div class="col-12 mb-2">
                <label for="mail" style="color: var(--color-principal, #b48a78); font-size:0.90rem;">Correo</label>
                <input type="email" class="form-control form-control-sm" id="mail" name="mail" placeholder="Tu correo" required>
              </div>
              <div class="col-12 mb-2">
                <label for="telefono" style="color: var(--color-principal, #b48a78); font-size:0.90rem;">Teléfono</label>
                <input type="text" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="Tu teléfono" required>
              </div>
              <div class="col-12 mb-2">
                <label for="comentario" style="color: var(--color-principal, #b48a78); font-size:0.90rem;">Comentario</label>
                <input type="text" class="form-control form-control-sm" id="comentario" name="comentario" placeholder="Tu comentario">
              </div>
              <div class="col-6 mb-2">
                <label for="adultos" style="color: var(--color-principal, #b48a78); font-size:0.90rem;">Adultos</label>
                <input type="number" class="form-control form-control-sm" id="adultos" name="adultos" required value="6" min="6">
              </div>
              <div class="col-6 mb-2">
                <label for="ninos" style="color: var(--color-principal, #b48a78); font-size:0.90rem;">Niños 4-8</label>
                <input type="number" class="form-control form-control-sm" id="ninos" name="ninos" value="0">
              </div>
              <div class="col-6 mb-2">
                <label for="ninos2" style="color: var(--color-principal, #b48a78); font-size:0.90rem;">Niños &lt;4</label>
                <input type="number" class="form-control form-control-sm" id="ninos2" name="ninos2" value="0">
              </div>
              <div class="col-6 mb-2">
                <label style="color: var(--color-principal, #b48a78); font-size:0.90rem;">Fecha</label>
                <input type="date" class="form-control form-control-sm" name="fecha" id="fecha">
              </div>
              <div class="col-6 mb-2">
                <label style="color: var(--color-principal, #b48a78); font-size:0.90rem;">Hora</label>
                <input type="text" class="form-control form-control-sm" name="hora" id="hora">
              </div>
              <input type="hidden" name="accion" id="accion" value="enviarmenu">
              <div class="col-12 mt-2 text-center">
                <button type="submit" class="btn btn-primary btn-sm" style="background: var(--color-principal, #b48a78); border: none;">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal-footer py-2">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>







