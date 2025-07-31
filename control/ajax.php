<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

 require_once("cfg/config.php"); 
 require_once("cfg/database.php"); 
 require_once("class/conexion.php"); 
 require_once("class/resize.php"); 
 require_once("class/consultas.php"); 
 //require_once __DIR__ . '/../vendor/autoload.php';
 $path =  '../vendor/autoload.php';
 require_once '../vendor/autoload.php';

 //echo $path . '<br>';
 //echo file_exists($path) ? 'Autoload encontrado ✅' : 'No se encontró autoload ❌';
 function limpiarNombreArchivo($nombre) {
    // Elimina acentos
    $nombre = iconv('UTF-8', 'ASCII//TRANSLIT', $nombre);

    // Convierte ñ y Ñ a n
    $nombre = str_replace(['ñ', 'Ñ'], ['n', 'N'], $nombre);

    // Elimina caracteres no alfanuméricos (excepto guiones y guiones bajos)
    $nombre = preg_replace('/[^a-zA-Z0-9_\-]/', '', $nombre);

    // Opcional: convertir todo a minúsculas
    $nombre = strtolower($nombre);

    return $nombre;
}

// Función para generar el menú del día en PDF
function generarMenuPDF(array $menudia, string $ruta_guardado = __DIR__ . '/../img/menudia.pdf'): bool {
	try {
		// Cargar fuente solo una vez
		$fontPath = __DIR__ . '/../css/fonts/rage.ttf';
		$fontName = TCPDF_FONTS::addTTFfont($fontPath, 'TrueTypeUnicode', '', 32, '', false);

		$pdf = new TCPDF();
		$pdf->AddPage();

		$fecha = $menudia['fecha'] ?? date('d/m/Y');
		$precio = isset($menudia['precio']) ? $menudia['precio'] . ' €' : '';

		// Título con fondo
		$pdf->SetFillColor(160, 161, 167); // Gris
		$pdf->SetTextColor(255, 255, 255); // Blanco
		$pdf->SetFont($fontName, '', 38);
		$pdf->Cell(0, 18, "Menú de día - $precio", 0, 1, 'C', true);

		// Fecha y precio
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('helvetica', '', 18);
		$pdf->Cell(0, 10, "Fecha: $fecha  -- Precio: $precio", 0, 1, 'C');
		$pdf->Ln(7);

		// Primeros platos
		$pdf->SetFont($fontName, 'B', 30);
		$pdf->SetX(20);
		$pdf->Cell(0, 12, 'Primer plato:', 0, 1);
		$pdf->SetFont('helvetica', '', 16);
		for ($i = 1; $i <= 4; $i++) {
			$campo = 'primer_plato' . $i;
			if (!empty($menudia[$campo])) {
				$pdf->SetX(30);
				$pdf->Cell(0, 8, '* ' . $menudia[$campo], 0, 1);
			}
		}

		// Segundos platos
		$pdf->Ln(7);
		$pdf->SetFont($fontName, 'B', 30);
		$pdf->SetX(20);
		$pdf->Cell(0, 12, 'Segundo plato:', 0, 1);
		$pdf->SetFont('helvetica', '', 16);
		for ($i = 1; $i <= 4; $i++) {
			$campo = 'segundo_plato' . $i;
			if (!empty($menudia[$campo])) {
				$pdf->SetX(30);
				$pdf->Cell(0, 8, '* ' . $menudia[$campo], 0, 1);
			}
		}

		// Bebida y postre
		$pdf->Ln(7);
		$pdf->SetFont($fontName, 'B', 30);
		$pdf->SetX(20);
		$pdf->Cell(0, 12, 'Bebida, postre y café', 0, 1);

		// Línea final + logo
		$pdf->Ln(8);
		$pdf->Cell(0, 0, '', 'B', 1); // Línea horizontal
		$pdf->SetFont('helvetica', '', 12);
		$y = $pdf->GetY();
		$pdf->SetXY(10, $y);
		$pdf->Cell(120, 5, 'Precio I.V.A. Incluido | I.V.E. Engadido | Taxes Included', 0, 1, 'L');
		$pdf->Cell(120, 5, 'manseo.es', 0, 0, 'L');

		$logoPath = __DIR__ . '/../img/logo.png';
		if (file_exists($logoPath)) {
			$pdf->Image($logoPath, $pdf->getPageWidth() - 60, $y+2  , 30);
		}

		// Guardar PDF
		$pdf->Output($ruta_guardado, 'F');
		return true;

	} catch (Exception $e) {
		error_log("Error generando PDF: " . $e->getMessage());
		return false;
	}
}
function generarMenuPDFDuplicado(array $menudia, string $ruta_guardado = __DIR__ . '/../img/menudia_duplicado.pdf'): bool {
	try {
		$fontPath = __DIR__ . '/../css/fonts/rage.ttf';
		$fontName = TCPDF_FONTS::addTTFfont($fontPath, 'TrueTypeUnicode', '', 32, '', false);

		$pdf = new TCPDF('L'); // L = Landscape
		$pdf->AddPage();

		$fecha = $menudia['fecha'] ?? date('d/m/Y');
		$precio = isset($menudia['precio']) ? $menudia['precio'] . ' €' : '';
		$anchoMitad = $pdf->getPageWidth() / 2 - 10;

		for ($columna = 0; $columna < 2; $columna++) {
			$offsetX = 10 + $columna * ($anchoMitad + 10);
			$pdf->SetXY($offsetX, 12);

			// Título
			$pdf->SetFillColor(160, 161, 167);
			$pdf->SetTextColor(255, 255, 255);
			$pdf->SetFont($fontName, '', 36); // + tamaño
			$pdf->Cell($anchoMitad, 14, "Menú del día", 0, 1, 'C', true);

			// Fecha
			$pdf->SetTextColor(0, 0, 0);
			$pdf->SetFont('helvetica', '', 14); // + tamaño
			$pdf->SetX($offsetX);
			$pdf->Cell($anchoMitad, 10, "Fecha: $fecha  -- Precio: $precio", 0, 1, 'C');
			$pdf->Ln(4);

			// Primeros platos
			$pdf->SetFont($fontName, 'B', 20);
			$pdf->SetX($offsetX + 5);
			$pdf->Cell($anchoMitad - 10, 12, 'Primer plato:', 0, 1);
			$pdf->SetFont('helvetica', '', 13);
			for ($i = 1; $i <= 4; $i++) {
				$campo = 'primer_plato' . $i;
				if (!empty($menudia[$campo])) {
					$pdf->SetX($offsetX + 10);
					$pdf->Cell($anchoMitad - 20, 8, '• ' . $menudia[$campo], 0, 1); // más alto
				}
			}

			// Segundos platos
			$pdf->Ln(4);
			$pdf->SetFont($fontName, 'B', 20);
			$pdf->SetX($offsetX + 5);
			$pdf->Cell($anchoMitad - 10, 12, 'Segundo plato:', 0, 1);
			$pdf->SetFont('helvetica', '', 13);
			for ($i = 1; $i <= 4; $i++) {
				$campo = 'segundo_plato' . $i;
				if (!empty($menudia[$campo])) {
					$pdf->SetX($offsetX + 10);
					$pdf->Cell($anchoMitad - 20, 8, '• ' . $menudia[$campo], 0, 1);
				}
			}

			// Bebida y postre
			$pdf->Ln(4);
			$pdf->SetFont($fontName, 'B', 20);
			$pdf->SetX($offsetX + 5);
			$pdf->Cell($anchoMitad - 10, 12, 'Bebida, postre y café', 0, 1);

			// Línea horizontal inferior
			$pdf->Ln(2);
			$pdf->SetX($offsetX + 5);
			$pdf->Cell($anchoMitad - 10, 0, '', 'B', 1);
			$pdf->SetFont('helvetica', '', 8);
			$y = $pdf->GetY();
			$pdf->SetXY($offsetX + 5, $y + 2);
			$pdf->Cell($anchoMitad - 15, 8, 'Precio I.V.A. Incluido | I.V.E. Engadido | Taxes Included', 0, 1, 'L');					 
			$pdf->Cell($anchoMitad - 15, 8,  'manseo.es', 0, 0, 'L');
			// Logo
			$logoPath = __DIR__ . '/../img/logo.png';
			if (file_exists($logoPath)) {
				$pdf->Image($logoPath, $offsetX + $anchoMitad - 40, $y + 2, 28);
			}
		}

		$pdf->Output($ruta_guardado, 'F');
		return true;
	} catch (Exception $e) {
		error_log("Error generando PDF duplicado: " . $e->getMessage());
		return false;
	}
}


