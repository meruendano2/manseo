

<div id="contenidos">

<div class="panel panel-default">
<div class="panel-heading">
   <h2 class="panel-title">Listado de menus</h2>
           <div class="row">
                       <div class="col-lg-6 col-xs-6">
                            <div  id="buscar" class="input-group input-group-sm  ">
                            <span class="input-group-addon">Buscar:</span>
                            <input type="text" class="form-control" placeholder="Escriba aqui" id="quicksearch" >
                            </div>
                      </div>
                       <div class="col-lg-6 col-xs-6">
                                <div id="sorts" class="btn-group ">
                                              <button class=" btn btn-default btn-sm" data-sort-value="campo1">numero</button>
                                      <button class=" btn btn-default btn-sm" data-sort-value="campo2">categoria</button>
                                      <button class=" btn btn-default btn-sm" data-sort-value="campo3">nombre</button>
                                      <button class=" btn btn-default btn-sm" data-sort-value="campo4">precio1</button>
                                      <button  id='ordenacionsalida' type="button" class="btn btn-link btn-sm">Tipo</button>
                                  </div>
                        </div>
          </div>
          <div class="row"> 
                        <div class="col-lg-9"> 

                        </div> 
                        <div class="col-lg-3">
                                <div class="well well-sm ">
                                <button class=" btn btn-primary btn-sm" id="nuevomenu" name='nuevomenu' data="<?php echo $id_cliente; ?>">Añadir nuevo menú</button>
                                </div>
                        </div>

          </div> 


 <div class="row-fluid">
        
  <div class='form-group   col-lg-1'> Borrar</div>
  <div   class='form-group   col-lg-2'>categoria </div> 
  <div   class='form-group   col-lg-2'>nombre </div> 
  <div   class='form-group   col-lg-1'>precio1 </div> 
  <div   class='form-group   col-lg-1'>precio2 </div> 
  <div   class='form-group   col-lg-1' > precio3 </div> 
  <div   class='form-group   col-lg-1' > precio4 </div> 
  <div   class='form-group   col-lg-1' > precio5 </div> 
  <div class='form-group   col-lg-1'> Modificar</div>
    <div class='form-group   col-lg-1'>  </div>
       
     </div> 
       <hr>
</div>

<div class="panel-body" >
      <ul class="isotope table-like list-group">
          <?php 
          $menu = $trabajo->getMenu(); // TODA LA TABLA, ORDENADA
               foreach ($menu as $campo){
                  echo "  <form id='formmenu".$campo['id']."' method='POST' action='' role='form'>
                   <li>
                    <div   class='mostrar col-lg-1' ><small>
                     <button type='button' class='btn btn-danger btn-xs eliminarregistro'  data='".$campo['id']."'>
                            <span class='glyphicon glyphicon-trash'></span> Borrar &nbsp
                            </button></small></div>
                   
                    <div class='form-group form-group-sm col-lg-2'>
                                  <select class='form-control  input-sm'  name='categoria' >
                                  <option value='".$campo['categoria']."'>".$campo['categoria']."</option>
                                  <option value='Entrantes'>Entrantes</option>
                                  <option value='Plato'>Plato</option>
                                  <option value='Complementos'>Complementos</option>
                                  </select>
                      </div>
                    <div class='form-group  col-lg-2' >    <input  type='text' class='form-control input-sm'   value='".$campo['nombre']."' name='nombre' >   </div>       
                    <div class='form-group  col-lg-1' >    <input  type='text' class='form-control input-sm' value='".$campo['precio1']."' name='precio1' > </div> 
                    <div class='form-group  col-lg-1' >    <input  type='text' class='form-control input-sm' value='".$campo['precio2']."' name='precio2' > </div> 
                    <div class='form-group  col-lg-1' >    <input  type='text' class='form-control input-sm' value='".$campo['precio3']."' name='precio3' >  </div> 
                    <div class='form-group  col-lg-1' >    <input  type='text' class='form-control input-sm' value='".$campo['precio4']."' name='precio4' >  </div> 
                    <div class='form-group  col-lg-1' >    <input  type='text' class='form-control input-sm' value='".$campo['precio5']."' name='precio5' > </div> 
         
                     <div  class='col-lg-1' ><small>
                    <button type='button' class='btn btn-success btn-xs modificarmenu'  data='" .$campo['id']."' enlace='".$campo['id']."'>
                                                Modificar &nbsp
                                                  </button></small></div> 
                    <div class='oculto 'col-lg-1'>
                    <span class='oculto campo1'> " .$campo['id']."</span>  
                    <span class='oculto campo2'> " .$campo['categoria']."</span>  
                    <span class='oculto campo3'> ".$campo['nombre'].   "</span>    
                    <span class='oculto campo4'>" .$campo['precio1']." </span>    
                    <span class='oculto campo5'>" .$campo['precio2']." </span> 
                    <span class='oculto campo6'>" .$campo['precio3']." </span>
                    <span class='oculto campo7'>" .$campo['precio4']." </span>
                    <span class='oculto campo8'>" .$campo['precio5']." </span>
                     <span class='oculto campo9'>     <input name='id' type='hidden' value='".$campo['id']."'> <input name='accion' type='hidden' value='modificarmenu'> </span>
                    </div>
                </li>   
                </form>
                 ";
               }
           ?>
      </ul>
