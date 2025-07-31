<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>gestion</title>
<?php require_once("cfg/config.php"); ?>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet" type="text/css" />


 <script src="js/jquery.min.js"></script>
<script language="javascript" src="js/md5.js"></script> 
<script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
 <script src="js/validator.min.js"></script> 

</head>

<body>

<div class="container-fluid">
<div class="row-fluid">

          

<div class="content">
<div class="logo">
    <img src="images/logo.png" border="0" style="max-width: 140px; height: auto;" />
</div>
          <hr>

        <form class='form' id="formlogin" name='formlogin' method='POST' role="form" data-toggle="validator">
                   
                             <div class="form-group">
                            <input type="email" class="form-control input-sm" id="user"  name="user" placeholder="tu email" data-error="Correo incorrecto" required>
                             <div class="help-block with-errors"></div>
                            </div> 

                            <div class="form-group">
                            <input type="password" class="form-control input-sm" id="pass" name="pass" placeholder="tu contraseña" required data-error="escribe contraseña" >
                                  <div class="help-block with-errors"></div>
                            </div>
                            <div class="control-group text-right" style="margin-right:30px;">
                            <button  type='submit' id="enviar" name="enviar" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-ok tar"> </span> Acceder</button>
                            </div>


   
              <!-- Error-->
          <div class="alert alert-error atec_error">Usuario o contraseña incorrectos</div>
          <div class="alert conectando">conectando</div>
          <div id='mensaje' class=""></div>
            <br>

      </form>

 </div>     
   </div>  
                      
                 

            
            
  </div>  


<script type="text/javascript">
	var CI_ROOT = '';

  $(document).ready(function() {
   $('.conectando').hide();
  }); // fin ready

$("#formlogin").submit(function(){
    var className = $('#enviar').attr('class');
    if(className!='btn btn-info btn-sm disabled'){
    data = new FormData(document.forms.namedItem("formlogin"));
    var user = $('#user').val();
    var pass = $('#pass').val();
    passEncrypt = $().crypt( {
        method: 'md5',
        source: pass
    });
    data.append('pass',passEncrypt);
    data.append('accion','login');
    uploadAjax(data);
 }
return false;
}); // fin funcion

function uploadAjax(data){
    $('#mensaje').text('procesando...');
    var url = "login.php";
    $.ajax({
        url:url,
        type:'POST',
        dataType: 'json',
        contentType:false,
        data:data,
        processData:false,
        cache:false,
           beforeSend: function(){
                  $('.atec_error').fadeOut('2000'); 
                  $('.conectando').fadeOut('2000');        
                  },
        success: function( data ){
              if (data.mensaje == 'true'){
                    if (data.categoria=='Cliente'){
                       document.location.href =  "../index.php";
                        $('#mensaje').text('Cliente...');
                    };
                    if (data.categoria=="Administrador"){
                        $('#mensaje').text('Administrador...');
                         document.location.href =  "gestion.php";
                    };
                    $('.conectando').fadeIn('2000');
                    $('.atec_error').hide()
              } ; 
              if (data.mensaje == 'false'){
                $('.atec_error').fadeIn('2000');
                $('#mensaje').text('error...');
              }
    }});

} // fin funcion





  </script>
</body>
</html>