$ejecutar=new Trabajo();
$mensaje="----<br>**********************";

// bborro el comentario
if (isset($_POST['accion'])) {
		foreach($_POST as $nombre_campo => $valor){
			$datosEnviados[$nombre_campo] = trim($valor) ;
			 $mensaje.=$nombre_campo."=".$valor."<br>" ;
		}

	if ($_POST['accion']=="modificarmenu" ){ 
		$mensaje="modificarmenu modificarmenu";
 		 $mensaje=$ejecutar->editarRegistro('tumenu',$datosEnviados);

	}
	if ($_POST['accion'] == "modificarmenudia") { 
		$mensaje = "modificarmenudia <br>";
		$mensaje .= $ejecutar->editarRegistro('menu_dia', $datosEnviados);
	
		// Verificación opcional (puede eliminarse si no hace falta)
		if (!class_exists('TCPDF')) {
			$mensaje .= "❌ La clase TCPDF no está disponible.";
		}
	
		
		
		
	
		// Llamada a la función
		$rutaPDF = __DIR__ . '/../img/menudia.pdf'; // Ajuste robusto
		if (generarMenuPDF($datosEnviados, $rutaPDF)) {
			$mensaje .= "✅ PDF generado correctamente. <a href='../img/menudia.pdf' target='_blank'>Ver PDF</a>";
		} else {
			$mensaje .= "❌ Error al generar el PDF.";
		}
		$rutaPDF = __DIR__ . '/../img/menudia_duplicado.pdf'; // Ajuste robusto
		if (generarMenuPDFDuplicado($datosEnviados, $rutaPDF)) {
			$mensaje .= "✅ PDF generarMenuPDFDuplicado correctamente. <a href='../img/menudia_duplicado.pdf' target='_blank'>Ver PDF</a>";
		} else {
			$mensaje .= "❌ Error al generar el PDF.";
		}

	}
	
	

	if ($_POST['accion']=="nuevomenu" ){ 
		$mensaje=$ejecutar->agregarRegistro($_POST['tabla'],$datosEnviados);


			}
			if ($_POST['accion']=="insertarNuevoRegistro" ){ 
				$mensaje=$ejecutar->agregarRegistro($_POST['tabla'],$datosEnviados);
		
		
					}



		if ($_POST['accion']=="eliminarregistro" ){ 
		$mensaje=$ejecutar->eliminarRegistro($_POST['tabla'],'id',$_POST['id']);
			};


		if ($_POST['accion']=="modificarcliente" ){

					$mensaje=$ejecutar->editarRegistro($_POST['tabla'],$datosEnviados);
					
				};
		if ($_POST['accion']=="guardarVacaciones" ){

			$mensaje=$ejecutar->editarRegistro('vacaciones',$datosEnviados);
			
		};
				
		if ($_POST['accion']=="guardarCarta" ){ 
				
				 $mensaje = "guardando carta<br>";
				

					// Verifica si se subió un archivo
					if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
						// Solo permite PDF
						$tipo = mime_content_type($_FILES['archivo']['tmp_name']);
						if ($tipo == "application/pdf") {
							$nombreFileOriginal=$datosEnviados['nombre'];
							$nombreFile = $nombreFileOriginal;//limpiarNombreArchivo($nombreFileOriginal);
							$archivoFile=$nombreFile."_".$datosEnviados['id'].".pdf";
							$rutaDestino = __DIR__ . "/../img/".$archivoFile; // Ruta absoluta
							$carpetaDestino = realpath(__DIR__ . "/../img") . "/";
							$imagenesGeneradas = [];

							if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaDestino)) {

								
								try {
									$imagick = new Imagick();
									$imagick->setResolution(300, 300);
									$imagick->readImage($rutaDestino);
								
									$imagenesGeneradas = [];
								
									foreach ($imagick as $i => $pagina) {
										// Asegura que la página esté en modo RGB
										$pagina->setImageColorspace(Imagick::COLORSPACE_RGB);
								
										// Clonamos la página como fondo blanco
										$background = new Imagick();
										$background->newImage($pagina->getImageWidth(), $pagina->getImageHeight(), new ImagickPixel("white"));
										$background->setImageFormat("jpg");
								
										// Componemos la página sobre fondo blanco
										$background->compositeImage($pagina, Imagick::COMPOSITE_OVER, 0, 0);
								
										// Guardar imagen
										$nombreImagen = $nombreFile . "_pag_" . ($i + 1) . ".jpg";
										$background->writeImage($carpetaDestino . $nombreImagen);
								
										$imagenesGeneradas[] = $nombreImagen;
								
										// Liberar memoria
										$background->destroy();
									}
								
									$imagick->clear();
									$imagick->destroy();
								
									$mensaje .= "<br>✅ PDF convertido correctamente con fondo blanco. Imágenes: " . implode(", ", $imagenesGeneradas);
								} catch (Exception $e) {
									$mensaje .= "<br>❌ Error: " . $e->getMessage();
								}
								
								
								/*
									$archivoPDF = $archivoFile;
									$salidaJPG = __DIR__ . '/../img/pagina_%03d.jpg'; // Patrón de nombres
									$carpetaDestino = dirname($salidaJPG); // Extrae la carpeta destino	
									$comando = "gs -dNOPAUSE -dBATCH -sDEVICE=jpeg -r150 -sOutputFile={$salidaJPG} {$archivoPDF}";
									exec($comando, $output, $return_var);

									if ($return_var === 0) {
										// Buscar archivos generados
										foreach (glob($carpetaDestino . '/pagina_*.jpg') as $archivoImagen) {
											$imagenesGeneradas[] = basename($archivoImagen);
										}
									
										$mensaje.= "Imágenes generadas correctamente: " . implode(', ', $imagenesGeneradas);
									} else {
										$mensaje.= "Error ejecutando Ghostscript.";
									}
								*/

								$mensaje.= "Archivo PDF guardado correctamente como carta.pdf <br>".$rutaDestino;
								$datosEnviados['archivo']=$archivoFile;
								$datosEnviados['imagen']=implode(", ", $imagenesGeneradas);;
							

								// Aquí puedes actualizar el campo 'archivo' en la base de datos si lo necesitas
							} else {
								$mensaje.= "Error al mover el archivo PDF.<br>";
							}
						} else {
							$mensaje.= "El archivo debe ser un PDF.<br>";
						}
					} else {
						$mensaje.= " No se subió ningún archivo PDF.<br>";
					}
					$mensaje.=$ejecutar->editarRegistro('cartas',$datosEnviados);
 
		}


		if ($_POST['accion']=="guardarFoto" ){ 
				
			$mensaje = "guardando guardarFoto<br>";
		   

			   // Verifica si se subió un archivo
			   
			   if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
				   // Solo permite PDF
				   $tipoMime = mime_content_type($_FILES['imagen']['tmp_name']);
				   if (strpos($tipoMime, 'image/') === 0) {
					$ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
					$nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($_FILES['imagen']['name'], PATHINFO_FILENAME));
					$nuevoNombre = $nombreLimpio . '_' . time() . '.' . $ext;


					   //$nombreFileOriginal=$datosEnviados['nombre'];
					   //$nombreFile = $nombreFileOriginal;//limpiarNombreArchivo($nombreFileOriginal);
					   $archivoFile=$nuevoNombre;
					   $rutaDestino = __DIR__ . "/../img/".$datosEnviados['seccion']."/".$archivoFile; // Ruta absoluta
					 

					   if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {

						   
						  

						   $mensaje.= "Archivo imagen guardado correctamente  <br>".$rutaDestino;
						   $datosEnviados['imagen']=$archivoFile;
						   
					   

						   // Aquí puedes actualizar el campo 'archivo' en la base de datos si lo necesitas
					   } else {
						   $mensaje.= "Error al mover el archivo imagen.<br>";
					   }
				   } else {
					   $mensaje.= "El archivo debe ser un imagen.<br>";
				   }
			   } else {
				   $mensaje.= " No se subió ningún archivo imagen.<br>";
			   }
				   
			   $mensaje.=$ejecutar->editarRegistro('fotos',$datosEnviados);

   }
   
		




}
echo $mensaje;


 
?>