<!-- Hero Section -->

<?php 
 
$textoVacaciones="";
$sql="select * from vacaciones   WHERE activo=1 limit 1";
  $vacaciones = $trabajo->getRegistrosSQL($sql); // TODA LA TABLA, ORDENADA
  if   (!empty($vacaciones)){
    $vacacion=$vacaciones[0];
    $textoVacaciones=$vacacion['nombre'];
  }
 
 
?>

<div id="inicio" class="hero d-flex align-items-center justify-content-center text-center text-white" style="background-image: url('img/local/f1.jpg'); background-size: cover; background-position: center; height: 100vh; position: relative;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

    <div class="position-relative z-2">
    <h1 class="display-4  mb-4 fw-bold"  style="background-color:rgb(238, 43, 59);"> <?php echo $textoVacaciones;?>  </h1>
        <h1 class="display-4 playfair mb-4 fw-bold">ManSeo  </h1>
        <h1 class="display-4 rage mb-4 fw-bold"> <small class="fw-light">Tu Restaurante</small></h1>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#carta" class="btn btn-lg rounded-pill px-4 text-white" style="background-color: #caa65c;">Carta</a>
           <?php
                        if (esDispositivoMovil()) { ?>
               
             
            <a href="#secciontumenu" class="btn btn-lg rounded-pill px-4 text-white" style="background-color: #caa65c;">  Configura tu menú</a>
           <?php } else { ?>
                 <button class="btn btn-lg rounded-pill px-4" style="background: transparent; border: 2px solid #caa65c; color: #caa65c;" data-bs-toggle="modal" data-bs-target="#tumenu">
                            Configura tu menú
                        </button>
         <?php   }            ?>
         <button class="btn btn-lg rounded-pill px-4" style="background: transparent; border: 2px solid #caa65c; color: #caa65c;" data-bs-toggle="modal" data-bs-target="#menudia">
                           Menú del día
                        </button>
          
        </div>
    </div>
</div>