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
 
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/styles.css">
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 
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
 
 ?>
  
     
 



<!-- Bootstrap JS -->
 

<?php
     include 'sections/navbar.php';
     include 'sections/hero.php';
     //include 'sections/espacios.php';
    // include 'sections/carta.php';
   //  include 'sections/carta2.php';
     //include 'sections/contacto.php';
     //include 'sections/situacion.php';
     include 'sections/footer.php';
     include 'tumenu.php'; 
     
     ?>
</body>

    <!-- jQuery -->
 
</html> 