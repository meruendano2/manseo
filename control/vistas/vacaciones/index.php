<?php 
  $token=rand(); 
  $id_cliente=$_SESSION['id_cliente'];
  $nombresesion=$_SESSION['nombre'];
  $fecha=date('Y-m-d');

$sql="select * from vacaciones    limit 1";
  $vacaciones = $trabajo->getRegistrosSQL($sql); // TODA LA TABLA, ORDENADA
 // $vacaciones=$cartas[0];
?>



<div id="contenidos">

<div class="panel panel-default">
<div class="panel-heading">
   <h2 class="panel-title">vacaciones</h2>
     
          

 
</div>

<div class="panel-body" >
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                   
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vacaciones as $carta): ?>
                <tr data-id="<?php echo $carta['id']; ?>">
                    <td><?php echo $carta['id']; ?></td>
                    <td contenteditable="true" class="editable" data-field="nombre"><?php echo htmlspecialchars($carta['nombre']); ?></td>
                   
                   
                  
                   
                    <td>
                        <input type="checkbox" class="editable-checkbox" data-field="activo" <?php if($carta['activo']) echo 'checked'; ?> />
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm guardar-vacacion">Guardar</button>
                         
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
$(document).on('click', '.guardar-vacacion', function() {
    var $row = $(this).closest('tr');
    var id = $row.data('id');
    var formData = new FormData();
    formData.append('id', id);
    formData.append('nombre', $row.find('[data-field="nombre"]').text());
   
 
 
    formData.append('activo', $row.find('.editable-checkbox').is(':checked') ? 1 : 0);
    formData.append('accion', 'guardarVacaciones');
   
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
      // setTimeout('document.location.reload()',1000)
    }});

}
</script>