 


<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li ><a href="#notificaciones" role="tab" data-toggle="tab">notificaciones</a></li>
  <li class="active"><a href="#personal" role="tab" data-toggle="tab">personal</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane fade  " id="notificaciones">
	
	
  </div>
  <div class="tab-pane fade  in active" id="personal">
  	
		     <?php include('vistas/cliente2/cliente.php');?>
  </div>
</div>




 
<script type="text/javascript">
$(document).ready(function() {
   $('.alerta').hide();
  }); // fin ready


$(function(){





}); // fin funcion


$("#formcliente").submit(function(){
    var className = $('#modificarusuario').attr('class');
 if(className!='btn btn-primary disabled'){
    data = new FormData(document.forms.namedItem("formcliente"));
        // validar pass
            resultado1=document.getElementById("pass1").value;
            resultado2=document.getElementById("pass2").value;
            patron=/^[a-z\d_]{4,15}$/i;
            if (patron.test(resultado1)){
                  if (resultado1==resultado2){
                      passEncrypt = $().crypt( {
                        method: 'md5',
                        source: resultado1
                       });
                    document.getElementById("pass").value=passEncrypt;
                    document.getElementById("pass1").value="00000";
                    document.getElementById("pass2").value="00000";
                     document.getElementById("error").innerHTML=" -";
                       $('.alerta').fadeOut('2000');
                  }
                else {
                    $('.alerta').fadeIn('2000');
                    document.getElementById("error").innerHTML="las contraseñas no coinciden";
                    document.getElementById("pass1").focus();
                    return false
                }
            }
            else{
               $('.alerta').fadeIn('2000');
            document.getElementById("error").innerHTML="Contraseña minimo 4 caracteres max 15";
            document.getElementById("pass1").focus();
            return false;
            };// fin validar pass
     data.append('pass',passEncrypt);
     uploadAjax(data);

}

return false;
}); // fin funcion



function uploadAjax(data){
var url = "ajax.php";
$.ajax({
url:url,
type:'POST',
contentType:false,
data:data,
processData:false,
cache:false,
  success: function( respuesta2 ){
      $('.alerta').fadeIn('2000');
          $('#error').html(respuesta2);
             $('#mensaje').html(respuesta2);
     }});

}// fin funcion


</script>