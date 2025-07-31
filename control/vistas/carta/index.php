<?php 
  $token=rand(); 
  $id_cliente=$_SESSION['id_cliente'];
  $nombresesion=$_SESSION['nombre'];
  $fecha=date('Y-m-d');

$sql="select * from cartas ORDER BY cartas.id DESC ";
  $cartas = $trabajo->getRegistrosSQL($sql); // TODA LA TABLA, ORDENADA
?>



<div id="contenidos">

<div class="panel panel-default">
<div class="panel-heading">
   <h2 class="panel-title">carta</h2>
     
          <div class="row"> 
                        <div class="col-lg-9"> 

                        </div> 
                        <div class="col-lg-3">
                                <div class="well well-sm ">
                                <button class=" btn btn-primary btn-sm" id="nuevaCarta" name='nuevaCarta' data="<?php echo $id_cliente; ?>">Añadir nuevo Carta</button>
                                </div>
                        </div>

          </div> 

 
</div>

<div class="panel-body" >
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Sección</th>
                    <th>Archivo PDF</th>
                    <th>Imágenes</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cartas as $carta): ?>
                <tr data-id="<?php echo $carta['id']; ?>">
                    <td><?php echo $carta['id']; ?></td>
                    <td contenteditable="true" class="editable" data-field="nombre"><?php echo htmlspecialchars($carta['nombre']); ?></td>
                    <td contenteditable="true" class="editable" data-field="descripcion"><?php echo htmlspecialchars($carta['descripcion']); ?></td>
                    <td>
                        <select class="form-select seccion-select" data-field="seccion">
                            <option value="Carta" <?php if($carta['seccion'] == 'Carta') echo 'selected'; ?>>Carta</option>
                            <option value="Celebraciones" <?php if($carta['seccion'] == 'Celebraciones') echo 'selected'; ?>>Celebraciones</option>
                        </select>
                    </td>
                    <td>
                        <?php if (!empty($carta['archivo'])): ?>
                            <a href="<?php echo  'http://www.manseo.es/new1/img/'.htmlspecialchars($carta['archivo']); ?>" target="_blank">Ver PDF</a><br>
                            
                        <?php endif; ?>
                        <input type="file" class="form-control-file archivo-input" name="archivo" accept="application/pdf">
                    </td>
                    <td contenteditable="false" class=" " data-field="imagen"><?php echo htmlspecialchars($carta['imagen']); ?>
                    <span class="archivo-actual"><?php echo htmlspecialchars($carta['archivo']); ?></span>ssss</td>
                    <td>
                        <input type="checkbox" class="editable-checkbox" data-field="activo" <?php if($carta['activo']) echo 'checked'; ?> />
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm guardar-carta">Guardar</button>
                        <button class="btn btn-danger btn-sm eliminar-carta">Eliminar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
  </div> <!-- fin panel-default-->
  </div> <!-- fin contenido- -->

<script>
// Edición inline y guardado con archivo
$(document).on('click', '.guardar-carta', function() {
    var $row = $(this).closest('tr');
    var id = $row.data('id');
    var formData = new FormData();
    formData.append('id', id);
    formData.append('nombre', $row.find('[data-field="nombre"]').text());
    formData.append('descripcion', $row.find('[data-field="descripcion"]').text());
    formData.append('seccion', $row.find('.seccion-select').val());
    formData.append('imagen', $row.find('[data-field="imagen"]').text());
    formData.append('activo', $row.find('.editable-checkbox').is(':checked') ? 1 : 0);
    formData.append('accion', 'guardarCarta');
    // Archivo
    var archivoInput = $row.find('.archivo-input')[0];
    if (archivoInput.files.length > 0) {
        formData.append('archivo', archivoInput.files[0]);
    } else {
        // Si no se sube archivo, enviar el nombre actual
        var archivoActual = $row.find('.archivo-actual').text();
        formData.append('archivo', archivoActual);
    }
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            //alert('Guardado correctamente');
            $('#mensaje').html(res);
            console.log(res);
        }
    });
});

// Eliminación
$(document).on('click', '.eliminar-carta', function() {
    if(confirm('¿Seguro que deseas eliminar esta carta?')) {
        var $row = $(this).closest('tr');
        var id = $row.data('id');
        $.post('ajax.php', {id: id, accion: 'eliminarregistro',tabla:'cartas'}, function(res) {
            $row.remove();
        });

   


    }
});

$( "#nuevaCarta" ).click(function() {
    var data = new FormData();
    data.append('accion','insertarNuevoRegistro');   
    data.append('tabla','cartas');  
    uploadAjax(data);

});

function uploadAjax(data){
    $('#mensaje').text('procesando...');
    var url = "ajax.php";
    $.ajax({
    url:url,
    type:'POST',
    contentType:false,
    data:data,
    processData:false,
    cache:false,
    success: function( respuesta2 ){
         $('#mensaje').html(respuesta2);
      setTimeout('document.location.reload()',1000)
    }});

}
</script>