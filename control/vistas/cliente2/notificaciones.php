

<div class="panel-group" id="accordion">
    <?php 
    $notificaciones = $trabajo->getNotificaciones($id_cliente); //  LA notificaciones por id
         foreach ($notificaciones as $campo){
           
echo "<div class='panel panel-default'>";
		echo "<div class='panel-heading'>
		      <h4 class='panel-title'>
		        <a data-toggle='collapse' data-parent='#accordion' href='#".$campo['id']."'>
		         ".$trabajo->fechaNormal($campo['fecha'])." -- ".$campo['titulo']."
		       <span class='glyphicon glyphicon-chevron-down pull-right'></span></a>
		      </h4>";
		echo " </div>";
		  echo " <div id='".$campo['id']."' class='panel-collapse collapse'>";
		      	
		     echo "	<div class='panel-body'>";
				echo " <div class='col-lg-9'>";
					 echo "	<h2>".$campo['titulo']." </h2>
								<div >".$campo['descripcion']."</div>
								<div ><a class='btn btn-success btn-xs' href='".$campo['url_externa']."' role='button'>Más info &raquo;</a></div>
								<hr>";
								// formulario comentario
							echo "<ul class='list-group'>";	
								$notificacionescomen = $trabajo->getNotificacionesComen('id_notificacion',$campo['id']); //  comentarios  por id
								$cuantos=count($notificacionescomen);
								echo "<li class='list-group-item active'><span class='badge'>$cuantos</span> Comentario: </li>";	
								echo "<li class='list-group-item '>	";			   
										echo "<form class='form' id='formcomen".$campo['id']."' role='form' method='POST'>
											  <div class='form-group '>
											      <textarea  class='form-control' id='comentario".$campo['id']."'rows='3' name='comentario".$campo['id']."'> </textarea>
											  </div>
											  <div class='form-group  '>
											      <button type='button' class='btn btn-primary btn-xs enviarcomen' idnotificacion='".$campo['id']."' >Enviar</button>
											  </div>
											  <div class='form-group   '>
											  <input type='hidden' name='nombre' value='".$nombresesion."'>
											  <input type='hidden' name='fecha' value='".$fecha."'>
											  <input type='hidden' name='pagina' value='".$pagina."'>
											  <input type='hidden' name='id_notificacion' value='".$campo['id']."'>
											  <input type='hidden' name='id_cliente' value='".$campo['id_cliente']."'>
											  <input type='hidden' name='accion' value='agregarcomentario'>
											   </div>
											</form>";
								echo "</li>";
								//  fin frmulario comentario
								// Notificaciones
								echo "	<li class='list-group-item '>";
												foreach ($notificacionescomen as $campoCom){	
													echo "<li  id='comentario".$campoCom['id']."' class='alertas list-group-item alert alert-success'>";
														echo "
														<button type='button'  class='desactivarcomentario badge pull-right' idborrar='".$campoCom['id']."' >&times;</button>";
													echo "<small><div><span class='badge '>".$trabajo->fechaNormal($campoCom['fecha'])."</span> Comentario de:".$campoCom['nombre']."</div>";
													echo "<div>".$campoCom['comentario']."</div></small>
													";
												}
								echo "	</li>	";	
							echo "</ul>";
								//  finNotificaciones
				echo "</div>";
				//  archivos
				echo "<div class='col-lg-3'> ";
						?>
								<?php
							   	$multimediaNot = $trabajo->getNotificacionesMult('id_notificacion',$campo['id']); //  LA notificaciones por id
	         					$cuantos=count($multimediaNot);
	         					echo "<ul class='list-group'>
										<li class='list-group-item active'>	<span class='badge'>$cuantos</span>Descargas	</li>";
		         						foreach ($multimediaNot as $campoNot){
											echo "
											<li class='list-group-item thumbnail text-center' id='archivo".$campoNot['id']."'>
												<a href='".$url_archivos.$campoNot['archivo_multimedia']."' target='_blank' class='' >
												<img src='images/".$campoNot['formato'].".jpg' alt='Descargar archivo'>
												<h6><small>".$campoNot['titulo_multimedia']."</small></h6>
												<h6><small>Formato:".$campoNot['formato']."</small></h6></a>";
											
											echo "	
											</li>	";
			   							};
			   					echo "</ul>";?>
   			<?php	echo "	</div>";
   				// fin  archivos
		echo "</div>";//panel-body
	 echo "</div>";//panel-collapse 
echo "</div>"; //panel-default
      }; // fin buclenotificaciones
 ?>

</div> <!-- fin panel-accordion-->