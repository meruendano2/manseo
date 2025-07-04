  



<?php 

?>
       
    
       <div class="modal fade" id="tumenu" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between align-items-center">
        <h5 class="modal-title mb-0" id="myModalLabel">
          Restaurante ManSeo - Configura tu Menú para grupos (mínimo 6 adultos)
        </h5>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <!-- Entrantes -->
        <div class="row mb-4">
          <div class="col">
            <div class="card">
              <div class="card-header bg-info text-white">
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
                      <label class='form-check-label' for='$id'>".$campo['nombre']."</label>
                    </div>
                  </div>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Platos -->
        <div class="row mb-4">
          <div class="col">
            <div class="card">
              <div class="card-header bg-success text-white">
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
                        idregistro='".$campo['id']."'>
                      <label class='form-check-label' for='$id'>".$campo['nombre']."</label>
                    </div>
                  </div>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Complementos -->
        <div class="row mb-4">
          <div class="col">
            <div class="card">
              <div class="card-header bg-warning text-dark">
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
                      <label class='form-check-label' for='$id'>".$campo['nombre']."</label>
                    </div>
                  </div>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Total -->
        <div class="row mb-4">
          <div class="col text-center">
            <hr>
            <h3>Precio total por persona adulta: <span id="preciototal2" class="fw-bold"></span></h3>
          </div>
        </div>

        <!-- Formulario -->
        <div class="card">
          <div class="card-header bg-secondary text-white">
            <h6 class="mb-0">Confirma tu menú y reserva</h6>
          </div>
          <div class="card-body">
            <form class="row" id="formmenu" method="POST" role="form">
              <div class="col-lg-5">
                <div class="mb-3">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre" required>
                </div>
                <div class="mb-3">
                  <label for="mail">Correo</label>
                  <input type="email" class="form-control" id="mail" name="mail" placeholder="Tu correo" required>
                </div>
                <div class="mb-3">
                  <label for="telefono">Teléfono</label>
                  <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tu teléfono" required>
                </div>
                <div class="mb-3">
                  <label for="comentario">Comentario</label>
                  <input type="text" class="form-control" id="comentario" name="comentario" placeholder="Tu comentario">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="mb-3">
                  <label for="adultos">Adultos (mayores de 9 años)</label>
                  <input type="number" class="form-control" id="adultos" name="adultos" required value="6" min="6">
                </div>
                <div class="mb-3">
                  <label for="ninos">Niños entre 4 y 8 años (1/2 plato)</label>
                  <input type="number" class="form-control" id="ninos" name="ninos" value="0">
                </div>
                <div class="mb-3">
                  <label for="ninos2">Niños menores de 4 (Gratis)</label>
                  <input type="number" class="form-control" id="ninos2" name="ninos2" value="0">
                </div>
                <div class="mb-3">
                  <label>Fecha</label>
                  <div class="input-group calendario">
                    <input type="date" class="form-control" name="fecha" id="fecha">
                    
                  </div>
                </div>
                <div class="mb-3">
                  <label>Hora</label>
                  <input type="text" class="form-control" name="hora" id="hora">
                </div>
                <input type="hidden" name="accion" id="accion" value="enviarmenu">
              </div>

              <div class="col-lg-3">
                <h5>Importe adultos: <span id="importeadultos"></span></h5>
                <h5>Importe niños: <span id="importeninos"></span></h5>
                <hr>
                <h3>Total: <span id="importetotal" class="fw-bold"></span></h3>
                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>








