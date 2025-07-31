	<?php $retorno=$_SERVER['PHP_SELF']."?pagina=cliente&id_cliente=".$id_cliente."&token=".rand();  ?>

  	<form role="form" method="POST"  id="formcliente" class="form"  role="form" data-toggle="validator">
  		     
  		<?php 

					$cliente=$trabajo->getClienteID($id_cliente);
					$mail=$cliente["mail"];
					$nombreapellidos=$cliente["nombre"]." ".$cliente["apellidos"];
					?>
		<div class="panel-group" id="cliente">
			<div class='panel panel-default'>
				<div class='panel-heading'>
					<h4 class='panel-title'>	Datos personales	- <?php echo $cliente["id"];?>
	 				
	 				  

					</h4>
				</div>
				<div class='panel-body'>
					    <div class="row-fluid">
					    	 <div class="col-lg-6 ">
					    	 	<?php echo $funciones->mostrarCampoInput('text','Nombre','nombre',$cliente["nombre"],'required','Escribe tu nombre',3);?>
								<?php echo $funciones->mostrarCampoInput('text','DNI/NIF','dni',$cliente["dni"],'required','Escribe tu DNI',3);?>
								<?php echo $funciones->mostrarCampoInput('text','Telf.','tel_empresa',$cliente["tel_empresa"],'required','Escribe tu telefono',3);?>
								<?php echo $funciones->mostrarCampoInput('text','Direccion','direccion',$cliente["direccion"],'required','Escribe tu direccion',3);?>
								<?php echo $funciones->mostrarCampoInput('number','Cod Postal','codigo_postal',$cliente["codigo_postal"],'required','Escribe tu cp',5);?>
							</div>
							<div class="col-lg-6 ">
								<?php echo $funciones->mostrarCampoInput('text','Apellidos','apellidos',$cliente["apellidos"],'required','Escribe tus apellidos',3);?>
								<?php echo $funciones->mostrarCampoInput('mail','Mail','mail',$cliente["mail"],'required','Escribe tu email',3);?>
								<?php echo $funciones->mostrarCampoInput('text','Movil','movil',$cliente["movil"],'required','Escribe tu tel',3);?>
								<?php echo $funciones->mostrarCampoInput('text','Localidad','localidad',$cliente["localidad"],'required','Escribe tu localidad',3);?>
								<?php echo $funciones->mostrarCampoInput('text','Provincia','provincia',$cliente["provincia"],'required','Escribe tu provincia',3);?>
								<?php echo $funciones->mostrarCampoInput('text','pais','pais',$cliente["pais"],'required','Escribe tu pais',3);?>
							</div>
						</div>
				</div>
			</div>
		</div>
		<div class="panel-group" id="acc">
			<div class='panel panel-default'>
				<div class='panel-heading'>
					<h4 class='panel-title'>	Datos de acceso	</h4>
					<div class='alert alert-warning alerta'>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div id="error" class="text-warning" > <p><small></small></p> </div>
                        </div>
				</div>
				<div class='panel-body'>
					    <div class="row-fluid">
					    	 <div class="col-lg-6 ">

								<?php echo $funciones->mostrarCampoInput('mail','Usario','user',$cliente["user"],'required','tiene que ser un mail',3);?>
								<?php echo $funciones->mostrarCampoInput('hidden','Categoria','categoria',$cliente["categoria"],'','',0);?>
							</div>
							<div class="col-lg-6 ">
								<?php echo $funciones->mostrarCampoInput('password','Contraseña','pass1','','required','Escribe tu pass',4);?>
								<?php echo $funciones->mostrarCampoInput('password','Verificar pass','pass2','','required','repite la pass',4);?>
								<?php echo $funciones->mostrarCampoInput('hidden','pass','pass','0','','',0);?>
								<?php echo $funciones->mostrarCampoInput('hidden','id_cliente','id_cliente',$cliente["id"],'','',0);?>
								<?php echo $funciones->mostrarCampoInput('hidden','id','id',$cliente["id"],'','',0);?>
								
								<?php echo $funciones->mostrarCampoInput('hidden','accion','accion','modificarcliente','','',0);?>
									<?php echo $funciones->mostrarCampoInput('hidden','tabla','tabla','clientes','','',0);?>
								<?php echo $funciones->mostrarCampoInput('hidden','pagina','pagina',$pagina,'','',0);?>

										<button type="submit" class="btn btn-primary" iduser='<?php echo $id_cliente;?>' id="modificarusuario" name="modificarusuario" >Modificar</button>
						
								
								

							</div>
						</div>
				</div>
			</div>
		</div>
</form>

