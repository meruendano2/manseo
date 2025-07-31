<?php 
  $token=rand(); 
  $id_cliente=$_SESSION['id_cliente'];
  $nombresesion=$_SESSION['nombre'];
  $fecha=date('Y-m-d');

$sql="select * from fotos  ORDER BY fotos.id DESC";
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
                                <button class=" btn btn-primary btn-sm" id="nuevaFoto" name='nuevaFoto' data="<?php echo $id_cliente; ?>">Añadir Nueva Foto</button>
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
                   
                    <th>Activo</th>
                    <th>Acciones</th>
                    <th> </th>
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
                            <option value="local" <?php if($carta['seccion'] == 'local') echo 'selected'; ?>>Local</option>
                            <option value="plato" <?php if($carta['seccion'] == 'plato') echo 'selected'; ?>>Plato</option>
                        </select>
                    </td>
                    <td>
                        <?php if (!empty($carta['imagen'])): ?>
                            <img src="<?php echo 'http://www.manseo.es/new1/img/' . $carta['seccion'] . '/' . $carta['imagen']; ?>" style="max-width: 100px; height: auto;" alt="Imagen" />

                            
                        <?php endif; ?>
                        <input type="file" class="form-control-file imagen-input" name="imagen" accept="image/*">

                    </td>
              
                    <td>
                        <input type="checkbox" class="editable-checkbox" data-field="activo" <?php if($carta['activo']) echo 'checked'; ?> />
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm guardar-foto">Guardar</button>
                        <button class="btn btn-danger btn-sm eliminar-foto">Eliminar</button>
                    </td>
                    <td contenteditable="false" class="editable" data-field="imagen-actual"><?php echo htmlspecialchars($carta['imagen']); ?></td>
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
$(document).on('click', '.guardar-foto', function() {
    var $row = $(this).closest('tr');
    var id = $row.data('id');
    var formData = new FormData();
    formData.append('id', id);
    formData.append('nombre', $row.find('[data-field="nombre"]').text());
    formData.append('descripcion', $row.find('[data-field="descripcion"]').text());
    formData.append('seccion', $row.find('.seccion-select').val());
    
    formData.append('activo', $row.find('.editable-checkbox').is(':checked') ? 1 : 0);
    formData.append('accion', 'guardarFoto');
    // Archivo
    var archivoInput = $row.find('.imagen-input')[0];
    if (archivoInput.files.length > 0) {
        formData.append('imagen', archivoInput.files[0]);
    } else {
        // Si no se sube archivo, enviar el nombre actual
        var archivoActual =$row.find('[data-field="imagen-actual"]').text();
        formData.append('imagen', archivoActual);
        console.log("sin imagen");
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
            setTimeout('document.location.reload()',1000)
        }
    });
});

// Eliminación
$(document).on('click', '.eliminar-foto', function() {
    if(confirm('¿Seguro que deseas eliminar esta foto?')) {
        var $row = $(this).closest('tr');
        var id = $row.data('id');
        $.post('ajax.php', {id: id, accion: 'eliminarregistro',tabla:'fotos'}, function(res) {
            $row.remove();
        });

   


    }
});

$( "#nuevaFoto" ).click(function() {
    var data = new FormData();
    data.append('accion','insertarNuevoRegistro');   
    data.append('tabla','fotos');  
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