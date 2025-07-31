<?php 
  $token=rand(); 
  $id_cliente=$_SESSION['id_cliente'];
  $nombresesion=$_SESSION['nombre'];
  $fecha=date('Y-m-d');

$sql="select * from menu_dia     limit 1  ";
  $menusDia = $trabajo->getRegistrosSQL($sql); // TODA LA TABLA, ORDENADA
  $menudia=$menusDia[0];
?>



<div id="contenidos">

<div class="panel panel-default">
<div class="panel-heading">
   <h2 class="panel-title">MENU DIA</h2>
     
          <div class="row"> 
                        <div class="col-lg-9"> 

                        </div> 
                        <div class="col-lg-3">
                               
                        </div>

          </div> 

 
</div>

<div class="panel-body" >

    <form id="formmenudia" name="formmenudia" method='POST' action='' role='form' class=" ">

 
    <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled inline-fields">
                <li>
                    <label for="pp31">FECHA:</label>
                    <input id="pp31" type="text" class="form-control form-control-sm"
                        name="fecha" value="<?php echo $menudia['fecha']; ?>">
                </li>
                <br><hr><br>

                <li>
                    <label for="pp1">Primer Plato 1:</label>
                    <input id="pp1" type="text" class="form-control form-control-sm"
                        name="primer_plato1" value="<?php echo $menudia['primer_plato1']; ?>">
                </li>
                <li>
                    <label for="pp2">Primer Plato 2:</label>
                    <input id="pp2" type="text" class="form-control form-control-sm"
                        name="primer_plato2" value="<?php echo $menudia['primer_plato2']; ?>">
                </li>
                <li>
                    <label for="pp3">Primer Plato 3:</label>
                    <input id="pp3" type="text" class="form-control form-control-sm"
                        name="primer_plato3" value="<?php echo $menudia['primer_plato3']; ?>">
                </li>
                <li>
                    <label for="pp4">Primer Plato 4:</label>
                    <input id="pp4" type="text" class="form-control form-control-sm"
                        name="primer_plato4" value="<?php echo $menudia['primer_plato4']; ?>">
                </li>
                </ul>
            </div>

            <div class="col-lg-6">
                <ul class="list-unstyled inline-fields">
                <li>
                    <label for="pp19">PRECIO:</label>
                    <input id="pp19" type="text" class="form-control form-control-sm"
                        name="precio" value="<?php echo $menudia['precio']; ?>">
                </li>
                <br><hr><br>
                <li>
                    <label for="sp1">Segundo Plato 1:</label>
                    <input id="sp1" type="text" class="form-control form-control-sm"
                        name="segundo_plato1" value="<?php echo $menudia['segundo_plato1']; ?>">
                </li>
                <li>
                    <label for="sp2">Segundo Plato 2:</label>
                    <input id="sp2" type="text" class="form-control form-control-sm"
                        name="segundo_plato2" value="<?php echo $menudia['segundo_plato2']; ?>">
                </li>
                <li>
                    <label for="sp3">Segundo Plato 3:</label>
                    <input id="sp3" type="text" class="form-control form-control-sm"
                        name="segundo_plato3" value="<?php echo $menudia['segundo_plato3']; ?>">
                </li>
                <li>
                    <label for="sp4">Segundo Plato 4:</label>
                    <input id="sp4" type="text" class="form-control form-control-sm"
                        name="segundo_plato4" value="<?php echo $menudia['segundo_plato4']; ?>">
                </li>
                </ul>
                <span class='oculto campo9'>     <input name='id' type='hidden' value='<?php echo $menudia['id']; ?>'> 
            <input name='accion' type='hidden' value='modificarmenudia'> </span>
            <button type='button' class='btn btn-success btn-lg modificarmenudia'  data='<?php echo $menudia['id']; ?>' enlace='<?php echo $menudia['id']; ?>'>
                                                Guardar cambios &nbsp
                                                  </button>  
            </div>
                
        </div>

            

    </form>
    <br><br>
    <a class='btn btn-primary  btn-sm  '  href='../img/menudia.pdf' target='_blank'>Ver menú PDF</a>
    <a class='btn btn-primary  btn-sm  '  href='../img/menudia_duplicado.pdf' target='_blank'>Ver menu doble PDF</a>
</div>
  </div> <!-- fin panel-default-->
  </div> <!-- fin contenido- -->

<script>
// Edición inline y guardado con archivo
$(".modificarmenudia").click(function(e) {
  e.preventDefault();                                // evita que recargue la página
  var form = document.forms.namedItem("formmenudia"); 
  if (!form) {
    console.error("Formulario no encontrado");
    return;
  }
  var data = new FormData(form);
  uploadAjax(data);
});
// Eliminación
 

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