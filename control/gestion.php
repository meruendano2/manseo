<?php
//session_start();
//$_SESSION['id_cliente']="1";
//$_SESSION['usuario']="alex";
//$_SESSION['nombre']="alex";
///$_SESSION['categoria']="alex";
//$_SESSION['mail']="alex";
//$_SESSION['tel']="alex";
?>
<?php
if (!isset($_SESSION)) {
  session_start();
  $id_cliente=$_SESSION['id_cliente'];
$nombresesion=$_SESSION['nombre'];
}
?>


<!doctype html>

<html>
<head>
<meta charset="utf-8">
<?php require_once("cfg/config.php"); ?>
<?php require_once("cfg/database.php"); ?>
<?php require_once("class/conexion.php"); ?>
<?php require_once("class/resize.php"); ?>
<?php require_once("class/consultas.php"); ?>
<?php require_once("class/funciones.php"); ?>

<?php


   // $nombresesion="FEDERICO";

 $trabajo=new Trabajo();
$funciones=new Funciones();

$pagina="inicio";
$mensaje="Mensajes";
if (isset($_GET['pagina'])) $pagina=$_GET['pagina'];
if (isset($_POST['pagina'])) $pagina=$_POST['pagina'];
if (isset($_GET['mensaje']))$mensaje=$_GET['mensaje'];
if (isset($_POST['mensaje']))$mensaje=$_POST['mensaje'];
$url_head="vistas/".$pagina."/head.php";      // para encabezado
$url_content="vistas/".$pagina."/index.php";  // para contenido

$mensaje=$trabajo->verificarUsuario($_SESSION['id_cliente'],$_SESSION['usuario'],$_SESSION['categoria']);

?>


<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">


<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/main.css" rel="stylesheet" type="text/css">



<script src="js/jquery.min.js"></script>

<script src="js/md5.js"></script> 
<script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
<script src="js/validator.min.js"></script> 







<?php require_once($url_head);?>





</head>


 <body>
<div class="container">
    <div class="row align-items-center py-2">
        <div class="col-lg-4 col-12 mb-2 mb-lg-0">
            <h2 class="mb-0" style="font-size:1.5rem;">
                Gestión <small style="font-size:1.5rem;"><?php echo $nombre_empresa; ?></small>
            </h2>
        </div>
        <div class="col-lg-4 col-12 mb-2 mb-lg-0 text-lg-center">
            <h3 class="mb-0" style="font-size:1.1rem;">
                <?php echo $_SESSION['id_cliente']; ?> <?php echo $_SESSION['categoria']; ?>
                <small style="font-size:0.95rem;"><?php echo $_SESSION['nombre']; ?></small>
            </h3>
        </div>
        <div class="col-lg-4 col-12 text-lg-end text-center">
            <div class="logo">
                <img src="images/logo.png" border="0" style="max-width:90px; height:auto; vertical-align:middle;" alt="Logo" />
            </div>
        </div>
    </div>
</div><!--/container-->

<div class="container">
    <?php require_once('vistas/menu/index.php');?>
</div><!--/container-->

 

<div class="container">
  
   <div class="row">
      <!--contenido-->
        <div class="col-lg-10">
        <?php require_once($url_content);?>
        </div>
      <!--/contenido-->

      <!--derecha-->
        <div class="col-lg-2">
           <br> <br>
              <?php //require_once('vistas/formularios/index.php');?>
            <?php require_once('vistas/mensaje/index.php');?>
         

        </div>
        <!--/derecha-->
  </div>     
           


</div>





      <hr>
<div class="container">
      <footer>
        <p>&copy; End</p>
      </footer>
</div><!--/.fluid-container-->


    <!-- Le javascript 
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->



  </body>
</html>
