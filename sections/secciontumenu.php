<!-- Sección Tu Menú para grupos (mínimo 6 adultos) -->
<section id="secciontumenu" class="seccion-tumenu py-5">
    <div class="container pt-5">
        <h2 class="section-title playfair mb-4 text-center" style="color: var(--color-principal, #b48a78);">
            Restaurante ManSeo  
        </h2>
        <h6 class="    mb-4 text-center" style="color: var(--color-principal, #b48a78);">
            Configura tu Menú para grupos<br> (mínimo 6 adultos)
        </h6>
        <div class="row">
            <div class="col-12">
                <!-- Entrantes -->
                <div class="card mb-4" style="border-color: var(--color-principal, #b48a78);">
                    <div class="card-header" style="background: var(--color-principal, #b48a78); color: #fff;">
                        <h6 class="mb-0">Entrantes <span id="men1"></span></h6>
                    </div>
                    <div class="card-body row">
                        <?php 
                        foreach ($entrantes as $i => $campo) {
                            $id = 'entrante_' . $campo['id'];
                            echo "
                            <div class='col-lg-4 col-md-6 mb-2'>
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
                                    <label class='form-check-label' for='$id' style='color: var(--color-texto, #3b2e2a);'>".$campo['nombre']."</label>
                                </div>
                            </div>";
                        }
                        ?>
                    </div>
                </div>
                <!-- Platos -->
                <div class="card mb-4" style="border-color: var(--color-secundario, #e5cfc3);">
                    <div class="card-header" style="background: var(--color-secundario, #e5cfc3); color: var(--color-principal, #b48a78);">
                        <h6 class="mb-0">Platos <span id="men2"></span></h6>
                    </div>
                    <div class="card-body row">
                        <?php 
                        foreach ($plato as $i => $campo) {
                            $id = 'plato_' . $campo['id'];
                            echo "
                            <div class='col-lg-4 col-md-6 mb-2'>
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
                                    <label class='form-check-label' for='$id' style='color: var(--color-texto, #3b2e2a);'>".$campo['nombre']."</label>
                                </div>
                            </div>";
                        }
                        ?>
                    </div>
                </div>
                <!-- Complementos -->
                <div class="card mb-4" style="border-color: var(--color-amarillo, #ffe7b2);">
                    <div class="card-header" style="background: var(--color-amarillo, #ffe7b2); color: var(--color-principal, #b48a78);">
                        <h6 class="mb-0">Complementos <span id="men3"></span></h6>
                    </div>
                    <div class="card-body row">
                        <?php 
                        foreach ($complementos as $i => $campo) {
                            $id = 'complemento_' . $campo['id'];
                            echo "
                            <div class='col-lg-4 col-md-6 mb-2'>
                                <div class='form-check'>
                                    <input class='form-check-input estilo complementos' type='checkbox' 
                                        id='$id'
                                        data-label='".$campo['nombre']."'
                                        precio1='".$campo['precio1']."'
                                        idregistro='".$campo['id']."'>
                                    <label class='form-check-label' for='$id' style='color: var(--color-texto, #3b2e2a);'>".$campo['nombre']."</label>
                                </div>
                            </div>";
                        }
                        ?>
                    </div>
                </div>
                <!-- Total -->
                <div class="row mb-4">
                    <div class="col text-center">
                        <hr>
                        <h3 style="color: var(--color-principal, #b48a78);">Precio total por persona adulta: <span id="preciototal2" class="fw-bold"></span></h3>
                    </div>
                </div>
                <!-- Formulario -->
                <div class="card mb-4" style="border-color: var(--color-principal, #b48a78);">
                    <div class="card-header" style="background: var(--color-principal, #b48a78); color: #fff;">
                        <h6 class="mb-0">Confirma tu menú y reserva</h6>
                    </div>
                    <div class="card-body">
                        <form class="row" id="formmenu" method="POST" role="form">
                            
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="nombre" style="color: var(--color-principal, #b48a78);">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="mail" style="color: var(--color-principal, #b48a78);">Correo</label>
                                    <input type="email" class="form-control" id="mail" name="mail" placeholder="Tu correo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" style="color: var(--color-principal, #b48a78);">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tu teléfono" required>
                                </div>
                                <div class="mb-3">
                                    <label for="comentario" style="color: var(--color-principal, #b48a78);">Comentario</label>
                                    <input type="text" class="form-control" id="comentario" name="comentario" placeholder="Tu comentario">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="adultos" style="color: var(--color-principal, #b48a78);">Adultos (mayores de 9 años)</label>
                                    <input type="number" class="form-control" id="adultos" name="adultos" required value="6" min="6">
                                </div>
                                <div class="mb-3">
                                    <label for="ninos" style="color: var(--color-principal, #b48a78);">Niños entre 4 y 8 años (1/2 plato)</label>
                                    <input type="number" class="form-control" id="ninos" name="ninos" value="0">
                                </div>
                                <div class="mb-3">
                                    <label for="ninos2" style="color: var(--color-principal, #b48a78);">Niños menores de 4 (Gratis)</label>
                                    <input type="number" class="form-control" id="ninos2" name="ninos2" value="0">
                                </div>
                                <div class="mb-3">
                                    <label style="color: var(--color-principal, #b48a78);">Fecha</label>
                                    <div class="input-group calendario">
                                        <input type="date" class="form-control" name="fecha" id="fecha">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label style="color: var(--color-principal, #b48a78);">Hora</label>
                                    <input type="text" class="form-control" name="hora" id="hora">
                                </div>
                                <input type="hidden" name="accion" id="accion" value="enviarmenu">
                            </div>
                            <div class="col-lg-3">
                                <h5 style="color: var(--color-principal, #b48a78);">Importe adultos: <span id="importeadultos"></span></h5>
                                <h5 style="color: var(--color-principal, #b48a78);">Importe niños: <span id="importeninos"></span></h5>
                                <hr>
                                <h3 style="color: var(--color-principal, #b48a78);">Total: <span id="importetotal" class="fw-bold"></span></h3>
                                <button type="submit" class="btn btn-primary mt-3" id="enviar" style="background: var(--color-principal, #b48a78); border: none;">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="resultado"></div>
            </div>
        </div>
    </div>
</section>