</div>
  </div> <!-- fin panel-default-->
  </div> <!-- fin contenido- -->

<script type="text/javascript">

$(function() {


  var qsRegex;
  // init Isotope
  var $container = $('.isotope').isotope({
    layoutMode: 'vertical',
    getSortData: {
      campo1: '.campo1 parseInt',
      campo2: '.campo2',
      campo3: '.campo3',
      campo4: '.campo4 parseInt',
      campo5: '.campo5',
      campo6: '.campo6',
      
    },
    filter: function() {
      return qsRegex ? $(this).text().match( qsRegex ) : true;
    }
  });

  // bind sort button click
  $('#sorts').on( 'click', 'button', function() {
    var sortValue = $(this).attr('data-sort-value');

             $('#mensaje').text(sortValue );
             $('#ordenacionsalida').text(sortValue);
    $container.isotope({ sortBy: sortValue });
  });


  // change is-checked class on buttons
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
      $buttonGroup.find('.active').removeClass('active');
      $( this ).addClass('active');
    });


 
  });

    // use value of search field to filter
  var $quicksearch = $('#quicksearch').keyup( debounce( function() {
    qsRegex = new RegExp( $quicksearch.val(), 'gi' );
    $container.isotope();
  }, 200 ) );
  
});

$( ".modificarmenu" ).click(function() {
  var id= $(this).attr('data');
  var formulario="formmenu"+id;
  data = new FormData(document.forms.namedItem(formulario));
  uploadAjax(data)
});



$( "#nuevomenu" ).click(function() {
    var data = new FormData();
    data.append('accion','nuevomenu');   
    data.append('tabla','tumenu');  
    uploadAjax(data);

});

$( ".eliminarregistro" ).click(function() {
var data = new FormData();
var id =$(this).attr('data');
data.append('id',id); 
data.append('accion','eliminarregistro');   
data.append('tabla','tumenu');
    if (confirm("se va a eliminar este menu...")){;
      uploadAjax(data);  
    }
});



// debounce so filtering doesn't happen every millisecond
function debounce( fn, threshold ) {
  var timeout;
  return function debounced() {
    if ( timeout ) {
      clearTimeout( timeout );
    }
    function delayed() {
      fn();
      timeout = null;
    }
    timeout = setTimeout( delayed, threshold || 100 );
  }

}

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

function enviarAjax(valores){
   $('#mensaje2').html("procesando...");
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: valores,
        success: function( respuesta2 ){

             $('#mensaje').html(respuesta2);
              // setTimeout('document.location.reload()',2000);
                  

     }});
};


  </script>