<script type="text/javascript">

  $(function(){
/*
  $('.calendarioxx').datepicker({
      format: "dd/mm/yyyy",
      language: "es",
      autoclose: true,
      orientation: "auto left",
      todayHighlight: true

  });
  */


 
    
  });
  var data = new FormData();
  var precioA=0;
  var precioB=0;
  var precioC=0;
  var precioD=0;
  var precioE=0;
  var cuantosentrantes=0;
  var cuantosplatos=0;
  var cuantoscomplementos=0;
  var precioentrantes=0;
  var precioplatos=0;
  var preciocomplementos=0;
  var precioTotal=0;
  $( ".entrantes" ).click(function() {
      
          var precio1 = parseFloat($(this).attr('precio1'));
          var precio2 = parseFloat($(this).attr('precio2'));
          var precio3 = parseFloat($(this).attr('precio3'));
          var precio4 = parseFloat($(this).attr('precio4'));
          var precio5 = parseFloat($(this).attr('precio5'));
            precioA=parseFloat(precioA);
              precioB=parseFloat(precioB);
              precioC=parseFloat(precioC);
              precioD=parseFloat(precioD);
              precioE=parseFloat(precioE);

          precio1 =precio1.toFixed(2); 
          precio2 =precio2.toFixed(2);  
          precio3 =precio3.toFixed(2);  
          precio4 =precio4.toFixed(2); 
          precio5 =precio5.toFixed(2); 
            

          var idregistro = $(this).attr('idregistro');
          var nombre = $(this).attr('data-label');
          nombre = "1.- : "+ nombre;

        activado=$(this).is(':checked');

        if (activado){
              precioA=Number(precioA)+Number(precio1);
              precioB=Number(precioB)+Number(precio2);
              precioC=Number(precioC)+Number(precio3);
              precioD=Number(precioD)+Number(precio4);
              precioE=Number(precioE)+Number(precio5);

              precioA=precioA.toFixed(2); 
              precioB=precioB.toFixed(2); 
              precioC=precioC.toFixed(2); 
              precioD=precioD.toFixed(2); 
              precioE=precioE.toFixed(2); 
              data.append(idregistro,nombre);
        cuantosentrantes++;
        } else{
              precioA=Number(precioA)-Number(precio1);
              precioB=Number(precioB)-Number(precio2);
              precioC=Number(precioC)-Number(precio3);
              precioD=Number(precioD)-Number(precio4);
              precioE=Number(precioE)-Number(precio5);

              precioA=precioA.toFixed(2); 
              precioB=precioB.toFixed(2); 
              precioC=precioC.toFixed(2); 
              precioD=precioD.toFixed(2); 
              precioE=precioE.toFixed(2); 
              data.append(idregistro,'');
        cuantosentrantes--;
        };



        $('#mensaje2').text(cuantosentrantes);
        $('#mensaje3').text(precioA+" - "+precioB+" - "+precioC+" - "+precioD+" - "+precioE    );
        $('#mensaje4').text(precio1+" - "+precio2+" - "+precio3+" - "+precio4+" - "+precio5    );

          if (cuantosentrantes==0){ 
              precioentrantes=0;
              precioentrantes=precioentrantes.toFixed(2); 
                };
              if (cuantosentrantes==1){ 
              precioentrantes=Number(precioA);
                precioentrantes=precioentrantes.toFixed(2); 
                };

              if (cuantosentrantes==2){ 
              precioentrantes=Number(precioB);
                precioentrantes=precioentrantes.toFixed(2); 

              };

              if (cuantosentrantes==3){ 
              precioentrantes=Number(precioC);
                precioentrantes=precioentrantes.toFixed(2); 


              };


              if (cuantosentrantes==4){ 
              precioentrantes=Number(precioD);
                precioentrantes=precioentrantes.toFixed(2); 

              };


              if (cuantosentrantes>=5){ 
              precioentrantes=Number(precioE);
                precioentrantes=precioentrantes.toFixed(2); 

              };

              if (cuantosentrantes>8){ 
        alert("Maximo de entrantes para elegir son 8 \n\n Elimine uno.. \n\n Gracias");

              };
      
      $('#mensaje2').text("entrantes: "+cuantosentrantes +" - precio "+precioentrantes);

      precioTotal=Number(precioentrantes)+Number(precioplatos)+Number(preciocomplementos);
      
      $('#men1').text("⇒ Precio: "+precioentrantes);
        $('#preciototal').text("⇒ Precio: "+precioTotal+" € ");
          $('#preciototal2').text(" "+precioTotal+" € ");
    

        $('#mensaje').text(precioTotal);
        CalcularImporte(precioTotal);
          
      
  });

