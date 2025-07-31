<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANSEO - Restaurante  </title>
    
    <!-- Fuentes -->
     
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 4 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   
 
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/styles.css">
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <style>.logo-img {
    background-color: transparent;
}
</style>
</head>
<body>
    <?php
    // Configuración de errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

        require_once('cfg/config.php');
        require_once('cfg/database.php');
        require_once('class/conexion.php');     
        require_once("class/consultas.php");  
        require_once("class/funciones.php"); 

        $trabajo=new Trabajo();
$funciones=new Funciones();


$entrantes=$trabajo->getMenu('Entrantes');
$plato=$trabajo->getMenu('Plato');
$complementos=$trabajo->getMenu('Complementos');
$sql="SELECT * FROM  privacidad  WHERE seccion='PRIVACIDAD' LIMIT 1";
  $privacidad=$trabajo->getRegistrosSQL($sql);
  $politica=$privacidad[0];

  $sql="SELECT * FROM  privacidad  WHERE seccion='CONDICIONES' LIMIT 1";
  $condicionessql=$trabajo->getRegistrosSQL($sql);
  $condiciones=$condicionessql[0];

 function esDispositivoMovil() {
    $agente = strtolower($_SERVER['HTTP_USER_AGENT']);
    return (strpos($agente, 'mobile') !== false || strpos($agente, 'android') !== false || strpos($agente, 'iphone') !== false || strpos($agente, 'ipad') !== false);
}
 ?>
  
     
 



<!-- Bootstrap JS -->
 

<?php
        include 'sections/navbar.php';
        include 'sections/hero.php';


        include 'sections/espacios.php';
        include 'sections/carta.php';
        include 'sections/celebraciones.php';
        //  include 'sections/carta2.php';
       include 'sections/fotosplatos.php';
      include 'sections/contacto.php';
        include 'sections/situacion.php';
        if (esDispositivoMovil()) {
        include 'sections/secciontumenu.php';
        
        } else {
         include 'tumenu.php';
         
        }
        include 'menudiamodal.php';
       include 'sections/footer.php';

        ?>
</body>

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
  var precioplatosA=0;
  var precioplatosB=0;
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
              var precio2 = parseFloat($(this).attr('precio2'));
              precio2 =precio2.toFixed(2); 


            var activado2=$(this).is(':checked');
            var idregistro = $(this).attr('idregistro');
            var nombre = $(this).attr('data-label');
            nombre = "2.- : "+ nombre;

      if (activado2){
           cuantosplatos++;
           console.log("cuantosplatos "+cuantosplatos);
           if(cuantosplatos<=2){
           
            precioplatosA=Number(precioplatosA)+Number(precio1);
            precioplatosA=precioplatosA.toFixed(2);

            precioplatosB=Number(precioplatosB)+Number(precio2);
            precioplatosB=precioplatosB.toFixed(2);

            //precioplatos=Number(precioplatos)+Number(precio1);
            // precioplatos=precioplatos.toFixed(2); 
             data.append(idregistro,nombre);
           }
           else{
            console.log("no procesa "+cuantosplatos);
           }

      } else{
        console.log("cuantosplatos "+cuantosplatos);
        cuantosplatos--;
         if(cuantosplatos<=2){
           precioplatosA=Number(precioplatosA)-Number(precio1);
            precioplatosA=precioplatosA.toFixed(2);

            precioplatosB=Number(precioplatosB)-Number(precio2);
            precioplatosB=precioplatosB.toFixed(2);

            //precioplatos=Number(precioplatos)-Number(precio1);
            //precioplatos=precioplatos.toFixed(2);
            data.append(idregistro,''); 
         }
         else{
          console.log("no procesa "+cuantosplatos);
         }   
              
        };
   
             if (cuantosplatos>2){ 
         alert("Maximo de platos para elegir son 2 \n\n Elimine uno.. \n\n Gracias");

            }

           if (cuantosplatos==2){ 
            precioplatos=precioplatosB;
            console.log("no precioplatos b "+precioplatosB);

            }
            else{
              precioplatos=precioplatosA;
              console.log("no precioplatos a "+precioplatosA);
            }

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
data.append('tipo',"configuramenu");
data.append('accion',"enviarmail");
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
        console.log(respuesta2);
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
 
</html> 