$( ".platos" ).click(function() {
 
            var precio1 = parseFloat($(this).attr('precio1'));
              precio1 =precio1.toFixed(2); 
            var activado2=$(this).is(':checked');
            var idregistro = $(this).attr('idregistro');
            var nombre = $(this).attr('data-label');
            nombre = "2.- : "+ nombre;

      if (activado2){
            precioplatos=Number(precioplatos)+Number(precio1);
             precioplatos=precioplatos.toFixed(2); 
            cuantosplatos++;
             data.append(idregistro,nombre);

      } else{
            precioplatos=Number(precioplatos)-Number(precio1);
            precioplatos=precioplatos.toFixed(2); 
             cuantosplatos--;
              data.append(idregistro,'');
        };
   
             if (cuantosplatos>2){ 
         alert("Maximo de platos para elegir son 2 \n\n Elimine uno.. \n\n Gracias");

            };
      $('#mensaje2').text("platos: "+cuantosplatos +" - precio: "+precioplatos);

     precioTotal=Number(precioentrantes)+Number(precioplatos)+Number(preciocomplementos);

      $('#men2').text("⇒ Precio: "+precioplatos);
      $('#mensaje').text(precioTotal);
  $('#preciototal').text("⇒ Precio: "+precioTotal+" € ");
   $('#preciototal2').text(" "+precioTotal+" € ");
   CalcularImporte(precioTotal);

});

$( ".complementos" ).click(function() {

                var idregistro = $(this).attr('idregistro');
                var nombre = $(this).attr('data-label');
                nombre = "3.- : "+ nombre;
                var precio1 =  parseFloat($(this).attr('precio1'));
                precio1 =precio1.toFixed(2); 
                var activado2=$(this).is(':checked');

      if (activado2){
            preciocomplementos=Number(preciocomplementos)+Number(precio1);
            preciocomplementos=preciocomplementos.toFixed(2); 
            cuantoscomplementos++;
            data.append(idregistro,nombre);

      } else{
            preciocomplementos=Number(preciocomplementos)-Number(precio1);
            preciocomplementos=preciocomplementos.toFixed(2); 
             cuantoscomplementos--;
             data.append(idregistro,'');
        };
   
      $('#mensaje2').text("complementos: "+cuantoscomplementos +" - precio: "+preciocomplementos);

     precioTotal=Number(precioentrantes)+Number(precioplatos)+Number(preciocomplementos);
      $('#men3').text("⇒ Precio: "+preciocomplementos);
      $('#mensaje').text(precioTotal);
     $('#preciototal').text("⇒ Precio: "+precioTotal+" € ");
       $('#preciototal2').text(" "+precioTotal+" € ");
  CalcularImporte(precioTotal);

});



$("#formmenu").submit(function(){

 var className = $('#enviar').attr('class');
 if(className!='btn btn-primary disabled'){
       if (cuantosplatos<1){ 
         alert("Minimo  de platos para elegir es 1 \n\n Gracias");
         return false;
            };
              if (cuantosentrantes<1){ 
      alert("Minimo de entrantes para elegir es 1\n\n  Gracias");
      return false;

            };
        var dataString = $('#formmenu').serialize();  

        
        var element = dataString.split('&');
        $.each( element, function( numero,valor ) {
          campo=valor.split('=');
        data.append(campo[0],decodeURIComponent(campo[1]));
        //     data.append(campo[0],campo[1]);
        })
uploadAjax(data);


 }
return false;
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
         $('#resultado').html(respuesta2);
         //setTimeout('document.location.reload()',1000)
    }});

}


$( "#adultos,#ninos" ).change(function() {
  CalcularImporte(precioTotal);

});


$( "#limpiar" ).click(function() {
setTimeout('document.location.reload()',1000);

});



function CalcularImporte(valores){
   var adultos = $('#adultos').val();
     var ninos = $('#ninos').val();
 
 importeadultos=Number(adultos)*Number(precioTotal);
  importeninos=(Number(ninos)*Number(precioTotal))/2;
  importetotal=Number(importeadultos)+Number(importeninos);
  importeadultos=importeadultos.toFixed(2); 
    importeninos=importeninos.toFixed(2); 
      importetotal=importetotal.toFixed(2); 
  $('#importeadultos').text(" "+importeadultos+" € ");
  $('#importeninos').text(" "+importeninos+" € ");
    $('#importetotal').text(" "+importetotal+" € ");

      data.append('importeadultos',importeadultos);
        data.append('importeninos',importeninos);
          data.append('importetotal',importetotal);
           data.append('porpersona',precioTotal);

};



</script>